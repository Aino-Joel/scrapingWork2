import requests
from bs4 import BeautifulSoup
import mysql.connector

con = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database = "scraper_data"
)

mycursor = con.cursor()

sql = "INSERT INTO scraped (company_name, required_skills, more_info) VALUES (%s, %s, %s)"

def find_jobs():
    req = requests.get("https://www.timesjobs.com/candidate/job-search.html?searchType=personalizedSearch&from=submit&txtKeywords=python&txtLocation=")

    soup = BeautifulSoup(req.content, "lxml")

    jobs = soup.find_all("li", class_="clearfix job-bx wht-shd-bx")

    for job in jobs:
        published_date = job.find('span', class_='sim-posted').span.text
        company_name = job.find('h3', class_='joblist-comp-name').text.replace(" ","")
        skills = job.find('span', class_='srp-skills').text.replace(" ","")
        more_info = job.header.h2.a['href']
        val = (company_name, skills, more_info)
        mycursor.execute(sql, val)
        con.commit()
            # print(f"Company Name: {company_name.strip()}\n")
            # print(f"Required Skills: {skills.strip()}\n")
            # print(f"More Info: {more_info}\n")
    mycursor.close()
    con.close()

find_jobs()

print('Done')