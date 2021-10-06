import decimal
from decimal import Decimal as Dec
import csv
import matplotlib.pyplot as plt

CSV_PATH = "data.csv"
ROUNDING = False
ROUNDING_NUM = Dec("1." + "0" * 4)


def csv_reader(name: str):
    """
    Чтение csv-файла
    :param name: имя файла
    :return: Словарь с двумя словарями: x, y
    """
    data = []
    with open(CSV_PATH, "r") as file:
        reader = csv.DictReader(file, delimiter=';')
        for row in reader:
            row = {key: Dec(str(value)) for key, value in row.items()}
            data.append(row)
    return data


def lagrange(data: list, x: Dec):
    """
    Формула Лагранжа, интерполяционный многочлен
    """
    if x < min([i['x'] for i in data]) or x > max([i['x'] for i in data]):
        raise ValueError(
            f"Несоответствующее значение \"{x}\" точки, значение должно быть в интевале [{min([i['x'] for i in data])}, {max([i['x'] for i in data])}]")
    interval = 0
    while x > data[interval]['x']:
        interval += 1
    res = Dec()
    # print(f"Точка \"{x}\" находится в(во) {interval} интервале")
    for i in range(interval + 1):
        tmp = [j for j in range(interval + 1)]
        tmp.remove(i)
        q = Dec("1")
        for j in tmp:
            q *= (x - data[j]['x']) / (data[i]['x'] - data[j]['x'])
        res += data[i]['y'] * q
    if ROUNDING:
        res = res.quantize(ROUNDING_NUM)
    return res


def main():
    data = csv_reader(CSV_PATH)
    # print(data)
    new = input(
        f"Введите искомые данные(через пробел) в интервале "
        f"[{min([i['x'] for i in data])}, {max([i['x'] for i in data])}]:\n").split(" ")
    new = list(map(lambda i: {'x': Dec(i)}, new))
    for i in new:
        i['y'] = lagrange(data, i['x'])
        print(f"x = {i['x']}  -->  y = {i['y']}")

    if input("Построить график? (y/n) ").upper() == 'Y':
        plt.plot(i)

        plt.show()


def test():
    # tt = [1, 3, 2]
    # print(tt)
    # print(list(map(lambda x: x + 1, tt)))
    # ss = {'x': 1, 'y': 2}
    # print(ss)
    # ss = {key: Dec(str(value)) for key, value in ss.items()}
    # for i in ss.keys():
    #     ss[i] = Dec(str(ss[i]))
    # print(ss)
    data = csv_reader(CSV_PATH)
    print(data)
    # a = Dec(input())
    # lagrange(data, a)
    # interval = 5
    # ff = [j for j in range(interval + 1)]
    # print(ff)
    # ff.remove(Dec(str(3)))
    # print(ff)


if __name__ == "__main__":
    decimal.getcontext().rounding = decimal.ROUND_HALF_UP
    plt.grid(True)
    # print(decimal.getcontext())
    main()
    # test()


import decimal
from decimal import Decimal as Dec
import csv
import numpy as np
import sympy as sp
import matplotlib.pyplot as plt

CSV_PATH = "data.csv"
ROUNDING = False
ROUNDING_NUM = Dec("1." + "0" * 4)
X = sp.symbols('x')


def csv_reader(name: str):
    """
    Чтение csv-файла
    :param name: имя файла
    :return: Словари x и y
    """
    x = []
    y = []
    with open(CSV_PATH, "r") as file:
        reader = csv.DictReader(file, delimiter=';')
        for row in reader:
            x.append(Dec(str(row['x'])))
            y.append(Dec(str(row['y'])))
    return [x, y]


