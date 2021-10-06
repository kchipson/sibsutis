#include <math.h>
#include "Structure.h"

int CheckSum(tLE* head)
{ // Контрольная сумма
    tLE* p;
    int sum = 0;
    for (p = head; p; p = p->next) {
        sum += p->data;
    }
    return sum;
}

int RunNumber(tLE* head) // Число неубывающих серий
{
    int sequence = 1;
    tLE* p;
    for (p = head; p->next; p = p->next) {
        if (p->data > p->next->data)
            sequence++;
    }
    return sequence;
}
