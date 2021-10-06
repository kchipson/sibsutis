#include <conio.h>
#include <iostream>
#include "functions.hpp"

/* Случайный список размером n */
list *listRand(int n, int d) {
  list *head = NULL;
  for (int i = 0; i < n; i++) {
    list *p;
    p = new list;
    p->data = rand() % d;
    p->next = head;
    p->prev = NULL;
    if (head != NULL)
      head->prev = p;
    head = p;
  }
  return head;
}

/* Добавление элемента X после k-ого элемента */
bool listAddAfter(list *&head, int x, unsigned short int k) {
  list *p = head;
  list *prev = NULL;
  unsigned int i = 0;
  while ((i != k) && (p != NULL)) {
    i++;
    prev = p;
    p = p->next;
  }

  if (p == NULL && i != k) {
    std::cout << "Не удалось добавить элемент, т.к. \"k\" превышает размер "
                 "списка";
    return false;
  }
  if (i == 0) {
    list *temp = new list;
    temp->data = x;
    head->prev = temp;
    temp->next = head;
    temp->prev = NULL;
    head = temp;

  } else {
    list *temp = new list;
    temp->data = x;
    temp->next = p;
    temp->prev = prev;
    prev->next = temp;
    if (p != NULL)
      p->prev = temp;
  }
  return true;
}

/* Удаление k-ого элемента */
bool listDeleteItem(list *&head, unsigned short int k) {
  int i = 1;
  list *p = head;
  while (i != k && p != NULL) {
    p = p->next;
    i++;
  }
  if (!p) {
    std::cout << "Не удалось удалить элемент, т.к. \"k\" превышает размер "
                 "списка";
    return false;
  }
  if (p->prev == NULL) { //голова
    list *temp = p;
    (p->next)->prev = NULL;
    head = p->next;
    delete temp;
  } else if (p->next == NULL) { //хвост
    list *temp = p;
    (p->prev)->next = NULL;
    delete temp;
  } else {
    list *temp = p;
    (p->prev)->next = p->next;
    (p->next)->prev = p->prev;
    delete temp;
  }
  return true;
}

/* Удаление элемента со значением k */
void listDeleteValue(list *head, int k) {
  int c = 0;
  list *p = head;
  while (p != NULL) {
    list *tmp = NULL;
    if (p->data == k) {
      if (c) {
        list *prev = p->prev;
        list *next = p->next;
        list *t = p;
        if (prev != NULL)
          prev->next = p->next;
        if (next != NULL)
          next->prev = p->prev;
        tmp = t;
      }
      c++;
    }
    p = p->next;
    delete (tmp);
  }
}

/* Число элементов списка */
unsigned int listNumOfItem(list *head) {
  unsigned int i = 0;
  while (head) {
    i++;
    head = head->next;
  }
  return i;
}

/* Перемещение р-ого элемента после к-ого  */
bool moveItemAfter(list *&head, int p, int k) {
  int i = 1;
  list *q1 = head;
  while (i != p && q1 != NULL) {
    q1 = q1->next;
    i++;
  }
  if (!q1) {
    std::cout << std::endl
              << "Ошибка, \"p\" превышает размер "
                 "списка";
    return false;
  }
  list *q2 = head; // после какого вставка
  unsigned int j = 1;
  if (k) {
    while ((j < k) && (q2 != NULL)) {
      j++;
      q2 = q2->next;
    }
  } else {
    j = 0;
  }

  if (q2 == NULL) {
    std::cout << std::endl
              << "Ошибка, \"k\" превышает размер "
                 "списка";
    return false;
  }
  if ((i == j + 1) || (i == j)) {
    std::cout << std::endl << "Ошибка, перемещение невозможно ";
    return false;
  }
  if (k == 0) {
    (q1->prev)->next = q1->next;
    if (!q1->next)
      (q1->next)->prev = q1->prev;

    head->prev = q1;
    q1->next = head;
    q1->prev = NULL;
    head = q1;

  } else {
    if (i == 1) {
      head = q1->next;
      head->prev = NULL;
    } else {
      (q1->prev)->next = q1->next;
      if (q1->next)
        (q1->next)->prev = q1->prev;
    }
    q1->next = q2->next;
    if (q1->next)
      (q1->next)->prev = q1;
    q2->next = q1;
    (q1->prev) = q2;
  }
  return true;
}

/* Вывод списка */
HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
void listPrint(list *head) {
  list *p;
  int q = 0;
  SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 8));
  std::cout
      << std::endl
      << "/* Вывод списка осуществляется построчно по 5 элементов в строке */"
      << std::endl;
  SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 4));
  std::cout << "[" << head << "]" << std::endl;
  for (p = head; p; p = p->next) {
    if (q == 5) {
      std::cout << std::endl;
      q = 0;
    }
    SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 3));
    std::cout << "[" << p << "]";
    std::cout.width(10);
    std::cout.setf(std::ios::left);
    SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7));
    std::cout << p->data;
    q++;
  }
  std::cout << std::endl;
}

/* Да | Нет */
bool selectionCheck() {
  bool flag = true;
  int key;
  do {
    flag = false;
    key = getch();
    if ((key == 110) || key == (78)) // n|N
      return false;
    else if ((key == 121) || key == (89)) // y|Y
      return true;
    else if ((key == 208) || key == (209)) { // rus
      key = getch();
      if ((key == 157) || key == (189)) // н|Н
        return true;
      else if ((key == 162) || key == (130)) // т|Т
        return false;
      else
        flag = true;
    } else
      flag = true;
  } while (flag);
  return false;
}

/* Очищение памяти по списку */
void listDelete(list *(&head)) {

  list *p, *t;
  for (p = head; p; p = t) {
    t = p->next;
    delete p;
  }
  head = NULL;
}

/* Пауза в конце программы */
void pauseAtTheEnd() {
  std::cout << std::endl << std::endl << "Press any key to close window!";
  getch();
}
