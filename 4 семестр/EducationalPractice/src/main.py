from os import path
import csv
import requests
from bs4 import BeautifulSoup

FILE_NAME = "../currencies.csv"
URL = "https://coinmarketcap.com/"

S_BOLD = "\033[1m"
S_RESET = "\033[0m"

C_RED = "\033[31m"
C_GREEN = "\033[32m"
C_YELLOW = "\033[33m"
C_CYAN = "\033[36m"


def parser_file():
    data = []
    try:
        file = open('/'.join(path.abspath(__file__).split('/')[:-1]) + '/' + FILE_NAME, 'r')
        table = csv.reader(file, delimiter=';')

        for row in table:
            item = {"name":      row[0],
                    "marketCap": row[1],
                    "price":     row[2]
                    }
            data.append(item)

        file.close()

    except FileNotFoundError:
        print(C_RED + S_BOLD + f"Ошибка! Файл \'{FILE_NAME}\' не обнаружен!")
        print(S_RESET)
        exit()

    return data


def parser_web():
    try:
        temp = 1
        table = []
        data = []
        print(C_YELLOW)
        print("Парсинг сайта...")
        print(S_RESET)

        while requests.get(URL + str(temp)).ok:
            soup = BeautifulSoup(requests.get(URL + str(temp)).text, "html.parser")
            page = soup.find_all(class_="cmc-table-row")  # строки таблицы
            for row in page:
                item = {"name":      row.find("td", class_="cmc-table__cell--sort-by__name").div.a.text,
                        "marketCap": row.find("td", class_="cmc-table__cell--sort-by__market-cap").div.text,
                        "price":     row.find("td", class_="cmc-table__cell--sort-by__price").a.text
                        }
                if item["marketCap"] == "$?" or item["price"] == "$?":
                    return data
                data.append(item)
            temp += 1
        return data

    except requests.exceptions.ConnectionError:
        print(C_RED + "Ошибка! Неудалось подключиться к серверу!")
        print(C_CYAN + "Проверьте подключение к интернету, а также работоспособность сайта!")
        print(S_RESET)
        exit()


def find_by_name(data, name):
    items = []
    for item in data:
        if item.get("name").upper().startswith(name.upper()):
            items.append(item)
    return items


def print_data(data):
    print(S_BOLD + C_GREEN)
    print(f"{'Название':35}  {'Рыночная капитализация':>25}    {'Цена':>15}")
    print(C_CYAN)
    for item in data:
        print(f"{item['name']:35}  {item['marketCap']:>25}    {item['price']:>15}")
    print(C_YELLOW)
    print("Кол-во элементов: ", len(data))
    print(S_RESET)


def main():
    data = []

    print("Считать данные из...")
    while True:
        choice = input("[F]ile|[W]eb: ").upper()
        if choice not in ['F', 'W']:
            print(C_RED + "Ошибка! Некорректный ввод!" + S_RESET)
        else:
            break

    if choice == 'F':
        data = parser_file()
    elif choice == 'W':
        data = parser_web()

    print_data(data)

    while True:
        found = find_by_name(data, input("Введите строку для поиска криптовалюты: "))
        if found:
            print_data(found)
        else:
            print(C_RED + "Криптовалюты не найдены!" + S_RESET)

        print("\n\nПовторить поиск?")
        while True:
            choice = input("[Y]es|[N]o: ").upper()
            if choice not in ['Y', 'N']:
                print(C_RED + "Ошибка! Некорректный ввод!" + S_RESET)
            else:
                break

        if choice == 'N':
            break


if __name__ == '__main__':
    main()
