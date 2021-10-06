#include "codings.hpp"

codeShannon * ShannonCode(chanceSymbol *chanceSymbols, short int numSymbols){
    codeShannon *shannon = new codeShannon[numSymbols];

    quickSortV2(chanceSymbols, numSymbols - 1, 0, 1, 1); // сортировка по убыванию вероятности
   
    // TODO : можно объединить в один for
    // for (int i = 0; i < numSymbols; i++){
    //     shannon[i].ch = chanceSymbols[i].ch;
    //     shannon[i].Pi = chanceSymbols[i].chance;
    //     shannon[i].Li = ceil (-log2(shannon[i].Pi)); // ceil - округление ?
    // }
    // shannon[0].Qi = 0;
    // for (int i = 1; i < numSymbols; i++)
    //     shannon[i].Qi = shannon[i-1].Qi + shannon[i-1].Pi;

    shannon[0].ch = chanceSymbols[0].ch;
    shannon[0].Pi = chanceSymbols[0].chance;
    shannon[0].Li = ceil (-log2(shannon[0].Pi)); // ceil - округление ?
    shannon[0].Qi = 0;

    for (int i = 1; i < numSymbols; i++){
        shannon[i].ch = chanceSymbols[i].ch;
        shannon[i].Pi = chanceSymbols[i].chance;
        shannon[i].Li = ceil (-log2(shannon[i].Pi)); // ceil - округление ?
        shannon[i].Qi = shannon[i-1].Qi + shannon[i-1].Pi;
    }

	for (int i = 0; i < numSymbols; i++) {
        float temp = shannon[i].Qi;
        shannon[i].codeword = new char[shannon[i].Li];
		for (int j = 0; j <  shannon[i].Li; j++) {
			temp = temp * 2;
			shannon[i].codeword[j] = (char)(floor(temp) + 48); // floor - возвращает наибольшее целое значение, которое не больше, чем val
			if (temp >= 1) {
				temp = temp - 1;
			}
		}
	}

    // for (int i = 0; i < numSymbols; i++){
    //     if (shannon[i].ch == '\n')
    //         std::cout << std::setw(4) << "\\n" << " | " << std::fixed << shannon[i].Pi << " | " << std::fixed << shannon[i].Qi << " | " << std::fixed << shannon[i].Li << " | "; 
    //     else
    //         std::cout << std::setw(4) << shannon[i].ch << " | " << std::fixed << shannon[i].Pi << " | " << std::fixed << shannon[i].Qi << " | " << std::fixed << shannon[i].Li << " | ";
        
    //     for (int j = 0; j < shannon[i].Li; j++)
    //         std::cout << shannon[i].codeword[j];
    //     std::cout << "\n";
	// } 
    
    return shannon;
}

//Находит медиану части массива P, т.е. такой индекс L ? m ? R, что минимальна величина
int med(codeFano *fano, int borderL, int borderR) {

	float SumL = 0;
	for (int i = borderL; i < borderR; i++) {
		SumL = SumL + fano[i].Pi;
	}
	float SumR = fano[borderR].Pi;
	int m = borderR;
	while (SumL >= SumR) {
		m = m - 1;
		SumL = SumL - fano[m].Pi;
		SumR = SumR + fano[m].Pi;
	}
	return m;
}

void FanoCode(codeFano * &fano, int borderL, int borderR, int k) {
    //k - длина уже построенной части элементарных кодов

	if (borderL < borderR) {
		k = k + 1;
		int m = med(fano, borderL, borderR);
        // std::cout << std::endl << borderL << " " << borderR << " | " << "k=" << k << " | "<< "m=" << m;
		for (int i = borderL; i <= borderR; i++) {
            if (fano[i].codeword != nullptr){
                char *temp = new char[k];
                for(int j = 0; j < k - 1; j++)
                    temp[j] = fano[i].codeword[j];
                delete[] fano[i].codeword;
                fano[i].codeword = temp;
            } 
            else
                fano[i].codeword = new char[k];

			if (i <= m) {
				fano[i].codeword[k - 1] = '0';
				fano[i].Li = fano[i].Li + 1;
			}
			else {
				fano[i].codeword[k - 1] = '1';
				fano[i].Li = fano[i].Li+ 1;
			}
		}
		FanoCode(fano, borderL, m, k);
		FanoCode(fano, m + 1, borderR, k);
	}
	else {

	}

}

codeFano * FanoCode(chanceSymbol *chanceSymbols, short int numSymbols){
    codeFano *fano = new codeFano[numSymbols];
    quickSortV2(chanceSymbols, numSymbols - 1, 0, 1, 1); // сортировка по убыванию вероятности

    for(int i = 0; i < numSymbols; i++){
        fano[i].ch = chanceSymbols[i].ch;
        fano[i].Pi = chanceSymbols[i].chance;
    }

    FanoCode(fano, 0, numSymbols - 1, 0);

    return fano;
}



