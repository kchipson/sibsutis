import decimal
from decimal import Decimal as Dec
from functools import reduce
from typing import List

import numpy as np
import sympy as sp

import matplotlib.pyplot as plt

decimal.getcontext().rounding = decimal.ROUND_HALF_UP
decimal.getcontext().prec = 40

ROUD = 50
S_X = sp.symbols('x')
FUNC = sp.S("sqrt(x)")


# def func(x: Dec) -> Dec:
#     return np.sqrt(x)

def func(function, x: Dec) -> Dec:
    """
    Нахожднение значения ф-ии в точке
    :param function: функция
    :param x: точка
    :return: Значение ф-ии в точке
    """
    # return Dec(str(function.subs(S_X, x)))
    f = sp.lambdify(S_X, function, 'numpy')
    return Dec(f(x))


def diff_func(function, n: int, x: Dec) -> Dec:
    """
    Нахожднение значения производной n-го порядка в точке
    :param function: функция
    :param n: порядок производной
    :param x: точка
    :return: Значение производной n-ого порядка
    """
    # print(type(function))
    # print(type(sp.diff(function, S_X, n)))
    diff = sp.lambdify(S_X, sp.diff(function, S_X, n), 'numpy')
    print(str(sp.diff(function, S_X, n)))
    print(diff.__str__)
    return Dec(diff(x))


def lagrange(x_arr: List[Dec], y_arr: List[Dec], x: Dec) -> Dec:
    length: int = len(x_arr)
    result: Dec = Dec("0.0")

    for i in range(length):
        tmp = list(range(length))
        tmp.remove(i)
        q: Dec = Dec("1.0")
        for j in tmp:
            q *= (x - x_arr[j]) / (x_arr[i] - x_arr[j])
        result += y_arr[i] * q

    return result


def eitken(x_arr: List[Dec], y_arr: List[Dec], x: Dec) -> Dec:
    """
    Интерполяционный многочлен. Схема Эйткена
    :param x_arr: Список x
    :param y_arr: Список y
    :param x: Точка
    :return: Значение в точке
    """
    length = len(x_arr)
    p: List[List[Dec]] = list()
    p.append(y_arr)

    for i in range(1, length):
        p.append([])
        for j in range(length - i):
            tmp = (p[i - 1][j] * (x - x_arr[j + i]) - p[i - 1][j + 1] * (x - x_arr[j])) / (x_arr[j] - x_arr[j + i])
            p[i].append(tmp)

    return p[-1][0]


def delta_y(x_arr: List[Dec], h: Dec, fun) -> List[List[Dec]]:
    """
    Таблица конечных разностей
    :param x_arr: Список x
    :param h: Шаг
    :return: "Матрица" конечных разностей
    """

    length = len(x_arr)
    for i in range(length - 1):
        if x_arr[i] + h != x_arr[i + 1]:
            print(f"\nAchtung!!! Интервал неравномерный или не соответствует шагу \"{h}\"")
            print("Интерполяция по методу Ньютона не может быть посчитана, т.к. интервал неравномерный\n")
            return []
    del_y: List[List[Dec]] = [[func(fun, x) for x in x_arr]]
    del_y[0].append(func(fun, (x_arr[-1] + h)))

    for i in range(length - 1):
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


def newton_1(x_arr: List[Dec], del_y: List[List[Dec]], x: Dec) -> Dec:
    q = (x - x_arr[0]) / (x_arr[1] - x_arr[0])
    qq = Dec("1")
    result = Dec("0")
    n = len(x_arr) - 1

    for i in range(n):
        result += (del_y[i][0] / factorial(i)) * qq
        qq *= (q - i)

    return result


