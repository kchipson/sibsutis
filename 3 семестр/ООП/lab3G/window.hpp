#ifndef WINDOW_HPP
#define WINDOW_HPP

#include <SFML/Graphics.hpp>

class Window {
  /* Поля */
private:
  unsigned int winWidth;
  unsigned int winHeight;
  sf::Color winBGColor;

  /* Методы */
public:
  void setWinSize(unsigned int x, unsigned int y);
  sf::Vector2u getWinSize();
  void setWinBG(int r, int g, int b);
  sf::Color getWinBG();
};

#endif // POINT_HPP