import spacy

# Load the spaCy model with the named entity recognition component
nlp = spacy.load("en_core_web_sm")

# Example sentences containing names
sentences = [
    "John Smith is a software engineer at XYZ Corp.",
    "Mary Johnson works as a data scientist at ABC Inc.",
    "The CEO of DEF Corp. is Sarah Brown.",
    "That person over there is Vinay Singh."
]

# Train the model on the example sentences
for sentence in sentences:
    doc = nlp(sentence)
    for ent in doc.ents:
        if ent.label_ == "PERSON":  # Check if the entity is a person's name
            print(f"Person's Name: {ent.text} | Sentence: {sentence}")
