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
    cout << "1. ���������� ����� �������������� ������� " << endl
         << "2. ���������� ����� ���������� ������� " << endl
         << "3. ���������� ����� ���������� ������� " << endl
         << "4. ������ ��������� ������" << endl
         << "5. ������� ����������� ����� ��������� ������" << endl
         << "6. ������� ���������� ����� � ������" << endl
         << "------------------------------------------------" << endl
         << "7. ���������� ������� �������������� ������� " << endl
         << "8. ���������� ������� ���������� ������� " << endl
         << "9. ���������� ������� ���������� ������� " << endl
         << "0. �������� ���� ��������� �� ������" << endl
         << endl;

    cout << " \nPress [Esc] to exit \n";
    t = _getch();
    system("CLS");
    switch (t) {

    case '1':
      if (head != NULL) {
        cout << "������� ������ ����� �������!";
        _getch();
        break;
      }
      cout << endl << "���-�� ��������� � �����: ";
      cin >> n;
      StackFillInc(n, head);
      break;

    case '2':
      if (head != NULL) {
        cout << "������� ������ ����� �������!";
        _getch();
        break;
      }
      cout << endl << "���-�� ��������� � �����: ";
      cin >> n;
      StackFillDec(n, head);
      break;

    case '3':
      if (head != NULL) {
        cout << "������� ������ ����� �������!";
        _getch();
        break;
      }
      cout << endl << "���-�� ��������� � �����: ";
      cin >> n;
      StackFillRand(n, head);
      break;

    case '4':
      if (head == NULL) {
        cout << "������� ������ ����� ���������!";
        _getch();
        break;
      }
      PrintList(head, tail);
      _getch();
      break;

    case '5':
      if (head == NULL) {
        cout << "������� ������ ����� ���������!";
        _getch();
        break;
      }
      PrintList(head, tail);
      cout << " ����������� �����: " << CheckSum(head);
      _getch();
      break;

    case '6':
      if (head == NULL) {
        cout << "������� ������ ����� ���������!";
        _getch();
        break;
      }
      PrintList(head, tail);
      cout << " ����� �����: " << RunNumber(head);
      _getch();
      break;

    case '7':
      if (head != NULL) {
        cout << "������� ������ ����� �������!";
        _getch();
        break;
      }
      cout << endl << "���-�� ��������� � �����: ";
      cin >> n;
      QueueFillInc(n, head, tail);
      break;

    case '8':
      if (head != NULL) {
        cout << "������� ������ ����� �������!";
        _getch();
        break;
      }
      cout << endl << "���-�� ��������� � �����: ";
      cin >> n;
      QueueFillDec(n, head, tail);
      break;

    case '9':
      if (head != NULL) {
        cout << "������� ������ ����� �������!";
        _getch();
        break;
      }
      cout << endl << "���-�� ��������� � �����: ";
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
