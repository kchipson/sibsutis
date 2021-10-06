//
// Created by kchipson on 06.12.2019.
//

#ifndef LINE_HPP
#define LINE_HPP

#include <SFML/Graphics.hpp>
#include <cmath>

#include "point.hpp"


class Line: public Point {
  /* Поля */
protected:
  short int x2;
  short int y2;

private:
  sf::ConvexShape line;

  /* Конструктор */
public:
  Line(){};
  Line(sf::RenderWindow *window, short int x1, short int y1, short int x2, short int y2);

  /* Методы */
public:
  void setPosition(short int x1, short int y1, short int x2, short int y2);
  void setX2(short int x);
  void setY2(short int y);

  void draw();
  void straightMove();


};

#endif // LINE_HPP
