import copy
import decimal
from decimal import Decimal as D
from typing import List, Tuple

import matplotlib.pyplot as plt

import test
import sympy as sp
import numpy as np


SYMBOL_X = sp.symbols('x')
ROUD = decimal.getcontext().prec = 40
decimal.getcontext().rounding = decimal.ROUND_HALF_UP  # Обычное округление вместо банковского


# def func(function, x: D) -> D:
#     return D(str(function.subs(SYMBOL_X, x)))
def func(function, x: D) -> D:
    return D(str(function.subs(SYMBOL_X, sp.Float(str(x), ROUD))))


def cubic_spline(x_arr: Tuple[D], y_arr: Tuple[D], M: List[D], h: Tuple[D], x: D):
    i = 1
    while x_arr[i] < x:
        i += 1

    m1 = M[i - 1] * ((x_arr[i] - x)**3 / (D("6") * h[0]))
    m2 = M[i] * ((x - x_arr[i - 1])**3 / (D("6") * h[i - 1]))
    m3 = (y_arr[i - 1] - (M[i - 1] * h[i - 1]**2) / D("6")) * ((x_arr[i] - x) / h[i - 1])
    m4 = (y_arr[i] - (M[i] * (h[i - 1]**2)) / D("6")) * ((x - x_arr[i - 1]) / h[i - 1])

    return m1 + m2 + m3 + m4


def method_gauss(l: List[List[D]]):
    a = copy.deepcopy(l)
    # Прямой ход
    for c in range(len(a[0]) - 2):  # Цикл по столбцам
        for i in range(c + 1, len(a)):  # Цикл по строкам
            coef = a[i][c] / a[c][c] * -1
            for j in range(c, len(a[i])):  # Цикл по ячейкам
                a[i][j] += a[c][j] * coef

    # Обратный ход
    for c in range(len(a) - 1, -1, -1):
        for i in range(len(a) - 1, c, -1):
            a[c][-1] -= a[c][i]
        a[c][-1] /= a[c][c]
        for i in range(0, len(a)):
            a[i][c] *= a[c][-1]

    return list(i[-1] for i in a)


def main():
    fun = sp.sqrt(SYMBOL_X)
    # fun = sp.S(input("f(x) = "))
    print("f(x) = ", fun)

    x0: D = D("1")  # D(input("x0 = "))
    n: int = 1  # int(input("n = "))
    step: D = D("0.5")  # D(input("Шаг = "))

    x_init: Tuple[D] = tuple(D(str(x0 + i * step)) for i in range(n + 1))
    # x_init: Tuple[D] = tuple(D(str(i)) for i in [1, 3, 5, 7, 9])  # test
    y_init: Tuple[D] = tuple(func(fun, i) for i in x_init)
    # y_init: Tuple[D] = tuple(D(str(i)) for i in [2, 5, 2, -1, 2])  # test

    print("x_init  |", x_init)
    print("y_init  |", y_init)

    step_g = D("0.1")  # D(input("Шаг графика:  "))
    x_g: Tuple[D] = tuple(sorted(set(x_init + tuple(D(i) for i in np.arange(x_init[0], x_init[-1], step_g)))))
    y_g: Tuple[D] = tuple(func(fun, i) for i in x_g)

    """~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"""

    h: Tuple[D] = tuple(map(lambda a, b: a - b, x_init[1:], x_init))
    print("h  |", *h)
    C: List[List[D]] = []
    for i in range(n - 1):
        C.append(list(D("0") for j in range(n - 1)))
        C[i][i] = (h[i] + h[i + 1]) / D("3")
        if i != 0:
            C[i][i - 1] = h[i + 1] / D("6")
        if i != (n - 1) - 1:
            C[i][i + 1] = h[i - 1] / D("6")
    print("C  |", *C, sep="\n")

    d: List[D] = []
    for i in range(1, n):
        tmp = ((y_init[i + 1] - y_init[i]) / h[i]) - ((y_init[i] - y_init[i - 1]) / h[i - 1])
        d.append(tmp)
    print("d  |", *d)

    tmp: List[List[D]] = []
    for i in range(n - 1):
        tmp.append(C[i])
        tmp[i].append(d[i])
    print("tmp  |", tmp)
    M = [D("0")] + method_gauss(tmp) + [D("0")]
    print("M  |", *M)

    y_cubic: List[D] = list(cubic_spline(x_init, y_init, M, h, i) for i in x_g)
    print("x_g  |", *x_g)
    print("y_cubic  |", *y_cubic)

    win_1: plt.Figure = plt.figure(facecolor="#FCFFB2",
                                   num="Интерполяция. Интерполяция кубическими сплайнами")
    mng = plt.get_current_fig_manager()
    mng.full_screen_toggle()
    # mng.resize(*mng.window.maxsize())
    canvas: plt.Axes = win_1.add_subplot(111)
    canvas.grid(True)

    canvas.scatter(x_init, y_init, marker='o', s=20, c="m")
    canvas.plot(x_g, y_g,    linestyle="-", color="r", label=f"f(x) = {fun}")
    canvas.plot(x_g, y_cubic,  linestyle=":", color="b", linewidth=1, label=f"Интерполяция кубическими сплайнами")

    canvas.legend()
    plt.show()


if __name__ == '__main__':
    main()
    exit()
    test.test()
