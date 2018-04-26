import sys
import os
import MySQLdb
import pandas as pd
import numpy as np
from pandas import DataFrame
from sklearn.preprocessing import MinMaxScaler
from sklearn import linear_model
import matplotlib.pyplot as plt

# Select data from MySQL
db_connection = MySQLdb.connect(host="localhost", user="root", passwd="password", db="fitness_database") 
# Create Pandas dataframe
df = pd.read_sql("SELECT * FROM DailyFoodData WHERE Username = '" + sys.argv[1] + "'", con=db_connection)
# Group by dates
weight_df = df.groupby('Dates', as_index=False)["Weight"].mean()
predictWeight = weight_df.drop(columns = "Dates")
predictWeight = predictWeight.iloc[-1:].values.tolist()

weight_df['Weight'] = weight_df['Weight'] - weight_df['Weight'].shift(1)
weight_df['Weight'] = weight_df['Weight'].shift(-1)



fitness_df = df.groupby('Dates', as_index=False)["Calories", "Protein", "Carbohydrates", "Sugars"].sum()
predictInput = fitness_df.drop(columns = "Dates")
predictInput = predictInput.iloc[-1:].values.tolist()

# Merge weight and fitness dataframes and convert to numpy array
merge_df = pd.merge(weight_df, fitness_df, on='Dates')
merge_df = merge_df.drop(columns = "Dates")
data = merge_df.values
data = data[:-1]

# Build the data
# Defining training and test data
n = data.shape[0]
p = data.shape[1]
train_start = 0
train_end = int(np.floor(0.8*n))
test_start = train_end
test_end = n
data_train = data[train_start:train_end, :]
data_test = data[np.arange(test_start, test_end), :]

# Scale the data
# scaler = MinMaxScaler()
# scaler.fit(data_train)
# data_train = scaler.transform(data_train)
# data_test = scaler.transform(data_test)

# Build X and y
x_train = data_train[:, 1:]
y_train = data_train[:, 0]
x_test = data_test[:, 1:]
y_test = data_test[:, 0]


regressor = linear_model.LinearRegression()
model = regressor.fit(x_train,y_train)
predictions = regressor.predict(x_train)
pred = regressor.predict(predictInput)
# lm.score(x_train,y_train)
y_pred = regressor.predict(x_test)
predictedWeight = predictWeight + pred
error = np.mean((regressor.predict(x_test) - y_test) ** 2)
print("Tomorrow's weight will be " + str(format(predictedWeight[0][0], '.2f')) + " with a mean squared error of " + str(format(error, '.2f')) + ".")