codeGilbert * GilbertMurCode(chanceSymbol *chanceSymbols, short int numSymbols){
    codeGilbert *gilbertmur = new codeGilbert[numSymbols];

    quickSortV2(chanceSymbols, numSymbols - 1, 0, 0, 0); // сортировка по алфавиту
    // printChanceSymbols(chanceSymbols, numSymbols);

    float pr = 0;
    for (int i = 0; i < numSymbols; i++){
        gilbertmur[i].ch = chanceSymbols[i].ch;
        gilbertmur[i].Pi = chanceSymbols[i].chance;
        gilbertmur[i].Li = ceil(-log2(gilbertmur[i].Pi)) + 1; // ceil - округление ?
        gilbertmur[i].Qi = pr + gilbertmur[i].Pi / 2;
        pr += gilbertmur[i].Pi;
    }

	for (int i = 0; i < numSymbols; i++) {
        float temp = gilbertmur[i].Qi;
        gilbertmur[i].codeword = new char[gilbertmur[i].Li];
		for (int j = 0; j <  gilbertmur[i].Li; j++) {
			temp = temp * 2;
			gilbertmur[i].codeword[j] = (char)(floor(temp) + 48); // floor - возвращает наибольшее целое значение, которое не больше, чем val
			if (temp >= 1) {
				temp = temp - 1;
			}
		}
	}

    // for (int i = 0; i < numSymbols; i++){
    //     if (gilbertmur[i].ch == '\n')
    //         std::cout << std::setw(4) << "\\n" << " | " << std::fixed << gilbertmur[i].Pi << " | " << std::fixed << gilbertmur[i].Qi << " | " << std::fixed << gilbertmur[i].Li << " | "; 
    //     else
    //         std::cout << std::setw(4) << gilbertmur[i].ch << " | " << std::fixed << gilbertmur[i].Pi << " | " << std::fixed << gilbertmur[i].Qi << " | " << std::fixed << gilbertmur[i].Li << " | ";
        
    //     for (int j = 0; j < gilbertmur[i].Li; j++)
    //         std::cout << gilbertmur[i].codeword[j];
    //     std::cout << "\n";
	// } 
    
    return gilbertmur;
}

#include "somefunctions.hpp"

codeHuffman * HuffmanCode(chanceSymbol *chanceSymbols, short int numSymbols){
    codeHuffman *huffman = new codeHuffman[numSymbols];
    float *Pi = new float[numSymbols]; 

    quickSortV2(chanceSymbols, numSymbols - 1, 0, 1, 1); // сортировка по убыванию вероятности

    for (int i = 0; i < numSymbols; i++){
        huffman[i].ch = chanceSymbols[i].ch;
        huffman[i].Pi = Pi[i]= chanceSymbols[i].chance;
    }

    HuffmanCode(huffman, Pi, numSymbols);

    return huffman;
}


unsigned short int Up(float *&Pi, unsigned int n, float x) {
	int j = 0;
	for (int i = n - 2; i > 0; i--) {
		if (Pi[i - 1] < x) {
			Pi[i] = Pi[i - 1];
		}
		else {
			j = i;
			break;
		}
	}
	Pi[j] = x;
	return j;
}

void Down(codeHuffman *&huffman, int n, int j) {
    // DEBAG
    // std::cout << "\n" << "j:" << j << " | " << "n:" << n << "   ";

	char *S = new char[huffman[j].Li + 1];
    for (int i = 0; i < huffman[j].Li; i++)
        S[i] = huffman[j].codeword[i];

	int L = huffman[j].Li;

	for (int i = j; i <= n - 2; i++) {
        delete[] huffman[i].codeword;
        huffman[i].codeword = new char[huffman[i + 1].Li];
        for (int t = 0; t < huffman[i + 1].Li; t++)
            huffman[i].codeword[t] = huffman[i + 1].codeword[t];
		huffman[i].Li = huffman[i + 1].Li;
	}

    delete[] huffman[n - 1].codeword;
    delete[] huffman[n].codeword;

    huffman[n - 1].Li = L + 1;
	huffman[n].Li = L + 1;
    huffman[n - 1].codeword = new char[huffman[n - 1].Li];
    huffman[n].codeword = new char[huffman[n].Li];
    
    for (int i = 0; i < L; i++)
        huffman[n - 1].codeword[i] = huffman[n].codeword[i] = S[i];
    
	huffman[n - 1].codeword[L] = '0';
	huffman[n].codeword[L] = '1';

    // DEBAG
    // for (int i = 0; i <= n; i++){
    //     for(int w = 0; w < huffman[i].Li; w++)
    //         std::cout << huffman[i].codeword[w];
    //     std::cout << "   ";
    // }

}

void HuffmanCode(codeHuffman *&huffman, float* &Pi, int n) {
	// DEBAG
    // for (int i = 0; i < n; i++)
    //     std::cout << Pi[i] << "  ";
    if (n == 2) {
		huffman[0].codeword = new char[1];
        huffman[0].codeword[0] = '0';
		huffman[0].Li = 1;
        huffman[1].codeword = new char[1];
        huffman[1].codeword[0] = '1';
		huffman[1].Li = 1;
	}
	else {
		float q = Pi[n - 2] + Pi[n - 1];
		int j = Up(Pi, n, q);
        // DEBAG
        // std::cout << "\n"<< "j:" << j << "  ";
		HuffmanCode(huffman, Pi, n - 1);
		Down(huffman, n - 1, j);
	}
}
