#include <iostream>
#include <iomanip>
#include <iostream>
#include <string>
#include <windows.h>
#include <fstream>

#include "somefunctions.hpp"
#include "functions.hpp"
#include "codings.hpp"
#include "struct.hpp"

int main(int argc, const char **argv) {
	SetConsoleOutputCP(1251);
	SetConsoleCP(1251);

	std::string	filename = "test.txt";
	unsigned int numSymbols = 0;
	unsigned int numUniqueSymbols = 0;

	unsigned short int window1251[256] = {0};

	/* ������ � ������ */

	// �������� �����
	std::ifstream file; 
	unsigned char ch;
	file.open (filename);
	if (!file){
		return 1;
	}
	
	//  ������������ ������ ����� � ������� ���-�� �������� � �����
	while ((ch = file.get()) && !file.eof()){
		numSymbols++;
		window1251[(int)ch]++;
		// if (ch == '\n')
		// 	std::cout << std::setw(4) << "\\n" << " | " << (int)ch << "\n";
		// else
		// 	std::cout << std::setw(4) << ch << " | " << (int)ch << "\n";
	}

	//  ������� ���������� ��������
	for (int i = 0; i < 256; i++) {
		if (window1251[i] != 0)
			numUniqueSymbols++;
    }

	std::cout << "���-�� ��������: " << numSymbols  << " | " << "���-�� ���������� ��������: " << numUniqueSymbols << "\n";

	// �������� �����
	file.close();

	/* ������������ �������� � ������*/
	// ����� � ������ : ch - ������, chance - ���������� ���� ������� � ������
	chanceSymbol *chanceSymbols = new chanceSymbol[numUniqueSymbols];

	// chanceSymbols[0].ch = 'a';
	// chanceSymbols[0].chance = 0.18;
	// chanceSymbols[1].ch = 'b';
	// chanceSymbols[1].chance = 0.18;
	// chanceSymbols[2].ch = 'c';
	// chanceSymbols[2].chance = 0.36;
	// chanceSymbols[3].ch = 'd';
	// chanceSymbols[3].chance = 0.07;
	// chanceSymbols[4].ch = 'e';
	// chanceSymbols[4].chance = 0.09;
	// chanceSymbols[5].ch = 'f';
	// chanceSymbols[5].chance = 0.12;

	// ������� ����� �������� � ������ � ���������� ������� ������
	unsigned short int temp = 0;
	for (int i = 0; i < 256; i++){
		if (window1251[i] != 0){
			chanceSymbols[temp].ch = (char)i;
			chanceSymbols[temp].chance = (float)window1251[i] / numSymbols;
			temp++;
		}
	}
	// ����� ������
	printChanceSymbols(chanceSymbols, numUniqueSymbols, window1251);

	/* �������� */
	float entropy = calculationEntropy(chanceSymbols, numUniqueSymbols);

	/* ��� ������� */
	codeShannon *shannon = nullptr ;
	shannon = ShannonCode(chanceSymbols, numUniqueSymbols);
	float averageLshannon = calculationAverageLength(shannon, numUniqueSymbols);

	std::cout << "\n" << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	std::cout << "\n��� �������:" << "\n";
    for (int i = 0; i < numUniqueSymbols; i++){
        if (shannon[i].ch == '\n')
            std::cout << std::setw(4) << "\\n" << " | " << std::fixed << shannon[i].Pi << " | " << std::fixed << shannon[i].Qi << " | " << std::fixed << shannon[i].Li << " | "; 
        else
            std::cout << std::setw(4) << shannon[i].ch << " | " << std::fixed << shannon[i].Pi << " | " << std::fixed << shannon[i].Qi << " | " << std::fixed << shannon[i].Li << " | ";
        
        for (int j = 0; j < shannon[i].Li; j++)
            std::cout << shannon[i].codeword[j];
        std::cout << "\n";
	}
	std::cout << "\n" << "��������: " << entropy << " | " << " ������� ����� �������� �����: " << averageLshannon << "\n";
	
	/* ��� ���� */
	quickSortV2(chanceSymbols, numUniqueSymbols - 1, 0, 0, 0);
	codeFano *fano = nullptr;
	fano = FanoCode(chanceSymbols, numUniqueSymbols);
	float averageLfano = calculationAverageLength(fano, numUniqueSymbols);

	std::cout << "\n" << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	std::cout << "\n��� ����:" << "\n";
    for (int i = 0; i < numUniqueSymbols; i++){
        if (fano[i].ch == '\n')
            std::cout << std::setw(4) << "\\n" << " | " << std::fixed << fano[i].Pi << " | " << std::fixed << fano[i].Li << " | "; 
        else
            std::cout << std::setw(4) << fano[i].ch << " | " << std::fixed << fano[i].Pi << " | " << std::fixed << fano[i].Li << " | ";
        
        for (int j = 0; j < fano[i].Li; j++)
            std::cout << fano[i].codeword[j];
        std::cout << "\n";
    }
	std::cout << "\n" << "��������: " << entropy << " | " << " ������� ����� �������� �����: " << averageLfano << "\n";

	/* ��� ��������-���� */
	codeGilbert *gilbertMur = nullptr ;
	gilbertMur = GilbertMurCode(chanceSymbols, numUniqueSymbols);
	float averageLgilbertMur = calculationAverageLength(gilbertMur, numUniqueSymbols);

	std::cout << "\n" << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	std::cout << "\n��� �������� ����:" << "\n";
    for (int i = 0; i < numUniqueSymbols; i++){
        if (gilbertMur[i].ch == '\n')
            std::cout << std::setw(4) << "\\n" << " | " << std::fixed << gilbertMur[i].Pi << " | " << std::fixed << gilbertMur[i].Qi << " | " << std::fixed << gilbertMur[i].Li << " | "; 
        else
            std::cout << std::setw(4) << gilbertMur[i].ch << " | " << std::fixed << gilbertMur[i].Pi << " | " << std::fixed << gilbertMur[i].Qi << " | " << std::fixed << gilbertMur[i].Li << " | ";
        
        for (int j = 0; j < gilbertMur[i].Li; j++)
            std::cout << gilbertMur[i].codeword[j];
        std::cout << "\n";
	}
	std::cout << "\n" << "��������: " << entropy << " | " << " ������� ����� �������� �����: " << averageLgilbertMur << "\n";

	/* ��� �������� */
	codeHuffman *huffman = nullptr ;
	huffman = HuffmanCode(chanceSymbols, numUniqueSymbols);
	float averageLhuffman = calculationAverageLength(huffman, numUniqueSymbols);

	std::cout << "\n" << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	std::cout << "\n��� ��������:" << "\n";
	for (int i = 0; i < numUniqueSymbols; i++){
        if (huffman[i].ch == '\n')
            std::cout << std::setw(4) << "\\n" << " | " << std::fixed << huffman[i].Pi << " | " << std::fixed << huffman[i].Li << " | "; 
        else
            std::cout << std::setw(4) << huffman[i].ch << " | " << std::fixed << huffman[i].Pi << " | " << std::fixed << huffman[i].Li << " | ";
        
        for (int j = 0; j < huffman[i].Li; j++)
            std::cout << huffman[i].codeword[j];
        std::cout << "\n";
	}
	std::cout << "\n" << "��������: " << entropy << " | " << " ������� ����� �������� �����: " << averageLhuffman << "\n";
	

	std::cout << "\n" << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" << "\n";
	std::cout << "  ��������: " << entropy << "\n";
	std::cout << "  ��.����� �������: " << averageLshannon<< "\n";
	std::cout << "  ��.����� ����: " << averageLfano<< "\n";
	std::cout << "  ��.����� ��������-����: " << averageLgilbertMur<< "\n";
	std::cout << "  ��.����� ��������: " << averageLhuffman<< "\n";
	pauseAtTheEnd();
	return 0;
}
