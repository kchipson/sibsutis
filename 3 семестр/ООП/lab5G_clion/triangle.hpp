//
// Created by kchipson on 20.12.2019.
//

#ifndef TRIANGLE_HPP
#define TRIANGLE_HPP

#include "ellipse.hpp"

class Triangle: public Ellipse {
  /* Поля */
public:
private:
  sf::CircleShape triangle;

  /* Конструктор */
public:
  Triangle();
  Triangle(sf::RenderWindow* window, short int x, short int y, short int radius);

  /* Методы */
public:
  void straightMove() override;
  void draw() override;
};

#endif // TRIANGLE_HPP