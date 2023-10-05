from flask import Flask, jsonify
import subprocess
from flask_cors import CORS

# Create a Flask web application
app = Flask(__name__)

# Enable CORS (Cross-Origin Resource Sharing) for the Flask app
CORS(app)

# Define a route that listens for HTTP POST requests at '/execute-scraping'
@app.route('/execute-scraping', methods=['POST'])

def execute_scraping():
    try:
        # Execute the Python script for web scraping
        subprocess.run(["python", "C:\wamp64\www\scrape\scraper.py"])
        
        # Return a JSON response indicating success
        return jsonify({"status": "success", "message": "Scraping completed successfully"})
    
    except Exception as e:
        # If an exception occurs during execution, return a JSON response indicating an error
        return jsonify({"status": "error", "message": str(e)})

# Run the Flask app if this script is executed directly (not imported as a module)
if __name__ == '__main__':
    app.run(debug=True)
