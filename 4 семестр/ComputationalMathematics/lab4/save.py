import sympy as sp
import numpy as np
import decimal

from decimal import Decimal as Dec

decimal.getcontext().prec = 60


def matrix_multiplication(a: list, b: list):
    res = []
    if len(a[0]) != len(b):
        print("Матрицы не могут быть перемножены")
        exit()
    else:
        temp = 0
        row = []
        for z in range(len(a)):  # строки a
            for j in range(len(b[0])):  # столбцы b
                for i in range(len(b)):  # строки b && столбцы a
                    temp += a[z][i] * b[i][j]
                row.append(temp)
                temp = 0
            res.append(row)
            row = []
    return res


def matrix_subtraction(a: list, b: list):
    res = []
    if len(a[0]) != len(b[0]) or len(a) != len(b):
        print("Матрицы не могут быть вычтены")
        exit()
    else:
        for i in range(len(a)):
            row = []
            for j in range(len(a[0])):
                row.append(a[i][j] - b[i][j])
            res.append(row)
    return res


def det(mat: list):
    s = len(mat)
    k = 1
    d = 0

    if s == 1:
        d = mat[0][0]
    elif s == 2:
        d = mat[0][0] * mat[1][1] - (mat[1][0] * mat[0][1])
    elif s > 2:
        for i in range(s):
            d = d + k * mat[i][0] * det([mat[j][1:] for j in range(s) if j != i])
            print(d)
            input()
            k = -k
    return d


def transpose(mat: list):
    res = []
    n = len(mat)
    m = len(mat[0])
    for j in range(m):
        tmp = []
        for i in range(n):
            tmp.append(mat[i][j])
        res.append(tuple(tmp))
    return tuple(res)


def main():
    """ Входные данные """
    x, y = sp.symbols('x, y')
    symbs = [x, y]
    funcs = (x * y - Dec('2.3'), x / y - Dec('1.9'))
    roots = [[Dec('2.0')], [Dec('1.0')]]
    epsilon = Dec(1e-3)

    print("Система уравнений: ", ("\n\t* '{}'" * len(funcs)).format(*funcs))
    print()
    print("x0: ", *roots)
    print()
    diff_funcs = tuple(tuple(sp.diff(fun, i) for i in symbs) for fun in funcs)
    if len(diff_funcs) != len(diff_funcs[0]):
        raise Exception('Invalid matrix. The matrix must be square.')

    print('~' * 60)
    print("dF/dx = ", *diff_funcs)
    print("△ = ", det(list(diff_funcs)))
    determinant = det(list(diff_funcs))  # определитель
    if determinant == 0:
        raise Exception('The determinant is zero.')
    print("(dF/dx)^T  = ", transpose(list(diff_funcs)))
    transpon = transpose(list(diff_funcs))  # Транспонированная матрица
    obrat = []  # Обратная матрица, без определителя
    for i in range(len(transpon)):
        tmp = []
        for j in range(len(transpon[0])):
            # print()
            tmp.append((-1) ** (i + j + 2) * det(
                [[transpon[k][kk] for kk in range(len(transpon[0])) if kk != j] for k in range(len(transpon)) if k != i]))
        obrat.append(tuple(tmp))
    obrat = tuple(obrat)

    print(f"(dF/dx)^-1 = {1/determinant} *", obrat)
    print(("#" * 60 + "\n") * 2)

    roots_p = roots
    check = True

    """ ОСНОВНОЕ ТЕЛО """
    while check:
        print()
        # dd = [[diff_funcs. for j in range(len(diff_funcs[0]))] for i in range(len(diff_funcs))]4
        """ Вывод F(x)(с подставленными x) """
        funcs_x = []
        for i in range(len(funcs)):
            funcs_x.append([Dec(str(funcs[i].subs([(symbs[k], roots[k][0]) for k in range(len(roots))])))])
        print("F(x) = ", funcs_x)

        """ Вывод dF/dx(с подставленными x) """
        diff_funcs_x = []
        for i in range(len(diff_funcs)):
            tmp = []
            for j in range(len(diff_funcs[0])):
                tmp.append(Dec(str(diff_funcs[i][j].subs([(symbs[k], roots[k][0]) for k in range(len(roots))]))))
            diff_funcs_x.append(tmp)
        print("dF/dx =", diff_funcs_x)

        """ Вывод △(с подставленными x) """
        determinant_x = det(diff_funcs_x)
        if determinant_x == 0:
            raise Exception('The determinant is zero.')
        print(f"\n△ = {determinant_x}\n")

        """ Вывод (dF/dx)^T (с подставленными x) """
        print("(dF/dx)^T = ")
        for i in range(len(diff_funcs)):
            for j in range(len(diff_funcs[0])):
                print(f"{str(transpon[i][j].subs([(symbs[k], roots[k][0]) for k in range(len(roots))])):>20}", end='')
            print()
        print()
        """ Вывод (dF/dx)^-1 (с подставленными x) """
        print("(dF/dx)^T = ")
        obrat_x = []
        for i in range(len(diff_funcs)):
            tmp = []
            for j in range(len(diff_funcs[0])):
                tmp.append((1/determinant_x) * obrat[i][j].subs([(symbs[k], roots[k][0]) for k in range(len(roots))]))
                print(f"{str((1/determinant_x) * obrat[i][j].subs([(symbs[k], roots[k][0]) for k in range(len(roots))])):>20}", end='')
            obrat_x.append(tmp)
            print()
        print()

        # print(matrix_multiplication(obrat_x, funcs_x))
        print("X prev: ", *roots)
        roots = matrix_subtraction(roots, matrix_multiplication(obrat_x, funcs_x))

        print("X: ", *roots)
        check = (max(sum(abs(j) for j in i) for i in matrix_subtraction(roots, roots_p)) > epsilon)
        if check:
            roots_p = roots
            print()
            print("~" * 60)





def test():
    """
    x, y = sympy.symbols('x, y')
    print(x, y)
    f = x**2
    print(f.subs(x, 2))
    print(sympy.diff(f))
    str = "x ^ y - 2.3 = 0"
    result = [Eq(*map(S, str.split("=")))]
    """
    # a = [[1, 2], [3, 4]]
    # print(a)
    # q = np.array([1, 2, 3], [2, 3, 4])
    # print(q.transpose())
    # np.linalg.det

    # print(mm, end="\n")
    # print(mm.transpose())

    # a = Dec(1)
    # print(a.__str__())
    """
    a = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9]
    ]
    i, j = 1, 1

    print([[a[k][kk] for kk in range(len(a)) if kk != j] for k in range(len(a)) if k != i])
    """
    # det([mat[j][1:] for j in range(s) if j != i]


if __name__ == "__main__":
    main()
    # test()
