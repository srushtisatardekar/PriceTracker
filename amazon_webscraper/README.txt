MAKE SURE TO HAVE PYTHON, PIP, AND ALL IMPORTS/LIBRARIES/DEPENDENCIES INSTALLED
- requests
- glob 
- bs4
- pandas
- datetime
- time
- pymysql
- csv
- ....probably more that I'm forgetting, run the program from the command line and see what dependencies need to be installed and install them.


scrape() function is the main function used in this file
- It takes a csv file which includes <url, id> for each product in our SQL Database (see readProductQueries, which creates/updates this CSV file from reading from our SQL table 'product')
	- csv file is located as trackedProducts.csv under the 'trackers' file (which should not exist until first run of the code)
- Scrapes data from amazon URL, takes price data using BeautifulSoup
- Stores every (product id, price) in a list, and uses it to write SQL queries to the 'price_tracker' SQL table (see writeProductQuesties, which concatenates all these queries and executes them)

readProductQueries() 
- headers for ['url', 'id']
- opens connection to phpmyadmin mysql database using pymysql
- executes "Select URL, Prod_id from product" statement and writes them to a new csv file (will create new file if none is present)
- closes connection

writeProductQueries()
- opens connection to phpmyadmin mysql database using pymysql
- concatenates insert statement to add all entries with prod_id and price to a correponding, incrementing batch_id every time it is run
- executes insert statement and all entries are inserted into 'price_tracker' table

*Note: the insert statements for the products we are using are in the google drive under database/starting_product_query.txt
**The deleteQueries.py file is strictly for deleting entries from the 'price_tracker' table. It is not part of the scraping process at all, just for convenience during testing
***scraper_batch is the batch file that schedules this to run every x amount of time. Change the timeout number (seconds) to adjust it  