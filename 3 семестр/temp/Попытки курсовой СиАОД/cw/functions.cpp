#include "functions.hpp"

/* Вывести элемент БД */
void printItemDB(itemDataBase item) {
  std::cout << item.depositor << "   ";
  std::cout.setf(std::ios::left);
  std::cout.width(5);
  std::cout << item.contribution << "   ";
  std::cout << item.date << "     ";
  std::cout << item.lawyer << std::endl;
}

/* Постраничный вывод БД */
void outputDB_PbyP(listDataBase *head, unsigned short int numOfElemsPerPage) {
  listDataBase *p = head;

  int j = 0;
  int key;
  int i = numOfElemsPerPage;
  do {
    system("CLS");

    for (j; (j < i) && (p != nullptr); j++, p = p->next) {

      std::cout.setf(std::ios::right);
      std::cout.width(4);
      std::cout << (j + 1) << ")"
                << "  ";
      printItemDB(p->data);
    }

    do {
      key = getch();
      switch (key) {
      case 75: // left
        if (j != numOfElemsPerPage) {
          i = i - numOfElemsPerPage;
          j = i - numOfElemsPerPage;
          p = head;
          for (int f = 0; f < j; f++)
            p = p->next;
        } else
          key = 0;
        break;
      case 77: // right
        if (p != nullptr) {
          i = i + numOfElemsPerPage;
        } else
          key = 0;
        break;
      }
    } while ((key != 75) && (key != 77) && (key != 27));

  } while (key != 27);
}
void outputDB_PbyP(itemDataBase **arr, unsigned short int size,
                   unsigned short int numOfElemsPerPage) {
  int j = 0;
  int key;
  int i = numOfElemsPerPage;
  do {
    system("CLS");

    for (j; (j < i) && (j < size); j++) {

      std::cout.setf(std::ios::right);
      std::cout.width(4);
      std::cout << (j + 1) << ")"
                << "  ";
      printItemDB(*arr[j]);
    }

    do {
      key = getch();
      switch (key) {
      case 75: // left
        if (j != numOfElemsPerPage) {
          i = i - numOfElemsPerPage;
          j = i - numOfElemsPerPage;
        } else
          key = 0;
        break;
      case 77: // right
        if (i < size) {
          i = i + numOfElemsPerPage;
        } else
          key = 0;
        break;
      }
    } while ((key != 75) && (key != 77) && (key != 27));

  } while (key != 27);
}

/* Полный вывод БД */
void outputDB_Full(listDataBase *p) {

  int i = 0;
  for (p; p; p = p->next) {
    std::cout.setf(std::ios::right);
    std::cout.width(4);
    std::cout << (i + 1) << ")"
              << "  ";
    printItemDB(p->data);
    i++;
  }
}
void outputDB_Full(itemDataBase **arr, unsigned short int size) {
  for (int i = 0; i < size; i++) {
    std::cout.setf(std::ios::right);
    std::cout.width(4);
    std::cout << (i + 1) << ")"
              << "  ";
    printItemDB(*arr[i]);
  }
}

/* Выбор вывода БД */
short int choiceOutput() {
  std::cout << std::endl;
  std::cout << "  1) Page by page" << std::endl;
  std::cout << "  2) All" << std::endl;
  std::cout << "  3) Skip" << std::endl;
  char c;
  do {
    c = getch();
  } while ((c != '1') && (c != '2') && (c != '3'));
  std::cout << std::endl;
  if (c == '1')
    return 0;
  else if (c == '2')
    return 1;
  else
    return 2;
}

/* Цифровая сортировка */
void digitalSort(listDataBase *(&S), int dec) {
  int KDI[32];
  for (int i = 0; i < 30; i++)
    KDI[i] = i;
  KDI[30] = 31;
  KDI[31] = 30;
  int L = 32;

  queue q[256];
  listDataBase *p;
  unsigned char d;
  int k;

  for (int j = L - 1; j >= 0; j--) {
    for (int i = 0; i <= 255; i++) {
      q[i].tail = (listDataBase *)&(q[i].head);
    }
    p = S;
    k = KDI[j];
    while (p != nullptr) {
      d = p->Digit[k];
      q[d].tail->next = p;
      q[d].tail = p;
      p = p->next;
    }

    p = (listDataBase *)&S;

    int i = 0;
    int sign = 1;
    if (dec == 1) {
      i = 255;
      sign = -1;
    }

    while ((i > -1) && (i < 256)) {
      if (q[i].tail != (listDataBase *)&(q[i].head)) {
        p->next = q[i].head;
        p = q[i].tail;
      }
      i += sign;
    }

    p->next = nullptr;
  }
  return;
}
short int comparator(const char *word1, const char *word2) {
  int i = 0;

  while (word1[i] != '\0' && word2[i] != '\0') {
    // КОСТЫЛИЩЕ-Е-Е-Е, код пробела больше, хотя по таблице и меньше
    if (word1[i] < word2[i] || (word1[i] == ' ' && word2[i] != ' '))
      return -1;
    // КОСТЫЛИЩЕ-Е-Е-Е, код пробела больше, хотя по таблице и меньше
    if (word1[i] > word2[i] || (word2[i] == ' ' && word1[i] != ' '))
      return 1;
    i++;
  }
  return 0;
}
/* Бинарный поиск (ver#2) */
listDataBase *binarySearch(itemDataBase **arr, int size,
                           const char *keySearch) {
  listDataBase *p = nullptr, *head = nullptr;
  int L = 0, R = size - 1, m;
  while (L < R) {
    m = (L + R) / 2;
    if (comparator(arr[m]->depositor, keySearch) == -1) {
      L = m + 1;
    } else {
      R = m;
    }
  }

  if (comparator(arr[R]->depositor, keySearch) == 0) {
    p = head = new listDataBase;
    p->data = *(arr[R]);
    R++;

    while (R < size && (comparator(arr[R]->depositor, keySearch) == 0)) {
      p->next = new listDataBase;
      p = p->next;
      p->data = *(arr[R]);
      R++;
    }
    p->next = nullptr;
  }
  return head;
}

/* Да | Нет */
int selectionCheck() {

  int key;
  do {

    key = getch();

    if ((key == 110) || key == (78)) // n|N
      return 0;
    else if ((key == 121) || key == (89)) // y|Y
      return 1;
    else if ((key == 141) || key == (173)) // н|Н
      return 1;
    else if ((key == 146) || key == (226)) // т|Т
      return 0;

  } while (true);
}

/* Пауза в конце программы */
void pauseAtTheEnd() {
  std::cout << std::endl
            << std::endl
            << "Press any key to close window!" << std::endl;
  getch();
}
