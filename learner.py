import MySQLdb
import sys

connection = MySQLdb.connect(host = "localhost", user = "root", passwd = "7UPdrinker", db = "fitness_database")

cursor = connection.cursor ()
cursor.execute ("SELECT * FROM FitnessData")
data = cursor.fetchall ()
for row in data:
    print(row[0], row[1])
