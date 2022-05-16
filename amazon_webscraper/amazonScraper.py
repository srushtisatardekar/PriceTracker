import requests
from glob import glob
from bs4 import BeautifulSoup
import pandas as pd
import pymysql
import csv

#Headers for browsers for scraping
HEADERS = ({'User-Agent':
            'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
            'Accept-Language': 'en-US, en;q=0.5'})

# scrape function is based on and modified from https://github.com/fnneves/amazon_webscraper
def scrape(): #interval_count refers to how many times we want the scraper to run in an instance
    readProductQueries() #read product entries from SQL
    prod_tracker = pd.read_csv('trackers/trackedProducts.csv', sep=',') #read from created csv file
    prod_tracker_URLS = prod_tracker.url
    
    queryList = []

    #Loop through all product ids/URLs in order to scrape price for each product
    for x, url in enumerate(prod_tracker_URLS):
        page = requests.get(url, headers=HEADERS)
        soup = BeautifulSoup(page.content, features="lxml")
        
        #scraping product title
        title = soup.find(id='productTitle').get_text().strip()
        
        # to prevent script from crashing when there isn't a price for the product
        try: 
            # dollar and cents spans are separate on amazon store page so they must be added together each time
            price = float(soup.find("span", {"class": "a-price-whole"}).get_text().replace('.', '').replace('€', '').replace(',', '').strip()) + (float(soup.find("span", {"class": "a-price-fraction"}).get_text().replace('$', '').replace(',', '').strip()))/100
        except:
            try:
                price = float(soup.find("span", {"class": "a-price-whole"}).get_text().replace('$', '').replace(',', '').strip()) + (float(soup.find("span", {"class": "a-price-fraction"}).get_text().replace('$', '').replace(',', '').strip()))/100
            except:
                price = ''

        #append all of these prices and ids to queryList for use in writeProductQueries
        queryList.append((prod_tracker.id[x], price))

        print('Scraped price for: '+ str(prod_tracker.id[x]) +'\n' + title + '\n\n')            

    writeProductQueries(queryList) #write price/prod_id data to SQL 
    
    print('end of search')

#reads product queries from SQL table 'product' (URL and product ID) and puts them into a csv file for scrape() to read from
def readProductQueries():
    header = ['url', 'id']
    connection = pymysql.connect(host="localhost",user="root",passwd="",database="wishlist_pricetracker" )
    cursor = connection.cursor()

    query = "Select URL, Prod_id from product;"

    cursor.execute(query)
    rows = cursor.fetchall()

    with open('trackers/trackedProducts.csv', 'w', encoding = 'UTF8', newline='') as f: 
        writer = csv.writer(f)
        writer.writerow(header)
        writer.writerows(rows)

    connection.close()

#writes scraped price data to SQL table price_tracker with prod_id and price
def writeProductQueries(queryList):
    connection = pymysql.connect(host="localhost",user="root",passwd="",database="wishlist_pricetracker" )
    cursor = connection.cursor()

    #Test for max available batch_id  in 'price_tracker'
    currentID = "SELECT MAX(Batch_id) FROM price_tracker"
    cursor.execute(currentID)
    result = cursor.fetchall()
    for i in result:
        maximum = i[0]
    #If there are no entries in 'price_tracker' then set batch_id to 1
    if maximum is None:
        query1 = "INSERT INTO price_tracker(Prod_id, Price, Batch_id) VALUES"
        for (prod_id, price) in queryList:
            query1 = query1+"("+ str(prod_id)+ ", " + str(price) + ", 1),"
        query1 = query1[:-1]
        print(query1)
        cursor.execute(query1)
    #Else just increment batch_id by 1 for this new scrape iteration
    else:
        query2 = "INSERT INTO price_tracker(Prod_id, Price, Batch_id) VALUES"
        newmax = maximum+1
        for (prod_id, price) in queryList:
            query2 = query2+"("+ str(prod_id)+ ", " + str(price) + ", " +  str(newmax) + "),"
        query2 = query2[:-1]
        print(query2)
        cursor.execute(query2)
    #commit to finalize changes
    connection.commit()
    connection.close()

scrape()
