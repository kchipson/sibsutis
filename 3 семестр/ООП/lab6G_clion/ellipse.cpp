//
// Created by kchipson on 20.12.2019.
//

#include "ellipse.hpp"

Ellipse::Ellipse():Circle(){
  scaleX = scaleY = 1;
}
Ellipse::Ellipse(sf::RenderWindow* window, short int x, short int y, short int radius):Circle(window, x, y, radius){
  scaleX = scaleY = 1;
}
void Ellipse::setScale(float x, float y){
  scaleX = x;
  scaleY = y;

}

void Ellipse::straightMove() {
  int windowWidth = window -> getSize().x;
  int windowHeight = window -> getSize().y;
  x1 += spd_x;
  y1 += spd_y;

  if (y1 - (float)radius * scaleY < 0) {
    this -> y1 = (float)radius * scaleY;
    this -> spd_y = abs(spd_y);
  }
  if (y1 + (float)radius * scaleY > (float)windowHeight) {
    this -> y1 = windowHeight - (float)radius * scaleY;
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

void Ellipse::rotateMove() {
  rotateAngle++;
  if (rotateAngle == 360) {
    rotateAngle = 0;
  }
}

void Ellipse::draw(){
  ellipse.setRotation((float)rotateAngle);
  ellipse.setRadius(radius);
  ellipse.setScale(scaleX, scaleY);
  ellipse.setOrigin(radius, radius);
  ellipse.setPosition(x1, y1);
  ellipse.setFillColor(fillColor);

  window -> draw(ellipse);
}