//
// Created by kchipson on 06.12.2019.
//
#include "circle.hpp"

Circle::Circle(sf::RenderWindow* window, short int x, short int y, short int radius){
  this -> window = window;
  this -> x1 = x;
  this -> y1 = y;
  this -> radius = radius;
  this -> spd_x =0;
  this -> spd_y = 0;
  this -> speed = 0;
  this -> fillColor = sf::Color(0, 0, 0);
  this -> circle.setOrigin(radius,radius);
}

/* Задает радиус круга */
void Circle::setRadius(unsigned short int radius){
  this -> radius = radius;
  circle.setRadius(this -> radius);
}


void Circle::draw(){
  this -> circle.setPosition(x1, y1);
  this -> circle.setRadius(radius);
  this -> circle.setFillColor(this->fillColor);
  this -> window -> draw(circle);
}

void Circle::straightMove() {

  short int windowWidth = window -> getSize().x;
  short int windowHeight = window -> getSize().y;
  x1 += this -> spd_x;
  y1 += this -> spd_y;

  if (((this -> y1) - radius) < 0) {
    this -> y1 = radius;
    this -> spd_y = abs(this -> spd_y);
  }
  if (((this -> y1) + radius) > windowHeight) {
    this -> y1 = windowHeight - radius;
    this -> spd_y = -abs(this -> spd_y);
  }
  if (((this -> x1) - radius) < 0) {
    this -> x1 = radius;
    this -> spd_x = abs(this -> spd_x);
  }
  if (((this -> x1) + radius) > windowWidth) {
    this -> x1 = windowWidth - radius;
    this -> spd_x = -abs(this -> spd_x);
  }
}


