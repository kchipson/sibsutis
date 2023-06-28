from lab1 import *
from collections import Counter
import re

def preprocess_file(filename: str, lang: str):
    with open(filename, 'r', encoding='utf-8') as f:
        line = f.read()
        f.close()
    line = line.lower()
    if lang == "ru":
        line = re.sub(r'[^а-яА-Я0-9 ]', '', line)
    elif lang == "en":
        line = re.sub(r'[^a-zA-Z0-9 ]', '', line)
    else:
        exit(1)
    return line


def calc_entropy_modified(line, symb_in_row):

    split_line = list(
        line[i: i + symb_in_row] for i in range(len(line) - symb_in_row + 1)
    )

    actual_probability = {k: v / len(line) for k, v in Counter(split_line).items()}
    
    # if symb_in_row ==1:
        # print(f'Размер алфавита: {len(actual_probability)}\nH0 =log2({len(actual_probability)}) = {log2(len(actual_probability))}\n')
        # print(f'Фактическая вероятность: {sorted(actual_probability.items())}')

    result = -sum(x * log2(x) for x in actual_probability.values())

    return result / symb_in_row


# название файла, и до какого количества чисел подряд считаем
def count_alphabet_entropy_using_created_file(filename, symbols_streak):
    for i in range(1, symbols_streak):
        print(f'Энтропия для {i} символа(ов) подряд: {calc_entropy_modified(filename, i)}')


def main():

    print("Текст:\t1984 — George Orwell. Русский язык. Часть первая")
    print("~"*80)
    line = preprocess_file('1984.txt', 'ru')
    count_alphabet_entropy_using_created_file(line, 6)

    return 0


if __name__ == '__main__':
    exit(main())
