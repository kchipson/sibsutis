import decimal
from decimal import Decimal as Dec


def fun(x: Dec) -> Dec:
    return x ** 2 - 6 * x


def main():
    epsilon = Dec(str(input("Введите необходимую точность(кол-во знаков после запятой):  ")))
    a, b = [Dec(i) for i in input("Введите a, b:  ").split(" ")]

    while True:
        if (b - a) / 2 < epsilon:
            print((b + a) / 2)
            break
        l1 = a + Dec("0.382") * (b - a)
        l2 = a + Dec("0.618") * (b - a)
        if fun(l1) > fun(l2):
            a = l1
        else:
            b = l2


if __name__ == '__main__':
    main()
