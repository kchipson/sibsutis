#include <iostream>
#include <iomanip>
#include <windows.h>

#include "somefunctions.hpp"
#include "codings.hpp"

int main(int argc, const char **argv) {
	// std::ios::sync_with_stdio(false);
	SetConsoleOutputCP(65001);
	SetConsoleCP(65001);

	uint8_t	number = 0; // 0 - 255
	// std::cout << sizeof(number);

	std::cout << "---------------------------------------------------------------------------------------------------------------------------------------------------------------------" << "\n";
	std::cout << "|" << std::setw(15) << "";
	std::cout << "|                              |                                                      Кодовое слово                                                 |" << "\n";

	std::cout << "|" << std::setw(15) << "     Число     ";
	std::cout << "|        Бинарный код          |--------------------------------------------------------------------------------------------------------------------|" << "\n";

	std::cout << "|" << std::setw(15) << "";
	std::cout << "|                              |            Fixed + Variable          |              γ-код Элиаса            |              ω-код Элиаса            |" << "\n";
	// std::cout << "|                              |                                      |                                      |                                      |" << "\n";
	std::cout << "---------------------------------------------------------------------------------------------------------------------------------------------------------------------" << "\n";
	
	do
	{
		std::cout << "|";
		std::cout << std::left << std::setw(15) << (int)number;
		std::cout << "|";
		std::cout << std::left << std::setw(30) << binary(number);
		std::cout << "|";
		std::cout << std::left << std::setw(38) << fixedVariable(number);
		std::cout << "|";
		std::cout << std::left << std::setw(38) << gammaCodeElias(number);
		std::cout << "|";
		std::cout << std::left << std::setw(38) << omegaCodeElias(number);
		std::cout << "|";
		std::cout << "\n";

		number ++;
	} while(number != 0);
	std::cout << "---------------------------------------------------------------------------------------------------------------------------------------------------------------------" << "\n";
	
	// fixedVariable(0);
	pauseAtTheEnd();
	return 0;
}
