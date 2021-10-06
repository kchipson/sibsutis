#include <iostream>
#include <ctime>

#include <SFML/Graphics.hpp>

#include "circle.hpp"
#include "ellipse.hpp"
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

  Point point[numberOfPoints];
  for (int i = 0; i < numberOfPoints; i++) {
    point[i]= Point(&window, rand() % (window.getSize().x), rand() % (window.getSize().y));
    point[i].setSpeed(rand() % 15 + 1);
    point[i].setDirection(rand() % 6 - 3, rand() % 6 - 3);
    point[i].setFillColor(rand() % 256, rand() % 256, rand() % 256);
  }

  Line line[numberOfLines];
  for (int i = 0; i < numberOfLines; i++) {
    line[i]= Line(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % (window.getSize().x), rand() % (window.getSize().y));
    line[i].setSpeed(rand() % 4 + 1);
    line[i].setDirection(rand() % 6 - 3, rand() % 6 - 3);
    line[i].setFillColor(rand() % 256, rand() % 256, rand() % 256);
  }

  Circle circle[numberOfCircles];
  for (int i = 0; i < numberOfCircles; i++) {
    circle[i] = Circle(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % 30 + 6);
    circle[i].setSpeed(rand() % 4 + 1);
    circle[i].setDirection(rand() % 6 - 3, rand() % 6 - 3);
    circle[i].setFillColor(rand() % 256, rand() % 256, rand() % 256);
  }

  Ellipse ellipse[numberOfEllipses];
  for (int i = 0; i < numberOfEllipses; i++) {
    ellipse[i] = Ellipse(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % 30 + 20);
    ellipse[i].setSpeed(rand() % 4 + 1);
    ellipse[i].setScale((rand() % 4 + 1)/(float)2, (rand() % 4 + 1)/(float)2);
    ellipse[i].setDirection(rand() % 6 - 3, rand() % 6 - 3);
    ellipse[i].setFillColor(rand() % 256, rand() % 256, rand() % 256);
  }

  Rhombus rhombus[numberOFRhombuses];
  for (int i = 0; i < numberOFRhombuses; i++) {
    rhombus[i] = Rhombus(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % 30 + 20);
    rhombus[i].setSpeed(rand() % 4 + 1);
    rhombus[i].setScale((rand() % 4 + 1)/(float)2, (rand() % 4 + 1)/(float)2);
    rhombus[i].setDirection(rand() % 6 - 3, rand() % 6 - 3);
    rhombus[i].setFillColor(rand() % 256, rand() % 256, rand() % 256);
  }

  Triangle triangle[numberOfTriangles];
  for (int i = 0; i < numberOfTriangles; i++) {
    triangle[i] = Triangle(&window, rand() % (window.getSize().x), rand() % (window.getSize().y), rand() % 30 + 20);
    triangle[i].setSpeed(rand() % 4 + 1);
    triangle[i].setScale((rand() % 4 + 1)/(float)2, (rand() % 4 + 1)/(float)2);
    triangle[i].setDirection(rand() % 6 - 3, rand() % 6 - 3);
    triangle[i].setFillColor(rand() % 256, rand() % 256, rand() % 256);
  }

  Rectangle rectangle[numberOFRectangles];
  for (int i = 0; i < numberOFRectangles; i++) {
    int temp_x, temp_y;
    temp_x = rand() % window.getSize().x;
    temp_y = rand() % window.getSize().y;
    rectangle[i] = Rectangle(&window, temp_x, temp_y, temp_x + (rand() % 300-150), temp_y + (rand() % 300-150));
    rectangle[i].setSpeed(rand() % 4 + 1);
    rectangle[i].setDirection(rand() % 6 - 3, rand() % 6 - 3);
    rectangle[i].setFillColor(rand() % 256, rand() % 256, rand() % 256);
  }



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

    for (int i = 0; i < numberOFRectangles; i++) {
      if(!type)
        rectangle[i].straightMove();
      else
        rectangle[i].rotateMove();
      rectangle[i].draw();
    }

    for (int i = 0; i < numberOfCircles; i++) {
      if(!type)
        circle[i].straightMove();
      circle[i].draw();
    }

    for (int i = 0; i < numberOfEllipses; i++) {
      if(!type)
        ellipse[i].straightMove();
      else
        ellipse[i].rotateMove();
      ellipse[i].draw();
    }

    for (int i = 0; i < numberOFRhombuses; i++) {
      if(!type)
        rhombus[i].straightMove();
      else
        rhombus[i].rotateMove();
      rhombus[i].draw();
    }

    for (int i = 0; i < numberOfTriangles; i++) {
      if(!type)
        triangle[i].straightMove();
      else
        triangle[i].rotateMove();
      triangle[i].draw();
    }

    for (int i = 0; i < numberOfLines; i++) {
      if(!type)
        line[i].straightMove();
      line[i].draw();
    }

    for (int i = 0; i < numberOfPoints; i++) {
      if(!type)
        point[i].straightMove();
      point[i].draw();
    }


    window.display();
//    sf::sleep(sf::milliseconds(30));
  }

  return 0;
}