import copy
import math
from scipy.misc import derivative


def func(x: float):
    return x**2 + x - 8


def bisection_method(a, b, e):
    print()
    print('#' * 158)
    print(" Метод половинного деления (МПД) или метод биссекций ")
    while abs(b - a) > e:
        print(f"a: {a:30}          b: {b:30}     ||     abs(b - a): {abs(b - a):30}")
        c = (a + b) / 2
        if func(a) * func(c) < 0:
            b = c
        else:
            a = c
    print(f"a: {a:30}          b: {b:30}     ||     abs(b - a): {abs(b - a):30}")

    print('~' * 158)
    print(f"Ответ: {(a + b) / 2} ± {abs(b - a) / 2}")


def chord_method(a, b, e):
    print()
    print('#' * 158)
    print(" Метод Хорд ")
    c_p = 0
    c = 0
    check = True
    while check:
        print(f"a: {a:30}          b: {b:30}     ||     ", end='')
        c = (a * func(b) - b * func(a)) / (func(b) - func(a))
        if func(a) * func(c) < 0:
            b = c
        else:
            a = c
        check = (abs(c - c_p) > e)
        print(f"abs(C(n) - C(n-1)): {abs(c - c_p)}")
        if check:
            c_p = c

    print('~' * 158)
    print(f"Ответ: {c} ± {c - c_p}")


def tangent_method(a, b, e):
    print()
    print('#' * 158)
    print(" Метод Ньютона или метод касательных")
    if a * derivative(func, a, 2) > 0:
        x_p = x = a
    elif b * derivative(func, b, 2) > 0:
        x_p = x = b
    else:
        print('?'*15)
        return
    print(f"x0: {x}")
    i = 1
    check = True
    while check:
        x = x - (func(x)/derivative(func, x))
        print(f"x{i}: {x}")
        check = (abs(x - x_p) > e)
        i += 1
        if check:
            x_p = x

    print('~' * 158)
    print(f"Ответ: {x}  ± {x - x_p}")


def main():
    e = float(input("Введите точность: "))
    a, b = list(map(int, input("Введите a и b: ").split(' ')))
    if func(a) * func(b) < 0 and a < b:
        bisection_method(a, b, e)
        chord_method(a, b, e)
        tangent_method(a, b, e)
    else:
        print("Введен некорректный отрезок")


if __name__ == "__main__":
    main()
