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
# Group by dates
weight_df = df.groupby('Dates', as_index=False)["Weight"].mean()
fitness_df = df.groupby('Dates', as_index=False)["Calories", "Protein", "Carbohydrates", "Sugars"].sum()
# Merge weight and fitness dataframes and convert to numpy array
merge_df = pd.merge(weight_df, fitness_df, on='Dates')
merge_df = merge_df.drop(columns = "Dates")
data = merge_df.values

# Build the data
# Defining training and test data
n = merge_df.shape[0]
p = merge_df.shape[1]
train_start = 0
train_end = int(np.floor(0.8*n))
test_start = train_end
test_end = n
data_train = data[train_start:train_end, :]
data_test = data[np.arange(test_start, test_end), :]

# Scale the data
scaler = MinMaxScaler()
scaler.fit(data_train)
data_train = scaler.transform(data_train)
data_test = scaler.transform(data_test)

# Build X and y
x_train = data_train[:, 1:]
y_train = data_train[:, 0]
x_test = data_test[:, 1:]
y_test = data_test[:, 0]

# Run tensorflow
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'
# Set number of neurons as numer of inputs plus outputs
n_neurons = p+1

# Start a session
net = tf.InteractiveSession()

# Define placeholders
X = tf.placeholder(dtype=tf.float32, shape=[None, p])
Y = tf.placeholder(dtype=tf.float32, shape=[None])

# Initializers using default variance_scaling_initializer
sigma = 1
weight_initializer = tf.variance_scaling_initializer(mode="fan_avg", distribution="uniform", scale=sigma)
bias_initializer = tf.zeros_initializer()

# Set hidden weights and bias
hidden_weight = tf.Variable(weight_initializer([p, n_neurons]))
hidden_bias = tf.Variable(bias_initializer([n_neurons]))

# Set output weights and bias
output_weight = tf.Variable(weight_initializer([n_neurons, 1]))
output_bias = tf.Variable(bias_initializer([1]))

# Hidden layer
hidden_layer = tf.nn.relu(tf.add(tf.matmul(X, hidden_weight), hidden_bias))

# Output layer
out = tf.transpose(tf.add(tf.matmul(hidden_layer, output_weight), output_bias))

# Cost function
mse = tf.reduce_mean(tf.squared_difference(out, Y))

# Optimizer
opt = tf.train.AdamOptimizer().minimize(mse)

# Init
net.run(tf.global_variables_initializer())

# Setup plot
plt.ion()
fig = plt.figure()
ax1 = fig.add_subplot(111)
line1, = ax1.plot(y_test)
line2, = ax1.plot(y_test * 0.5)
plt.show()

# Fit neural net
batch_size = 5
mse_train = []
mse_test = []

# Run
epochs = 10
for e in range(epochs):
    mse_train.append(net.run(mse, feed_dict={X: x_train, Y: y_train}))
    mse_test.append(net.run(mse, feed_dict={X: x_test, Y: y_test}))
    print('MSE Train: ', mse_train[-1])
    print('MSE Test: ', mse_test[-1])
    # Prediction
    pred = net.run(out, feed_dict={X: x_test})
    line2.set_ydata(pred)
    plt.pause(0.01)