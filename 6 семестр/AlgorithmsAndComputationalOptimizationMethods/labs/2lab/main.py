'''
Базисное от опорного?
Максимальное кол-во базисных?
Когда базисное решение не существует?
'''

import sys
import math
import itertools

class Fraction:
    """
    Класс, реализующий дроби
    """
    __slots__ = ('_numerator', '_denominator')

    def __init__(self, numerator=0, denominator=1):
        if type(numerator) is not int or type(denominator) is not int:
            raise TypeError(
                'Fraction(%s, %s) - the numerator and denominator values must be integers' % (numerator, denominator))
        if denominator == 0:
            raise ZeroDivisionError('Fraction(%s, 0)' % numerator)
        g = math.gcd(numerator, denominator)
        if denominator < 0:
            g = -g
        numerator //= g
        denominator //= g
        self._numerator = numerator
        self._denominator = denominator

    def __add__(self, other):
        """Сумма 2-х дробей"""
        if isinstance(other, Fraction):
            return Fraction(self._numerator * other._denominator + other._numerator * self._denominator,
                            self._denominator * other._denominator)
        return NotImplemented

    def __sub__(self, other):
        """Разность 2-х дробей"""
        if isinstance(other, Fraction):
            return Fraction(self._numerator * other._denominator - other._numerator * self._denominator,
                            self._denominator * other._denominator)
        return NotImplemented

    def __mul__(self, other):
        """Произведение 2-х дробей"""
        if isinstance(other, Fraction):
            return Fraction(self._numerator * other._numerator,
                            self._denominator * other._denominator)
        return NotImplemented

    def __truediv__(self, other):
        """Частное 2-х дробей"""
        if isinstance(other, Fraction):
            return Fraction(self._numerator * other._denominator,
                            self._denominator * other._numerator)
        return NotImplemented

    def __lt__(self, other):
        """x < y"""
        if isinstance(other, Fraction):
            return self._numerator * other._denominator < other._numerator * self._denominator
        return NotImplemented

    def __le__(self, other):
        """x <= y"""
        if isinstance(other, Fraction):
            return self._numerator * other._denominator <= other._numerator * self._denominator
        return NotImplemented

    def __eq__(self, other):
        """x == y"""
        if isinstance(other, Fraction):
            return self._numerator * other._denominator == other._numerator * self._denominator
        return NotImplemented

    def __ne__(self, other):
        """x != y"""
        if isinstance(other, Fraction):
            return self._numerator * other._denominator != other._numerator * self._denominator
        return NotImplemented

    def __gt__(self, other):
        """x > y"""
        if isinstance(other, Fraction):
            return self._numerator * other._denominator > other._numerator * self._denominator
        return NotImplemented

    def __ge__(self, other):
        """x >= y"""
        if isinstance(other, Fraction):
            return self._numerator * other._denominator >= other._numerator * self._denominator
        return NotImplemented

    def __repr__(self):
        if self._denominator == 1:
            return 'Fraction(%s)' % self._numerator
        else:
            return 'Fraction(%s, %s)' % (self._numerator, self._denominator)

    def __str__(self):
        if self._denominator == 1:
            return str(self._numerator)
        else:
            return '%s/%s' % (self._numerator, self._denominator)

    def abs(self):
        return Fraction(abs(self._numerator), abs(self._denominator))


def print_matrix(matrix):
    for i in matrix:
        for j in i:
            print('%15s' % j, end='')
        print()
    print()


