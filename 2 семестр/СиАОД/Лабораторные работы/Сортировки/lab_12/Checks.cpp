#include <math.h>
#include "Structure.h"

int CheckSum(tLE *head)
{
    tLE *p;
    int sum = 0;
    for (p = head; p; p = p->next)
    {
        sum += p->data;
    }
    return sum;
}

int RunNumber(tLE *head)
{
    int sequence = 1;
    tLE *p;
    for (p = head; p->next; p = p->next)
    {
        if (p->data > p->next->data)
            sequence++;
    }
    return sequence;
}
