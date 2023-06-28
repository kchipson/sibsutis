# Метод линейной регрессии
import os
import pandas as pd
from sklearn import preprocessing
from sklearn.linear_model import *
from sklearn.model_selection import train_test_split


def calculate_accuracy(data, test_size):
    data_X = preprocessing.normalize(data[:, :-1])
    data_Y = data[:, -1]
    train_x, test_x, train_y, test_y = train_test_split(data_X, data_Y, test_size=test_size, stratify=data_Y)
    linear_regression = LinearRegression()
    linear_regression.fit(train_x, train_y)
    predicted = linear_regression.predict(test_x)
    success = 0
    for i in range(len(test_x)):
        if abs(test_y[i] - predicted[i]) < 1:
        # if abs(test_y[i] - predicted[i]) / abs(test_y[i])*100) < 5: # Выражение в процентном соотношении
            success += 1
    return success / len(test_x) * 100

def main():
    # Вариант: 12
    # Модель: 1
    #     1. Использовать классическую модель LinearRegression
    file_name = os.path.dirname(__file__) + "\\data\\winequalityN.csv"
    test_size = .3
    n = 10

    data = pd.read_csv(file_name, header=0).fillna(0)
    data.loc[data.type == 'white', 'type'] = 0
    data.loc[data.type == 'red', 'type'] = 1

    data = data.to_numpy()
    print(f"Общий размер данных:{len(data)}\n"
          f"{'~'*10}")

    print(f'Все вина:')
    total = 0
    for i in range(n):
        acc = calculate_accuracy(data, test_size)
        print(f"{i + 1:>2}.Точность:  {acc :.6f}%")
        total += acc
    print(f'Средняя точность: {(total / n):.6f}% за {n} проходов\n\n')

    print(f'Белые вина:')
    white = data[data[:, 0] == 0]
    total = 0
    for i in range(n):
        acc = calculate_accuracy(white, test_size)
        print(f"{i + 1:>2}.Точность:  {acc :.6f}%")
        total += acc
    print(f'Средняя точность: {(total / n):.6f}% за {n} проходов\n\n')

    print(f'Красные вина:')
    red = data[data[:, 0] == 1]
    total = 0
    for i in range(n):
        acc = calculate_accuracy(red, test_size)
        print(f"{i + 1:>2}.Точность:  {acc :.6f}%")
        total += acc
    print(f'Средняя точность: {(total / n):.6f}% за {n} проходов')

def test():
    var = 12
    print(f"Модель: {(var % 4) + 1}")
    file_name = os.path.dirname(__file__) + "\\data\\winequalityN.csv"
    data = pd.read_csv(file_name, header=0).fillna(0)
    data.loc[data.type == 'white', ('type')] = 0
    data.loc[data.type == 'red', ('type')] = 1

    data = data.to_numpy()
    white = data[data[:, 0] == 0]
    print(len(data), len(white))
    pass


if __name__ == "__main__":
    main()
    # test()
