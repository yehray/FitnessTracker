import sys
import os
import MySQLdb
import pandas as pd
import numpy as np
from pandas import DataFrame
from sklearn.preprocessing import MinMaxScaler
import tensorflow as tf
import matplotlib.pyplot as plt

# Select data from MySQL
db_connection = MySQLdb.connect(host="localhost", user="root", passwd="password", db="fitness_database") 
# Create Pandas dataframe
df = pd.read_sql("SELECT * FROM DailyFoodData WHERE Username = '" + sys.argv[1] + "'", con=db_connection)