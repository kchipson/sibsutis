import copy
import decimal
import sys
from decimal import Decimal as Dec
from functools import reduce
import csv
import numpy as np
import sympy as sp
import matplotlib
import matplotlib.pyplot as plt

CSV_PATH = "data.csv"
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


def lagrange(x: list, y: list, n: int, point: Dec):
    """
     Интерполяционный многочлен. Формула Лагранжа
    :param x: список x
    :param y: список y
    :param n: интерполяция по n точкам
    :param point: точка
    :return: Значение в точке
    """
    res = Dec()
    for i in range(n + 1):
        tmp = [j for j in range(n + 1)]
        tmp.remove(i)
        q = 1
        for j in tmp:
            q *= (point - x[j]) / (x[i] - x[j])
        res += y[i] * q

    return res.normalize()


def eitken_old(x: list, y: list, a: int, b: int, point: Dec):
    """
    Интерполяционный многочлен. Схема Эйткена
    :param x: Список x
    :param y: Список y
    :param a:
    :param b:
    :param point: Точка
    :return: Значение в точке
    """
    if a == b:
        return Dec(y[a])
    else:
        return Dec((eitken(x, y, a, b - 1, point) * (point - x[b]) - eitken(x, y, a + 1, b, point) * (point - x[a])) / (
                    x[a] - x[b]))


def eitken(x: list, y: list, point: Dec):
    """
    Интерполяционный многочлен. Схема Эйткена
    :param x: Список x
    :param y: Список y
    :param point: Точка
    :return: Значение в точке
    """
    n = len(x)
    p = list()
    p.append(y)

    for i in range(1, n):
        p.append([])
        for j in range(n - i):
            tmp = (p[i - 1][j] * (point - x[j + i]) - p[i - 1][j + 1] * (point - x[j])) / (x[j] - x[j + i])
            p[i].append(tmp)

    return p[-1][0]


def delta_y(x, h, fun):
    """
    Таблица конечных разностей
    :param x: список x
    :param h: шаг
    :param fun: функция
    :return: "Матрица" конечных разностей
    """
    for i in range(len(x) - 1):
        if x[i] + h != x[i + 1]:
            print(f"Achtung!!! интервал неравномерный или не соответствует шагу \"{h}\"")
            return []
    del_y = [[func(fun, i) for i in x]]
    (del_y[0]).append(func(fun, x[-1] + h))

    for i in range(len(del_y[0]) - 1):
        temp = []
        for j in range(len(del_y[i]) - 1):
            temp.append(del_y[i][j + 1] - del_y[i][j])
        del_y.append(temp)
    return del_y


def newton_1(x, del_y, point):
    q = (point - x[0]) / (x[1] - x[0])
    qq = 1
    res = Dec()

    for i in range(len(del_y) - 1):
        res += (del_y[i][0] / sp.factorial(i)) * qq
        qq *= (q - i)

    return res


def newton_2(x, del_y, point):
    q = (point - x[-1]) / (x[1] - x[0])
    qq = 1
    res = Dec()

    for i in range(len(del_y) - 1):
        res += (del_y[i][n - i] / sp.factorial(i)) * qq
        qq *= (q + i)

    return res


def print_res(x: list, y: list, e: list = None):
    if e:
        for i in range(len(x)):
            print(f"x = {x[i]}  -->  y = {y[i]}  |  E = {-e[i] if e[i] < 0 else e[i]}")
    else:
        for i in range(len(x)):
            print(f"x = {x[i]}  -->  y = {y[i]}")


def func(function, x):
    """
    Нахожднение значения ф-ии в точке
    :param function: функция
    :param x: точка
    :return: Значение ф-ии в точке
    """
    return Dec(str(function.subs(X, x)))


def diff_funcs(function, n, x):
    """
    Нахожднение значения производной n-го порядка в точке
    :param function: функция
    :param n: порядок производной
    :param x: точка
    :return: Значение производной n-ого порядка
    """
    diff = sp.diff(function, X, n)
    return Dec(str(diff.subs(X, x)))


