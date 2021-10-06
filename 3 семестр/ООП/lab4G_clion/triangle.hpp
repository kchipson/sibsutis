//
// Created by kchipson on 11.12.2019.
//

#ifndef TRIANGLE_HPP
#define TRIANGLE_HPP

#include "circle.hpp"

class Triangle: public Circle {
  /* Поля */
public:
private:
  sf::CircleShape triangle;

  /* Конструктор */
public:
  Triangle(){};
  Triangle(sf::RenderWindow* window, short int x, short int y, short int radius);

  /* Методы */
public:
  void draw();
  void rotateMove();
};

#endif // TRIANGLE_HPP
