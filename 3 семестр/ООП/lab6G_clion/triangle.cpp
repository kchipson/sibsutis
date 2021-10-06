//
// Created by kchipson on 20.12.2019.
//

#include "triangle.hpp"


Triangle::Triangle():Ellipse(){
  triangle.setPointCount(3);
}

Triangle::Triangle(sf::RenderWindow* window, short int x, short int y, short int radius):Ellipse(window, x, y, radius){
  triangle.setPointCount(3);
}

void Triangle::straightMove() {
  int windowWidth = window -> getSize().x;
  int windowHeight = window -> getSize().y;
  x1 += spd_x;
  y1 += spd_y;

  if (y1 - (float)radius * scaleY < 0) {
    this -> y1 = (float)radius * scaleY;
    this -> spd_y = abs(spd_y);
  }
  if (y1 + (float)radius * scaleY - (float)radius * scaleY / 2 > (float)windowHeight) {
    this -> y1 = windowHeight - (float)radius * scaleY + (float)radius * scaleY / 2 ;
    this -> spd_y = -abs(spd_y);
  }
  if (x1 - (float)radius * scaleX < 0) {
    this -> x1 = (float)radius * scaleX;
    this -> spd_x = abs(spd_x);
  }
  if (x1 + (float)radius * scaleX > (float)windowWidth) {
    this -> x1 = windowWidth - (float)radius * scaleX;
    this -> spd_x = -abs(spd_x);
  }
}


void Triangle::draw(){
  triangle.setOrigin(sf::Vector2f(radius, radius));
  triangle.setRotation(rotateAngle);
  triangle.setScale(scaleX,scaleY);
  triangle.setPosition(x1, y1);
  triangle.setRadius(radius);
  triangle.setFillColor(fillColor);
  window -> draw(triangle);
}