def newton_2(x_arr: List[Dec], del_y: List[List[Dec]], x: Dec):
    q = (x - x_arr[-1]) / (x_arr[1] - x_arr[0])
    qq = Dec("1")
    result = Dec("0")
    n = len(x_arr) - 1

    for i in range(n):
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
    fun = sp.sqrt(S_X)  # sp.S(input("f(x) = "))
    print("f(x) = ", fun)
    a, b = Dec("1.0"), Dec("10.0")
    # a, b = list(map(lambda f: D(str(f)), input("Введите интервал (через пробел) : ").split(' ')))
    print(type(a), ':', a, " | ", type(b), ':', b)
    c = Dec("0.1")
    # c = Dec(str(input("Введите шаг: ")))

    initial_x = list(Dec(i) for i in np.arange(a, (b + c), c))
    if initial_x[-1] > b:
        initial_x = initial_x[:-1]
    print(initial_x)

    initial_y: List[Dec] = list(func(fun, i) for i in initial_x)
    print(initial_y)

    x: List[Dec] = list((Dec("1.6955"), Dec("2.56")))
    # x: List[Dec] = list(Dec(x) for x in input(f"Введите узлы интерполяции в интервале"
    #                                f" [{min(initial_x)}, {max(initial_x)}] (через пробел) : ").split(' '))
    for i in x:
        if i < min(initial_x) or i > max(initial_x):
            raise ValueError(f"Achtung!!! Несоответствующее значение \"{i}\" точки, "
                             f"значение должно быть в интевале [{min(initial_x)}, {max(initial_x)}]")
    print(x)

    y_lagrange: List[Dec] = list(lagrange(initial_x, initial_y, i) for i in x)
    y_eitken: List[Dec] = list(lagrange(initial_x, initial_y, i) for i in x)

    n = len(initial_x) - 1
    # Максимальное значение производной (n+1)-ого порядка
    mxdn = lambda f: max([diff_func(fun, n + 1, i) for i in initial_x] + [diff_func(fun, n + 1, f)])
    # Нахождение (x-x0) * ... * (x-xn)
    pxx = lambda f: reduce(lambda xx, yy: xx * yy, list((f - i) for i in x))

    # TODO : В формуле не уверен 🙃:/
    e_ycech = ([Dec(str(mxdn(i) * (pxx(i)) / (factorial(n + 1)))) for i in x] if fun else [])  # усеченнная погрешность

    table_of_final_differences = delta_y(initial_x, c, fun)

    if table_of_final_differences:
        y_newton1: List[Dec] = list(newton_1(initial_x, table_of_final_differences, i) for i in x)
        y_newton2: List[Dec] = list(newton_2(initial_x, table_of_final_differences, i) for i in x)
    else:
        y_newton1 = []
        y_newton2 = []

    print_res(x, y_lagrange, "\"\"\"     Интерполяция многочленами. Формула Лагранжа     \"\"\"")
    print_res(x, y_eitken,   "\"\"\"      Интерполяция многочленами.  Схема Эйткена      \"\"\"")
    print_res(x, y_newton1,  "\"\"\"    Интерполяция многочленами. Формула Ньютона #1    \"\"\"")
    print_res(x, y_newton2,  "\"\"\"    Интерполяция многочленами. Формула Ньютона #2    \"\"\"")

    input("\nДля продолжения нажмите Enter(x2)")

    """~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"""
    """~~~~~~~~~~~~~ ГРАФИКИ ~~~~~~~~~~~~~"""
    """~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"""
    win_1: plt.Figure = plt.figure(facecolor="#DFB1F9", num="Исходная функция")  # Фигура с исходной функцией
    print(type(win_1))
    canvas_main = win_1.add_subplot(111)  # Полотно с исходной функцией
    print(type(canvas_main))
    exit()
    canvas_main.grid(True)
    canvas_main.set_title(label="f(x) = " + str(fun),
                          size="xx-large",
                          weight="bold")
    canvas_main.set_xlim([x[0], x[-1]])
    canvas_main.set_ylim([y[0], y[-1]])
    canvas_main.set_xlabel("Ось абцис")
    canvas_main.set_ylabel("Ось ординат")
    canvas_main.plot(x, y,
            linestyle="-",
            color="r",
            )
    mng = plt.get_current_fig_manager()
    mng.full_screen_toggle()
    # mng.resize(*mng.window.maxsize())


def ff(function, x: sp.Float) -> Dec:
    # return Dec(str(function.subs(S_X, x)))
    print(function)
    print(x)
    f = sp.lambdify(S_X, function, 'numpy')
    print(f(x).round(50))
    print(sp.N(f(x), 50))
    print(sp.N(f(x), maxn=500))
    return f(x).evalf(50)


if __name__ == '__main__':
    # main()
    fun = S_X ** 2

    a = sp.Float("500000.5555555555555555555555555555555555555555555555555555555555555550")
    # print(a)
    print(ff(fun, a))
    # print(Dec("1.0") / a)