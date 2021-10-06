#include "Structure.h"
void Merge(tLE **a, int q, tLE **b, int r, Queue *c, int &C, int &M)
{
	while (q != 0 && r != 0)
	{
		C++;
		if ((*a)->data <= (*b)->data)
		{
			M++;
			c->tail->next = *a;
			c->tail = *a;
			*a = (*a)->next;
			q--;
		}
		else
		{
			M++;
			c->tail->next = *b;
			c->tail = *b;
			*b = (*b)->next;
			r--;
		}
	}
	while (q > 0)
	{
		M++;
		c->tail->next = *a;
		c->tail = *a;
		*a = (*a)->next;
		q--;
	}
	while (r > 0)
	{
		M++;
		c->tail->next = *b;
		c->tail = *b;
		*b = (*b)->next;
		r--;
	}
}

int Split(tLE *S, tLE **a, tLE **b, int &M)
{
	tLE *k, *p;
	*a = S;
	*b = S->next;
	int n = 1;
	k = *a;
	p = *b;
	while (p != NULL)
	{
		n++;
		k->next = p->next;
		k = p;
		p = p->next;
	}
	M += n;
	return n;
}

void MergeSort(tLE *(&S), tLE *(&tail), int &C, int &M)
{
	C = M = 0;
	tLE *a;
	tLE *b;
	int n = Split(S, &a, &b, M);
	int p = 1; // предполагаемый размер серии
	int q, r;  // фактический размер серий a и b
	Queue c[2];
	while (p < n)
	{
		c[0].tail = (tLE *)&(c[0].head);
		c[1].tail = (tLE *)&(c[1].head);

		int i = 0;
		int m = n; // текущее кол-во элементов в a и b
		while (m > 0)
		{
			if (m >= p)
				q = p;
			else
				q = m;

			m = m - q;

			if (m >= p)
				r = p;
			else
				r = m;

			m = m - r;
			Merge(&a, q, &b, r, &c[i], C, M);
			i = 1 - i;
		}
		a = c[0].head;
		b = c[1].head;
		p = 2 * p;
	}
	c[0].tail->next = NULL;
	S = c[0].head;
	tail = c[0].tail;
}