//
// Created by kchipson on 20.12.2019.
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
  unsigned short int speed;
  short int spd_x;
  short int spd_y;
  sf::Color fillColor;
  int rotateAngle = 0;

private:
  sf::Vertex point;

  /* Конструктор */
public:
  Point();
  Point(sf::RenderWindow* window, short int x, short int y);

  /* Методы */
public:
  void setX1(short int x);
  void setY1(short int y);
  void setPosition(short int x, short int y);

  void setSpeed(unsigned short int speed);

  void setDirection(short int dx, short int dy);

  void setFillColor(unsigned short int R, unsigned short int G,
                    unsigned short int B);


  virtual void straightMove();
  virtual void rotateMove(){};

  virtual void draw();
};

#endif // POINT_HPP
