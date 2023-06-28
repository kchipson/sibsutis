

# 3 5
# 1 0 1 1 1
# 0 1 0 1 0
# 0 0 1 1 1

# 2 5
# 1 0 1 0 1
# 0 1 0 1 1

# 7 4
# 1 0 0 0 1 0 1
# 0 1 0 0 1 1 1
# 0 0 1 0 1 1 0
# 0 0 0 1 0 1 1

# 3 6
# 1 0 0 1 0 1
# 0 1 0 1 1 1
# 0 0 1 1 1 0

def main():
    f = open('matrix4.txt')
    n = -1
    m = -1
    matr = []
    ma = []
    alp = []

    for line in f:
        if n == -1 and m == -1:
            n, m = map(int, line.split())
        else:
            ma = ((line.split()))
            # print(ma)
            matr.append(ma)
    f.close()

    print(f"Порождающая матрица {n} на {m}:")
    for i in range(n):
        for j in range(m):
            matr[i][j] = int(matr[i][j])
            alp.append(matr[i][j])
        print(matr[i])
    print("Размерность кода: ", n)
    print("Количество кодовых слов: ", pow(2, n))

    count = m + 1
    for code in range(len(matr)):
        for i in range(code + 1, len(matr)):
            cou = 0
            for j in range(len(matr[i])):
                if matr[code][j] != matr[i][j]:
                    cou += 1
            if cou < count:
                count = cou

    print("Минимальное кодовое расстояние: ", count)


if __name__ == "__main__":
    exit(main())

