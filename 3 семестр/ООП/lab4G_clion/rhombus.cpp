//
// Created by kchipson on 11.12.2019.
//

#include "rhombus.hpp"

Rhombus::Rhombus(sf::RenderWindow* window, short int x, short int y, short int radius){
  this -> window = window;
  this -> x1 = x;
  this -> y1 = y;
  this -> radius = radius;
  this -> spd_x =0;
  this -> spd_y = 0;
  this -> speed = 0;
  this -> fillColor = sf::Color(0, 0, 0);
  rhombus.setPointCount(4);
  this -> rhombus.setOrigin(radius,radius);
}

void Rhombus::draw(){
  this -> rhombus.setPosition(x1, y1);
  this -> rhombus.setRadius(radius);
  this -> rhombus.setFillColor(this->fillColor);
  this -> window -> draw(rhombus);
}

void Rhombus::rotateMove() {
  rhombus.setRotation(rotateAngle);
  rotateAngle++;
  if (rotateAngle == 360) {
    rotateAngle = 0;
  }
}