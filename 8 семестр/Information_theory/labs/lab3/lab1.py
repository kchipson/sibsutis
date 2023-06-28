import random
from math import log2


def calc_entropy(filename, symb_in_row):
    with open(filename, 'r') as f:
        line = f.read()
        f.close()
    # if symb_in_row == 1:
    #     split_line = [line[i: i + symb_in_row] for i in range(0, len(line), symb_in_row)]
    #     # print(type(split_line))
    #     # print(split_line)
    # elif symb_in_row == 2:
    #     # print(line)
    #     split_line_first = [line[i: i + symb_in_row] for i in range(0, len(line), symb_in_row)]
    #     # print(split_line_first, len(split_line_first))
    #     split_line_sec = [line[i: i + symb_in_row] for i in range(1, len(line), symb_in_row)]
    #     # print(split_line_sec, len(split_line_sec))
    #     split_line = []
    #     for i in range((len(split_line_first) + len(split_line_sec)) // 2):
    #         if len(split_line_first[i]) == 2:
    #             split_line.append(split_line_first[i])
    #         if len(split_line_sec[i]) == 2:
    #             split_line.append(split_line_sec[i])
    #     # print(split_line, len(split_line))

    split_line = []
    # print(line)
    for i in range(len(line)):
        if i + symb_in_row >= len(line):
            break
        split_line.append(line[i: i + symb_in_row])
    # print(split_line)

    symb_occur = {}
    for c in split_line:
        if c in symb_occur:
            symb_occur.update({c: symb_occur.get(c) + symb_in_row})
        else:
            symb_occur.update({c: 1})

    actual_probability = {k: v / len(line) / symb_in_row for k, v in symb_occur.items()}
    print(f'Фактическая вероятность: {sorted(actual_probability.items())}')

    result = -sum(x * log2(x) for x in actual_probability.values())

    return result / symb_in_row


def count_alphabet_entropy_creating_random_file(alphabet, filename, symbols_num):

    # генерируем файл
    symbols = list(alphabet.keys())
    weights = list(alphabet.values())
    with open(filename, 'w') as f:
        for i in range(symbols_num):
            f.write(''.join(random.choices(symbols, weights)))
        f.close()

    print(f'Алфавит: {alphabet}\n')
    for i in range(1, 4):
        print(f'Энтропия для {i} символа(ов) подряд: {calc_entropy(filename, i)} \n')
    print()


def main() -> int:
    equal_prob = {'a': 1/3, 'b': 1/3, 'c': 1/3}
    diff_prob = {'a': 0.1, 'b': 0.3, 'c': 0.6}

    print("Равные вероятности (Размер файла: 50000 симв.):")
    count_alphabet_entropy_creating_random_file(equal_prob, 'f1.txt', 50000)
    print("~" * 90)

    print("Заданные вероятности (Размер файла: 50000 симв.):")
    count_alphabet_entropy_creating_random_file(diff_prob, 'f2.txt', 50000)
    return 0


if __name__ == '__main__':
    exit(main())
