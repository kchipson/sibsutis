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


def funcr(x: Dec) -> Dec:
    return np.sqrt(x)


def func(function, x: Dec) -> Dec:
    """
    Нахожднение значения ф-ии в точке
    :param function: функция
    :param x: точка
    :return: Значение ф-ии в точке
    """
    # return Dec(str(function.subs(S_X, x)))
    # f = sp.lambdify(S_X, function, 'numpy')
    return Dec(str(function.subs(S_X, sp.Float(str(x), ROUD))))


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
    diff = sp.diff(function, S_X, n)
    return Dec(str(diff.subs(S_X, sp.Float(str(x), ROUD))))


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


def delta_y(y_arr: List[Dec], dop_y: Dec = None) -> List[List[Dec]]:
    del_y: List[List[Dec]] = [copy.deepcopy(y_arr)]
    n = len(y_arr) - 1
    if dop_y:
        del_y[0].append(dop_y)
        n += 1 
  

    for i in range(n - 1):
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


def newton_1(x_arr: List[Dec], del_y: List[List[Dec]], x: Dec, flag = True) -> Dec:
    q = (x - x_arr[0]) / (x_arr[1] - x_arr[0])
    qq = Dec("1")
    result = Dec("0")
    if flag:
        n = len(del_y) - 1
    else:
        n = len(del_y)

    for i in range(n):
        result += (del_y[i][0] / factorial(i)) * qq
        qq *= (q - i)

    return result


