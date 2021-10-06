//
// Created by kchipson on 06.12.2019.
//

#include "ellipse.hpp"

Ellipse::Ellipse(sf::RenderWindow* window, short int x, short int y, short int radius){
  this -> window = window;
  this -> x1 = x;
  this -> y1 = y;
  this -> radius = radius;
  this -> scaleX = 1;
  this -> scaleY = 1;
  this -> spd_x =0;
  this -> spd_y = 0;
  this -> speed = 0;
  this -> fillColor = sf::Color(0, 0, 0);
  this -> ellipse.setOrigin(radius, radius);
}



void Ellipse::draw(){

  this -> ellipse.setPosition(x1, y1);
  this -> ellipse.setRadius(radius);
  this -> ellipse.setFillColor(this->fillColor);
  this -> ellipse.setScale(this->scaleX, this->scaleY);

  this -> window -> draw(ellipse);
}

void Ellipse::setScale(float x, float y){
  this -> scaleX = x;
  this -> scaleY = y;

}

void Ellipse::straightMove() {

  int windowWidth = window -> getSize().x;
  int windowHeight = window -> getSize().y;
  x1 += this -> spd_x;
  y1 += this -> spd_y;

  if ((this -> y1 - radius * scaleY) < 0) {
    this -> y1 = radius* scaleY;
    this -> spd_y = abs(this -> spd_y);
  }
  if (((this -> y1) + radius * scaleY) > windowHeight) {
    this -> y1 = windowHeight - radius * scaleY;
    this -> spd_y = -abs(this -> spd_y);
  }
  if ((this -> x1 - radius * scaleX) < 0) {
    this -> x1 = radius * scaleX;
    this -> spd_x = abs(this -> spd_x);
  }
  if (((this -> x1) + radius * scaleX) > windowWidth) {
    this -> x1 = windowWidth - radius * scaleX;
    this -> spd_x = -abs(this -> spd_x);
  }
}

void Ellipse::rotateMove() {
  ellipse.setRotation(rotateAngle);
  rotateAngle++;
  if (rotateAngle == 360) {
    rotateAngle = 0;
  }
}