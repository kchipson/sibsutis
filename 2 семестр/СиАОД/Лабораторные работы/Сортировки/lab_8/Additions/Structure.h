#ifndef STRUCTURE_H
#define STRUCTURE_H

#include <string>
#define structSize 15

struct phone_book
{
	std::string surname;  // �������
    std::string name;     // ���
    std::string number;   // ��������� �������
    std::string email;    // eail
};

phone_book* generateStructure();
#endif 