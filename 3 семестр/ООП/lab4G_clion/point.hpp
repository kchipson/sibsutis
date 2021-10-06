//
// Created by kchipson on 17.10.2019.
//

#ifndef POINT_HPP
#define POINT_HPP

#include <SFML/Graphics.hpp>
#include <cmath>
#include <cstdlib>

class Point{
  /* Поля */
protected:
  sf::RenderWindow* window = nullptr;
  short int x1;
  short int y1;
  sf::Color fillColor;
  unsigned short int speed;
  int spd_x;
  int spd_y;
  int rotateAngle = 0;

private:
  sf::Vertex point;

  /* Конструктор */
public:
  Point(){};
  Point(sf::RenderWindow* window, short int x, short int y);

  /* Методы */
public:
  void setX1(short int x);
  void setY1(short int y);
  void setPosition(short int x, short int y);

  void setDirection(short int dx, short int dy);
  void setSpeed(unsigned short int speed);
  void setFillColor(unsigned short int R, unsigned short int G,
                    unsigned short int B);

  void draw();
  void straightMove();

  void rotateMove();
};

#endif // POINT_HPP
