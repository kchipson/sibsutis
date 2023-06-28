from dataclasses import dataclass
from typing import Dict, List
import tkinter as tk
import tkinter.filedialog
import tkinter.messagebox
from os import path
from functools import partial
from colorama import Fore, init
import json


window = tk.Tk()

@dataclass
class Machine:
    Q: List[str]
    V: List[str]
    Rules: List[List[str]]
    Start_state: str
    Current_state: str
    Start_stack: str
    Stack: str
    End: List[str]


def machine_input(filename):
    try:
        with open(filename, "r") as json_file:
            data = json.load(json_file)
    except FileNotFoundError:
        print(Fore.RED + "Файл с данными не найден.")
        exit(-1)
    states = data["states"]
    alphabet = data["alphabet"]
    in_stack = data["in_stack"]
    rules = data["rules"]
    start = data["start"]
    stack = data["start_stack"]
    end = data["end"]
    lbl_machine = tk.Label(window, text=f"P({states}, {alphabet}, {in_stack}, δ, {start}, {stack}, {end})",
                        font=("Arial", 15), padx=5, pady=10)
    lbl_machine.grid(row=1, column=0, sticky="w")
    print(f"P({states}, {alphabet}, {in_stack}, δ, {start}, {stack}, {end})")
    for i in rules:
        if i[1] == "EPS":
            i[1] = "ε";
        if i[4] == "EPS":
            i[4] = "ε";
        print(f"({i[0]}, {i[1]}, {i[2]}) -> ({i[3]}, {i[4]})")
    machine = Machine(states, alphabet, rules, start, start, stack, stack, end)
    return machine


def upload_file():
    file = tk.filedialog.askopenfilename(filetypes=[("Json Files", "*.json"), ("All Files", "*.*")],
                                      initialdir=path.dirname(__file__))
    if not file:
        return
    
    line = tk.Entry(master=window, width=60)
    out = tk.Text(master=window, width=60, height=10)

    machine = machine_input(file)
    
    frame = tk.Frame(master=window, padx=10, pady=15)
    
    for i in range(len(machine.Rules)):
        rule = machine.Rules[i]
        
        tk.Label(frame, text=f"({rule[0]}, {rule[1]}, {rule[2]})", font=("Arial", 12), padx=5, pady=5).grid(row=1 + i, column=0)
        tk.Label(frame, text=f"→", font=("Arial", 12), padx=5, pady=5).grid(row=1 + i, column=1)
        tk.Label(frame, text=f"({rule[3]}, {rule[4]})", font=("Arial", 12), padx=5, pady=5).grid(row=1 + i, column=2)

    frame.grid(row=2, column=0, sticky="w")
    
    lbl_check_word = tk.Label(window, text=f" Введите цепочку для проверки: ", font=("Arial", 13), padx=5, pady=10)
    lbl_check_word.grid(row=3, column=0, sticky="w")
    
    line.grid(row=4, column=0)
    
    btn_check_word = tk.Button(window, text="Проверить", command=partial(check_string, machine, line, out), padx=10, pady=10)
    btn_check_word.grid(row=4, column=1, sticky="e")

    # out.grid(row=5, column=0, columnspan=2, sticky="w", padx=10)
    # scroll = tk.Scrollbar(command=out.yview)
    # scroll.grid(row=5, column=1, sticky="n"+"s"+"w", padx=10)
    # out.config(yscrollcommand=scroll.set)


def check_string(machine, line, out):
    text = line.get()
    out.delete("1.0",tk.END)
    machine.Current_state = machine.Start_state
    machine.Stack = machine.Start_stack
    if all([c in machine.V for c in text]):
        print(Fore.GREEN + "Цепочка состоит только из символов алфавита, начинаю проверку..." + Fore.RESET)
        out.insert(tk.END, "Цепочка состоит только из символов алфавита, начинаю проверку...")
        check_word(machine, text, out)
        
    else:
        tk.messagebox.showerror("Ошибка", "Ошибка. Слово состоит из символов, которых нет в алфавите.")
        print(Fore.RED + "Ошибка. Слово состоит из символов, которых нет в алфавите." + Fore.RESET)


def check_word(machine, word, text):
    step = 1
    for i in word:
        
        print(Fore.CYAN + "Шаг" + Fore.RESET, step)
        print(f"  Символ: {i}")
        print(f"  Стек: {machine.Stack}")
        text.insert(tk.END, f"Шаг {step}\n")
        text.insert(tk.END, f"  Символ: {i}\n")
        text.insert(tk.END, f"  Стек: {machine.Stack}\n")
        
        ban = True
        for j in machine.Rules: 
            if machine.Current_state != j[0] or i != j[1] or machine.Stack[0] != j[2]:
                continue

            print(f"Rule: ({j[0]}, {j[1]}, {j[2]}) -> ({j[3]}, {j[4]})\n")
            text.insert(tk.END, f"Rule: ({j[0]}, {j[1]}, {j[2]}) -> ({j[3]}, {j[4]})\n\n")
            machine.Current_state = j[3]
            if len(j[4]) == 2:
                machine.Stack = i + machine.Stack
            elif j[4] == "ε":
                machine.Stack = machine.Stack[1:]
            ban = False
            break
        step += 1
        if ban:
            print(Fore.RED + "Ошибка. Отсутсвует переход для данного состояния.\n" + Fore.RESET)
            text.insert(tk.END, f"Ошибка. Отсутсвует переход для данного состояния.\n\n")
            return
        
    while tk.TRUE:
        if len(machine.Stack) == 0 and machine.Current_state in machine.End:
            print(Fore.GREEN + "Цепочка принадлежит заданному ДКА.\n" + Fore.RESET)
            text.insert(tk.END, f"Цепочка принадлежит заданному ДКА.\n\n")
            return
        
        print(Fore.CYAN + "Шаг" + Fore.RESET, step)
        print(f"  Символ: ε")
        print(f"  Стек: {machine.Stack}")
        text.insert(tk.END, f"Шаг {step}\n")
        text.insert(tk.END, f"Символ: ε\n")
        text.insert(tk.END, f"Стек: {machine.Stack}\n")
        
        ban = True
        for j in machine.Rules:
            if machine.Current_state != j[0] or "ε" != j[1] or machine.Stack[0] != j[2]:
                continue

            print(f"Rule: ({j[0]}, {j[1]}, {j[2]}) -> ({j[3]}, {j[4]})\n")
            text.insert(tk.END, f"Rule: ({j[0]}, {j[1]}, {j[2]}) -> ({j[3]}, {j[4]})\n\n")
            machine.Current_state = j[3]
            if j[4] == "ε":
                machine.Stack = machine.Stack[1:]
                ban = False
                break
        step += 1
        if ban:
            print(Fore.RED + "Ошибка. Отсутсвует переход для данного состояния.\n" + Fore.RESET)
            text.insert(tk.END, f"Ошибка. Отсутсвует переход для данного состояния.\n\n")
            return


if __name__ == '__main__':
    window.title("ТЯПиМТ - лучший предмет")
    lbl = tk.Label(window, text="ДМПА:", font=("Arial Bold", 20))
    lbl.grid(row=0, column=0, sticky="nw")
    btn = tk.Button(window, text="Загрузить ДМПА", command=upload_file, padx=10, pady=10)
    btn.grid(row=0, column=1, sticky="e")
    window.mainloop()
