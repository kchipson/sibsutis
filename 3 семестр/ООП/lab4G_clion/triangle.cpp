//
// Created by kchipson on 11.12.2019.
//

#include "triangle.hpp"
Triangle::Triangle(sf::RenderWindow* window, short int x, short int y, short int radius){
  this -> window = window;
  this -> x1 = x;
  this -> y1 = y;
  this -> radius = radius;
  this -> spd_x =0;
  this -> spd_y = 0;
  this -> speed = 0;
  this -> fillColor = sf::Color(0, 0, 0);
  triangle.setPointCount(3);
}

void Triangle::draw(){
  this -> triangle.setOrigin(radius,radius);
  this -> triangle.setPosition(x1, y1);
  this -> triangle.setRadius(radius);
  this -> triangle.setFillColor(this->fillColor);
  this -> window -> draw(triangle);
}

void Triangle::rotateMove() {
  triangle.setRotation(rotateAngle);
  rotateAngle++;
  if (rotateAngle == 360) {
    rotateAngle = 0;
  }
}

#include "triangle.hpp"
