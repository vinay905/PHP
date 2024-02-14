import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn import preprocessing
import numpy as np
import spacy
import re
from flask import Flask, jsonify, request
from flask_cors import CORS 
app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

@app.route('/summarize', methods=['POST'])
def summarize():
    data = request.json
    patient_case = data.get('patientCase')

    training = pd.read_csv('Data/Training.csv')
    testing= pd.read_csv('Data/Testing.csv')
    cols = training.columns[:-1].tolist()
    x = training[cols]
    y = training['prognosis']


    reduced_data = training.groupby(training['prognosis']).max()

    #mapping strings to numbers
    le = preprocessing.LabelEncoder()
    le.fit(y)
    y = le.transform(y)


    x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.33, random_state=42)
    testx    = testing[cols]
    testy    = testing['prognosis']  
    testy    = le.transform(testy)
    clf1  = DecisionTreeClassifier()
    clf = clf1.fit(x_train,y_train)

    nlp = spacy.load("en_core_web_sm")

    def extract_features(input_text):
        doc = nlp(input_text)

        name = ""
        age = ""
        gender = ""
        symptoms = []
        diagnosed_disease = ""
        age_pattern = r'(\d{1,3})\s*(years\s*old|years|\b)'
        male_patterns = [r'\b(male|man)\b', r'\bhe\b', r'\bhis\b']
        female_patterns = [r'\b(female|woman)\b', r'\bshe\b', r'\bher\b']

        # Function to check if any pattern matches the input text
        def find_gender(text, patterns):
            for pattern in patterns:
                if re.search(pattern, text, re.IGNORECASE):
                    return True
            return False

        # Gender identification
        if find_gender(patient_case, male_patterns):
            gender = "male"
        elif find_gender(patient_case, female_patterns):
            gender = "female"
        else:
            gender = "unknown"
        # Find all matches of the age pattern in the input text
        age_regex = re.compile(age_pattern, re.IGNORECASE)
        matches = age_regex.search(patient_case)
        if matches:
            age = matches.group(1)
            age= int(age)

        for entity in doc.ents:
            if entity.label_ == "PERSON":  
                name=entity.text
            elif entity.label_ == "SYMPTOM"or"symptoms":
                symptoms_start_index = input_text.lower().find("symptoms") + len("symptoms")
                symptoms_text = input_text[symptoms_start_index:].strip()

                # Remove trailing period if present
                stop_index = symptoms_text.find('.')
                if stop_index != -1:
                    symptoms_text = symptoms_text[:stop_index]

                # Remove leading colon if present
                if symptoms_text.startswith(':'):
                    symptoms_text = symptoms_text[1:]

                # Split symptoms based on commas (and trim spaces)
                symptoms = [symptom.strip() for symptom in symptoms_text.split(",")]

                input_symptoms = np.zeros(len(cols), dtype=int)  
                for symptom in symptoms:
                    if symptom in cols:
                        input_symptoms[cols.index(symptom)] = 1  

                
                predicted_disease_encoded = clf.predict([input_symptoms])[0]  
                diagnosed_disease = le.inverse_transform([predicted_disease_encoded])[0]
            elif entity.label_ == "PERSON" and not name:
                name = entity.text
            elif entity.label_ == "DATE" and len(entity.text.split()) == 1:
                age = entity.text

        return {
            "name": name,
            "age": age,
            "gender": gender,
            "symptoms": symptoms,
            "diagnosed_disease": diagnosed_disease
        }

    
    extracted_features = extract_features(patient_case)
    print(extracted_features)

    response_data = {
        'summary': extracted_features
    }

    return jsonify(response_data)

if __name__ == '__main__':
    app.run(debug=True)
