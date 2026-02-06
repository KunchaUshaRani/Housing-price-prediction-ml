# predict_price.py
import sys
import joblib
import json

# Receive input as JSON string
input_data = json.loads(sys.argv[1])

# Load the model
model = joblib.load("house_price_model.pkl")

# Prediction (expects dict with correct keys)
X_input = [input_data]  # Single record in list
prediction = model.predict(X_input)[0]

# Print result for PHP to capture
print(f"{prediction:.2f}")
