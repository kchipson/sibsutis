#ifndef POINT_HPP
#define POINT_HPP

#define _USE_MATH_DEFINES

#include <SFML/Graphics.hpp>
#include "cstdlib"
#include <cmath>
#include <iostream>

class Point {
  /* Поля */
private:
  short int x;
  short int y;

  short int orientation;
  short int orientation_x;
  short int orientation_y;


  short int speed;
  double angle;

  sf::Color color;
  sf::RectangleShape pixel;

  /* Конструктор */
public:
  Point();

  /* Методы */
public:
  sf::RectangleShape getPixel();
  void setRandCoordinate(int winWidth, int winHeight);

  void rectilinearMotion(int winWidth, int winHeight);
  void randomMotion(int winWidth, int winHeight);
};

#endif // POINT_HPP