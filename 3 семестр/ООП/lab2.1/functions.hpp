#ifndef FUNCTIONS_HPP
#define FUNCTIONS_HPP

#include "struct.hpp"

/* Случайный список размером n */
list *listRand(int n, int d = 1000);

/* Добавление элемента X после k-ого элемента */
bool listAddAfter(list *&head, int x, unsigned short int k);

/* Удаление k-ого элемента */
bool listDeleteItem(list *&head, unsigned short int k);

/* Удаление элемента со значением k */
void listDeleteValue(list *head, int k);

/* Число элементов списка */
unsigned int listNumOfItem(list *head);

/* Перемещение р-ого элемента после к-ого  */
bool moveItemAfter(list *&head, int p, int k);

/* Вывод списка */
void listPrint(list *head);

/* Да | Нет */
bool selectionCheck();

/* Очищение памяти по списку */
void listDelete(list *(&head));

/* Пауза в конце программы */
void pauseAtTheEnd();

#endif