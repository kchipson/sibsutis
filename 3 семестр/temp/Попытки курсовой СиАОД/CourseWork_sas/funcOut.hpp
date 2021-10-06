#ifndef FUNCOUT_HPP
#define FUNCOUT_HPP

#include <iostream>
#include "conio.h"

#include "struct.hpp"
#include "func.hpp"

const unsigned short int itemsPage = 30; // Кол-во записей на странице

void printItemDB(itemDataBase item);

void output(listDataBase* p);
void outputDB_PbyP(listDataBase *p);
void outputDB_Full(listDataBase *p);

void outputTree(treeLawyer *p);
void outputTree_LR(treeLawyer *p, bool full);

#endif // FUNCOUT_HPP
