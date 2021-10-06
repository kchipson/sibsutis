//
// Created by kchipson on 20.12.2019.
//

#include "rhombus.hpp"

Rhombus::Rhombus():Ellipse(){
  rhombus.setPointCount(4);
}

Rhombus::Rhombus(sf::RenderWindow* window, short int x, short int y, short int radius):Ellipse(window, x, y, radius){
  rhombus.setPointCount(4);
}


void Rhombus::draw(){
  rhombus.setOrigin(sf::Vector2f(radius, radius));
  rhombus.setRotation(rotateAngle);
  rhombus.setScale(scaleX,scaleY);
  rhombus.setPosition(x1, y1);
  rhombus.setRadius(radius);
  rhombus.setFillColor(fillColor);
  window -> draw(rhombus);
}