#include "Structure.h"

void DigitalSort(tLE16 *(&S), tLE16 *(&tail), int &M, int dec = 0) {
  M = 0;
  int KDI[2] = {1, 0};
  int L = 2;
  tLE16 *temp;
  Queue16 q[256];
  tLE16 *p;
  unsigned char d;
  int k;

  for (int j = L - 1; j >= 0; j--) {
    for (int i = 0; i < 255; i++) {
      q[i].tail = (tLE16 *)&(q[i].head);
    }
    p = S;
    k = KDI[j];
    while (p != NULL) {
      M++;
      d = p->Digit[k];
      q[d].tail->next = p;
      q[d].tail = p;
      p = p->next;
    }
    temp = p = (tLE16 *)&S;

    int i = 0;
    int sign = 1;
    if (dec == 1) {
      i = 255;
      sign = -1;
    }

    while ((i > -1) && (i < 256)) {
      if (q[i].tail != (tLE16 *)&(q[i].head)) {
        M++;
        p->next = q[i].head;
        p = q[i].tail;
      }
      i += sign;
    }

    p->next = NULL;
    S = temp->next;
  }
  return;
}

void DigitalSort(tLE32 *(&S), tLE32 *(&tail), int &M, int dec = 0) {
  int KDI[4] = {3, 2, 1, 0};
  int L = 4;
  tLE32 *temp;
  Queue32 q[256];
  tLE32 *p;
  unsigned char d;
  int k;

  for (int j = L - 1; j >= 0; j--) {
    for (int i = 0; i <= 255; i++) {
      q[i].tail = (tLE32 *)&(q[i].head);
    }
    p = S;
    k = KDI[j];
    while (p != NULL) {
      M++;
      d = p->Digit[k];
      q[d].tail->next = p;
      q[d].tail = p;
      p = p->next;
    }
    temp = p = (tLE32 *)&S;

    int i = 0;
    int sign = 1;
    if (dec == 1) {
      i = 255;
      sign = -1;
    }

    while ((i > -1) && (i < 256)) {
      if (q[i].tail != (tLE32 *)&(q[i].head)) {
        M++;
        p->next = q[i].head;
        p = q[i].tail;
      }
      i += sign;
    }

    p->next = NULL;
    S = temp->next;
  }
  return;
}