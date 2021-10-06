//
// Created by kchipson on 20.12.2019.
//

#ifndef CIRCLE_HPP
#define CIRCLE_HPP

#include <SFML/Graphics.hpp>
#include "point.hpp"

class Circle: public Point {
  /* Поля */
public:
  short int radius;
private:
  sf::CircleShape circle;

  /* Конструктор */
public:
  Circle();
  Circle(sf::RenderWindow* window, short int x = 0, short int y = 0, unsigned short int radius = 1);

  /* Методы */
public:

  void setRadius(unsigned short int radius = 1);

  void straightMove();
  void draw() ;

};

#endif // CIRCLE_HPP
