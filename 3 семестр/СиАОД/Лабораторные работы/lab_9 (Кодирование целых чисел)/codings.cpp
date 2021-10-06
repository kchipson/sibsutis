#include "codings.hpp"

std::string binary(uint8_t num){
	std::string answer = "";
	for(int i = sizeof(num) * 8; i > 0; i--){
		if((num & (1 << (i - 1))) != 0){
			answer += '1';
		}else{
			answer += '0';
		}
	}
	return answer;
}

std::string fixedVariable(uint8_t num){
	short int size = 8 * sizeof(num);
	uint8_t order = 0;
	std::string answer = "";

	for(int i = size; i > 0; i--){ // определение порядка
		if((num & ( 1 << (i - 1))) != 0){
			order = i;
			break;
		}
	}

	int temp = 0;
    while(pow(2, temp) <= size) // вычисление размера порядка
        temp++;

	for(int i = temp; i > 0; i--){ // кодирование порядка
		if((order & (1 << (i - 1))) != 0){
			answer += '1';
		}else{
			answer += '0';
		}
	}
	answer += ' ';

	for(int i = (order - 1); i > 0; i--){ // кодирование мантиссы
		if((num & (1 << (i - 1))) != 0){
			answer += '1';
		}else{
			answer += '0';
		}
	}
	return answer;
}

std::string gammaCodeElias(uint8_t num){

	short int size = 8 * sizeof(num);
	uint8_t order = 0;
	std::string answer = "";

	for(int i = size; i > 0; i--){ // определение порядка
		if((num & ( 1 << ( i- 1))) != 0){
			order = i;
			break;
		}
	}

	for(int i = (order - 1); i > 0; i--) // кодирование порядка
		answer += '0';
	
	answer += ' ';

	for(int i = order; i > 0; i--){ // кодирование мантиссы
		if((num & (1 << (i - 1))) != 0){
			answer += '1';
		}else{
			answer += '0';
		}
	}
	return answer;
}

std::string omegaCodeElias(uint8_t num){
    if (num == 0)
        return "";

    short int size = 8 * sizeof(num);
	uint8_t order = 0;
    std::string temp = "";
	std::string answer = "0";

    while (num != 1){
        temp = "";

        for(int i = size; i > 0; i--){ // определение порядка
            if((num & ( 1 << ( i- 1))) != 0){
                order = i;
                break;
            }
        }
        
        for(int i = order; i > 0; i--){
            if((num & (1 << (i - 1))) != 0){
                temp += '1';
            }else{
                temp += '0';
            }
        }    
        temp += " " + answer;
        answer = temp;
        num = order - 1;

    }

	return answer;
}