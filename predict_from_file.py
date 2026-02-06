import sys
import pandas as pd
import joblib  # or pickle, depending on what you saved the model with

def main():
    if len(sys.argv) < 2:
        print("Usage: python predict_from_file.py <file_path>")
        return

    file_path = sys.argv[1]
    
    # Load file
    if file_path.endswith(".csv"):
        df = pd.read_csv(file_path)
    elif file_path.endswith(".xlsx"):
        df = pd.read_excel(file_path)
    else:
        print("Unsupported file format.")
        return

    # Load trained model
    model = joblib.load("model/bayesian_random_forest.pkl")

    # Preprocess features (ensure to match training format)
    features = df  # Assuming input is already in correct format

    # Predict
    predictions = model.predict(features)

    # Print predictions
    for i, price in enumerate(predictions):
        print(f"Home {i + 1}: ₹{price:,.2f}")

if __name__ == "__main__":
    main()
