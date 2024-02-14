import spacy
import pandas as pd

# Load the spaCy model with the part-of-speech tagging component
nlp = spacy.load("en_core_web_sm")

# Example sentences containing symptoms
sentences = [
    "I have itching, skin_rash, nodal_skin_eruptions.",
    "She complained of Itching.",
    "The patient presented with Constipation."
]

# List of CSV files containing symptoms data
csv_files = ["Data/Book1.csv"]  # Replace with your actual CSV file paths

# Function to extract symptoms from a sentence
def extract_symptoms(sentence, symptoms):
    doc = nlp(sentence)
    extracted_symptoms = []
    for token in doc:
        if token.text.lower() in symptoms:
            extracted_symptoms.append(token.text.lower())
    return extracted_symptoms

# Load each CSV file and check for symptoms in the sentences
for csv_file in csv_files:
    # Load the CSV file
    df = pd.read_csv(csv_file)

    # Get the list of symptoms from the CSV file
    symptoms = df['SYMPTOMS'].tolist()

    # Process each sentence and check for symptoms
    for sentence in sentences:
        extracted_symptoms = extract_symptoms(sentence, symptoms)
        if extracted_symptoms:
            print(f"Symptoms: {', '.join(extracted_symptoms)} | Sentence: {sentence} | File: {csv_file}")
        else:
            print(f"No symptoms found in: {sentence} | File: {csv_file}")
