#include "treecreate.hpp"
#include <iostream>
#include <ctime>
#include <conio.h>
#include "somefunctions.hpp"

tree *init() {
  tree *p = new tree;
  p->data = rand() % MAX_RAND;
  return p;
}

void printTree(tree *p) {
  std::cout << std::endl;
  std::cout << "                  ___                  " << std::endl;
  std::cout << "                 |";
  std::cout.width(3);
  std::cout << p->data;
  std::cout << "|                  " << std::endl;
  std::cout << "                  ___                  " << std::endl;
  std::cout << "               /      \\                 " << std::endl;
  std::cout << "            ___        ___           " << std::endl;
  std::cout << "           |";
  std::cout.width(3);
  std::cout << (p->L)->data;
  std::cout << "|      |";
  std::cout.width(3);
  std::cout << (p->R)->data;
  std::cout << "|          " << std::endl;
  std::cout << "            ___        ___           " << std::endl;
  std::cout << "         /           /                 " << std::endl;
  std::cout << "      ___         ___                  " << std::endl;
  std::cout << "     |";
  std::cout.width(3);
  std::cout << ((p->L)->L)->data;
  std::cout << "|       |";
  std::cout.width(3);
  std::cout << ((p->R)->L)->data;
  std::cout << "|                 " << std::endl;
  std::cout << "      ___         ___                  " << std::endl;
  std::cout << "                     \\                " << std::endl;
  std::cout << "                       ___           " << std::endl;
  std::cout << "                      |";
  std::cout.width(3);
  std::cout << (((p->R)->L)->R)->data;
  std::cout << "|          " << std::endl;
  std::cout << "                       ___           " << std::endl;
}

/* Вариант 6*/
void createTree(tree *&p) {
  p = init();
  p->L = init();
  (p->L)->L = init();
  p->R = init();
  (p->R)->L = init();
  ((p->R)->L)->R = init();

  std::cout << "Вывести построенное дерево? (y/n)";
  if (selectionCheck())
    printTree(p);
}

/* Ручное управление */
void createTreeManualControl(tree *&p) {

  bool i = true;
  p = init();
  std::cout << "Есть ли левая ветка?" << std::endl
            << "\t- Нажмите \"Enter\" если да," << std::endl
            << "\t- Нажмите \"Esc\" если нет;" << std::endl;
  while (i) {
    switch (getch()) {
    case 13:
      createTreeManualControl(p->L);
      i = !i;
      break;
    case 27:
      i = !i;
      break;
    }
  }
  i = !i;
  std::cout << std::endl
            << "Есть ли правая ветка?" << std::endl
            << "\t- Нажмите \"Enter\" если да," << std::endl
            << "\t- Нажмите \"Esc\" если нет;" << std::endl;
  while (i) {
    switch (getch()) {
    case 13:
      createTreeManualControl(p->R);
      i = !i;
      break;
    case 27:
      i = !i;
      break;
    }
  }
  return;
}