from lab2 import *
import re
from collections import Counter
from math import log2, ceil


def decimal_converter(num):
    if num == 0.0:
        return 0.0
    while num > 1:
        num /= 10
    return num


def float_bin(number: float, places: int):
    whole, dec = str(number).split(".")
    whole = int(whole)
    dec = int(dec)
    res = bin(whole).strip("0b") + "."
    for x in range(places):
        whole, dec = str((decimal_converter(dec)) * 2).split(".")
        dec = int(dec)
        res += whole
    return res


def shanon_code(text: str):
    print("\nШенон: ")
    split_line = list(text[i: i + 1] for i in range(len(text)))

    probabilities = {k: v / len(split_line) for k, v in Counter(split_line).items()}
    probabilities = dict(
        sorted(probabilities.items(), key=lambda item: item[1], reverse=True)
    )
    # print(probabilities)

    code_length = [ceil(-log2(i)) for i in probabilities.values()]
    # print(code_length)

    cumulative_probs = [float(0) for _ in range(len(probabilities))]
    for i in range(1, len(probabilities)):
        cumulative_probs[i] = (
            cumulative_probs[i - 1] + list(probabilities.values())[i - 1]
        )
    # print(cumulative_probs)

    codes = list()
    for i in range(len(cumulative_probs)):
        codes.append(float_bin(cumulative_probs[i], code_length[i])[1:])
        print(
            f"{list(probabilities.keys())[i]}: {list(probabilities.values())[i]:.4f} - {codes[i]}"
        )

    # print(codes)
    l_average = sum(
        list(probabilities.values())[i] * code_length[i]
        for i in range(len(probabilities.items()))
    )
    print("Средняя длина кодовых слов (L ср.):", l_average)


    print("--")
    print("Текст:  coded_shanon.txt")
    with open("coded_shanon.txt", "w") as f:
        for i in text:
            index = list(probabilities.keys()).index(i)
            f.write(codes[index])

    with open("coded_shanon.txt", "r") as f:
        text = f.readline()
    for i in range(1, 4):
        print(f'Энтропия для {i} символа(ов) подряд:', calc_entropy_modified(text, i))
    return l_average




# Создать класс узла
class Node(object):
    def __init__(self, name=None, value=None):
        self.name = name
        self.value = value
        self.lchild = None
        self.rchild = None


def huffman_code(text: str):

    print("Хаффман: ")
    split_line = list(text[i: i + 1] for i in range(len(text)))

    probabilities = {k: v / len(split_line) for k, v in Counter(split_line).items()}
    probabilities = dict(
        sorted(probabilities.items(), key=lambda item: item[1], reverse=True)
    )
    # print(probabilities)

    leaf = [Node(k,v) for k, v in probabilities.items()]
    while len(leaf) != 1:
        leaf.sort(key=lambda node:node.value, reverse=True)
        n = Node(value=(leaf[-1].value + leaf[-2].value))
        n.lchild = leaf.pop(-1)
        n.rchild =leaf.pop(-1)
        leaf.append(n)
    tree = leaf[0]

    # Создавать коды с рекурсивным мышлением

    codes = dict()
    def generate(tree, code=''):
        node = tree
        if (not node):
            return
        elif node.name:
            codes[node.name] = code
            return
        generate(node.lchild, code + '0')
        generate(node.rchild, code + '1')
    
    generate(tree)

    for i in probabilities.keys():
        print( f"{i}: {probabilities[i]:.4f} - {codes[i]}")
    l_average = sum(probabilities[i] * len(codes[i]) for i in probabilities.keys())
    print("Средняя длина кодовых слов (L ср.):", l_average)

    print("--")
    print("Текст:  coded_huffman.txt")
    with open("coded_huffman.txt", "w") as f:
        for i in text:
            f.write(codes[i])

    with open("coded_huffman.txt", "r") as f:
        text = f.readline()
    for i in range(1, 4):
        print(f'Энтропия для {i} символа(ов) подряд:', calc_entropy_modified(text, i))
    return l_average

        

def main():
    print("Текст:\t1984 — George Orwell. Русский язык. Часть первая")
    print("~"*80)
    text = preprocess_file("1984.txt", "ru")
    orig_entropy = calc_entropy_modified(text, 1)
    print("Энтропия оригинального текста:", orig_entropy)
    # # избыточность кодироавния
    # print("Избыточность кодирования (r): ", shanon_code(text) - orig_entropy)
    shanon_code(text)
    print('\n\n')
    huffman_code(text)
    # tree = HuffmanTree(text)
    # tree.get_code()
    return 0


if __name__ == "__main__":
    exit(main())
