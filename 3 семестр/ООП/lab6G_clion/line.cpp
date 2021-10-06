//
// Created by kchipson on 20.12.2019.
//

#include "line.hpp"

Line::Line():Point() {
  this -> x2 = 0;
  this -> y2 = 0;

}
Line::Line(sf::RenderWindow *window, short int x1, short int y1, short int x2, short int y2): Point(window, x1, y1) {
  this -> x2 = x2;
  this -> y2 = y2;

}

/* Задает положение 2 точки линии по оси абсцисс [0 , winWidth] */
void Line::setX2(short int x) {
  ((x >= 0) && (x <= window -> getSize().x)) ? this -> x2 = x : this -> x2 = 0;
}

/* Задает положение 2 точки линии по оси ординат [0 , winWHeight] */
void Line::setY2(short int y) {
  ((y >= 0) && (y <= window -> getSize().y)) ? this -> y2 = y : this -> y2 = 0;
}

/* Задает положение линии на координатной оси */
void Line::setPosition(short int x1, short int y1, short int x2, short int y2) {
  setX1(x1);
  setX2(x2);
  setY1(y1);
  setY2(y2);
}


void Line::straightMove() {

  short int windowWidth = window -> getSize().x;
  short int windowHeight = window -> getSize().y;
  short int temp;

  x1 += spd_x;
  y1 += spd_y;
  x2 += spd_x;
  y2 += spd_y;

  if ( x1 < 0 || x2 < 0) {
    temp = abs(x1 - x2);
    if (x1 < 0){
      x1 = 0;
      x2 = temp;
    }
    else {
      x2 = 0;
      x1 = temp;
    }
    spd_x = abs(spd_x);
  }

  if (x1 > windowWidth || x2 > windowWidth) {
    temp = abs(x1 - x2);
    if (x1 > windowWidth){
      x1 = windowWidth;
      x2 = windowWidth - temp;
    }

    else {
      this->x2 = windowWidth;
      this->x1 = windowWidth - temp;
    }
    this -> spd_x = - abs(this -> spd_x);
  }
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
}


void Line::draw(){
  line[0].position =sf::Vector2f(this -> x1, this -> y1);
  line[0].color = fillColor;
  line[1].position =sf::Vector2f(this -> x2, this -> y2);
  line[1].color = fillColor;
  window -> draw(line, 2, sf::Lines);
}
