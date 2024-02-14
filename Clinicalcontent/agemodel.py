import spacy
import re

# Load the spaCy model with the named entity recognition component
nlp = spacy.load("en_core_web_sm")

# Example sentences containing age information
sentences = [
    "John is 24 years old.",
    "Mary is 30.",
    "The CEO, Sarah Brown, is 45 years old.",
    "Thomas is a software developer, 25 years old"
]

# Regular expression pattern to match age formats like "24 years old", "24", or "24 years"
age_pattern = r'(\d{1,3})\s*(years\s*old|years|\b)'

# Compile the regular expression pattern
age_regex = re.compile(age_pattern, re.IGNORECASE)

# Function to extract age from a sentence
def extract_age(sentence):
    doc = nlp(sentence)
    matches = age_regex.search(sentence)
    if matches:
        age = matches.group(1)
        return int(age)
    return None

# Extract and print age from each sentence
for sentence in sentences:
    age = extract_age(sentence)
    if age:
        print(f"Age: {age} | Sentence: {sentence}")
    else:
        print(f"No age found in: {sentence}")
