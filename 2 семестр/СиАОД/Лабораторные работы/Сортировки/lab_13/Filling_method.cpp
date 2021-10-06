#include <ctime>
#include <stdlib.h>
#include "Structure.h"

void QueueFillInc(int n, tLE16 *(&head), tLE16 *(&tail))
{
    int i = 1;
    tLE16 *p;
    head = tail = new tLE16;
    head->next = tail->next = 0;
    tail->data = i;
    i++;
    do
    {
        p = new tLE16;
        p->data = i;
        tail->next = p;
        tail = p;
        i++;

    } while (i <= n);
    tail->next = 0;
}

void QueueFillDec(int n, tLE16 *(&head), tLE16 *(&tail))
{
    int i = n;
    tLE16 *p;
    head = tail = new tLE16;
    head->next = tail->next = 0;
    tail->data = i;
    i--;
    do
    {
        p = new tLE16;
        p->data = i;
        tail->next = p;
        tail = p;
        i--;

    } while (i > 0);
    tail->next = 0;
}

void QueueFillRand(int n, tLE16 *(&head), tLE16 *(&tail))
{
    srand(time(NULL));
    int i = 1;
    tLE16 *p;
    head = tail = new tLE16;
    head->next = tail->next = 0;
    tail->data = rand() % (n * 2);
    i++;
    do
    {
        p = new tLE16;
        p->data = rand() % (n * 2);
        tail->next = p;
        tail = p;
        i++;

    } while (i <= n);
    tail->next = 0;
}

void QueueFillInc(int n, tLE32 *(&head), tLE32 *(&tail))
{
    int i = 1;
    tLE32 *p;
    head = tail = new tLE32;
    head->next = tail->next = 0;
    tail->data = i;
    i++;
    do
    {
        p = new tLE32;
        p->data = i;
        tail->next = p;
        tail = p;
        i++;

    } while (i <= n);
    tail->next = 0;
}

void QueueFillDec(int n, tLE32 *(&head), tLE32 *(&tail))
{
    int i = n;
    tLE32 *p;
    head = tail = new tLE32;
    head->next = tail->next = 0;
    tail->data = i;
    i--;
    do
    {
        p = new tLE32;
        p->data = i;
        tail->next = p;
        tail = p;
        i--;

    } while (i > 0);
    tail->next = 0;
}

void QueueFillRand(int n, tLE32 *(&head), tLE32 *(&tail))
{
    srand(time(NULL));
    int i = 1;
    tLE32 *p;
    head = tail = new tLE32;
    head->next = tail->next = 0;
    tail->data = rand() % ((n * 2) * 10000);
    i++;
    do
    {
        p = new tLE32;
        p->data = rand() % ((n * 2) * 10000);
        tail->next = p;
        tail = p;
        i++;

    } while (i <= n);
    tail->next = 0;
}