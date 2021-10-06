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

struct tree {
  char data[22]; // lawyer
  short int balance = 0;
  tree *left = nullptr;
  tree *right = nullptr;
  listDataBase *elems = nullptr;
};

#endif // !STRUCT_HPP