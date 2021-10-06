//
// Created by kchipson on 20.12.2019.
//

#include "circle.hpp"

Circle::Circle():Point() {
  radius = 1;
}
Circle::Circle(sf::RenderWindow* window, short int x, short int y, unsigned short int radius):Point(window, x, y){
  this -> radius = radius;
}

/* Задает радиус круга */
void Circle::setRadius(unsigned short int radius){
  this -> radius = radius;
}

void Circle::straightMove() {
  short int windowWidth = window -> getSize().x;
  short int windowHeight = window -> getSize().y;
  x1 += spd_x;
  y1 += spd_y;

  if (x1 - radius < 0) {
    x1 = radius;
    spd_x = abs(spd_x);
  }
  if (x1 + radius > windowWidth) {
    x1 = windowWidth - radius;
    spd_x = -abs(spd_x);
  }
  if (y1 - radius < 0) {
    y1 = radius;
    spd_y = abs(spd_y);
  }
  if (y1 + radius > windowHeight) {
    y1 = windowHeight - radius;
    spd_y = -abs(spd_y);
  }
}

  void Circle::draw(){
  circle.setPosition(x1, y1);
  circle.setOrigin(sf::Vector2f(radius, radius));
  circle.setRadius(radius);
  circle.setFillColor(fillColor);
  window -> draw(circle);
}