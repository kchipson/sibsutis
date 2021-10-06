//
// Created by kchipson on 06.12.2019.
//
#include "line.hpp"

Line::Line(sf::RenderWindow *window, short int x1, short int y1, short int x2, short int y2):Point(window, x1, y1) {
//  this -> window = window;
//  this -> x1 = x1;
//  this -> y1 = y1;
  this -> x2 = x2;
  this -> y2 = y2;
//  this -> spd_x = 0;
//  this -> spd_y = 0;
//  this -> speed = 0;
//  this -> fillColor = sf::Color(0, 0, 0);
}

/* Задает положение 2 точки линии по оси абсцисс [0 , winWidth] */
void Line::setX2(short int x) {
  this -> x2 = x;
}

/* Задает положение 2 точки линии по оси ординат [0 , winWHeight] */
void Line::setY2(short int y) {
  this -> y2 = y;
}

/* Задает положение линии на координатной оси */
void Line::setPosition(short int x1, short int y1, short int x2, short int y2) {
  this -> x1 = x1;
  this -> y1 = y1;
  this -> x2 = x2;
  this -> y2 = y2;
}

void Line::draw(){


  line.setPointCount(4);
  line.setPoint(0, sf::Vector2f(this -> x1, this -> y1));
  line.setPoint(1, sf::Vector2f(this -> x2, this -> y2));
  line.setPoint(2, sf::Vector2f(this -> x2, this -> y2 + 1));
  line.setPoint(3, sf::Vector2f(this -> x1, this -> y1 + 1));
  line.setFillColor(this -> fillColor);
  this -> window -> draw(line);
}

void Line::straightMove() {

  short int windowWidth = window -> getSize().x;
  short int windowHeight = window -> getSize().y;
  int temp;
  x1 += this -> spd_x;
  y1 += this -> spd_y;
  x2 += this -> spd_x;
  y2 += this -> spd_y;
  if (((this -> y1) < 0) || ((this -> y2) < 0)) {
    temp = abs(y1 - y2);
    if ((this -> y1) < 0){
      this -> y1 = 0;
      this -> y2 = temp;
    }
    else {
      this->y2 = 0;
      this->y1 = temp;
    }
    this -> spd_y = abs(this -> spd_y);
  }
  if (((this -> y1) > windowHeight) || ((this -> y2) > windowHeight)){
    temp = abs(y1 - y2);
    if ((this -> y1) > windowHeight){
      this -> y1 = windowHeight;
      this -> y2 = windowHeight - temp;
    }
    else {
      this->y2 = windowHeight;
      this->y1 = windowHeight - temp;
    }
    this -> spd_y = -abs(this -> spd_y);
  }
  if (((this -> x1) < 0) || ((this -> x2) < 0)) {
    temp = abs(x1 - x2);
    if ((this -> x1) < 0){
      this -> x1 = 0;
      this -> x2 = temp;
    }
    else {
      this->x2 = 0;
      this->x1 = temp;
    }
    this -> spd_x = abs(this -> spd_x);
  }
  if (((this -> x1) > windowWidth) || ((this -> x2) > windowWidth)) {
    temp = abs(x1 - x2);
    if ((this -> x1) > windowWidth){
      this -> x1 = windowWidth;
      this -> x2 = windowWidth - temp;
    }
    else {
      this->x2 = windowWidth;
      this->x1 = windowWidth - temp;
    }
    this -> spd_x = - abs(this -> spd_x);
  }
}
