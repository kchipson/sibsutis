#include "iostream"
#include <SFML/Window.hpp>
#include <SFML/Graphics.hpp>
#include "conio.h"
#include "ctime"
#include <cmath> // для hypot
#include <windows.h>
using namespace std;

const int MAX_RAND = 1000; // Число в дереве [0..MAX_RAND]
struct TREE {
  int data;
  TREE *L = NULL;
  TREE *R = NULL;
};

void outTree_ToptoBott(TREE *p, bool root = 1) {
  if (root)
    cout << endl << "▼ : ";
  if (p != NULL) {
    cout << p->data << "; ";
    outTree_ToptoBott(p->L, 0);
    outTree_ToptoBott(p->R, 0);
  }
}

void outTree_LefttoRight(TREE *p, bool root = 1) {
  if (root)
    cout << endl << "> : ";
  if (p != NULL) {
    outTree_LefttoRight(p->L, 0);
    cout << p->data << "; ";
    outTree_LefttoRight(p->R, 0);
  }
}
void outTree_BotttoTop(TREE *p, bool root = 1) {
  if (root)
    cout << endl << "▲ : ";
  if (p != NULL) {
    outTree_BotttoTop(p->L, 0);
    outTree_BotttoTop(p->R, 0);
    cout << p->data << "; ";
  }
}

int sizeTree(TREE *p, bool root = 1) {
  if (root)
    cout << endl << "The size of the tree: ";
  if (p == NULL)
    return 0;
  else
    return (1 + sizeTree(p->L, 0) + sizeTree(p->R, 0));
}

int checkSumTree(TREE *p, bool root = 1) {
  if (root)
    cout << endl << "The checksum tree: ";
  if (p == NULL)
    return 0;
  else
    return (p->data + checkSumTree(p->L, 0) + checkSumTree(p->R, 0));
}

int sumOfPathLengths(TREE *p, int depth, bool root = 1) {
  if (root)
    cout << endl << "The sum of the lengths of the paths of the tree: ";
  if (p == NULL)
    return 0;
  else
    return (depth + sumOfPathLengths(p->L, depth + 1, 0) +
            sumOfPathLengths(p->R, depth + 1, 0));
}

int maxHeight(int a, int b) {
  if (a < b)
    return b;
  else
    return a;
}

int heightTree(TREE *p, bool root = 1) {
  if (root)
    cout << endl << "The height tree: ";
  if (p == NULL)
    return 0;
  else
    return (1 + maxHeight(heightTree(p->L, 0), heightTree(p->R, 0)));
}

float averageHeightTree(TREE *ROOT, bool root = 1) {
  if (root)
    cout << endl << "The average height tree: ";
  return (float(sumOfPathLengths(ROOT, 1, 0)) / sizeTree(ROOT, 0));
}

void FillRand(int *A, int n) {

  bool table[MAX_RAND] = {false};
  int x;
  for (int i = 0; i < n; i++) {
    while (table[x = rand() % MAX_RAND])
      ;
    table[x] = true;
    A[i] = x;
  }
}

void InsertSort(int *A, int n) {
  int temp, i, j;
  for (i = 1; i < n; i++) {
    temp = A[i];
    j = i - 1;
    while (j >= 0 && temp < A[j]) {
      A[j + 1] = A[j];
      j = j - 1;
    }
    A[j + 1] = temp;
  }
}

TREE *PBST(int left, int right, int *A) {
  /*Perfectly balanced search tree*/ /*Идеально сбалансированное дерево поиска*/
  if (left > right)
    return NULL;
  else {
    int m = ((left + right) / 2);
    TREE *p = new TREE;
    p->data = A[m];
    p->L = PBST(left, m - 1, A);
    p->R = PBST(m + 1, right, A);
    return p;
  }
}

int addRST(TREE *&root, int data) {
  TREE **p = &root;
  while (*p != NULL) {
    if (data < (*p)->data)
      p = &((*p)->L);
    else if (data > (*p)->data)
      p = &((*p)->R);
    else {
      cout << "\t\t /* Данные с ключом \"" << data << "\" уже есть в дереве */"
           << endl;
      return 0;
    }
  }
  if (*p == NULL) {
    *p = new TREE;
    (*p)->data = data;
  }
  return 1;
}

void zoomViewAt(sf::Vector2i pixel, sf::RenderWindow &window, sf::View &view,
                float zoom) {
  const sf::Vector2f beforeCoord{window.mapPixelToCoords(pixel)};
  view.zoom(zoom);
  window.setView(view);
  const sf::Vector2f afterCoord{window.mapPixelToCoords(pixel)};
  const sf::Vector2f offsetCoords{beforeCoord - afterCoord};
  view.move(offsetCoords);
  window.setView(view);
}

