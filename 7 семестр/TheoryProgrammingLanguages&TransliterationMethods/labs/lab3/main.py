from dataclasses import dataclass
from typing import Dict, List
from tkinter import *
from tkinter import filedialog
from os import path
from functools import partial
from colorama import Fore, init
import json

nomachine = 0;
window = Tk()
txt = Entry(window, width=60)


@dataclass
class Machine:
    Q: List[str]
    V: List[str]
    Func: Dict[str, Dict[str, str]]
    Start: str
    End: str


def machine_input(filename):
    try:
        with open(filename, "r") as json_file:
            data = json.load(json_file)
    except FileNotFoundError:
        print(Fore.RED + "Файл с данными не найден.")
        exit(-1)
    states = data["states"]
    alphabet = data["alphabet"]
    func = data["Func"]
    start = data["start"]
    ends = data["ends"]
    lbl_machine = Label(window, text=f"M({states}, {alphabet}, δ, {start}, {ends})", font=("Arial", 15), padx=5,
                        pady=10)
    # lbl_machine.place(x=10, y=40)
    lbl_machine.grid(row=1, column=0, sticky="w")
    print(f"M({states}, {alphabet}, δ, {start}, {ends})")
    print(f"δ = {list(func.keys())}")
    machine = Machine(states, alphabet, func, start, ends)
    return machine


# Отрисовывает таблицу переходов
def generate_func_tab(machine, frame):
    lbl_sigma = Label(frame, text=f"δ", font=("Arial", 15), padx=5, pady=5)
    lbl_sigma.grid(row=0, column=0)
    for i in range(len(machine.V)):
        lbl_alphabet = Label(frame, text=f"'{list(machine.V)[i]}'", font=("Arial", 15), padx=5, pady=5)
        lbl_alphabet.grid(row=0, column=1 + i)
    for i in range(len(machine.Q)):
        # print(list(machine.Func)[0])
        lbl_state = Label(frame, text=f"{list(machine.Q)[i]}:", font=("Arial", 15), padx=5, pady=5)
        lbl_state.grid(row=1 + i, column=0)
        for j in range(len(machine.V)):
            text = "λ"
            if (state := machine.Func.get(list(machine.Q)[i])) is not None:
                if (passage := state.get(list(machine.V)[j])) is not None:
                    text = passage
            lbl_alphabet = Label(frame, text=text, font=("Arial", 15), padx=5, pady=5)
            lbl_alphabet.grid(row=1 + i, column=1 + j)


def clicked():
    file = filedialog.askopenfilename(filetypes=[("Json Files", "*.json"), ("All Files", "*.*")],
                                      initialdir=path.dirname(__file__))
    if not file:
        return
    result = machine_input(file)
    frame = Frame(master=window, padx=10, pady=15)
    generate_func_tab(result, frame)
    # frame.place(x=10, y=90)
    frame.grid(row=2, column=0, sticky="w")
    lbl_check_word = Label(window, text=f" Введите цепочку для проверки: ", font=("Arial", 15), padx=5, pady=10)
    lbl_check_word.grid(row=3, column=0, sticky="w")
    txt.grid(row=4, column=0)
    btn_check_word = Button(window, text="Проверить", command=partial(check_button, result), padx=10, pady=10)
    btn_check_word.grid(row=4, column=1, sticky="e")

    print(result)
    print(result.Func)
    print(result.Func.get(list(result.Q)[0]))


def check_button(machine):
    text = txt.get()
    if text == 'quit':
        return 0
    # for c in text:
    #     print(c in machine.V)
    if all([c in machine.V for c in text]):
        print(Fore.GREEN + "Цепочка состоит только из символов алфавита, начинаю проверку...")
        check_word(text, machine, machine.Start)
    else:
        print(Fore.RED + "\nОшибка. Слово состоит из символов, которых нет в алфавите.\n")


def check_word(word, machine, state):
    if word == "λ":
        print(f"({state}, {word})")
        print(f"Конечное состояние: {state}")
        if state in machine.End:
            print(Fore.GREEN + "Цепочка принадлежит заданному ДКА.\n")
        else:
            print(Fore.RED + "Ошибка. Конечное состояние не принадлежит множеству конечных состояний ДКА.\n")
        return

    print(f"({state}, {word})")
    if len(word) > 1:
        print(f"(δ({state},{word[0]}), {word[1:]})")
        try:
            state = machine.Func[state][word[0]]
        except KeyError:
            print(Fore.RED + "Ошибка. Отсутсвует переход для данного состояния.\n")
            return
        word = word[1:]
    else:
        print(f"(δ({state},{word[0]}), λ)")
        try:
            state = machine.Func[state][word[0]]
        except KeyError:
            print(Fore.RED + "Ошибка. Отсутсвует переход для данного состояния.\n")
            return
        word = "λ"
    check_word(word, machine, state)


if __name__ == '__main__':
    # window.columnconfigure(1, minsize=400, weight=1)
    # window.rowconfigure(0, minsize=250, weight=1)
    window.title("Добро пожаловать на сервер PythonRu")
    # window.geometry('400x250')
    lbl = Label(window, text="ДКА:", font=("Arial Bold", 20))
    lbl.grid(row=0, column=0, sticky="nw")
    # lbl.place(x=0, y=0)
    btn = Button(window, text="Загрузить ДКА!", command=clicked, padx=10, pady=10)
    btn.grid(row=0, column=1, sticky="e")
    # btn.place(x=290, y=220)
    window.mainloop()
