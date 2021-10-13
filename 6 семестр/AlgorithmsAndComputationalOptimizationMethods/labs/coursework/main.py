import math
import sys


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


def read_from_file(filename: str = "input.txt"):
    """
    Функция, считывающая входные данные из файла
    :param filename: имя файла
    :return: Словарь с матрицей("matrix") и z-функцией("z")
    """
    with open(filename, 'r', encoding="utf-8") as f:
        lines = list(filter(lambda x: x != '' and '#' not in x, list(map(lambda x: x.strip(), f.readlines()))))
    f.close()
    z = list(map(Fraction, map(int, lines[0].split(' '))))
    z = list((i * Fraction(-1))for i in z[:-1]) + z[-1:]
    matrix = list(list(Fraction(int(y)) for y in x.split(' ')) for x in lines[1:])
    # print(z, *matrix, sep='\n')
    return dict(z=z, matrix=matrix)


def print_step(matrix, z, x, step_num, simplex_relation=None, resolution_element=None):
    """
    Функция, выводящая шаг работы алгоритма
    :param matrix: Матрица
    :param z: Z - функция (список)
    :param x: X (список)
    :param step_num: Номер шага (инт)
    :param simplex_relation: Симплексное отношение (список)
    :param resolution_element: Индекс разрешаюшего элемента (словарь(row, col))
    :return: None
    """

    # Шапка
    field_width = 10
    print("{:^6}|".format("б.п."), end='')
    print("{:^{size}}|".format("1", size=field_width), end='')
    for i in range(len(matrix[0]) - 1):
        print("{:^{size}} ".format("x" + str(i + 1), size=field_width), end='')
    print(("\n{:-^6}+{:-^{size}}+{:-^" + str(field_width * (len(matrix[0]) - 1) + len(matrix[0]) - 1) + "}").format('', '', '', size=field_width))

    # Строки

    x_index = list()
    for i in range(len(matrix)):
        tmp_flag = False
        for j in range(len(matrix[0]) - 1):
            if matrix[i][j] == Fraction(1):
                for k in range(len(matrix)):
                    if matrix[k][j] == Fraction(0) or k == i:
                        tmp_flag = True
                    else:
                        tmp_flag = False
                        break
            if tmp_flag:
                x_index.append(j)
                break

    for i in range(len(matrix)):
        print("{:^6}|".format("x" + str(x_index[i] + 1)), end='')
        print("{:^{size}}|".format(str(matrix[i][-1]), size=field_width), end='')
        for j in range(len(matrix[0]) - 1):
            print("{:^{size}} ".format(str(matrix[i][j]), size=field_width), end='')
        # стрелочка ←
        if resolution_element and i == resolution_element["row"]:
            print("  ←", end="")
        print()
    print(("{:-^6}+{:-^{size}}+{:-^" + str(field_width * (len(matrix[0]) - 1) + len(matrix[0]) - 1) + "}").format('', '', '', size=field_width))

    # Z
    print("{:^6}|".format("Z1"), end='')
    print("{:^{size}}|".format(str(z[-1]), size=field_width), end='')
    for i in range(len(z) - 1):
        print("{:^{size}} ".format(str(z[i]), size=field_width), end='')

    # СО
    if simplex_relation:
        print(("\n{:-^6}+{:-^{size}}+{:-^" + str(field_width * (len(matrix[0]) - 1) + len(matrix[0]) - 1) + "}").format('', '', '', size=field_width))
        print("{:^6}|".format("СО"), end='')
        print("{:^{size}}|".format('', size=field_width), end='')
        for i in range(len(simplex_relation)):
            if simplex_relation[i] != Fraction(sys.maxsize):
                print("{:^{size}} ".format(str(simplex_relation[i]), size=field_width), end='')
            else:
                print("{:^{size}} ".format("-", size=field_width), end='')
    print()
    # стрелочка ↑
    if resolution_element:
        print(("{:^6} {:^{size}} {:^" + str(field_width * (resolution_element["col"]) + resolution_element["col"]) + "}{:^{size}}").format('', '', '', "↑", size=field_width))
    print()

    # X
    print("X" + str(step_num) + " = " + "(", end='')
    print(*x, sep=', ', end='')
    print(")")

    # Z(X)

    print("Z1(X" + str(step_num) + ") = " + str(z[-1]))


step = 0


def dual_simplex_method(matrix, z):
    global step
    flag = True
    while flag:
        step += 1
        flag = any(x < Fraction(0) for x in [x[-1] for x in matrix])
        res = list(Fraction(0) for _ in range(len(matrix[0]) - 1))

        for i in range(len(matrix)):
            tmp_flag = False
            for j in range(len(matrix[0]) - 1):
                if matrix[i][j] == Fraction(1):
                    for k in range(len(matrix)):
                        if matrix[k][j] == Fraction(0) or k == i:
                            tmp_flag = True
                        else:
                            tmp_flag = False
                            break
                if tmp_flag:
                    res[j] = matrix[i][-1]
                    break

        if flag:
            if any(x < Fraction(0) for x in z[:-1]):
                print("Отрицательный элемент в Z строке. \nДальше необходимо решать простым симплекс методом")
                flag = False
                break

            # Поиск разрешающей строки
            b = list(x[-1] for x in matrix)
            negative_b = list(filter(lambda q: q < Fraction(0), b))
            resolution_row = b.index(min(negative_b))

            if not any(x < Fraction(0) for x in matrix[resolution_row][:-1]):
                print("Нет решений.\nВ разрешающей строке нет отрицательных элементов")
                flag = False
                break

            # Поиск разрешающего столбца
            simplex_relation = list(Fraction(sys.maxsize) for i in range(len(matrix[0]) - 1))
            for i in range(len(matrix[0]) - 1):
                if matrix[resolution_row][i] < Fraction(0):
                    simplex_relation[i] = z[i].abs() / matrix[resolution_row][i].abs()
            resolution_col = simplex_relation.index(min(simplex_relation))

            print_step(matrix, z, res, step, simplex_relation, dict(row=resolution_row, col=resolution_col))

            print("\nРазрешающий элемент - a[{}][{}] = {}".format(resolution_row, resolution_col, matrix[resolution_row][resolution_col]))

            tmp = matrix[resolution_row][resolution_col]
            for i in range(len(matrix[resolution_row])):
                matrix[resolution_row][i] /= tmp

            for i in range(len(matrix)):
                if i != resolution_row and matrix[i][resolution_col] != Fraction(0):
                    coeff = matrix[i][resolution_col] * Fraction(-1)
                    for j in range(len(matrix[0])):
                        matrix[i][j] = matrix[i][j] + matrix[resolution_row][j] * coeff

            coeff = z[resolution_col] * Fraction(-1)
            for i in range(len(z)):
                z[i] = z[i] + matrix[resolution_row][i] * coeff

        else:
            print_step(matrix, z, res, step)

        print("--\n\n")

        print("Z = " + str(z[-1].abs()))


def main():
    # Чтение из файла
    data = read_from_file()
    z, matrix = data["z"], data["matrix"]
    # print_step(matrix, z, list(Fraction(i) for i in range(len(matrix[0]))), 0, list(0 for i in range(len(matrix[0]) - 1)), dict(row=2, col=3))

    dual_simplex_method(matrix, z)
    return


def test():
    pass


if __name__ == '__main__':
    main()
    # test()
