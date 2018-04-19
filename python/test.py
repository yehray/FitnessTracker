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

weight_df['Weight'] = weight_df['Weight'] - weight_df['Weight'].shift(-1)
weight_df.iloc[-1,-1]= 0

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
max_weight = weight_df["Weight"].max().astype(np.int32) 

# Set number of neurons as maximum weight*2
n_neurons = 180

# Start a session
net = tf.InteractiveSession()

# Define placeholders
X = tf.placeholder(dtype=tf.float32, shape=[None, 4])
Y = tf.placeholder(dtype=tf.float32, shape=[None])

# Initializers using default variance_scaling_initializer
sigma = 1
weight_initializer = tf.variance_scaling_initializer(mode="fan_avg", distribution="uniform", scale=sigma)
bias_initializer = tf.zeros_initializer()

# Set hidden weights and bias
hidden_weight = tf.Variable(weight_initializer([4, n_neurons]))
hidden_bias = tf.Variable(bias_initializer([n_neurons]))

# Set output weights and bias
output_weight = tf.Variable(weight_initializer([n_neurons, 1]))
output_bias = tf.Variable(bias_initializer([1]))

# Hidden layer using rectified linear unit
hidden_layer = tf.nn.relu(tf.add(tf.matmul(X, hidden_weight), hidden_bias))

# Output layer
out = tf.transpose(tf.add(tf.matmul(hidden_layer, output_weight), output_bias))

# Use mean squared error as cost function
mse = tf.reduce_mean(tf.squared_difference(out, Y))

# Optimizer
opt = tf.train.AdamOptimizer().minimize(mse)

# Init
net.run(tf.global_variables_initializer())

# Run
mse_train = []
mse_test = []
epochs = 10
batch_size = 5

for e in range(epochs):

    # Shuffle training data
    shuffle_indices = np.random.permutation(np.arange(len(y_train)))
    x_train = x_train[shuffle_indices]
    y_train = y_train[shuffle_indices]

 # Minibatch training
    for i in range(0, len(y_train) // batch_size):
        start = i * batch_size
        batch_x = x_train[start:start + batch_size]
        batch_y = y_train[start:start + batch_size]
        # Run optimizer with batch
        net.run(opt, feed_dict={X: batch_x, Y: batch_y})

        mse_train.append(net.run(mse, feed_dict={X: x_train, Y: y_train}))
        mse_test.append(net.run(mse, feed_dict={X: x_test, Y: y_test}))
        # print('MSE Train: ', mse_train[-1])
        # print('MSE Test: ', mse_test[-1])

# Prediction
pred = net.run(out, feed_dict={X: x_test})
# print(pred)
mse_final = net.run(mse, feed_dict={X: x_test, Y: y_test})
print(mse_final)

# Final Prediction
# data = scaler.transform(data)
x_train = np.matrix(data[-1, 1:])
print(x_train)

pred = net.run(out, feed_dict={X: x_train})
print(pred[0][0])

