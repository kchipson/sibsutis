#ifndef Checks
#define Checks
#include "Structure.h"

int CheckSum(tLE16 *head);  // Контрольная сумма
int CheckSum(tLE32 *head);  // Контрольная сумма
int RunNumber(tLE16 *head); // Число неубывающих серий
int RunNumber(tLE32 *head); // Число неубывающих серий

#endif