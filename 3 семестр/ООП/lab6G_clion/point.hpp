//
// Created by kchipson on 20.12.2019.
//

#ifndef POINT_HPP
#define POINT_HPP

#include "figure.hpp"
#include <SFML/Graphics.hpp>
#include <cmath>
#include <cstdlib>

class Point : public Figure{
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
  Point(sf::RenderWindow* window, short int x = 0, short int y = 0);

  /* Методы */
public:
  void setX1(short int x = 0);
  void setY1(short int y = 0);
  void setPosition(short int x = 0, short int y = 0);

  void setSpeed(unsigned short int speed = 0);

  void setDirection(short int dx = 0, short int dy = 0);

  void setFillColor(unsigned short int R = 0, unsigned short int G = 0,
                    unsigned short int B = 0);


  void straightMove() override;
  void rotateMove(){} ;
  void draw() override;
};

#endif // POINT_HPP
