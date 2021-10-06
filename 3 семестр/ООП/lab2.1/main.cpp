#include <iostream>
#include <ctime>
#include <conio.h>
#include <windows.h>
#include "struct.hpp"
#include "functions.hpp"

int main(int a rgc, const char **argv) {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  srand(time(NULL));

  int x, k, p; 
  list *head = listRand(10);

  std::cout << "Начальный список:";
  listPrint(head);
  std::cout << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
  std::cout << "Проверить Базовые функции? (y/n)\n";

  if (selectionCheck()) {

    do {
      system("CLS");
      std::cout << "Список:";
      listPrint(head);
      std::cout
          << "1. добавление элемента после к-ого элемента списка\n"
             "2. удаление из списка к-ого элемента \n"
             "3. подсчет числа элементов в списке \n"
             "4. перемещение р -ого элемента списка после к - ого элемента \n";
      switch (getch()) {
      case 49:
        system("CLS");
        std::cout << "Список:";
        listPrint(head);
        std::cout << "Добавить элемент: ";
        std::cin >> x;
        std::cout << "Добавить элемент после : ";
        std::cin >> k;
        if (listAddAfter(head, x, k)) {
          listPrint(head);
          std::cout << "Продолжить добавление? (y/n)\n";
        } else
          std::cout << "Повторить? (y/n)\n";
        if (selectionCheck()) {
          do {
            std::cout << "Добавить элемент: ";
            std::cin >> x;
            std::cout << "Добавить элемент после : ";
            std::cin >> k;
            if (listAddAfter(head, x, k)) {
              listPrint(head);
              std::cout << "Продолжить добавление? (y/n)\n";
            } else
              std::cout << "Повторить? (y/n)\n";
          } while (selectionCheck());
          std::cout << std::endl;
        }
        break;
      case 50:
        system("CLS");
        std::cout << "Список:";
        listPrint(head);
        std::cout << "Удалить элемент: ";
        std::cin >> k;
        if (listDeleteItem(head, k)) {
          listPrint(head);
          std::cout << "Продолжить добавление? (y/n)\n";
        } else
          std::cout << "Повторить? (y/n)\n";
        if (selectionCheck()) {
          do {
            std::cout << "Удалить элемент: ";
            std::cin >> k;
            if (listDeleteItem(head, k)) {
              listPrint(head);
              std::cout << "Продолжить добавление? (y/n)\n";
            } else
              std::cout << "Повторить? (y/n)\n";
          } while (selectionCheck());
          std::cout << std::endl;
        }
        break;
      case 51:
        system("CLS");
        std::cout << "Список:";
        listPrint(head);
        std::cout << "\n Количество элементов в списке: "
                  << listNumOfItem(head);
        std::cout << std::endl;
        break;
      case 52:
        system("CLS");
        std::cout << "Список:";
        listPrint(head);
        std::cout << "Переместить элемент: ";
        std::cin >> p;
        std::cout << "Переместить после : ";
        std::cin >> k;
        if (moveItemAfter(head, p, k)) {
          listPrint(head);
          std::cout << "Продолжить перемещение? (y/n)\n";
        } else
          std::cout << "Повторить? (y/n)\n";
        if (selectionCheck()) {
          do {
            std::cout << "Переместить элемент: ";
            std::cin >> p;
            std::cout << "Переместить после : ";
            std::cin >> k;
            if (moveItemAfter(head, p, k)) {
              listPrint(head);
              std::cout << "Продолжить перемещение? (y/n)\n";
            } else
              std::cout << "Повторить? (y/n)\n";
          } while (selectionCheck());
          std::cout << std::endl;
        }
        break;

      default:
        break;
      }
      std::cout << "Продолжить проверку базовых функций? (y/n)\n";
    } while (selectionCheck());
    std::cout << std::endl;
  }

  listDelete(head);

  system("CLS");
  head = listRand(20, 10);
  std::cout << "Начальный список:";
  listPrint(head);

  for (k = 1; k * k < 256; k++)
    listAddAfter(head, k * k, 0);

  std::cout << "Список после добавления полных квадратов:";
  listPrint(head);

  list *q = head;
  int c = listNumOfItem(head);
  while (q != NULL) {
    listDeleteValue(head, q->data);
    if (c != listNumOfItem(head)) {
      c = listNumOfItem(head);
    }
    q = q->next;
  }
  std::cout << "Список после удаления дублей:";
  listPrint(head);

  std::cout << "Длина после всех преобразований: " << listNumOfItem(head);

  pauseAtTheEnd();
  return 0;
}