void Draw(sf::RenderWindow &window, TREE *tree, int x, int y) { window.draw(); }
int window(TREE *tree) {
  sf::RenderWindow window((sf::VideoMode::getFullscreenModes())[0], L"Дерево",
                          sf::Style::Fullscreen);
  cout << window.getSize().x << endl;
  sf::View view(window.getDefaultView());
  sf::Vector2f oldPos;

  bool moving = false;
  const float zoomAmount{1.1f}; // zoom by 10%

  window.setMouseCursorGrabbed(true);
  window.setFramerateLimit(60);
  window.requestFocus();

  sf::Texture texture;
  if (!texture.loadFromFile("ag80QzQ.png")) {
    std::cerr << "Could not load image.";
    return EXIT_FAILURE;
  }

  sf::Sprite sprite(texture);
  sprite.setScale({1.0f, 1.0f}); // Размер изображения

  sf::VertexArray line(sf::Lines, 2);
  line[0].position = sf::Vector2f(0, 0);
  line[0].color = sf::Color::Blue;
  line[1].position = sf::Vector2f(500, 500);
  // линия будет с градиентом
  line[1].color = sf::Color::Cyan;

  //======================================================
  // Конструктор линии с изменяемой толщиной
  //======================================================
  sf::RectangleShape line2(sf::Vector2f(hypot(500, 500), 5));
  // Устанавливаем позицию откуда начинать рисовать
  line2.setPosition(0, 500);
  line2.setFillColor(sf::Color(255, 0, 0));
  // минус рисует вверх
  line2.rotate(-45);

  while (window.isOpen()) {
    sf::Event event;

    while (window.pollEvent(event)) {
      switch (event.type) {
      case sf::Event::Closed: // Событие закрытия
        window.close();
        break;
      case sf::Event::KeyPressed: // Нажатие клавиши
        switch (event.key.code) {
        case sf::Keyboard::Escape: // Esc
          window.close();
          break;
        case sf::Keyboard::Space: // Пробел
          view = window.getDefaultView();
          window.setView(view);
          break;
        }
        break;
      case sf::Event::MouseWheelScrolled: // Скроллинг
        if (event.mouseWheelScroll.delta > 0)
          zoomViewAt({event.mouseWheelScroll.x, event.mouseWheelScroll.y},
                     window, view, (1.f / zoomAmount));
        else if (event.mouseWheelScroll.delta < 0)
          zoomViewAt({event.mouseWheelScroll.x, event.mouseWheelScroll.y},
                     window, view, zoomAmount);
        break;
      case sf::Event::MouseButtonPressed: // Нажатие кнопки мыши
        if (event.mouseButton.button == 0) { // ЛКМ
          moving = true;
          oldPos = window.mapPixelToCoords(
              sf::Vector2i(event.mouseButton.x, event.mouseButton.y));
        }
        break;
      case sf::Event::MouseButtonReleased: // Отпускание кнопки мыши
        if (event.mouseButton.button == 0) { // ЛКМ
          moving = false;
        }
        break;
      case sf::Event::MouseMoved: // Перемещение мыши
        if (moving) {
          //  Определение новой позиции в мировых координатах
          const sf::Vector2f newPos = window.mapPixelToCoords(
              sf::Vector2i(event.mouseMove.x, event.mouseMove.y));
          // Определение способа перемещения курсора
          // p.s Поменять местами для инвертирования
          const sf::Vector2f deltaPos = oldPos - newPos;

          // Перемещение камеры
          view.setCenter(view.getCenter() + deltaPos);
          // Обновление камеры
          window.setView(view);

          // Пересохранение позиции
          oldPos = window.mapPixelToCoords(
              sf::Vector2i(event.mouseMove.x, event.mouseMove.y));
        }
      }
    }
    window.clear(sf::Color(204, 228, 182, 255));

    window.draw(sprite);
    window.draw(line);
    window.draw(line2);
    window.display();
  }
}

void table(TREE *PBST, TREE *RST, int n) {
  cout << endl;
  cout << " -------------------------------------------------------------------"
          "-------------"
       << endl;
  cout << "┊ n=";
  cout.width(6);
  cout << n;
  cout << " ┊    Размер    ┊    Контр. сумма    ┊    Высота    ┊   "
          "Средн.высота   ┊"
       << endl;
  cout << " -------------------------------------------------------------------"
          "-------------"
       << endl;
  cout << "┊   ИСДП   ┊ ";
  cout.width(12);
  cout << sizeTree(PBST, false);
  cout << " ┊ ";
  cout.width(18);
  cout << checkSumTree(PBST, false);
  cout << " ┊ ";
  cout.width(12);
  cout << heightTree(PBST, false);
  cout << " ┊ ";
  cout.width(16);
  cout << averageHeightTree(PBST, false);
  cout << " ┊" << endl;
  cout << " -------------------------------------------------------------------"
          "-------------"
       << endl;
  cout << "┊   СДП    ┊ ";
  cout.width(12);
  cout << sizeTree(RST, false);
  cout << " ┊ ";
  cout.width(18);
  cout << checkSumTree(RST, false);
  cout << " ┊ ";
  cout.width(12);
  cout << heightTree(RST, false);
  cout << " ┊ ";
  cout.width(16);
  cout << averageHeightTree(RST, false);
  cout << " ┊" << endl;
  cout << " -------------------------------------------------------------------"
          "-------------"
       << endl;
}

