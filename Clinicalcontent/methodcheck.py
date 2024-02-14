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

# Example input text with "SYMPTOMS" keyword
input_text = "the patient name was vinay singh a male 23years old, suffering from SYMPTOMS: fatigue, cramps, bruising, obesity"
# Extracting symptoms from the input text


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

# symptoms=['fatigue', 'cramps', 'bruising', 'obesity']
print(symptoms)

input_symptoms = np.zeros(len(cols), dtype=int)  # Create an empty input array with zeros
for symptom in symptoms:
    if symptom in cols:
        input_symptoms[cols.index(symptom)] = 1  # Set the corresponding feature to 1 if the symptom is present

# Make prediction using the trained classifier
predicted_disease_encoded = clf.predict([input_symptoms])[0]  # Assuming clf is your trained decision tree classifier

# Inverse transform the predicted disease code to get the actual disease name
predicted_disease = le.inverse_transform([predicted_disease_encoded])[0]

# Returning diagnosis and symptoms as output
output = {
    "diagnosis": predicted_disease,
    "symptoms": symptoms
}

print(output)
