import copy
import decimal
from decimal import Decimal as Dec
from functools import reduce
from typing import List

import numpy as np
import sympy as sp

import matplotlib.pyplot as plt

decimal.getcontext().rounding = decimal.ROUND_HALF_UP
ROUD = decimal.getcontext().prec = 40

S_X = sp.symbols('x')
FUNC = sp.S("sqrt(x)")


def func(function, x: Dec) -> Dec:
    return Dec(str(function.subs(S_X, sp.Float(str(x), ROUD))))


def diff_func(function, n: int, x: Dec) -> Dec:
    diff = sp.diff(function, S_X, n)
    # print(diff)
    return Dec(str(diff.subs(S_X, sp.Float(str(x), ROUD))))


def lagrange(x_arr: List[Dec], y_arr: List[Dec], n: int, x: Dec) -> Dec:
    result: Dec = Dec("0.0")
    for i in range(n + 1):
        tmp = list(range(n + 1))
        tmp.remove(i)
        q: Dec = Dec("1.0")
        for j in tmp:
            q *= (x - x_arr[j]) / (x_arr[i] - x_arr[j])
        result += y_arr[i] * q

    return result


def eitken(x_arr: List[Dec], y_arr: List[Dec], n: int, x: Dec) -> Dec:
    p: List[List[Dec]] = list()
    p.append(y_arr)
    for i in range(1, n + 1):
        p.append([])
        for j in range((n + 1) - i):
            tmp = (p[i - 1][j] * (x - x_arr[j + i]) - p[i - 1][j + 1] * (x - x_arr[j])) / (x_arr[j] - x_arr[j + i])
            p[i].append(tmp)
    
    return p[-1][0]


def delta_y(y_arr: List[Dec], n: int) -> List[List[Dec]]:
    del_y: List[List[Dec]] = [copy.deepcopy(y_arr)]

    for i in range(n):
        tmp = []
        for j in range(len(del_y[i]) - 1):
            tmp.append(del_y[i][j + 1] - del_y[i][j])
        del_y.append(tmp)

    return del_y


def factorial(x) -> Dec:
    fact: Dec = Dec("1")
    for j in range(2, x + 1):
        fact *= j
    return fact


def newton_1(x_arr: List[Dec], del_y: List[List[Dec]], n: int, x: Dec) -> Dec:
    q = (x - x_arr[0]) / (x_arr[1] - x_arr[0])
    qq = Dec("1")
    result = Dec("0")

    for i in range(n + 1):
        result += (del_y[i][0] / factorial(i)) * qq
        qq *= (q - i)

    return result


def newton_2(x_arr: List[Dec], del_y: List[List[Dec]], n: int, x: Dec) -> Dec:
    q = (x - x_arr[-1]) / (x_arr[1] - x_arr[0])
    qq = Dec("1")
    result = Dec("0")

    for i in range(n + 1):
        result += (del_y[i][n - i] / factorial(i)) * qq
        qq *= (q + i)

    return result


def print_res(x_arr: List[Dec], y_arr: List[Dec], label: str = None, inaccuracy: List[Dec] = None):
    if y_arr:
        if label:
            print('\n' + label)
        if inaccuracy:
            for i in range(len(x_arr)):
                print(
                    f"x = {x_arr[i]}  -->  y = {y_arr[i]}  |  E = {-inaccuracy[i] if inaccuracy[i] < 0 else inaccuracy[i]}")
        else:
            for i in range(len(x_arr)):
                print(f"x = {x_arr[i]}  -->  y = {y_arr[i]}")


