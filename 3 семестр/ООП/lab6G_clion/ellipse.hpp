//
// Created by kchipson on 20.12.2019.
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
  Ellipse();
  Ellipse(sf::RenderWindow* window, short int x = 0, short int y = 0, short int radius = 1);

  /* Методы */
public:
  void setScale(float x = 0, float y = 0);

  void straightMove() override;
  void rotateMove() override;
  void draw() override;

};

#endif // ELLIPSE_HPP