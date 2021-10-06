#include <ctime>
#include <stdlib.h>
#include "Structure.h"

void StackFillInc(int n, tLE*(&head))
{
    int i = n;
    tLE* p;
    p = NULL;
    do {

        head = new tLE;
        head->next = p;
        p = head;
        head->data = i;
        i--;

    } while (i > 0);
}

void StackFillDec(int n, tLE*(&head))
{
    int i = 1;
    tLE* p;
    p = NULL;
    do {
        head = new tLE;
        head->next = p;
        p = head;
        head->data = i;
        i++;

    } while (i <= n);
}

void StackFillRand(int n, tLE*(&head))
{
    srand(time(NULL));
    int i = 1;
    tLE* p;
    p = NULL;
    do {
        head = new tLE;
        head->next = p;
        p = head;
        head->data = rand() % (n * 2) - n;;
        i++;

    } while (i <= n);

}

void QueueFillInc(int n, tLE*(&head), tLE*(&tail))
{
    int i = 1;
    tLE* p;
    head = tail = new tLE;
    head->next = tail->next = 0;
    tail->data=i;
    i++;
    do {
        p = new tLE;
        p->data = i;
        tail->next = p;
        tail = p;
        i++;

    } while (i <= n);
    tail->next = 0;
}

void QueueFillDec(int n, tLE*(&head), tLE*(&tail))
{
    int i = n;
    tLE* p;
    head = tail = new tLE;
    head->next = tail->next = 0;
    tail->data=i;
    i--;
    do {
        p = new tLE;
        p->data = i;
        tail->next = p;
        tail = p;
        i--;

    } while (i > 0);
    tail->next = 0;
}

void QueueFillRand(int n, tLE*(&head), tLE*(&tail))
{
    srand(time(NULL));
    int i = 1;
    tLE* p;
    head = tail = new tLE;
    head->next = tail->next = 0;
    tail->data=rand() % (n * 2) - n;
    i++;
    do {
        p = new tLE;
        p->data = rand() % (n * 2) - n;
        tail->next = p;
        tail = p;
        i++;

    } while (i <=n);
    tail->next = 0;

}