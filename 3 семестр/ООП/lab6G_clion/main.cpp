#include <iostream>
#include <ctime>

#include <SFML/Graphics.hpp>

#include "circle.hpp"
#include "ellipse.hpp"
#include "figure.hpp"
#include "line.hpp"
#include "point.hpp"
#include "rectangle.hpp"
#include "rhombus.hpp"
#include "triangle.hpp"

int main(int argc, char const *argv[]) {
  int seed = time(0);
  srand(seed);
//  sf::ContextSettings settings;
//  settings.antialiasingLevel = 4;
  sf::RenderWindow window(sf::VideoMode(1360,700), L"ООП. Лабораторная работа #5",sf::Style::Close);
  window.setPosition(sf::Vector2i(0,0));
  window.setFramerateLimit(60);

  int numberOfPoints = 500;
  int numberOfLines = 10;
  int numberOfCircles = 15;
  int numberOfEllipses = 10;
  int numberOFRhombuses = 10;
  int numberOfTriangles = 10;
  int numberOFRectangles = 15;

  int sum = numberOfPoints + numberOfLines+numberOfCircles + numberOfEllipses + numberOFRhombuses + numberOfTriangles + numberOFRectangles;
  int temp = 0;
  Figure * figure[sum];

  for (int i = temp; i < temp + numberOfPoints; i++) {
    Point *point;
    point = new Point(&window, rand() % (window.getSize().x), rand() % (window.getSize().y));
    point -> setSpeed(rand() % 15 + 1);
    point -> setDirection(rand() % 6 - 3, rand() % 6 - 3);
    point -> setFillColor(rand() % 256, rand() % 256, rand() % 256);
    figure[i] = point;
  }
  temp = temp + numberOfPoints;


  for (int i = temp; i < temp + numberOfLines; i++) {
    Line *line;
    line = new Line(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % (window.getSize().x), rand() % (window.getSize().y));
    line -> setSpeed(rand() % 4 + 1);
    line -> setDirection(rand() % 6 - 3, rand() % 6 - 3);
    line -> setFillColor(rand() % 256, rand() % 256, rand() % 256);
    figure[i] = line;
  }
  temp = temp + numberOfLines;

  for (int i = temp; i < temp + numberOfCircles; i++) {
    Circle *circle;
    circle = new Circle(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % 30 + 6);
    circle -> setSpeed(rand() % 4 + 1);
    circle -> setDirection(rand() % 6 - 3, rand() % 6 - 3);
    circle -> setFillColor(rand() % 256, rand() % 256, rand() % 256);
    figure[i] = circle;
  }
  temp = temp + numberOfCircles;


  for (int i = temp; i < temp + numberOfEllipses; i++) {
    Ellipse *ellipse;
    ellipse = new Ellipse(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % 30 + 20);
    ellipse -> setSpeed(rand() % 4 + 1);
    ellipse -> setScale((rand() % 4 + 1)/(float)2, (rand() % 4 + 1)/(float)2);
    ellipse -> setDirection(rand() % 6 - 3, rand() % 6 - 3);
    ellipse -> setFillColor(rand() % 256, rand() % 256, rand() % 256);
    figure[i] = ellipse;
  }
  temp = temp + numberOfEllipses;


  for (int i = temp; i < temp + numberOFRhombuses; i++) {
    Rhombus *rhombus;
    rhombus = new Rhombus(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % 30 + 20);
    rhombus -> setSpeed(rand() % 4 + 1);
    rhombus -> setScale((rand() % 4 + 1)/(float)2, (rand() % 4 + 1)/(float)2);
    rhombus -> setDirection(rand() % 6 - 3, rand() % 6 - 3);
    rhombus -> setFillColor(rand() % 256, rand() % 256, rand() % 256);
    figure[i] = rhombus;
  }
  temp = temp + numberOFRhombuses;

  for (int i = temp; i < temp + numberOfTriangles; i++) {
    Triangle *triangle;
    triangle = new Triangle(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % 30 + 20);
    triangle -> setSpeed(rand() % 4 + 1);
    triangle -> setScale((rand() % 4 + 1)/(float)2, (rand() % 4 + 1)/(float)2);
    triangle -> setDirection(rand() % 6 - 3, rand() % 6 - 3);
    triangle -> setFillColor(rand() % 256, rand() % 256, rand() % 256);
    figure[i] = triangle;
  }
  temp = temp + numberOfTriangles;


  for (int i = temp; i < temp + numberOFRectangles; i++) {
    Rectangle *rectangle;
    int temp_x, temp_y;
    temp_x = rand() % window.getSize().x;
    temp_y = rand() % window.getSize().y;
    rectangle = new Rectangle(&window, temp_x, temp_y, temp_x + (rand() % 300-150), temp_y + (rand() % 300-150));
    rectangle -> setSpeed(rand() % 4 + 1);
    rectangle -> setDirection(rand() % 6 - 3, rand() % 6 - 3);
    rectangle -> setFillColor(rand() % 256, rand() % 256, rand() % 256);
    figure[i] = rectangle;
  }
  temp = temp + numberOFRectangles;

  bool type = false;
  sf::Event event{};
  while (window.isOpen()) {
    while (window.pollEvent(event)) {
      if (event.type == sf::Event::Closed ||(event.type == sf::Event::KeyPressed && event.key.code == sf::Keyboard::Escape))
        window.close();
      if (event.type == sf::Event::KeyPressed && event.key.code == sf::Keyboard::Space)
        type = !type;
    }

    window.clear(sf::Color(0, 0, 0));

    for (int i = 0; i < temp; i++) {
      if(!type)
        figure[i]->straightMove();
      else
        figure[i]->rotateMove();
      figure[i]->draw();
    }
    window.display();
  }
  return 0;
}