def main():
    # x, y = csv_reader(CSV_PATH)

    fun = sp.sqrt(X)  # sp.S(input("f(x) = "))
    print("f(x) = ", fun)
    a, b = Dec("1"), Dec("10")
    # list(map(lambda f: Dec(f), input("Введите интервал [a, b](через пробел):  ").split(" ")))  # Dec("1"), Dec("2.5")
    c = Dec("0.1")  # Dec(input("Введите шаг:  "))  #

    x = list(filter(lambda f: f <= b, [Dec(i) for i in np.arange(a, b + c, c)]))  # Формирование списка x
    y = [func(fun, i) for i in x]  # Формирование списка y
    print("x :  ", end="")
    print(*x, sep=" ; ")
    print("y :  ", end="")
    print(*y, sep=" ; ")

    new_x = [Dec("1.21"), Dec("1.69"), Dec("1.96"), Dec("2.25"), Dec("4.41")]
    # sorted(list(map(lambda f: Dec(f), input(f"Введите искомые данные(через пробел) в интервале [{min(x)}, {max(x)}]:  ").split(" "))))  # sorted([Dec("1.69"), Dec("1.85"), Dec("1.95")])
    n = len(x) - 1
    del_y = delta_y(x, c, fun)
    # print(*del_y, sep="\n")

    lagrange_y = []
    eitken_y = []
    newton_1_y = []
    newton_2_y = []
    for i in new_x:
        if i < min(x) or i > max(x):
            raise ValueError(
                "Achtung!!! "
                f"Несоответствующее значение \"{i}\" точки, значение должно быть в интевале [{min(x)}, {max(x)}]")
        print(i)
        lagrange_y.append(lagrange(x, y, n, i))
        print("la")
        eitken_y.append(eitken(x, y, i))
        print("ei")
        if del_y:
            newton_1_y.append(newton_1(x, del_y, i))
            print("n1")
            newton_2_y.append(newton_1(x, del_y, i))
            print("n2")

    # Нахождение максимального значения производной (n+1)-ого порядка
    mxdn = lambda qq: max([diff_funcs(fun, n + 1, xx) for xx in x] + [diff_funcs(fun, n + 1, qq)])
    # Нахождение (x-x0)...(x-xn)
    pxx = lambda qq: reduce(lambda xx, yy: xx * yy, list((qq - i) for i in x))

    # TODO : В формуле не уверен 🙃:/
    e = ([Dec(str(mxdn(xx) * (pxx(xx)) / (sp.factorial(n + 1)))) for xx in new_x] if fun else [])

    print('\n"""          Интерполяция многочленами. Формула Лагранжа          """\n' + '"' * 69)
    print_res(new_x, lagrange_y)
    print('\n"""            Интерполяция многочленами. Схема Эйткена           """\n' + '"' * 69)
    print_res(new_x, eitken_y)
    print('\n"""          Интерполяция многочленами. Формула Ньютона #1        """\n' + '"' * 69)
    print_res(new_x, newton_1_y)
    print('\n"""          Интерполяция многочленами. Формула Ньютона #2        """\n' + '"' * 69)
    print_res(new_x, newton_2_y)
    print('\n"""          Интерполяция многочленами. Формула Ньютона #2        """\n' + '"' * 69)

    input("\nДля продолжения нажмите Enter(x2)")

    fff = plt.figure(facecolor="#DFB1F9", num="Исходная функция")  # Фигура с исходной функцией
    ff = fff.add_subplot(111)  # Полотно с исходной функцией
    ff.grid(True)
    ff.set_title(label="f(x) = " + str(fun),
                 size="xx-large",
                 weight="bold")
    ff.set_xlim([x[0], x[-1]])
    ff.set_ylim([y[0], y[-1]])
    ff.set_xlabel("Ось абцис")
    ff.set_ylabel("Ось ординат")
    ff.plot(x, y,
            linestyle="-",
            color="r",
            )
    mng = plt.get_current_fig_manager()
    mng.full_screen_toggle()
    # mng.resize(*mng.window.maxsize())

    nnn = plt.figure(facecolor="#FCFFB2",
                     num="Интерполяция. Интерполяция многочленами")  # Фигура с интерполяционными многочленами
    la = nnn.add_subplot(221)  # формула Лагранжа
    la.grid(True)
    la.set_title(label="Формула Лагранжа", weight="bold")
    # la.plot(new_x, lagrange_y, linestyle=":", color="red")
    la.set_xlim([x[0], x[-1]])
    la.scatter(new_x, lagrange_y, marker='*', s=20, c="red")
    ei = nnn.add_subplot(222)  # Схема Эйткена
    ei.grid(True)
    ei.set_title(label="Схема Эйткена", weight="bold")
    ei.set_xlim([x[0], x[-1]])
    # ei.plot(x, [eitken(x, y, 0, n, i) for i in x])
    # ei.plot(new_x, eitken_y, linestyle=":", color="blue")
    ei.scatter(new_x, lagrange_y, marker='D', s=20, c="blue")
    n1 = nnn.add_subplot(223)  # Формула Ньютона №1
    n1.grid(True)
    n1.set_title(label="Формула Ньютона #1", weight="bold")
    n1.set_xlim([x[0], x[-1]])
    n1.plot(x, [newton_1(x, del_y, i) for i in x])
    # n1.plot(new_x, newton_1_y, linestyle=":", color="green")
    n1.scatter(new_x, lagrange_y, marker='x', s=20, c="green")
    n2 = nnn.add_subplot(224)  # Формула Ньютона №2
    n2.grid(True)
    n2.set_title(label="Формула Ньютона #2", weight="bold")
    n2.set_xlim([x[0], x[-1]])
    n2.plot(x, [newton_1(x, del_y, i) for i in x])
    # n2.plot(new_x, newton_2_y, linestyle=":", color="magenta")
    n2.scatter(new_x, lagrange_y, marker='o', s=20, c="magenta")
    mng = plt.get_current_fig_manager()
    mng.full_screen_toggle()
    # mng.resize(*mng.window.maxsize())

    plt.show()


if __name__ == "__main__":
    sys.setrecursionlimit(2000)
    decimal.getcontext().rounding = decimal.ROUND_HALF_UP
    # decimal.getcontext().prec = 18
    # print(decimal.getcontext())
    main()
    # test()
