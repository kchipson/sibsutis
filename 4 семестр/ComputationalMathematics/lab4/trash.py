
"""
def read_file():
    functions = []
    x0 = []
    with open("inputF.txt") as f:
        for func in f:
            func = func.strip()
            func = S(''.join(func.split(' ')))
            functions.append(func)

    with open("inputX0.txt") as f:
        for x in f:
            x = x.strip()
            x = S(''.join(x.split(' ')))
            functions.append(x)

    return tuple(functions), tuple(x0)
"""


class SquareMatrix(object):
    def __init__(self, list_: list):
        if len(list_) != len(list_[0]):
            raise Exception('Invalid matrix. The matrix must be square.')
        self.__mat = list()
        for i in list_:
            self.__mat.append([Dec(ii) for ii in i])

    def __str__(self, *args, **kwargs):
        return self.__mat.__str__()

    def __getitem__(self, i: int):
        return self.__mat[i]

    def transpose(self):
        res = []
        n = len(self.__mat)
        m = len(self.__mat[0])
        for j in range(m):
            tmp = []
            for i in range(n):
                tmp.append(self.__mat[i][j])
            res.append(tmp)
        return res

    def det(self):
        return det(self.__mat)