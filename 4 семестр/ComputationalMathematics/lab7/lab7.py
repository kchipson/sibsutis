from typing import Tuple

import matplotlib.pyplot as plt
import sympy as sp
import numpy as np
import decimal
from decimal import Decimal as D

SYMBOL_X = sp.symbols('x')
ROUD = decimal.getcontext().prec = 40
decimal.getcontext().rounding = decimal.ROUND_HALF_UP  # Обычное округление вместо банковского


def func(function, x: D) -> D:
    return function.subs(SYMBOL_X, sp.Float(str(x), ROUD))


def trigonometric_interpolation(x_arr, y_arr, x):
    n = len(x_arr)
    h = x_arr[1] - x_arr[0]

    Aj = lambda j: sum((y_arr[k] * sp.exp(-2 * sp.pi * sp.I * ((k * j) / n)) for k in range(0, n)))

    tmp = n**(-1) * sum(Aj(j) * sp.exp(2 * sp.pi * sp.I * j * ((x - x_arr[0]) / (n * h)))
                        for j in range(-n//2 + 1, n//2 + 1))
    return tmp


def main():
    # fun = sp.sqrt(SYMBOL_X)
    fun = sp.S(input("f(x) = "))
    # fun = None
    print("f(x) = ", fun if fun else "?")

    # x0: D = D("1")
    # n: int = 3
    # step: D = D("1")
    x0: D = D(input("x0 = "))
    n: int = int(input("n = "))
    step: D = D(input("Шаг = "))

    # a_g = D("-5")
    # b_g = D("5")
    # step_g = D("0.1")
    a_g, b_g, step_g = list(map(lambda f: D(f),
                                input("Введите интервал для графика [a, b], а также шаг (через пробел):  ").split(" ")))

    x_init: Tuple = tuple(D(str(x0 + D(str(i)) * step)) for i in range(n + 1))
    y_init: Tuple = tuple(func(fun, i) for i in x_init)

    x_g: Tuple = tuple(D(i) for i in np.arange(a_g, (b_g + step_g), step_g))
    # x_g: Tuple[D] = tuple(sorted(set(x_init + tuple(D(i) for i in np.arange(x_init[0], x_init[-1], step_g)))))
    y_g: Tuple = tuple(func(fun, i) for i in x_g)
    print("x_init  |", *x_init)
    print("y_init  |", *y_init)

    y_tri = list(trigonometric_interpolation(x_init, y_init, i) for i in x_g)

    """~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"""
    y_init_re = list()
    y_init_im = list()
    for i in y_init:
        y_init_re.append(sp.re(i))
        y_init_im.append(sp.im(i))

    y_g_re = list()
    y_g_im = list()
    for i in y_g:
        y_g_re.append(sp.re(i))
        y_g_im.append(sp.im(i))

    y_tri_re = list()
    y_tri_im = list()
    for i in y_tri:
        y_tri_re.append(sp.re(sp.N(i)))
        y_tri_im.append(sp.im(i))

    win_1: plt.Figure = plt.figure(facecolor="#a3acb1",
                                   num="Интерполяция. Тригонометрическая интерполяция")
    mng = plt.get_current_fig_manager()
    mng.full_screen_toggle()
    # mng.resize(*mng.window.maxsize())
    canvas: plt.Axes = win_1.add_subplot(111)
    canvas.grid(True)

    canvas.scatter(x_init, y_init_re, marker='o', s=40, c="#00243f")

    canvas.scatter(x_init, y_init_im, marker='o', s=40, c="#46899b")
    
    canvas.plot(x_g, y_g_re, linestyle="-", color="#00243f", linewidth=2, label=f"f(x) = {fun}. Re часть")
    canvas.plot(x_g, y_g_im, linestyle="--", color="#46899b", linewidth=2, label=f"f(x) = {fun}. Im часть")
    # print(*y_tri_re)
    canvas.plot(x_g, y_tri_re, linestyle="-", color="#d8574a", linewidth=2, label="Тригонометрическая интерполяция. Re часть")
    canvas.plot(x_g, y_tri_im, linestyle="--", color="#b94d5c", linewidth=2, label="ИТригонометрическая интерполяция. Im часть")

    canvas.legend()
    plt.show()
    
    x_tian = [D("1.5"), D("2")]
    y_tian = list(trigonometric_interpolation(x_init, y_init, i) for i in x_tian)
    for i in range(len(x_tian)):
        print(x_tian[i], "  :", sp.N(y_tian[i]))


if __name__ == '__main__':
    main()

