//
// Created by kchipson on 20.12.2019.
//

#ifndef RHOMBUS_HPP
#define RHOMBUS_HPP

#include "ellipse.hpp"

class Rhombus: public Ellipse {
  /* Поля */
private:
  sf::CircleShape rhombus;

  /* Конструктор */
public:
  Rhombus();
  Rhombus(sf::RenderWindow* window, short int x, short int y, short int radius);

  /* Методы */
public:
  void draw() override;
};

#endif // RHOMBUS_HPP
