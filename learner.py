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
    a = {'foo': 3}
    return json.dumps(a)


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