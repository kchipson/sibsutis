//
// Created by kchipson on 11.12.2019.
//
#include "rectangle.hpp"

Rectangle::Rectangle(sf::RenderWindow* window, short int x1, short int y1, short int x2, short int y2){
  this -> window = window;
  this -> x1 = x1;
  this -> y1 = y1;
  this -> x2 = x2;
  this -> y2 = y2;
  this -> spd_x = 0;
  this -> spd_y = 0;
  this -> speed = 0;
  this -> fillColor = sf::Color(0, 0, 0);

}

int min(int q1, int q2){
  if (q1 <= q2)
    return q1;
  else
    return q2;
}
void Rectangle::draw(){

  this -> rectangle.setOrigin(abs(x1-x2)/2, abs(y1-y2)/2);
  this -> rectangle.setFillColor(this -> fillColor);
  this -> rectangle.setPosition(min(x1,x2), min(y1,y2));
  this -> rectangle.setSize(sf::Vector2f(abs(x2 - x1), abs(y2 - y1)));
  this -> window -> draw(rectangle);
}

void Rectangle::straightMove() {

  short int windowWidth = window -> getSize().x;
  short int windowHeight = window -> getSize().y;
  int temp;
  x1 += this -> spd_x;
  y1 += this -> spd_y;
  x2 += this -> spd_x;
  y2 += this -> spd_y;
  if (((this -> y1 - abs(y1-y2)/2) < 0) || ((this -> y2 - abs(y1-y2)/2) < 0)) {
    temp = abs(y1 - y2);
    if ((this -> y1 - abs(y1-y2)/2) < 0){
      this -> y1 = abs(y1-y2)/2;
      this -> y2 = temp + abs(y1-y2)/2;
    }
    else {
      this -> y2 = abs(y1-y2)/2;
      this -> y1 = temp + abs(y1-y2)/2;
    }
    this -> spd_y = abs(this -> spd_y);
  }
  if (((this -> y1 - abs(y1-y2)/2) > windowHeight) || ((this -> y2 - abs(y1-y2)/2)) > windowHeight){
    temp = abs(y1 - y2);
    if ((this -> y1 - abs(y1-y2)/2) > windowHeight){
      this -> y1 = windowHeight + abs(y1-y2)/2;
      this -> y2 = windowHeight - temp + abs(y1-y2)/2;
    }
    else {
      this -> y2 = windowHeight + abs(y1-y2)/2;
      this -> y1 = windowHeight - temp + abs(y1-y2)/2;
    }
    this -> spd_y = -abs(this -> spd_y);
  }
  if (((this -> x1 - abs(x1-x2)/2) < 0) || ((this -> x2 - abs(x1-x2)/2) < 0)) {
    temp = abs(x1 - x2);
    if ((this -> x1 - abs(x1-x2)/2) < 0){
      this -> x1 = abs(x1-x2)/2;
      this -> x2 = temp + abs(x1-x2)/2;
    }
    else {
      this -> x2 = abs(x1-x2)/2;
      this -> x1 = temp + abs(x1-x2)/2;
    }
    this -> spd_x = abs(this -> spd_x);
  }
  if (((this -> x1 - abs(x1-x2)/2) > windowWidth) || ((this -> x2 - abs(x1-x2)/2) > windowWidth)) {
    temp = abs(x1 - x2);
    if ((this -> x1 - abs(x2-x1)/2) > windowWidth){
      this -> x1 = windowWidth + abs(x2-x1)/2;
      this -> x2 = windowWidth - temp + abs(x2-x1)/2;
    }
    else {
      this -> x2 = windowWidth + abs(x2-x1)/2;
      this -> x1 = windowWidth - temp + abs(x2-x1)/2;
    }
    this -> spd_x = - abs(this -> spd_x);
  }
}

void Rectangle::rotateMove() {
  rectangle.setRotation(rotateAngle);

  rotateAngle++;
  if (rotateAngle == 360) {
    rotateAngle = 0;
  }
}