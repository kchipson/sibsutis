#ifndef FUNCOUT_HPP
#define FUNCOUT_HPP

#include <iostream>
#include <iomanip>
#include <cmath>
#include "conio.h"

#include "struct.hpp"
#include "func.hpp"

const unsigned short int itemsPage = 20; // Кол-во записей на странице

void printItemDB(itemDataBase item);

void output(listDataBase* p);
void outputDB_PbyP(listDataBase *head);
void outputDB_Full(listDataBase *p);

void outputTree(treeLawyer *p);
void outputTree_LR(treeLawyer *p, bool full);

void printTableSymbols(coding *code, int numSymbols);

#endif // FUNCOUT_HPP
