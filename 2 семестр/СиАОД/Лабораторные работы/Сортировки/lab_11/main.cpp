#include <math.h>
#include <iostream>
#include <conio.h>
#include "Filling_method.h"
#include "Checks.h"
#include "Functions.h"
#include "Structure.h"

using namespace std;

int main() {
  int n, t;
  tLE *head = NULL, *tail = NULL;
  setlocale(LC_ALL, "Russian");
  // system("CLS");

  do {
    // system("CLS");
    cout << "1. Заполнение стека возврастающими числами " << endl
         << "2. Заполнение стека убывающими числами " << endl
         << "3. Заполнение стека случайными числами " << endl
         << "4. Печать элементов списка" << endl
         << "5. Подсчет контрольной суммы элементов списка" << endl
         << "6. Подсчет количества серий в списке" << endl
         << "------------------------------------------------" << endl
         << "7. Заполнение очереди возврастающими числами " << endl
         << "8. Заполнение очереди убывающими числами " << endl
         << "9. Заполнение очереди случайными числами " << endl
         << "0. Удаление всех элементов из списка" << endl
         << endl;

    cout << " \nPress [Esc] to exit \n";
    t = _getch();
    system("CLS");
    switch (t) {

    case '1':
      if (head != NULL) {
        cout << "Сначала список нужно удалить!";
        _getch();
        break;
      }
      cout << endl << "Кол-во элементов в стеке: ";
      cin >> n;
      StackFillInc(n, head);
      break;

    case '2':
      if (head != NULL) {
        cout << "Сначала список нужно удалить!";
        _getch();
        break;
      }
      cout << endl << "Кол-во элементов в стеке: ";
      cin >> n;
      StackFillDec(n, head);
      break;

    case '3':
      if (head != NULL) {
        cout << "Сначала список нужно удалить!";
        _getch();
        break;
      }
      cout << endl << "Кол-во элементов в стеке: ";
      cin >> n;
      StackFillRand(n, head);
      break;

    case '4':
      if (head == NULL) {
        cout << "Сначала список нужно заполнить!";
        _getch();
        break;
      }
      PrintList(head, tail);
      _getch();
      break;

    case '5':
      if (head == NULL) {
        cout << "Сначала список нужно заполнить!";
        _getch();
        break;
      }
      PrintList(head, tail);
      cout << " Контрольная сумма: " << CheckSum(head);
      _getch();
      break;

    case '6':
      if (head == NULL) {
        cout << "Сначала список нужно заполнить!";
        _getch();
        break;
      }
      PrintList(head, tail);
      cout << " Число серий: " << RunNumber(head);
      _getch();
      break;

    case '7':
      if (head != NULL) {
        cout << "Сначала список нужно удалить!";
        _getch();
        break;
      }
      cout << endl << "Кол-во элементов в стеке: ";
      cin >> n;
      QueueFillInc(n, head, tail);
      break;

    case '8':
      if (head != NULL) {
        cout << "Сначала список нужно удалить!";
        _getch();
        break;
      }
      cout << endl << "Кол-во элементов в стеке: ";
      cin >> n;
      QueueFillDec(n, head, tail);
      break;

    case '9':
      if (head != NULL) {
        cout << "Сначала список нужно удалить!";
        _getch();
        break;
      }
      cout << endl << "Кол-во элементов в стеке: ";
      cin >> n;
      QueueFillRand(n, head, tail);
      break;

    case '0':
      DeleteList(head, tail);
      _getch();
      break;

    case 27:
      return 0;
    }
  } while (1);
  return 0;
}
