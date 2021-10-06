#ifndef STRUCTURE_H
#define STRUCTURE_H

#include <string>
#define structSize 15

struct tLE
{
	tLE *next;
	int data;
};
struct Queue
{
	tLE *head;
	tLE *tail;
};
#endif