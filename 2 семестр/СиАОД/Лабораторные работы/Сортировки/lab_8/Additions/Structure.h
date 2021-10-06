#ifndef STRUCTURE_H
#define STRUCTURE_H

#include <string>
#define structSize 15

struct phone_book
{
	std::string surname;  // фамилия
    std::string name;     // имя
    std::string number;   // мобильный телефон
    std::string email;    // eail
};

phone_book* generateStructure();
#endif 