def jordan_gauss_method(matrix, flag=True):
    print("<Исходная матрица>")
    print_matrix(matrix)
    # По столбцам
    for c in range(len(matrix)):
        index = c
        # По элементам столбца
        for i in range(c + 1, len(matrix)):
            if matrix[index][c].abs() < matrix[i][c].abs():
                index = i
        if index != c:
            matrix[index], matrix[c] = matrix[c], matrix[index]
            print("<Произошел свап>")
            print_matrix(matrix)
        if matrix[c][c] == Fraction(0):
            continue
        if matrix[c][c] != Fraction(1):
            # Сокращение строки
            matrix[c] = [i / matrix[c][c] for i in matrix[c]]
            print_matrix(matrix)

        # По всем строкам для их "зануления"
        for i in range(len(matrix)):
            if matrix[i][c] == Fraction(0) or i == c:
                continue
            coeff = matrix[i][c] * Fraction(-1)
            # По элементам строк, начиная с c-ого
            for j in range(c, len(matrix[0])):
                matrix[i][j] = matrix[i][j] + matrix[c][j] * coeff
        print_matrix(matrix)

    count_no_null_str = 0
    for i in matrix:
        null_sum_flag = True
        for j in i[:-1]:
            if j != Fraction(0):
                null_sum_flag = False
                break
        # Если элементы строки нулевые и значение не нулевое
        if null_sum_flag and i[-1] != Fraction(0):
            count_no_null_str = 0
            break
        # Если строка нулевая
        elif null_sum_flag and i[-1] == Fraction(0):
            continue
        count_no_null_str += 1

    if not count_no_null_str:
        return None
    elif count_no_null_str == len(matrix) and count_no_null_str == len(matrix[0]) - 1:
        return [[matrix[i][-1] for i in range(len(matrix))]]
    else:
        res = [[], []]
        # Общее решение
        for i in matrix:
            tmp_sum = Fraction(0)
            for j in i:
                tmp_sum += j.abs()
            if tmp_sum != Fraction(0):
                res[0].append(i)
        matrix = res[0]
        # Базисное решение
        if flag:
            for i in itertools.combinations([i for i in range(len(matrix[0])-1)], count_no_null_str):
                print("-" * 30)
                print(i)
                tmp_res = [0 for i in range(len(matrix[0]) - 1)]
                tmp_matrix = []
                # Получение необходимых столбов, как строк
                for j in i:
                    tmp_matrix.append([x[j] for x in matrix])
                tmp_matrix.append([x[-1] for x in matrix])
                # Транспонирование
                tmp_matrix = [list(j) for j in zip(*tmp_matrix)]
                res_r = jordan_gauss_method(tmp_matrix, False)
                if not res_r:
                    print("\nНет решения")
                elif len(res_r) == 1:
                    print("\nРешение:")
                    ans = res_r[0]

                    for j in range(len(ans)):
                        print("x{} = {}".format(j + 1, ans[j]), end="  ")
                    t = 0
                    for j in i:
                        tmp_res[j] = ans[t]
                        t += 1
                    print("\n")
                    res[1].append(tmp_res)
                elif len(res_r) == 2:
                    print("\nСЛАУ имеет множество решений")
        return res


def main():
    matrix = []
    f = open('input.txt', 'r')
    # TODO: возможность ввода дробей
    for line in f:
        a = list(map(int, line.strip().split(' ')))
        matrix.append(list(map(Fraction, a)))
    res = jordan_gauss_method(matrix)
    print("#" * 50)
    print("<Сокращенная матрица>")
    print_matrix(matrix)
    if not res:
        print("\nНет решения")
    elif len(res) == 1:
        print("\nРешение:")
        ans = res[0]
        for i in range(len(ans)):
            print("\tx{} = {}".format(i + 1, ans[i]))
        print("\n")
    elif len(res) == 2:

        o_ans = res[0]
        ans = res[1]
        print("\nОбщее решение:")
        for i in o_ans:
            tmp_str = ""
            for j in range(len(i) - 1):
                tmp = i[j]
                if tmp != Fraction(0):
                    if tmp.abs() != Fraction(1):
                        if tmp < Fraction(0):
                            tmp_str += " - "
                        else:
                            tmp_str += " + "
                        tmp_str += str(tmp.abs()) + " * "
                    tmp_str += "x" + str(j + 1)
            tmp_str += " = " + str(i[-1])
            print(tmp_str)

        print("\nБазисные решения:")
        for i in ans:
            for j in range(len(i)):
                print("\tx{} = {}".format(j + 1, i[j]))
            print()
    else:
        print("Вышла какая-то ошибочка :с")
    return


def test():
    a = Fraction(-1, 5)
    b = Fraction(4, 10)
    print(a + b)
    print(a < b)


if __name__ == '__main__':
    main()
    # test()
