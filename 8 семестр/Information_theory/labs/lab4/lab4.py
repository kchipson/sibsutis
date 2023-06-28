from lab3 import *
import re
from collections import Counter
from math import log, ceil

def huffman_code_modified(text: str, n: int):
    print("Хаффман: ")
    split_line = list(text[i: i + n] for i in range(len(text)))

    probabilities = {k: v / len(split_line) for k, v in Counter(split_line).items()}
    probabilities = dict(
        sorted(probabilities.items(), key=lambda item: item[1], reverse=True)
    )
    # print(probabilities)

    leaf = [Node(k,v) for k, v in probabilities.items()]
    while len(leaf) != 1:
        leaf.sort(key=lambda node:node.value, reverse=True)
        node = Node(value=(leaf[-1].value + leaf[-2].value))
        node.lchild = leaf.pop(-1)
        node.rchild =leaf.pop(-1)
        leaf.append(node)
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
        print( f"{i}: {probabilities[i]:.10f} - {codes[i]}")
    l_average = sum(probabilities[i] * len(codes[i]) for i in probabilities.keys())
    print("Средняя длина кодовых слов (L ср.):", l_average)

    # print("--")
    # print("Текст:  coded_huffman.txt")
    with open("coded_huffman.txt", "w") as f:
        for i in [text[i:i+n] for i in range(0, len(text), n)]:
            f.write(codes[i])

    with open("coded_huffman.txt", "r") as f:
        text = f.readline()
    # for i in range(1, 2):
    #     print(f'Энтропия для {i} символа(ов) подряд:', calc_entropy_modified(text, i))
    return l_average


def main():
    n = 3
    print("Текст:\t1984 — George Orwell. Русский язык. Часть первая")
    print("~"*80)
    text = preprocess_file("1984.txt", "ru")
    orig_entropy = calc_entropy_modified(text, n)
    print("Энтропия оригинального текста:", orig_entropy)
    huffman_code_modified(text, n)

    return 0


if __name__ == "__main__":
    exit(main())
