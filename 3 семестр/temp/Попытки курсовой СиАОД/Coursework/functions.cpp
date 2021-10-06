#include "functions.hpp"


/* Открытие файла с БД */
bool openDataBase(char* filename, std::fstream*& file){
  file->open(filename, std::ios::in | std::ios::binary);
  if (!(*file))
    return 0;
  return 1;
}

/* Считывание БД и формирование исходного списка */
listDataBase* readDataBase(std::fstream*& file, unsigned int & size){
  itemDataBase* data = new itemDataBase;
  listDataBase* head;
  listDataBase* temp = head = new listDataBase;
  file->read((char *)data, sizeof(*data)).eof();
  temp->data = *data;
  size++;
  while (!file->read((char *)data, sizeof(*data)).eof()) {
    temp->next = new listDataBase;
    temp = temp->next;
    temp->data = *data;
    size++;
  }
  temp->next = nullptr;
  return head;
}


///* Цифровая сортировка */
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

/* Инициализация индексного массива */
itemDataBase** createIndexArr(listDataBase* p ,unsigned int size){
  itemDataBase** arr = new itemDataBase *[size] { nullptr };
  for (int i = 0; p != nullptr; p = p->next, i++)
    arr[i] = &(p->data);
  return arr;
}

short int comparator(char *word1, char *word2) {
  int i = 0;
  while (word1[i] != '\0'){
    std::cout<<word1[i];
    i++;
  };
  std::cout<<" | ";
  i = 0;
  while (word2[i] != '\0'){
    std::cout<<word2[i];i++;
  };
  std::cout<<"\n";
  i = 0;

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
                           char *keySearch) {
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


/* Пауза в конце программы */
void pauseAtTheEnd() {
  std::cout << std::endl
            << std::endl
            << "Press any key to close window!" << std::endl;
  getch();
}