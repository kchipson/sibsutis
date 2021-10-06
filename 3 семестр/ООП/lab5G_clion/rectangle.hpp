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
  Rectangle(sf::RenderWindow* window, short int x1, short int y1, short int x2, short int y2);

  /* Методы */
public:
  void straightMove() override;
  void rotateMove() override;
  void draw() override;


};

#endif // RECTANGLE_HPP
