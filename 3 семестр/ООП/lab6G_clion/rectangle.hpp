//
// Created by kchipson on 20.12.2019.
//

#ifndef RECTANGLE_HPP
#define RECTANGLE_HPP

#include "line.hpp"
class Rectangle: public Line {
private:
  sf::RectangleShape rectangle;

  /* Конструктор */
public:
  Rectangle();
  Rectangle(sf::RenderWindow* window, short int x1 = 0, short int y1 = 0, short int x2 = 0, short int y2 = 0);

  /* Методы */
public:
  void straightMove() override;
  void rotateMove() override;
  void draw() override;


};

#endif // RECTANGLE_HPP
