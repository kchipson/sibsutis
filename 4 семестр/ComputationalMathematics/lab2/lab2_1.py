import copy
import math

EPSILON = 1e-3


def matrix_multiplication(a, b):
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


def matrix_subtraction(a, b):
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


def main():
    a = []
    b = []

    file = open("input.txt", "r")
    for line in file:
        tmp = list(map(float, line.strip().split(" ")))
        a.append(tmp[:-1])
        b.append([tmp[-1]])
    file.close()
    print("Исходные данные:")
    for i in range(len(a)):
        print(("{:10.6f}" * len(a[i]) + " │ {:>10.6f}").format(*a[i], b[i][0]))

    for i in range(len(a)):
        b[i][0] /= a[i][i]
        a[i] = [j / a[i][i] for j in a[i]]
    print("\nМатрица, приведенная к виду, удобному для итерации:")
    for row in a:
        print(("{:10.6f}" * len(row)).format(*row))

    a_e = [[(1 if i == j else 0) for j in range(len(a))] for i in range(len(a))]
    print("\nЕдиничная матрица:")
    for row in a_e:
        print(("{:10.6f}" * len(row)).format(*row))

    a_c = copy.deepcopy(a)
    for i in range(len(a_c)): a_c[i][i] = 0
    print("\nМатрица C:")
    for row in a_c:
        print(("{:10.6f}" * len(row)).format(*row))

    infinite_norm_c = max(sum(abs(j) for j in i) for i in a_c)
    infinite_norm_b = max(abs(i[0]) for i in b)
    n = math.log((EPSILON * (1 - infinite_norm_c)) / infinite_norm_b) / math.log(infinite_norm_c) + 1
    print(f"\nНеобходимое кол-во итераций для {EPSILON} точности: {n}\n\n")

    num_dec_places = int(len(str(EPSILON).split('.')[1]))
    i = 0
    x = [[0] for i in range(len(b))]
    while i < n:
        x = matrix_subtraction(b, matrix_multiplication(a_c, x))
        print(f"\n {i + 1} итерация:")
        for el in x:
            print(f"{el[0]: 30}")
            # print(f"{(int(el[0]*10**num_dec_places)/10**num_dec_places):30}") # если без округления
            # print(f"{el[0]:30.{num_dec_places}f}") # округляя
        i += 1


def test():
    f = [-100, 0, 10]
    print(sum(abs(i) for i in f))


if __name__ == "__main__":
    main()
    # test()

