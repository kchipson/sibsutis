#include <string.h>
#include "structure.hpp"
#include "functions.hpp"

void insertSort(char *A, int n)
{
    int i, j;
    char temp;
    for (i = 1; i < n; i++)
    {
        temp = A[i];
        j = i - 1;

        while (j >= 0 && temp < A[j])
        {
            A[j + 1] = A[j];
            j = j - 1;
        }
        A[j + 1] = temp;
    }
}

void sortWords(list *head)
{
    list *p;

    int size, i;
    char *A;
    for (p = head; p; p = p->next)
    {
        size = strlen(p->data);
        A = new char[size];
        for (i = 0; i < size; i++)
        {
            A[i] = (p->data)[i];
        }
        insertSort(A, size);
        for (i = 0; i < size; i++)
        {
            (p->data)[i] = A[i];
        }
        (p->data)[i] = '\0';
        delete A;
    }
}

void *sortList(list *(&head))
{

    list *temp, *cur, *next;

    for (int i = 0; i < lenList(head); i++)
    {
        cur = temp = head;
        next = head->next;

        while (next != NULL)
        {
            if ((strcmp(cur->data, next->data) > 0))
            {
                if (temp == cur)
                {
                    head = next;
                    head->previous = NULL;
                }
                else
                {
                    temp->next = next;
                    next->previous = temp;
                }

                cur->next = next->next;
                if (next->next != 0)
                    next->next->previous = cur;

                next->next = cur;
                cur->previous = next;

                temp = cur;
                cur = next;
                next = temp;
            }
            temp = cur;
            cur = cur->next;
            next = next->next;
        }
    }
}
