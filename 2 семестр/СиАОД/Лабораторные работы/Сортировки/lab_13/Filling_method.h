#ifndef Filling_method
#define Filling_method
#include "Structure.h"
void QueueFillRand(int n, tLE16 *(&head), tLE16 *(&tail));
void QueueFillDec(int n, tLE16 *(&head), tLE16 *(&tail));
void QueueFillInc(int n, tLE16 *(&head), tLE16 *(&tail));

void QueueFillRand(int n, tLE32 *(&head), tLE32 *(&tail));
void QueueFillDec(int n, tLE32 *(&head), tLE32 *(&tail));
void QueueFillInc(int n, tLE32 *(&head), tLE32 *(&tail));
#endif