import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn import preprocessing
import numpy as np
import spacy
import re
training = pd.read_csv('Data/Training.csv')
testing= pd.read_csv('Data/Testing.csv')
cols = training.columns[:-1].tolist()
x = training[cols]
y = training['prognosis']
y1= y


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


# Load the English language model
nlp = spacy.load("en_core_web_sm")

# Define a function to extract features from the input text
def extract_features(input_text):
    # Process the input text using spaCy
    doc = nlp(input_text)

    # Initialize variables to store extracted information
    name = ""
    age = ""
    gender = ""
    symptoms = []
    diagnosed_disease = ""
    age_pattern = r'\b\d+\s*(?:years\s*old|years)?\b'

    # Find all matches of the age pattern in the input text
    ages = re.findall(age_pattern, input_text, re.IGNORECASE)

    # Extracting the first matched age (assuming there's only one age mentioned)
    if ages:
        age = ages[0]
    # Iterate over the entities in the processed text
    for entity in doc.ents:
        if entity.label_ == "PERSON":
            # Extract the patient's name
            name = entity.text
        elif entity.label_ == "SYMPTOM"or"symptoms":
    # Finding the index of "symptoms" in the input text
            symptoms_start_index = input_text.lower().find("symptoms") + len("symptoms")
            symptoms_text = input_text[symptoms_start_index:].strip()

            # Remove trailing period if present
            stop_index = symptoms_text.find('.')
            if stop_index != -1:
                symptoms_text = symptoms_text[:stop_index]

            # Remove leading colon if present
            if symptoms_text.startswith(':'):
                symptoms_text = symptoms_text[1:]
            symptoms = [symptom.strip() for symptom in symptoms_text.split(",")]
            input_symptoms = np.zeros(len(cols), dtype=int)  # Create an empty input array with zeros
            for symptom in symptoms:
                if symptom in cols:
                    input_symptoms[cols.index(symptom)] = 1  # Set the corresponding feature to 1 if the symptom is present

            # Make prediction using the trained classifier
            predicted_disease_encoded = clf.predict([input_symptoms])[0]  # Assuming clf is your trained decision tree classifier
            # Inverse transform the predicted disease code to get the actual disease name
            diagnosed_disease = le.inverse_transform([predicted_disease_encoded])[0]
        elif entity.label_ == "PERSON" and not name:
            # Extract the patient's name if not already extracted
            name = entity.text
        elif entity.label_ == "DATE" and len(entity.text.split()) == 1:
            # Extract the patient's age if only the year is mentioned
            age = entity.text
    if "male" or "man" in input_text.lower():
        gender = "male"
    elif "female" or "woman" in input_text.lower():
        gender = "female"
    # Return the extracted features as a dictionary
    return {
        "name": name,
        "age": age,
        "gender": gender,
        "symptoms": symptoms,
        "diagnosed_disease": diagnosed_disease
    }

# Example input text
input_text = "the patient name was vinay singh a male 23years old, suffering from SYMPTOMS:itching,skin_rash,nodal_skin_eruptions"

# Extract features from the input text
extracted_features = extract_features(input_text)

# Print the extracted features
print(extracted_features)