import sys
import MySQLdb

db = MySQLdb.connect(host="localhost", user="root", passwd="password", db="fitness_database") 
cur = db.cursor()
cur.execute("SELECT * FROM DailyFoodData")

# print all the first cell of all the rows
for row in cur.fetchall():
    print(row[3])

db.close()

print (sys.argv[1])
hello = "hello"
world = "world"
print(hello + " " + world)