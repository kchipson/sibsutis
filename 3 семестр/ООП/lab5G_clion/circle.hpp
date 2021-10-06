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
  Circle(sf::RenderWindow* window, short int x, short int y, unsigned short int radius);

  /* Методы */
public:

  void setRadius(unsigned short int radius);

  void straightMove() override;
  void draw() override;

};

#endif // CIRCLE_HPP
