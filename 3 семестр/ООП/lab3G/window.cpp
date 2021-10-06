#include "window.hpp"

void Window::setWinSize(unsigned int x, unsigned int y) {
  winWidth = x;
  winHeight = y;
  return;
}

sf::Vector2u Window::getWinSize() {
  sf::Vector2u vector(winWidth, winHeight);
  return vector;
}

void Window::setWinBG(int r, int g, int b) {
  winBGColor = sf::Color(r, g, b);

  return;
}

sf::Color Window::getWinBG() { return winBGColor; }