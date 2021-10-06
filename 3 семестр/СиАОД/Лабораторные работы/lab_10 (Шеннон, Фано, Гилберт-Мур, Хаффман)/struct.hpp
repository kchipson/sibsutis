#ifndef STRUCT_HPP
#define STRUCT_HPP

struct chanceSymbol
{
    unsigned char ch = 0;
    float chance = 0;
};

struct codeShannon
{
    unsigned char ch = 0;
    float Pi = 0;
    float Qi = 0;
    unsigned short int Li = 0;
    char *codeword = nullptr; // массив символов, в конце нет завершающего символа
};

struct codeFano
{
    unsigned char ch = 0;
    float Pi = 0;
    unsigned short int Li = 0;
    char *codeword = nullptr; // массив символов, в конце нет завершающего символа
};

struct codeGilbert
{
    unsigned char ch = 0;
    float Pi = 0;
    float Qi = 0;
    unsigned short int Li = 0;
    char *codeword = nullptr; // массив символов, в конце нет завершающего символа
};

struct codeHuffman
{
    unsigned char ch = 0;
    float Pi = 0;
    unsigned short int Li = 0;
    char *codeword = nullptr; // массив символов, в конце нет завершающего символа
};
#endif // !STRUCT_HPP