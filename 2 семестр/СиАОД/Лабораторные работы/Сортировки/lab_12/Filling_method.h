#ifndef Filling_method
#define Filling_method
#include "Structure.h"

void StackFillInc(int n, tLE *&head);
void StackFillDec(int n, tLE *&head);
void StackFillRand(int n, tLE *&head);

void QueueFillRand(int n, tLE *(&head), tLE *(&tail));
void QueueFillDec(int n, tLE *(&head), tLE *(&tail));
void QueueFillInc(int n, tLE *(&head), tLE *(&tail));
#endif