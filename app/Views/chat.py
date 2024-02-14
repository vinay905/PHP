import random

# Define a dictionary of possible bot responses
responses = {
    "hi": ["Hello!", "Hi there!", "Hey!"],
    "how are you": ["I'm doing well, thank you.", "Not too bad. How can I help you?", "I'm okay. What can I do for you?"],
    "what can you do": ["I can help answer your questions or have a conversation with you.", "I can tell you jokes or give you suggestions.", "I can do many things, what do you need help with?"],
    "tell me a joke": ["Why did the tomato turn red? Because it saw the salad dressing!", 
                      "Why don't scientists trust atoms? Because they make up everything!", "Why don’t sharks live on land? They can’t climb trees."],
    "suggest a movie": ["How about watching The Shawshank Redemption?", "Have you seen The Godfather yet?", "You might enjoy Inception."]
}

# Define a function to get a response from the bot
def get_response(message):
    message = message.lower()

    # Check if message is a known greeting
    if message in ["hello", "hi", "hey"]:
        return random.choice(responses["hi"])

    # Check if message is asking how the bot is doing
    elif message in ["how are you", "how are you doing"]:
        return random.choice(responses["how are you"])

    # Check if message is asking what the bot can do
    elif message in ["what can you do", "what are your capabilities", "what are you capable of"]:
        return random.choice(responses["what can you do"])

    # Check if message is asking for a joke
    elif message in ["tell me a joke", "give me a joke"]:
        return random.choice(responses["tell me a joke"])

    # Check if message is asking for movie suggestions
    elif message in ["suggest a movie", "what should I watch", "recommend a movie"]:
        return random.choice(responses["suggest a movie"])

    else:
        return "I'm sorry, I didn't understand what you said."

# Start the conversation with the bot
print("Hello! I'm chatbot. How can I help you?")
while True:
    message = input()
    if message.lower() == "bye":
        print("Bye! Have a great day!")
        break
    else:
        response = get_response(message)
        print(response)