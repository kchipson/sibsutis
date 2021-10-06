#include <iostream>
#include <conio.h>
#include <windows.h>

struct list {
  list *next;
  int data;
};
HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);

class List {
  /* Поля */
protected:
  list* head;


  /* Конструкторы */
public:
  List():head(nullptr){};
  explicit List(list *head):head(head){};
  /* Деструкторы */
public:
  ~List() {
    clear();
  };
  /* Методы */
public:
  virtual void add(int k) = 0;
  virtual bool remove(int k) = 0;
  virtual void print() = 0;
  virtual void clear() {
    while (head != nullptr) {
      list* tmp = head;
      head = head -> next;
      delete(tmp);
    }
    head = nullptr;
  };
  virtual list* getHead(){
    return head;
  }
  static int getSize(list *head) {
    int size = 0;
    list* p = head;
    while(p != nullptr){
      size++;
      p = p -> next;
    }
    return size;
  }

};

class Stack: public List{
  /* Конструкторы */
public:
  Stack() = default;
  explicit Stack(list *head):List(head){};
  /* Деструкторы */
public:
  ~Stack() = default;;
  /* Методы */
public:
  void add(int k) override {
    list *p = new list;
    p->data = k;
    p->next = head;
    head = p;
  };

  bool remove(int k) override {
    try {
      list* p = head;
      if (p == nullptr)
        throw 1;
      if (p -> data == k){
        head = head -> next;
        delete p;
        return true;
      }
      while (p->next != nullptr){
        if(p -> next -> data == k){
          list* temp = p -> next;
          p -> next = p -> next -> next;
          delete temp;
          return true;
        }
        p = p ->next;
      }
      throw 2;
    } catch (int x) {
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 4));
      if (x == 1)
        std::cout << "Удаление невозможно! Стек пуст!\n";
      if (x == 2)
        std::cout << "Элемент в стеке не найден!\n";
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 7));
      return false;
    };
  };

  void print()override {
    try {
      if(head == nullptr){
        throw 1;
      }
      list *p = head;
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 14));
      std::cout << p->data << " ";
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 7));
      p = p->next;
      while (p != nullptr) {
        std::cout << p->data << " ";
        p = p->next;
      }
    }
    catch (int x){
      if (x == 1){
        SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 4));
        std::cout << "Стек пуст!";
        SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 7));
      }
    }
    std::cout << "\n";
  };

};

class Queue: public List{
  /* Поля */
protected:
  list* tail;

  /* Конструкторы */
public:
  Queue():tail(nullptr){};
  explicit Queue(list *head):List(head),tail(nullptr){};
  /* Деструкторы */
public:
  ~Queue() = default;;
  /* Методы */
public:
  void add(int k) override {
    if (head == nullptr) {
      list *p = new list;
      p -> data = k;
      p -> next = nullptr;
      tail = head = p;
      head -> next = nullptr;
      return;
    }
    list *p = new list;
    p -> data = k;
    p -> next = nullptr;
    tail -> next = p;
    tail = p;
 };

  bool remove(int k)override {
    try {
      list* p = head;
      if (p == nullptr)
        throw 1;
      if (p -> data == k){
        head = head -> next;
        delete p;
        return true;
      }
      while (p->next != nullptr){
        if(p -> next -> data == k){
          if(p -> next == tail)
            tail = p;

          list* temp = p -> next;
          p -> next = p -> next -> next;
          delete temp;
          return true;
        }
        p = p ->next;
      }
      throw 2;
    } catch (int x) {
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 4));
      if (x == 1)
        std::cout << "Удаление невозможно! Очередь пуста!\n";
      if (x == 2)
        std::cout << "Элемент в очереди не найден!\n";
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 7));
      return false;
    };
 }

  void print()override {
    try {
      if(head == nullptr){
        throw 1;
      }
      list *p = head;
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 14));
      std::cout << p->data << " ";
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 7));
      p = p->next;
      while (p != tail && p != nullptr) {
        std::cout << p->data << " ";
        p = p->next;
      }
      if(p == nullptr){
        throw 2;
      }
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 9));
      std::cout << p->data << " ";
      SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 7));
    }
    catch (int x){
      if (x == 1){
        SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 4));
        std::cout << "Очередь пуста!";
        SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 7));

      }
      if (x == 2){
        SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 9));
        std::cout << "Tail = head!";
        SetConsoleTextAttribute(hConsole, (WORD)(0 << 4u | 7));

      }
    }
    std::cout << "\n";
  };

  void clear() override {
    List::clear();
    tail = nullptr;
  };
};

int main() {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  Queue queue;
  Stack stack;
  int i = 0;
  char ch;
  do {
    system("cls");
    std::cout << "Stack: ";
    stack.print();
    std::cout << "Queue: ";
    queue.print();
    ch = getch();

    if (ch == '+') {
      std::cout << "Element: ";
      std::cin >> i;
      queue.add(i);
      stack.add(i);
    }
    else if (ch == '-') {
      std::cout << "Element: ";
      std::cin >> i;
      int temp = 0;
      temp += stack.remove(i);
      temp += queue.remove(i);
      if (temp != 2){
        std::cout << "\nPress any key to continue!\n";
        getch();
      }


    }
    else if (ch == 's') {
      std::cout << "\nРазмер стека равен: " << List::getSize(stack.getHead()) << "\n";
      std::cout << "Размер очереди равен: " << List::getSize(queue.getHead()) << "\n";
      std::cout << "\nPress any key to continue!\n";
      getch();
    }
    else if (ch == 'c') {
      queue.clear();
      stack.clear();
    }
  } while (ch != 27);

  std::cout << "\nPress any key to finish!\n";
  getch();

  return 0;
}