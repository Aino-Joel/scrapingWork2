from flask import Flask, request, jsonify
import subprocess
from flask_cors import CORS

app = Flask(__name__)

CORS(app)

@app.route('/execute-scraping', methods=['POST'])

def execute_scraping():
    try:
        # Execute the Python script for web scraping
        subprocess.run(["python ", "C:\wamp64\www\scrape\scraper.py"])
        return jsonify({"status": "success", "message": "Scraping completed successfully"})
    except Exception as e:
        return jsonify({"status": "error", "message": str(e)})

if __name__ == '__main__':
    app.run(debug=True)
