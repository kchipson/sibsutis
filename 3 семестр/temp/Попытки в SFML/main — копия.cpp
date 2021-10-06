#include <SFML/Graphics.hpp>
#include <iostream>
#include <ctime>
#include <cstdlib>

using namespace std;

const int WINDOW_WIDTH = 800;  // ширина окна
const int WINDOW_HEIGHT = 600; // высота окна

void drawStuff(int &pointCounter, sf::RenderWindow &window, sf::Event event,
               sf::VertexArray &triangle);
void Randomize();
int RandomInteger(int low, int high);
void drawCircle(sf::RenderWindow &window, sf::Vector2f currentPoint,
                sf::CircleShape &circle);
void moveCurrentPoint(sf::Vector2f &currentPoint, sf::VertexArray triangle);

// точка входа в программу
int main() {
  // инициализируется генератор случайных чисел
  Randomize();
  // создается окно
  sf::RenderWindow window(sf::VideoMode(WINDOW_WIDTH, WINDOW_HEIGHT),
                          "Chaos Game");
  int pointCounter = 0;                        // счетчик кликов
  sf::VertexArray triangle(sf::LinesStrip, 4); // массив вершин
  sf::CircleShape circle(WINDOW_WIDTH / 500);
  sf::Vector2f currentPoint; // текущая точка
  cout << "Click three points within window please" << endl;

  // основной цикл работает пока открыто окно
  while (window.isOpen()) {
    sf::Event event; // объект события
    // обработка событий внутри окна
    while (window.pollEvent(event)) {
      switch (event.type) {
      // если проиошло событие закрытия окна, то закрыть
      case sf::Event::Closed:
        window.close();
        break;
      case sf::Event::MouseButtonPressed:
        // если пользователь нажал на левую кнопку мыши
        if (event.mouseButton.button == sf::Mouse::Left) {
          cout << "Mouse pressed! "
               << "Mouse X: " << event.mouseButton.x
               << " Y: " << event.mouseButton.y << endl;
          // если произошло меньше 4 кликов строит внешний треугольник
          if (pointCounter <= 2)
            triangle[pointCounter].position =
                sf::Vector2f(event.mouseButton.x, event.mouseButton.y);
          pointCounter++;
          if (pointCounter == 3) {
            triangle[pointCounter].position = triangle[0].position;
            currentPoint = triangle[RandomInteger(0, 2)].position;
          }
        }
        break;
      }
    }

    // рисует треугольник и текущую точку
    if (pointCounter == 3) {
      window.draw(triangle);
      drawCircle(window, currentPoint, circle);
      // перемещает текущую точку
      moveCurrentPoint(currentPoint, triangle);
    } else if (pointCounter > 3)
      window.close();
    window.display();
  }

  return 0;
}

// инициализирует генератор случайных чисел текущим временем
void Randomize() { srand(int(time(NULL))); }

// генерирует случайное число от low до high
int RandomInteger(int low, int high) {
  double normalVal = double(rand()) / (double(RAND_MAX) + 1);
  int scaledVal = int(normalVal * (high - low + 1));
  return low + scaledVal;
}

// рисует круг с центром в текущей точке
void drawCircle(sf::RenderWindow &window, sf::Vector2f currentPoint,
                sf::CircleShape &circle) {
  circle.setFillColor(sf::Color(sf::Color::Yellow));
  int xPos = currentPoint.x - circle.getRadius();
  int yPos = currentPoint.y - circle.getRadius();
  cout << "Random x: " << xPos + circle.getRadius()
       << " y: " << yPos + circle.getRadius() << endl;
  circle.setPosition(xPos, yPos);
  window.draw(circle);
}

// перемещает текущую точку в направлении случайно выбранной вершины на половину
// расстояния до вершины
void moveCurrentPoint(sf::Vector2f &currentPoint, sf::VertexArray triangle) {
  int vertexIndex = RandomInteger(0, 2);
  sf::Vector2f dirVertex = triangle[vertexIndex].position;
  currentPoint.x = (dirVertex.x + currentPoint.x) / 2;
  currentPoint.y = (dirVertex.y + currentPoint.y) / 2;
}