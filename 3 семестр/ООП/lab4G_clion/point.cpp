//
// Created by kchipson on 17.10.2019.
//
#include "point.hpp"

Point::Point(sf::RenderWindow* window, short int x, short int y){
  this -> window = window;
  this -> x1 = x;
  this -> y1 = y;
  this -> spd_x =0;
  this -> spd_y = 0;
  this -> speed = 0;
  this -> fillColor = sf::Color(0, 0, 0);
}

/* Задает положение точки по оси абсцисс [0 , winWidth] */
void Point::setX1(short int x) {this -> x1 = x; }

/* Задает положение точки по оси ординат [0 , winWHeight] */
void Point::setY1(short int y) { this -> y1 = y; }

/* Задает положение точки на координатной оси */
void Point::setPosition(short int x, short int y) {
  this -> x1 = x;
  this -> y1 = y;
}


/* Задает направление */
void Point::setDirection(short int dx, short int dy) {
  this -> spd_x = dx * speed;
  this -> spd_y = dy * speed;
}
/* Задает скорость движения [0 , ..) */
void Point::setSpeed(unsigned short int speed) {
  (speed >= 0) ? this -> speed = speed : this -> speed = 0;
}

/* Задает цвет точки в фомате RGB */
void Point::setFillColor(unsigned short int R, unsigned short int G,
                         unsigned short int B) {
  this -> fillColor = sf::Color(R, G, B);

}

void Point::draw(){
  this -> point.position = sf::Vector2f(this -> x1, this -> y1);
  this -> point.color = this->fillColor;
  this -> window -> draw(&point, 1, sf::Points);
}

void Point::straightMove() {

  short int windowWidth = window -> getSize().x;
  short int windowHeight = window -> getSize().y;
  x1 += this -> spd_x;
  y1 += this -> spd_y;

  if ((this -> y1) < 0) {
    this -> y1 = 0;
    this -> spd_y = std::abs(this -> spd_y);
  }
  if ((this -> y1) > windowHeight) {
    this -> y1 = windowHeight;
    this -> spd_y = -std::abs(this -> spd_y);
  }
  if ((this -> x1) < 0) {
    this -> x1 = 0;
    this -> spd_x = std::abs(this -> spd_x);
  }
  if ((this -> x1) > windowWidth) {
    this -> x1 = windowWidth;
    this -> spd_x = -std::abs(this -> spd_x);
  }
}

void Point::rotateMove() {
}