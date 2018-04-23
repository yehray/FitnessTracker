import sys
import os
import MySQLdb
import pandas as pd
import numpy as np
from pandas import DataFrame
import matplotlib.pyplot as plt
import time

# Select data from MySQL
db_connection = MySQLdb.connect(host="localhost", user="root", passwd="password", db="fitness_database") 
# Create Pandas dataframe
df = pd.read_sql("SELECT * FROM DailyFoodData WHERE Username = '" + sys.argv[1] + "'", con=db_connection)

# Group by dates
weight_df = df.groupby('Dates', as_index=False)["Weight"].mean()
weight_df.time = pd.to_datetime(weight_df['Dates'], format='%Y-%m-%d')
weight_df.set_index(['Dates'],inplace=True)
weight_df.plot.line()
plt.title("Weights")
plt.xlabel("Dates")
plt.ylabel("Weight")
timestr = time.strftime("%Y%m%d-%H%M%S")
plt.savefig("/Users/yehray/Sites/fitness_tracker/python/plots/" + str(sys.argv[1]) + timestr + ".png")
print("python/plots/" + str(sys.argv[1]) + timestr +  ".png")

# changed_df = weight_df

# changed_df['Weight']  = changed_df['Weight'] - changed_df['Weight'].shift(-1)
# weight_df.iloc[-1,-1]= 0

# weight_df.plot.line()
# plt.title("Weights")
# plt.xlabel("Dates")
# plt.ylabel("Weight")
# plt.xticks(rotation=70)
# plt.show()

