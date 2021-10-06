#include "functions.hpp"

void printChanceSymbols(chanceSymbol* A, unsigned int num, unsigned short int encoding[256] ){
    float tmp = 0;
	for (int i = 0; i < num; i++){
        if(encoding){
            if (A[i].ch == '\n')
                std::cout << std::setw(4) << "\\n" << "(" << std::setw(3) << encoding[(int)A[i].ch] <<")"<< " | " << std::fixed << A[i].chance << "\n"; 
            else
                std::cout << std::setw(4) << A[i].ch << "(" << std::setw(3) << encoding[(int)A[i].ch] <<")"<< " | " << std::fixed << A[i].chance << "\n"; 
        }
        else{
            if (A[i].ch == '\n')
                std::cout << std::setw(4) << "\\n" << " | " << std::fixed << A[i].chance << "\n"; 
            else
                std::cout << std::setw(4) << A[i].ch << " | " << std::fixed << A[i].chance << "\n"; 

        }
        tmp +=  A[i].chance;
	}
    std::cout << "::Сумма вероятностей: " << tmp << "\n";
}

void quickSortV2(chanceSymbol*& A, int R, int L, unsigned short int field, bool reverse)
{
    while (L < R) {
        float x;
        if (field == 0)
            x = A[L].ch;
        else if (field == 1)
            x = A[L].chance;

        int i = L;
        int j = R;
        while (i <= j) {
            if (field == 0){
                if(reverse){
                    while (A[i].ch > x)
                        i++;
                    while (A[j].ch < x)
                        j--;  
                }
                else
                {
                    while (A[i].ch < x)
                        i++;
                    while (A[j].ch > x)
                        j--;  
                }
                
            }
            else if (field == 1)
            {
                if(reverse){
                    while (A[i].chance > x)
                        i++;
                    while (A[j].chance < x)
                        j--;
                }
                else
                {
                    while (A[i].chance < x)
                        i++;
                    while (A[j].chance > x )
                        j--;
                }
                
            }            
            if (i <= j) {
                int temp;
                temp = A[i].ch;
                A[i].ch = A[j].ch;
                A[j].ch = temp;
                float tmp;
                tmp = A[i].chance;
                A[i].chance = A[j].chance;
                A[j].chance = tmp;
                i++;
                j--;
            }
        }
        if (j - L > R - i) {
            quickSortV2(A, R, i, field, reverse);
            R = j;
        }
        else {
            quickSortV2(A, j, L, field, reverse);
            L = i; 
        } 
    } 
}

float calculationEntropy(chanceSymbol* A, unsigned int nums){
    float answer = 0;
	for (int i = 0; i < nums; i++) {
		answer += (A[i].chance * log2(A[i].chance));
	}
	return -answer;
}

float calculationAverageLength(codeShannon* A, unsigned int nums){
    float answer = 0;
	for (int i = 0; i < nums; i++) {
		answer += A[i].Li * A[i].Pi;
	}
	return answer;
}

float calculationAverageLength(codeFano* A, unsigned int nums){
    float answer = 0;
	for (int i = 0; i < nums; i++) {
		answer += A[i].Li * A[i].Pi;
	}
	return answer;
}

float calculationAverageLength(codeGilbert* A, unsigned int nums){
    float answer = 0;
	for (int i = 0; i < nums; i++) {
		answer += A[i].Li * A[i].Pi;
	}
	return answer;
}

float calculationAverageLength(codeHuffman* A, unsigned int nums){
    float answer = 0;
	for (int i = 0; i < nums; i++) {
		answer += A[i].Li * A[i].Pi;
	}
	return answer;
}