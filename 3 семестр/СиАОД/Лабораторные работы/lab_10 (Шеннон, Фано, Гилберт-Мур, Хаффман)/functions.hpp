#ifndef FUNCTIONS_HPP
#define FUNCTIONS_HPP


#include <iostream>
#include <iomanip>
#include <cmath>
#include "struct.hpp"

void printChanceSymbols(chanceSymbol* A, unsigned int num, unsigned short int encoding[256] = nullptr);

void quickSortV2(chanceSymbol*& A, int R, int L, unsigned short int field, bool reverse);

float calculationEntropy(chanceSymbol* A, unsigned int nums);

float calculationAverageLength(codeShannon* A, unsigned int nums);
float calculationAverageLength(codeFano* A, unsigned int nums);
float calculationAverageLength(codeGilbert* A, unsigned int nums);
float calculationAverageLength(codeHuffman* A, unsigned int nums);
#endif