# Решающие деревья
import os
import numpy as np
from sklearn.metrics import accuracy_score
import itertools
from sklearn.impute import SimpleImputer
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier


def main():
    file_name = os.path.dirname(__file__) + "\\data\\heart_data.csv"
    test_size = .3
    n = 10

    data = np.genfromtxt(file_name, delimiter=',', skip_header=True)
    data_X = data[:, :-1]
    data_Y = data[:, -1]

    train_x, test_x, train_y, test_y = train_test_split(data_X, data_Y, test_size=test_size, stratify=data_Y,
                                                        random_state=1)
    print(f"Общий размер данных:{len(data)}\n"
          f"Обучающая выборка: x{len(train_x)},y{len(train_y)}\n"
          f"Тестовая выборка: x{len(test_x)},y{len(test_y)}\n"
          f"{'~'*10}")

    imp = SimpleImputer(missing_values=np.nan, strategy="mean")
    imp.fit(train_x)
    train_x = imp.transform(train_x)
    test_x = imp.transform(test_x)
    # print(train_x)

    best_result = []

    for max_depth, min_samples_leaf in itertools.product(range(2, 20), range(2, 20)):
        drc = DecisionTreeClassifier(max_depth=max_depth, min_samples_leaf=min_samples_leaf)
        drc.fit(train_x, train_y)

        pred = drc.predict(test_x)
        x = accuracy_score(test_y, pred)
        best_result.append((x, max_depth, min_samples_leaf))

    # print(max(best_result))
    best_max_depth = max(best_result)[1]
    best_min_samples_leaf = max(best_result)[2]

    print(f"Наилучшая глубина дерева = {best_max_depth}\n"
          f"Наилучшее минимальное количество выборок, необходимых для конечного узла = {best_min_samples_leaf}\n"
          f"{'~'*10}")

    answer = 0
    for i in range(n):
        train_x, test_x, train_y, test_y = train_test_split(data_X, data_Y, test_size=test_size, stratify=data_Y)
        imp.fit(train_x)
        train_x = imp.transform(train_x)

        drc = DecisionTreeClassifier(max_depth=best_max_depth, min_samples_leaf=best_min_samples_leaf)
        drc.fit(train_x, train_y)

        test_x = imp.transform(test_x)
        pred = drc.predict(test_x)
        x = accuracy_score(test_y, pred)

        print(f"{i+1:>2}.Точность:  {(x * 100):.6f}%")
        answer += x

    print(f"{'~'*10}\n"
          f"Средняя точность: {(answer / n * 100):.6f}% за {n} разбиений")


def test():
    pass


if __name__ == "__main__":
    main()
    # test()
