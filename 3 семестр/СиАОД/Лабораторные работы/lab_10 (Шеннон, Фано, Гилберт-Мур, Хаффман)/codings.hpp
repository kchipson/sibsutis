#ifndef CODINGS_HPP
#define CODINGS_HPP

#include <cmath>
#include <string>
#include <iostream>

#include "struct.hpp"
#include "functions.hpp"

codeShannon * ShannonCode(chanceSymbol *chanceSymbols, short int numSymbols);

codeFano * FanoCode(chanceSymbol *chanceSymbols, short int numSymbols);

codeGilbert * GilbertMurCode(chanceSymbol *chanceSymbols, short int numSymbols);

codeHuffman * HuffmanCode(chanceSymbol *chanceSymbols, short int numSymbols);

void HuffmanCode(codeHuffman *&huffman, float* &Pi, int n) ;
#endif