def lagrange(x: list, y: list, p: Dec):
    """
    Формула Лагранжа, интерполяционный многочлен
    """
    if p < min(x) or p > max(x):
        raise ValueError(
            f"Несоответствующее значение \"{p}\" точки, значение должно быть в интевале [{min(x)}, {max(x)}]")
    interval = 0
    while p > x[interval]:
        interval += 1
    res = Dec()
    # print(f"Точка \"{x}\" находится в(во) {interval} интервале")
    for i in range(interval + 1):
        tmp = [j for j in range(interval + 1)]
        tmp.remove(i)
        q = Dec("1")
        for j in tmp:
            q *= (p - x[j]) / (x[i] - x[j])
        res += y[i] * q
    if ROUNDING:
        res = res.quantize(ROUNDING_NUM)
    return res


def print_res(x: list, y: list):
    for i in range(len(x)):
        print(f"x = {x[i]}  -->  y = {y[i]}")


def func(function, x):
    """
    Нахожднение значения ф-ии в точке
    :param function: Функция
    :param x: Точка
    :return: Значение ф-ии в точке
    """
    return function.subs(X, x)


def diff_funcs(function, n, x):
    """
    Нахожднение значения производной n-го порядка в точке
    :param function: Функция
    :param n: Порядок производной
    :param x: Точка
    :return: Значение производной n-ого порядка
    """
    diff = sp.diff(function, X, n)
    return diff.subs(X, x)


def main():
    # x, y = csv_reader(CSV_PATH)
    fun = X ** 2  # sp.S(input("f(x) = "))
    print(fun)
    a, b = Dec("1"), Dec("3")  # list(map(lambda f: Dec(f), input("Введите интервал [a, b](через пробел):  ").split(" ")))
    c = Dec("0.1")  # Dec(input("Введите шаг:  "))

    x = list(filter(lambda f: f <= b, [i for i in np.arange(a, b + c, c)]))  # Формирование списка x
    y = [func(fun, i) for i in x]  # Формирование списка y

    new_x = list(map(lambda f: Dec(f), input(f"Введите искомые данные(через пробел) в интервале [{a}, {max(x)}]:  ").split(" ")))

    print('\n"""          Интерполяция многочленами. Формула Лагранжа          """\n' + '"' * 69)
    lagrange_y = [lagrange(x, y, new_x[i]) for i in range(len(new_x))]  # Список  новых значений y через формулу Лагранжа
    print_res(new_x, lagrange_y)

    # print('\n"""            Интерполяция многочленами. Схема Эйткена           """\n' + '"' * 69)

    input("\nДля продолжения нажмите Enter")
    plt.plot(x, y)  # График исходной ф-ии
    plt.plot(new_x, lagrange_y, '*')
    plt.show()


def test():
    # tt = [1, 3, 2]
    # print(tt)
    # print(list(map(lambda x: x + 1, tt)))
    # ss = {'x': 1, 'y': 2}
    # print(ss)
    # ss = {key: Dec(str(value)) for key, value in ss.items()}
    # for i in ss.keys():
    #     ss[i] = Dec(str(ss[i]))
    # print(ss)
    # data = csv_reader(CSV_PATH)
    # print(data)
    # a = Dec(input())
    # lagrange(data, a)
    # interval = 5
    # ff = [j for j in range(interval + 1)]
    # print(ff)
    # ff.remove(Dec(str(3)))
    # print(ff)
    # funtest = X ** 2 - 2.3
    # fun = sp.evaluate(input("f(x) = "))
    # str = "x ^ y - 2.3"
    # result = sp.S(str)
    # print(type(result))
    # print(result)
    # print(type(funtest))
    # print(funtest)
    pass

def test():
    a = [1, 2]
    print(a)
    a = a + [3, 4]
    dd = lambda qq: max(a + [qq])
    print(dd(0))
    print(a)
    xx = 5
    items = [1, 2, 3, 4, 5]
    sum_all = reduce(lambda x, y: x * y, items)
    print(sum_all)
    print(reduce(lambda x, y: x * y, list((xx - i) for i in a)))
    pass


if __name__ == "__main__":
    decimal.getcontext().rounding = decimal.ROUND_HALF_UP
    plt.grid(True)
    # print(decimal.getcontext())
    main()
    # test()
