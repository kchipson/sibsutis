#ifndef FUNCTIONS_HPP
#define FUNCTIONS_HPP

#include "structure.hpp"

void error(int error);
void freeList(list *head);
int strlen(char *str);
void createList(list *(&head));
void printList(list *head);
void recordList(list *head);
int lenList(list *head);
#endif
