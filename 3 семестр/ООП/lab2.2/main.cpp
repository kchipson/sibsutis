#include <iostream>
#include <ctime>
#include <conio.h>
#include <windows.h>
#include <stdio.h>

using namespace std;

struct list {
  list *next;
  int data;
};

/* Вывод списка */
HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
void listPrint(list *head, list *tail = NULL) {
  list *p = head;
  while (p != NULL) {
    if (p == head)
      SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 14));
else if (p == tail)
SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 9));

cout << p->data << " ";
SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7));
p = p->next;
}
cout << endl;
}

void AddItemStack(list *&head, int k) {
  list *p = new list;
  p->data = k;
  p->next = head;
  head = p;
}
void AddItemQueue(list *&head, list *&tail, int k) {
  if (head == NULL) {
    list *p = new list;
    p->data = k;
    head = p;
    head->next = NULL;
    tail = head;
    return;
  }
  list *p = new list;
  p->data = k;
  tail->next = p;
  tail = p;
  tail->next = NULL;
}

void Remove(list *&head) {
  list *p = head;
  head = head->next;
  delete (p);
}

void Remove(list *&head, list *&tail) {
  if (head == tail) {
    delete (head);
    head = NULL;
    return;
  }
  Remove(head);
}

int main() {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  srand(time(NULL));

  list *head = NULL;
  list *headQ = NULL;
  list *tailQ = NULL;
  int i = rand() % 100;

  while (1) {
    system("cls");
    cout << "Стек : ";
    listPrint(head);
    cout << endl << "Очередь: ";
    listPrint(headQ, tailQ);

    cout << endl << "Следующее число: " << i;
    int k = getch();
    if (k == 77) {
      AddItemStack(head, i);
      AddItemQueue(headQ, tailQ, i);
      i = rand() % 100;
    } else if (k == 75) {
      Remove(head);
      Remove(headQ, tailQ);
    }
  }
}