int main(int argc, const char **argv) {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  srand(time(NULL));
  int n = 100;

  TREE *root1 = NULL, *root2 = NULL;
  int *Arr = new int[n];
  FillRand(Arr, n);
  cout << "\tНачальный массив:" << endl;
  for (int i = 0; i < n; i++)
    cout << Arr[i] << " ";
  cout << "\n\n";

  InsertSort(Arr, n);

  cout << "\tОтсортированный массив:" << endl;
  for (int i = 0; i < n; i++)
    cout << Arr[i] << " ";
  cout << "\n\n\n";

  cout << "\t***   Идеально сбалансированное дерево поиска   ***";
  root1 = PBST(0, n - 1, Arr);
  outTree_LefttoRight(root1);
  cout << endl << "_____________________";
  cout << sizeTree(root1);
  cout << checkSumTree(root1);
  cout << heightTree(root1);
  cout << averageHeightTree(root1);
  cout << endl;

  cout << endl << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
  cout << "\t***   Случайное дерево поиска   ***:" << endl;
  int i = 0;

  while (i < n) {
    i = i + addRST(root2, rand() % MAX_RAND);
  }
  outTree_LefttoRight(root2);
  cout << endl << "_____________________";
  cout << sizeTree(root2);
  cout << checkSumTree(root2);
  cout << heightTree(root2);
  cout << averageHeightTree(root2);
  cout << endl;

  cout << endl << "Вывести сравительную таблицу? (y/n)";
  int key;
  bool flag = true;
  do {
    flag = false;
    key = getch();
    if ((key == 110) || key == (78)) // n|N
      break;
    else if ((key == 121) || key == (89)) // y|Y
      table(root1, root2, n);
    else if ((key == 208) || key == (209)) { // rus
      key = getch();
      if ((key == 157) || key == (189)) // н|Н
        table(root1, root2, n);
      else if ((key == 162) || key == (130)) // т|Т
        break;
      else
        flag = true;
    } else
      flag = true;
  } while (flag);
  window(root1);
  cout << endl << endl << "Press any key to close window!";
  getch();
  return 0;
}

/* Ивенты без case */

// if (event.type == sf::Event::Closed ||
//     (event.type == sf::Event::KeyPressed &&
//      event.key.code == sf::Keyboard::Escape)) { // Закрытие приложения
//   window.close();
// } else if (event.type == sf::Event::KeyPressed &&
//            event.key.code == sf::Keyboard::Space) { // Нажатие пробела
//   view = window.getDefaultView();
//   window.setView(view);

// } else if (event.type == sf::Event::MouseWheelScrolled) { // Скроллинг
//   if (event.mouseWheelScroll.delta > 0)
//     zoomViewAt({event.mouseWheelScroll.x, event.mouseWheelScroll.y},
//                window, view, (1.f / zoomAmount));
//   else if (event.mouseWheelScroll.delta < 0)
//     zoomViewAt({event.mouseWheelScroll.x, event.mouseWheelScroll.y},
//                window, view, zoomAmount);

// } else if (event.type == sf::Event::MouseButtonPressed) {
//   // Кнопка мыши нажата
//   if (event.mouseButton.button == 0) {
//     moving = true;
//     oldPos = window.mapPixelToCoords(
//         sf::Vector2i(event.mouseButton.x, event.mouseButton.y));
//   }
// } else if (event.type == sf::Event::MouseButtonReleased) {
//   // Кнопка мыши отпущена
//   if (event.mouseButton.button == 0) {
//     moving = false;
//   }
// } else if (event.type == sf::Event::MouseMoved) {
//   if (moving) {
//     // Determine the new position in world coordinates
//     const sf::Vector2f newPos = window.mapPixelToCoords(
//         sf::Vector2i(event.mouseMove.x, event.mouseMove.y));
//     // Determine how the cursor has moved
//     // Swap these to invert the movement direction
//     const sf::Vector2f deltaPos = oldPos - newPos;

//     // Move our view accordingly and update the window
//     view.setCenter(view.getCenter() + deltaPos);
//     window.setView(view);

//     // Save the new position as the old one
//     // We're recalculating this, since we've changed the view
//     oldPos = window.mapPixelToCoords(
//         sf::Vector2i(event.mouseMove.x, event.mouseMove.y));
//   }
// }