def main():
    fun = sp.sqrt(S_X)
    # fun = sp.S(input("f(x) = "))
    print("f(x) = ", fun)

    x0 = Dec(input("x0 = "))
    n = int(input("n = "))
    c = Dec(input("Шаг = "))

    x_init: List[Dec] = list(Dec(x0 + i * c) for i in range(n + 1))
    y_init: List[Dec] = list(func(fun, i) for i in x_init)
    print_res(x_init, y_init, "Начальные данные:")

    a_g = Dec("1")
    b_g = Dec("10")
    c_g = Dec("0.1")
    a_g, b_g, c_g = list(map(lambda f: Dec(f),
                             input("Введите интервал для графика [a, b], а также шаг (через пробел):  ").split(" ")))
    x_g = list(Dec(i) for i in np.arange(a_g, (b_g + c_g), c_g))
    if x_g[-1] > b_g:
        x_g = x_g[:-1]

    y_lag:   List[Dec] = list(lagrange(x_init, y_init, n, i) for i in x_g)
    y_eit:   List[Dec] = list(eitken(x_init, y_init, n, i) for i in x_g)

    del_y = delta_y(y_init, n)

    y_new1:  List[Dec] = list(newton_1(x_init, del_y, n, i) for i in x_g)
    y_new2:  List[Dec] = list(newton_2(x_init, del_y, n, i) for i in x_g)
    # print_res(x, y_lag, "\"\"\"     Интерполяция многочленами. Формула Лагранжа     \"\"\"")
    # print_res(x, y_eit, "\"\"\"      Интерполяция многочленами.  Схема Эйткена      \"\"\"")
    # print_res(x, y_new1, "\"\"\"    Интерполяция многочленами. Формула Ньютона #1    \"\"\"")
    # print_res(x, y_new2, "\"\"\"    Интерполяция многочленами. Формула Ньютона #2    \"\"\"")

    # Максимальное значение производной (n+1)-ого порядка
    mxdn = lambda f: max([diff_func(fun, n + 1, i) for i in x_init] + [diff_func(fun, n + 1, f)])
    # Нахождение (x-x0) * ... * (x-xn)
    pxx = lambda f: reduce(lambda xx, yy: xx * yy, list((f - i) for i in x_init))
    # Усеченная погрешность
    e_ycech = ([Dec(str(mxdn(i) * (pxx(i)) / (factorial(n + 1)))) for i in x_g] if fun else [])

    """~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"""
    """~~~~~~~~~~~~~ ГРАФИКИ ~~~~~~~~~~~~~"""
    """~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"""

    y_g = [func(fun, i) for i in x_g]
    """ ОКНО #1 """

    win_1: plt.Figure = plt.figure(facecolor="#FCFFB2",
                       num="Интерполяция. Интерполяция многочленами")  # Фигура с интерполяционными многочленами
    mng = plt.get_current_fig_manager()
    mng.full_screen_toggle()
    # mng.resize(*mng.window.maxsize())
    canvas: plt.Axes = win_1.add_subplot(111)  #
    canvas.grid(True)
    # canvas_lagrange.set_xlim(-5, 15)

    canvas.scatter(x_init, y_init, marker='o', s=20, c="m")
    canvas.plot(x_g, y_g,    linestyle="-", color="r", label=f"f(x) = {fun}")
    canvas.plot(x_g, y_lag,  linestyle=":", color="b", linewidth=1, label=f"формула Лагранжа")
    canvas.plot(x_g, y_eit,  linestyle=":", color="g", linewidth=1, label=f"Схема Эйткена")
    canvas.plot(x_g, y_new1, linestyle=":", color="y", linewidth=1, label=f"формула Ньютона #1")
    canvas.plot(x_g, y_new2, linestyle=":", color="m", linewidth=1, label=f"формула Ньютона #2")

    canvas.legend()
    plt.show()


if __name__ == '__main__':
    main()

    # fun = sp.sqrt(S_X)
    # x0 = Dec("1")
    # n = 3
    # c = Dec("0.5")

    # x_init: List[Dec] = list(Dec(x0 + i * c) for i in range(n + 1))
    # y_init: List[Dec] = list(func(fun, i) for i in x_init)
    # print_res(x_init, y_init, "Начальные данные:")


    # del_y = delta_y(y_init, n)

    # print("lag:   ", lagrange(x_init, y_init, n, Dec("2.5")))
    # print("eit:   ", eitken(x_init, y_init, n, Dec("2.5")))
    # print("new#1: ", newton_1(x_init, del_y, n, Dec("2.5")))
    # print("new#2: ", newton_2(x_init, del_y, n, Dec("2.5")))
