import requests
from bs4 import BeautifulSoup
import mysql.connector

# Establish a connection to the MySQL database
con = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="scraper_data"
)

# Create a cursor to interact with the database
mycursor = con.cursor()

# SQL statement to insert data into the 'scraped' table
sql = "INSERT INTO scraped (company_name, required_skills, more_info) VALUES (%s, %s, %s)"

# Function to scrape job data from a website and insert it into the database
def find_jobs():
    # Send an HTTP GET request to the job search website
    req = requests.get("https://www.timesjobs.com/candidate/job-search.html?searchType=personalizedSearch&from=submit&txtKeywords=python&txtLocation=")

    # Parse the HTML content of the page using BeautifulSoup and lxml
    soup = BeautifulSoup(req.content, "lxml")

    # Find all job listings on the page
    jobs = soup.find_all("li", class_="clearfix job-bx wht-shd-bx")

    for job in jobs:
        # Extract data for each job listing
        # published_date = job.find('span', class_='sim-posted').span.text
        company_name = job.find('h3', class_='joblist-comp-name').text.replace(" ","")
        skills = job.find('span', class_='srp-skills').text.replace(" ","")
        more_info = job.header.h2.a['href']

        # Create a tuple with the extracted data
        val = (company_name, skills, more_info)

        # Execute the SQL query to insert the data into the database
        mycursor.execute(sql, val)

        # Commit the changes to the database
        con.commit()

        # print(f"Company Name: {company_name.strip()}\n")
        # print(f"Required Skills: {skills.strip()}\n")
        # print(f"More Info: {more_info}\n")

    # Close the cursor and database connection
    mycursor.close()
    con.close()

# Call the 'find_jobs' function to start the scraping and data insertion process
find_jobs()

# Print 'Done' when the process is complete
print('Done')
