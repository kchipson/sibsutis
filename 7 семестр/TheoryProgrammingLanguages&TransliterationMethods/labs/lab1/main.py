from dataclasses import dataclass
import argparse
import json
import sys

@dataclass
class Grammar:
    VT: list[str]
    VN: list[str]
    P: dict[str, list[str]]
    S: str

def parser() -> list[str, int, int]:
    default_input = "input.json"
    def check_positive(value: str) -> int:
        try:
            ivalue = int(value)
            if ivalue < 0:
                raise ValueError
        except ValueError:
            raise argparse.ArgumentTypeError(f"{value} не является натуральным числом")
        return ivalue

    parser = argparse.ArgumentParser(description="ТЯП. Лабораторная работа #1")
    parser.add_argument("-f", "--file", 
                        type=argparse.FileType(),
                        dest="grammar_file",
                        default=default_input,
                        metavar="FILENAME", 
                        help="JSON файл, содержащий КС - грамматику"
                        )
    parser.add_argument("-r", "--range", 
                        type=check_positive,
                        required=True,
                        nargs=2,
                        dest="range",
                        metavar=("FROM", "TO"),
                        help="2 натуральных числа - диапазон длин генерируемых цепочек")
    
    args = parser.parse_args()
    if args.range[0] > args.range[1]:
        args.range[0], args.range[1] = args.range[1], args.range[0]

    return args.grammar_file, *args.range 

def count_non_term_sym(grammar, sequence):
    length = 0
    for sym in sequence:
        if sym in grammar.VT:
            length += 1
    return length

if __name__ == "__main__":
    w = ['S', 'G']
    a = 'SGGGSa'
    print(sum(a.count(i) for i in w))
    exit()
    file, range_l, range_r = parser()

    try:
        data = json.load(file) 
        grammar = Grammar(*data.values())  
    except json.JSONDecodeError as e:
        raise Exception("\nНекоректный файл формата JSON") from e
    except TypeError as e:
        print(e)
        raise ValueError("\nГрамматика некоректна") from e

    stack = list(grammar.S)
    used_sequence = set()
    while stack:

        sequence = stack.pop()
        print("seq: " + sequence)
        if sequence in used_sequence:
            continue
        used_sequence.add(sequence)
        
        no_VN = True
        for i, symbol in enumerate(sequence):
            print(i, "symbol: " + symbol)
            if symbol in grammar.VN:
                no_VN = False
                for elem in grammar.P[symbol]:
                    _tmp = sequence[:i] + elem + sequence[i + 1:]
                    if count_non_term_sym(grammar, _tmp) <= right_border + 1 and _tmp not in stack:
                        stack.append(_tmp)
                        
        for elem in stack:
            print("stack: " + elem)
        
        if no_VN and range_l <= len(sequence) <= range_r:
            print(sequence if sequence else "λ")
        print("******")