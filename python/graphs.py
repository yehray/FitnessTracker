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
# weight_df.time = pd.to_datetime(weight_df['Dates'], format='%Y-%m-%d')

changed_df = df.groupby('Dates', as_index=False)["Weight"].mean()
changed_df['Weight']  = changed_df['Weight'] - changed_df['Weight'].shift(-1)
changed_df.iloc[-1,-1]= 0

fig, axes = plt.subplots(nrows=2, ncols=1, figsize=(9,9))
fig.subplots_adjust(hspace=.5)

ax1 = weight_df.plot(ax=axes[0])
ax1.title.set_text('Weights')
ax1.set_xlabel('Days')
ax1.set_ylabel('Weight')
ax1.patch.set_facecolor('#f2f2f2')

ax2 = changed_df.plot(ax=axes[1], color=['red'])
ax2.title.set_text('Change in Weight')
ax2.set_xlabel('Days')
ax2.set_ylabel('Change in Weight')
ax2.legend(['Change in Weight'])
ax2.patch.set_facecolor('#f2f2f2')


timestr = time.strftime("%Y%m%d-%H%M%S")
plt.savefig("/Users/yehray/Sites/fitness_tracker/python/plots/" + str(sys.argv[1]) + timestr + ".png", facecolor='#f2f2f2')

print("python/plots/" + str(sys.argv[1]) + timestr +  ".png")




