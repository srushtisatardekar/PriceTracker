import pymysql
#import csv

# open connection
connection = pymysql.connect(host="localhost",user="root",passwd="",database="wishlist_pricetracker" )
cursor = connection.cursor()

#change this query to delete whatever you need
query = "DELETE FROM price_tracker where Batch_id=1;"
cursor.execute(query)

# commit changes to sql and close connection
connection.commit()
connection.close()