#include "func.hpp"

/* Считывание БД и формирование исходного списка */
void readDataBase(listDataBase *&p, unsigned int & size){
  if (p != nullptr){
    delList(p);
    size = 0;
  }
  std::fstream *file = new std::fstream;
  file->open("testBase3.dat", std::ios::in | std::ios::binary);
  if (!(*file)){
    std::cout << "Error#1. Файл \"testBase3.dat\" не найден!";
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

short int comparator(const char *word1, const char * word2) {
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
listDataBase *binarySearch(itemDataBase **arr, unsigned int size, char *keySearch) {
  listDataBase *p = nullptr, *head = nullptr;
  int L = 0, R = (int)size - 1, m;
  while (L < R) {
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
              << "\n"
              << " < Значения для данного ключа в базе данных не найдены >"
              << "\n"
              << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << "\n";
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

void quickSortCoding(coding* A, int R, int L)  // Сортировка для кодировки (сортировка по убыванию вероятности)
{
  while (L < R) {
    float x = A[L].probability;
    int i = L;
    int j = R;
    while (i <= j) {
      while (A[i].probability > x)
        i++;
      while (A[j].probability < x)
        j--;

      if (i <= j) {
        char tmp_ch;
        tmp_ch = A[i].symbol;
        A[i].symbol = A[j].symbol;
        A[j].symbol = tmp_ch;

        unsigned int tmp_q;
        tmp_q = A[i].quantity;
        A[i].quantity = A[j].quantity;
        A[j].quantity = tmp_q;

        float tmp_prop;
        tmp_prop = A[i].probability;
        A[i].probability = A[j].probability;
        A[j].probability = tmp_prop;
        i++;
        j--;
      }
    }

    if (j - L > R - i) {
      quickSortCoding(A, R, i);
      R = j;
    }
    else {
      quickSortCoding(A, j, L);
      L = i;
    }
  }
}

//Находит медиану части массива P, т.е. такой индекс L <= m <= R, что минимальна величина
int med(coding *code, int borderL, int borderR) {
  float SumL = 0;
  for (int i = borderL; i < borderR; i++)
    SumL = SumL + code[i].probability;

  float SumR = code[borderR].probability;
  int m = borderR;

  while (SumL >= SumR) {
    m = m - 1;
    SumL = SumL - code[m].probability;
    SumR = SumR + code[m].probability;
  }

  return m;
}

void codeFano(coding * code, int borderL, int borderR, int k) {
  //k - длина уже построенной части элементарных кодов
  if (borderL < borderR) {
    k = k + 1;
    int m = med(code, borderL, borderR);
    for (int i = borderL; i <= borderR; i++) {
      if (code[i].codeword != nullptr){
        char *temp = new char[k + 1];
        for(int j = 0; j < k - 1; j++)
          temp[j] = code[i].codeword[j];
        delete[] code[i].codeword;
        code[i].codeword = temp;
      }
      else
        code[i].codeword = new char[k + 1];

      if (i <= m)
        code[i].codeword[k - 1] = '0';
      else
        code[i].codeword[k - 1] = '1';

      code[i].codeword[k] = '\0';
      code[i].lengthCW = code[i].lengthCW+ 1;
    }
    codeFano(code, borderL, m, k);
    codeFano(code, m + 1, borderR, k);
  }
}

void tableSymbols(coding* &code, int &numsUnique){
  int windows866[256] = {0};
  int totalNums = 0;
  char ch;

  std::fstream file("testBase3.dat", std::ios::in | std::ios::binary);

  if (!(file.is_open())){
    std::cout << "Error#1. Файл \"testBase3.dat\" не найден!";
    exit(1);
  }

  while (!file.read((char*)&ch, sizeof(ch)).eof()){
      totalNums++;
      if (int(ch) < 0)
        windows866[int(ch) + 256]++;
      else
        windows866[int(ch)]++;
  }
  file.close();

  for (int i = 0; i < 256; i++)
    if (windows866[i] != 0 )
      numsUnique++;

  code = new coding[numsUnique];
  unsigned short int temp = 0;
  for (int i = 0; i < 256; i++) {
    if(windows866[i] != 0){
      code[temp].symbol = char(i);
      code[temp].quantity = windows866[i];
      code[temp].probability = (float)windows866[i] / (float)totalNums;
      temp++;
    }
  }

  quickSortCoding(code, numsUnique - 1, 0);
  codeFano(code, 0, numsUnique - 1, 0);

}
//

/* Пауза  */
void pause() {
  std::cout << "\nPress any key to continue!\n";
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
  std::cout << "\n";
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