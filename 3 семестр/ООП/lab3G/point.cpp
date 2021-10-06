#include "point.hpp"
#include <iostream>

Point::Point() {
  x = 0;
  y = 0;
  speed = rand() % 15 + 5;
  angle = rand() % 85 + 5;
  orientation_x = orientation_y = 1;
  if (rand() % 2)
    orientation = 1;
  else
    orientation = -1;

  color = sf::Color(rand() % 256, rand() % 256, rand() % 256);

  pixel.setSize(sf::Vector2f(10.f, 10.f)); // Размеры "пикселя"
  pixel.setFillColor(color);
  pixel.setPosition(x, y);
}

sf::RectangleShape Point::getPixel() { return pixel; }
 
void Point::setRandCoordinate(int winWidth, int winHeight) {
  x = rand() % (winWidth - int(pixel.getSize().x)) + pixel.getSize().x / 2;
  y = rand() % (winHeight - int(pixel.getSize().y / 2)) + pixel.getSize().y / 2;
}

void Point::rectilinearMotion(int winWidth, int winHeight) {
  x += orientation * speed;
  if (x < 0) {
    x = 0;
    orientation = 1;
  }
  if (x + pixel.getSize().x > winWidth) {
    x = winWidth - pixel.getSize().x;
    orientation = -1;
  }

  pixel.setPosition(x, y);
}

void Point::randomMotion(int winWidth, int winHeight) {
  x = x + orientation_x * cos(angle * M_PI / 180.0) * speed;
  y = y + orientation_y * sin(angle * M_PI / 180.0) * speed;

  if (x < 0) {
    x = 0;
    orientation_x = -orientation_x;
  } else if ((x + pixel.getSize().x) > winWidth) {
    x = winWidth - pixel.getSize().x;
    orientation_x = -orientation_x;
  }
  if (y < 0) {
    y = 0;
    orientation_y = -orientation_y;
  } else if ((y + pixel.getSize().y) > winHeight) {
    y = winHeight - pixel.getSize().y;
    orientation_y = -orientation_y;
  }

  pixel.setPosition(x, y);
}
