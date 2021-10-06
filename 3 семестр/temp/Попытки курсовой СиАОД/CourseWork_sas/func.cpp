#include "func.hpp"

/* Считывание БД и формирование исходного списка */
void readDataBase(listDataBase *&p, unsigned int & size){
  if (p != nullptr){
    delList(p);
    size = 0;
  }
  std::fstream *file = new std::fstream;
  file->open("DataBase.dat", std::ios::in | std::ios::binary);
  if (!(*file)){
    std::cout << "Error#1. Файл \"DataBase.dat\" не найден!";
    pause();
    exit(1);
  }

  itemDataBase* data = new itemDataBase;
  listDataBase* temp = p = new listDataBase;
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
  file->close();
}

/* Цифровая сортировка */
void digitalSort(listDataBase *(&S), int reverse) {
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
    if (reverse == 1) {
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
}

/* Удаление списка */
void delList(listDataBase *&p){
  while(p){
    listDataBase * temp = p->next;
    delete p;
    p = temp;
  }
}

/* Инициализация массива */
void createIndexArr(itemDataBase** &arr, listDataBase* p ,unsigned int size){
  if (arr != nullptr)
    delArr(arr, size);
  arr = new itemDataBase *[size] { nullptr };
  for (int i = 0; p != nullptr; p = p->next, i++)
    arr[i] = &(p->data);
}

/* Удаление массива */
void delArr(itemDataBase** &arr, unsigned int size){
  for (unsigned int i = 0; i < size; i++)
    delete arr[i];
  arr = nullptr;
}

short int comparator(const char *word1, const char *word2) {
  int i = 0;
  while (word1[i] != '\0' && word2[i] != '\0') {
    if ((word1[i] == ' ' && word2[i] != ' '))
      return -1;
    else if ((word2[i] == ' ' && word1[i] != ' '))
      return 1;
    else if ((word1[i] < word2[i]))
      return -1;
    else if ((word1[i] > word2[i]) || (word2[i] == ' ' && word1[i] != ' '))
      return 1;
    i++;
  }
  return 0;
}
/* Бинарный поиск (ver#2) */
listDataBase *binarySearch(itemDataBase **arr, unsigned int size,
                           char *keySearch) {
  listDataBase *p = nullptr, *head = nullptr;
  int L = 0, R = (int)size - 1, m;
  while (L < R) {
//    std::cout << L << "% " << R << std::endl;
    m = (L + R) / 2;
    if (comparator(arr[m]->depositor, keySearch) == -1)
      L = m + 1;
    else
      R = m;
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
  else
    std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << std::endl
              << " < Значения для данного ключа в базе данных не найдены >"
              << std::endl
              << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << std::endl;
  return head;
}


void addAVL(treeLawyer *&p, itemDataBase data, bool &growth) {
  if (p == nullptr) {
    p = new treeLawyer;
    strcpy(p->data, data.lawyer);
    p->elems = new listDataBase;
    p->elems->data = data;
    p->elems->next = nullptr;
    growth = true;
  } else if (comparator(p->data, data.lawyer) == 1) {
    addAVL(p->left, data, growth);
    if (growth) {
      if (p->balance > 0) {
        p->balance = 0;
        growth = false;
      } else if (p->balance == 0) {
        p->balance = -1;
        growth = true;
      } else if ((p->left)->balance < 0) {
        rotateLL(p);
        growth = false;
      } else {
        rotateLR(p);
        growth = false;
      }
    }
  }
  else if (comparator(p->data, data.lawyer) == -1) {
    addAVL(p->right, data, growth);
    if (growth) {
      if (p->balance < 0) {
        p->balance = 0;
        growth = false;
      } else if (p->balance == 0) {
        p->balance = 1;
        growth = true;
      } else if ((p->right)->balance > 0) {
        rotateRR(p);
        growth = false;
      } else {
        rotateRL(p);
        growth = false;
      }
    }
  }
  else {
    listDataBase *q = p->elems;
    while (q->next != nullptr)
      q = q->next;
    q->next = new listDataBase;
    q = q->next;
    q->data = data;
    q->next = nullptr;
    growth = false;
  }
}

/* Поиск вершины по ключу */
treeLawyer *findVertexWithKey(treeLawyer *p, char *key) {
  treeLawyer *q = p;
  while (q != nullptr) {
    if (comparator(key, q->data) == -1)
      q = q->left;
    else if (comparator(key, q->data) == 1)
      q = q->right;
    else
      break;
  }
  return q;
}

void delTree(treeLawyer *&p){
  if(p != nullptr){
    delTree(p->left);
    delTree(p->right);
    delList(p->elems);
    delete p;
    p = nullptr;
  }
}

/* Пауза  */
void pause() {
  std::cout << std::endl
            << "Press any key to continue!" << std::endl;
  getch();
}

/* Да | Нет */
bool selectionCheck() {
  int key;
  short int selection = -1;
  clearBuffer();
  while(selection == -1) {
    key = getch();
    if (key == 13) // Enter
      selection = 1;
    else if (key == 27) // Esc
      selection = 0;
    else if ((key == 110) || key == (78)) // n|N
      selection = 0;
    else if ((key == 121) || key == (89)) // y|Y
      selection = 1;
    else  if ((key == 173) || key == (141)) // н|Н
      selection = 1;
    else if ((key == 226) || key == (146)) // т|Т
      selection = 0;
  }
  std::cout << std::endl;
  return selection;
}

/* Очистка буфера */
void clearBuffer(){
  FlushConsoleInputBuffer(GetStdHandle(STD_INPUT_HANDLE)); // Очищает буфер консоли
  if (std::cin.fail()) { // Очищает поток ввода
    std::cin.clear();
    while (std::cin.get() != '\n')
      ;
  }
}