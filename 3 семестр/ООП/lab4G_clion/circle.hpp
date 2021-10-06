//
// Created by kchipson on 06.12.2019.
//

#ifndef CIRCLE_HPP
#define CIRCLE_HPP

#include <SFML/Graphics.hpp>
#include "point.hpp"

class Circle: public Point {
  /* Поля */
public:
  unsigned short int radius;

private:
  sf::CircleShape circle;

  /* Конструктор */
public:
  Circle(){};
  Circle(sf::RenderWindow* window, short int x, short int y, short int radius);

  /* Методы */
public:

  void setRadius(unsigned short int radius);
  void draw();
  void straightMove();

};

#endif // LAB4_CLION_CIRCLE_HPP
