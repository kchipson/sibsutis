//
// Created by kchipson on 06.12.2019.
//

#ifndef ELLIPSE_HPP
#define ELLIPSE_HPP

#include <SFML/Graphics.hpp>
#include "circle.hpp"

class Ellipse: public Circle {
  /* Поля */
public:
  float scaleX;
  float scaleY;

private:
  sf::CircleShape ellipse;

  /* Конструктор */
public:
  Ellipse(){};
  Ellipse(sf::RenderWindow* window, short int x, short int y, short int radius);

  /* Методы */
public:
  void setScale(float x, float y);

  void draw();
  void straightMove();
  void rotateMove();

};

#endif // ELLIPSE_HPP
