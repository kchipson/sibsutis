//
// Created by kchipson on 20.12.2019.
//

#include "rectangle.hpp"

Rectangle::Rectangle():Line(){}

Rectangle::Rectangle(sf::RenderWindow* window, short int x1, short int y1, short int x2, short int y2):Line(window, x1, y1, x2, y2){}

int min(int q1, int q2){
  if (q1 <= q2)
    return q1;
  else
    return q2;
}

void Rectangle::straightMove() {

  short int windowWidth = window -> getSize().x;
  short int windowHeight = window -> getSize().y;
  short int temp;
  x1 += spd_x;
  y1 += spd_y;
  x2 += spd_x;
  y2 += spd_y;

  if ((x1 - abs(x1 - x2) / 2 < 0) || (x2 - abs(x1 - x2) / 2 < 0)) {
    temp = abs(x1 - x2);
    if (x1 - abs(x1-x2) / 2 < 0){
      x1 = abs(x1 - x2) / 2;
      x2 = temp + abs(x1 - x2) / 2;
    }
    else {
      x2 = abs(x1 - x2) / 2;
      x1 = temp + abs(x1 - x2) / 2;
    }
     spd_x = abs(spd_x);
  }
  if ((x1 - abs(x1 - x2) / 2 > windowWidth) || (x2 - abs(x1 - x2) / 2 > windowWidth)) {
    temp = abs(x1 - x2);
    if (x1 - abs(x2 - x1) / 2 > windowWidth){
      x1 = windowWidth + abs(x2 - x1) / 2;
      x2 = windowWidth - temp + abs(x2 - x1) / 2;
    }
    else {
      x2 = windowWidth + abs(x2 - x1) / 2;
      x1 = windowWidth - temp + abs(x2 - x1) / 2;
    }
    spd_x = - abs(spd_x);
  }

  if ((y1 - abs(y1 - y2) / 2 < 0) || (y2 - abs(y1 - y2) / 2 < 0)) {
    temp = abs(y1 - y2);
    if (y1 - abs(y1 - y2) / 2 < 0){
      y1 = abs(y1 - y2) / 2;
      y2 = temp + abs(y1 - y2) / 2;
    }
    else {
      y2 = abs(y1 - y2) / 2;
      y1 = temp + abs(y1 - y2) / 2;
    }
    spd_y = abs(spd_y);
  }
  if ((y1 - abs(y1 - y2) / 2 > windowHeight) || (y2 - abs(y1 - y2) / 2 > windowHeight)){
    temp = abs(y1 - y2);
    if (y1 - abs(y1 - y2) / 2 > windowHeight){
      y1 = windowHeight + abs(y1 - y2) / 2;
      y2 = windowHeight - temp + abs(y1 - y2) / 2;
    }
    else {
      y2 = windowHeight + abs(y1 - y2) / 2;
      y1 = windowHeight - temp + abs(y1 - y2) / 2;
    }
    spd_y = -abs(spd_y);
  }
}

void Rectangle::rotateMove() {
  rotateAngle++;
  if (rotateAngle == 360) {
    rotateAngle = 0;
  }
}

void Rectangle::draw(){
  rectangle.setRotation(rotateAngle);
  rectangle.setOrigin(abs(x1-x2)/2, abs(y1-y2)/2);
  rectangle.setPosition(min(x1,x2), min(y1,y2));
  rectangle.setSize(sf::Vector2f(abs(x2 - x1), abs(y2 - y1)));
  rectangle.setFillColor(fillColor);
  window -> draw(rectangle);
}