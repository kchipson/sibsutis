#ifndef STRUCTURE_H
#define STRUCTURE_H

#include <string>
#define structSize 15

struct tLE16
{
	tLE16 *next;
	union {
		short int data;
		unsigned char Digit[sizeof(data)];
	};
};
struct tLE32
{
	tLE32 *next;
	union {
		int data;
		unsigned char Digit[sizeof(data)];
	};
};
struct Queue16
{
	tLE16 *head;
	tLE16 *tail;
};
struct Queue32
{
	tLE32 *head;
	tLE32 *tail;
};
#endif