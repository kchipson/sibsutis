import csv
from math import sqrt
import numpy as np
from sklearn.model_selection import train_test_split
import os


def read_data(file):
    data = list()
    with open(file) as f:
        reader = csv.reader(f)
        next(reader)
        for row in reader:
            data.append(list(map(int, row)))
    return data


def distance(x1, x2):
    return sqrt((x1[0] - x2[0]) ** 2 + (x1[1] - x2[1]) ** 2)


def leave_one_out(train_x, train_y, k):
    assert len(train_y) == len(train_x)
    correct = 0
    incorrect = 0
    for i in range(len(train_x)):
        # print(i)
        index_distance = ((j, distance(train_x[i], train_x[j])) for j in range(len(train_x)))
        k_min_dist = (sorted(index_distance, key=lambda item: item[1])[1:])[:k]  # [1:] чтобы скипнуть саму точку

        # print(k_min_dist)
        classes = dict()
        # тут чет с весами должно быть
        for ind, _ in k_min_dist:
            key = train_y[ind]
            if key not in classes:
                classes[key] = 0
            classes[key] += 1
        if train_y[i] == max(classes.items(), key=lambda j: j[1])[0]:
            correct += 1
        else:
            incorrect += 1
    print(correct, incorrect)
    accuracy = correct / (correct + incorrect)
    print(f"Для k={k} процент точности={accuracy * 100}%")


def knn(train_x, train_y, test_x, test_y, k=6):
    # Не должна ли она "дообучаться" на тестовых данных?
    assert len(train_y) == len(train_x)
    assert len(test_x) == len(test_y)
    correct = 0
    incorrect = 0
    for i in range(len(test_x)):
        index_distance = ((j, distance(train_x[i], train_x[j])) for j in range(len(train_x)))
        k_min_dist = (sorted(index_distance, key=lambda item: item[1])[1:])[:k]  # [1:] чтобы скипнуть саму точку
        classes = dict()
        for ind, _ in k_min_dist:
            key = train_y[ind]
            if key not in classes:
                classes[key] = 0
            classes[key] += 1
        if test_y[i] == max(classes.items(), key=lambda j: j[1])[0]:
            correct += 1
        else:
            incorrect += 1
    print(correct, incorrect)
    accuracy = correct / (correct + incorrect)
    print(f"Процент точности алгоритма={accuracy * 100}% при k = {k}")


def main():
    # Вариант: 12
    # Классификатор: 1
    #     1. Метод k взвешенных ближайших соседей
    # Вес: 1
    #     1. w_{i} = q^i, q ∈ (0, 1)
    # Ядро: -
    # Файл: 5
    file_name = os.path.dirname(__file__) + "\\data\\data5.csv"
    test_size = .2

    #####
    # data = read_data(file_name)
    # data_0 = list(i for i in data if i[2] == 0)
    # data_1 = list(i for i in data if i[2] == 1)
    # data_0_train, data_0_test = train_test_split(data_0, test_size=test_size)
    # data_1_train, data_1_test = train_test_split(data_1, test_size=test_size)
    #
    # data_train = data_0_train + data_1_train
    # data_test = data_0_test + data_1_test
    #
    # random.shuffle(data_train)
    # random.shuffle(data_test)

    # print(len(data), len(data_train), len(data_test))
    #####

    data = np.genfromtxt(file_name, delimiter=',', skip_header=True)
    data_X = data[:, :-1]
    data_Y = data[:, -1]

    train_x, test_x, train_y, test_y = train_test_split(data_X, data_Y, test_size=test_size, stratify=data_Y, random_state=1)
    print(f'Общий размер данных:{len(data)}\n'
          f'Обучающая выборка: x{len(train_x)},y{len(train_y)}\n'
          f'Тестовая выборка: x{len(test_x)},y{len(test_y)}')

    # for i in range(1, 10):
    #     leave_one_out(train_x, train_y, i)
    knn(train_x, train_y, test_x, test_y)


def test():
    var = 12
    print(f"Классификатор: {(var % 3) + 1}")
    print(f"Вес: {(var % 2) + 1}")
    print(f"Ядро: {((var * 6 + 13) % 8 % 3) + 1}")
    print(f"Файл: {((var + 2) % 5) + 1}")

    file = os.path.dirname(__file__) + "\\data\\data5.csv"

    data = list()
    with open(file) as f:
        reader = csv.reader(f)
        next(reader)
        for row in reader:
            data.append(list(map(int, row)))

    # print(*data, sep='\n')
    pass


if __name__ == "__main__":
    main()
    # test()
