#ifndef STRUCT_HPP
#define STRUCT_HPP

struct itemDataBase {
  char depositor[30];
  unsigned short int contribution;
  char date[10];
  char lawyer[22];
};

struct listDataBase {
  listDataBase *next;
  union {
    itemDataBase data;
    unsigned char Digit[sizeof(data)];
  };
};

struct queue {
  listDataBase *head;
  listDataBase *tail;
};

struct treeLawyer {
  char data[22]; // lawyer
  short int balance = 0;
  treeLawyer *left = nullptr;
  treeLawyer *right = nullptr;
  listDataBase *elems = nullptr;
};

struct coding {
  char symbol; // Символ
  unsigned int quantity; // Встречаемость в текте
  float probability; // Вероятность
  unsigned short int lengthCW; // Длина кодового слова
  char * codeword; // Кодовое слово
};

#endif // STRUCT_HPP
