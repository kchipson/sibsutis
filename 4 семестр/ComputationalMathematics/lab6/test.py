def test():
    a = [i for i in range(10, 1, -1)]
    print("a  |", a)

    b = list(map(lambda x, y: x - y, a[1:], a))
    print("b  |", b)