def newton_2(x_arr: List[Dec], del_y: List[List[Dec]], x: Dec, flag =True):
    q = (x - x_arr[-1]) / (x_arr[1] - x_arr[0])
    qq = Dec("1")
    result = Dec("0")
    if flag:
        n = len(del_y) - 1
    else:
        n = len(del_y)

    # print(len(del_y[0]), len(del_y))


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
    fun = sp.sqrt(S_X)
    # fun = sp.S(input("f(x) = "))
    print("f(x) = ", fun)
    # a, b = Dec("1.0"), Dec("10.0")
    # a, b = list(map(lambda f: Dec(str(f)), input("Введите интервал (через пробел) : ").split(' ')))
    # c = Dec("0.1")
    # c = Dec(str(input("Введите шаг: ")))

    x0 = Dec(input("x0 = "))
    n = int(input("n = "))
    cc = Dec(input("Шаг = "))


    a, b, c = Dec("1.0") , Dec("10.0"), Dec("0.1")

    initial_x: List[Dec] = list(Dec(x0 + i * cc) for i in range(n + 1))
    print(initial_x)

    # initial_x = list(Dec(i) for i in np.arange(a, (b + c), c))
    # if initial_x[-1] > b:
    #     initial_x = initial_x[:-1]
    # n = len(initial_x) - 1

    initial_y: List[Dec] = list(func(fun, i) for i in initial_x)
    print(initial_y)

    # x: List[Dec] = list((Dec("1"), Dec("2"), Dec("3")))
    x = list(Dec(i) for i in np.arange(a, (b + c), c))
    # x: List[Dec] = list(Dec(i) for i in input(f"Введите точки интерполяции в интервале"
                                            #   f" [{min(initial_x)}, {max(initial_x)}] (через пробел) : ").split(' '))

    # print(x)

    # for i in x:
    #     if i < min(initial_x) or i > max(initial_x):
    #         raise ValueError(f"Achtung!!! Несоответствующее значение \"{i}\" точки, "
    #                          f"значение должно быть в интевале [{min(initial_x)}, {max(initial_x)}]")

    y_lagrange: List[Dec] = list(lagrange(initial_x, initial_y, i) for i in x)
    y_eitken: List[Dec] = list(lagrange(initial_x, initial_y, i) for i in x)

    table_of_final_differences = delta_y(initial_y, func(fun, (x[-1] + cc)))

    if table_of_final_differences:
        y_newton1: List[Dec] = list(newton_1(initial_x, table_of_final_differences, i) for i in x)
        y_newton2: List[Dec] = list(newton_2(initial_x, table_of_final_differences, i) for i in x)
    else:
        y_newton1 = []
        y_newton2 = []

    # print_res(x, y_lagrange, "\"\"\"     Интерполяция многочленами. Формула Лагранжа     \"\"\"")
    # print_res(x, y_eitken, "\"\"\"      Интерполяция многочленами.  Схема Эйткена      \"\"\"")
    # print_res(x, y_newton1, "\"\"\"    Интерполяция многочленами. Формула Ньютона #1    \"\"\"")
    # print_res(x, y_newton2, "\"\"\"    Интерполяция многочленами. Формула Ньютона #2    \"\"\"")

    # Максимальное значение производной (n+1)-ого порядка
    mxdn = lambda f: max([diff_func(fun, n + 1, i) for i in initial_x] + [diff_func(fun, n + 1, f)])
    # Нахождение (x-x0) * ... * (x-xn)
    pxx = lambda f: reduce(lambda xx, yy: xx * yy, list((f - i) for i in initial_x))

    # TODO : В формуле не уверен 🙃:/
    e_ycech = ([Dec(str(mxdn(i) * (pxx(i)) / (factorial(n + 1)))) for i in x] if fun else [])  # усеченная погрешность
    # print(*e_ycech)
    input("\nДля продолжения нажмите Enter(x2)")

    """~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"""
    """~~~~~~~~~~~~~ ГРАФИКИ ~~~~~~~~~~~~~"""
    """~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"""

    fun_g_y = [func(fun, i) for i in x]
    """ ОКНО #1 """

    win_2 = plt.figure(facecolor="#FCFFB2",
                       num="Интерполяция. Интерполяция многочленами")  # Фигура с интерполяционными многочленами
    mng = plt.get_current_fig_manager()
    mng.full_screen_toggle()
    # mng.resize(*mng.window.maxsize())
    canvas_lagrange = win_2.add_subplot(221)  # формула Лагранжа
    canvas_lagrange.grid(True)
    canvas_lagrange.set_title(label="Формула Лагранжа", weight="bold")
    # canvas_lagrange.set_xlim(-5, 15)
    canvas_lagrange.plot(x, fun_g_y, linestyle="-", color="r")
    canvas_lagrange.plot(x,  y_lagrange, linestyle=":", color="blue")
    # canvas_lagrange.scatter(x, y_lagrange, marker='*', s=20, c="red")

    canvas_eitken = win_2.add_subplot(222)  # Схема Эйткена
    canvas_eitken.grid(True)
    canvas_eitken.set_title(label="Схема Эйткена", weight="bold")
    # canvas_eitken.set_xlim(-5, 15)
    canvas_eitken.plot(x, fun_g_y, linestyle="-", color="r")
    canvas_eitken.plot(x, y_eitken, linestyle=":", color="green")
    # canvas_eitken.scatter(x, y_eitken, marker='D', s=20, c="blue")

    canvas_newton1 = win_2.add_subplot(223)  # Формула Ньютона №1
    canvas_newton1.grid(True)
    canvas_newton1.set_title(label="Формула Ньютона #1", weight="bold")
    # canvas_newton1.set_xlim(-5, 15)
    canvas_newton1.plot(x, fun_g_y, linestyle="-", color="r")
    canvas_newton1.plot(x, y_newton1, linestyle=":", color="green")
    # canvas_newton1.scatter(x, y_newton1, marker='x', s=20, c="green")

    canvas_newton2 = win_2.add_subplot(224)  # Формула Ньютона №2
    canvas_newton2.grid(True)
    canvas_newton2.set_title(label="Формула Ньютона #2", weight="bold")
    # canvas_newton2.set_xlim(-5, 15)
    canvas_newton2.plot(x, fun_g_y, linestyle="-", color="r")
    canvas_newton2.plot(x, y_newton2, linestyle=":", color="blue")
    # canvas_newton2.scatter(x, y_newton2, marker='o', s=20, c="magenta")

    plt.show()


if __name__ == '__main__':
    main()

    # fun = S_X ** 2
    #
    # a = sp.Float("500000.5555555555555555555555555555555555555555555555555555555555555550")
    # # print(a)
    # print(ff(fun, a))
    # # print(Dec("1.0") / a)
