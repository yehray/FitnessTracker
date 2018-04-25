import MySQLdb
import json
import sys
from flask import Flask
from flaskext.mysql import MySQL
from flask_cors import CORS

app = Flask(__name__)
# added for CORS
CORS(app)
mysql = MySQL()
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = 'password'
app.config['MYSQL_DATABASE_DB'] = 'fitness_database'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)
 
@app.route("/", methods=['POST'])
def hello():
    cur = mysql.get_db().cursor()
    cur.execute('SELECT * FROM FitnessData WHERE Calories = 3')
    row_headers=[x[0] for x in cur.description] #this will extract row headers
    rv = cur.fetchall()
    json_data=[]
    for result in rv:
        json_data.append(dict(zip(row_headers,result)))
    return json.dumps(json_data, indent=4, sort_keys=True, default=str)



@app.route("/hello", methods=['POST'])
def ss():
    # connection = MySQLdb.connect(host = "localhost", user = "root", passwd = "password", db = "fitness_database")
    # cursor = connection.cursor ()
    # cursor.execute ("SELECT * FROM FitnessData")
    # data = cursor.fetchall ()
    # json.dumps("return value")

    return "hello hello world"
 
if __name__ == "__main__":
    app.run(port=5000)