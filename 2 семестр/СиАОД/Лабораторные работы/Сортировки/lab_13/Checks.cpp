#include <math.h>
#include "Structure.h"

int CheckSum(tLE16 *head)
{
    tLE16 *p;
    int sum = 0;
    for (p = head; p; p = p->next)
    {
        sum += p->data;
    }
    return sum;
}

int RunNumber(tLE16 *head)
{
    int sequence = 1;
    tLE16 *p;
    for (p = head; p->next; p = p->next)
    {
        if (p->data > p->next->data)
            sequence++;
    }
    return sequence;
}

int CheckSum(tLE32 *head)
{
    tLE32 *p;
    int sum = 0;
    for (p = head; p; p = p->next)
    {
        sum += p->data;
    }
    return sum;
}

int RunNumber(tLE32 *head)
{
    int sequence = 1;
    tLE32 *p;
    for (p = head; p->next; p = p->next)
    {
        if (p->data > p->next->data)
            sequence++;
    }
    return sequence;
}
