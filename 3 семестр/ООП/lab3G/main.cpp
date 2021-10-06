#include <iostream>
#include <SFML/Graphics.hpp>
#include <ctime>
#include <Windows.h>
#include "cstdlib"
#include <conio.h>
#include "point.hpp"
#include "window.hpp"

int main(int argc, char const *argv[]) {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  srand(time(NULL));

  const int numberOfPoints = 250;
  bool type = 0;

  Window *window = new Window;
  window->setWinBG(107, 128, 150);
  window->setWinSize(1366, 768);

  Point points[numberOfPoints];
  for (int i = 0; i < numberOfPoints; i++) {
    points[i].setRandCoordinate(window->getWinSize().x, window->getWinSize().y);
  }

  sf::RenderWindow windowBox(
      sf::VideoMode(window->getWinSize().x, window->getWinSize().y),
      L"ООП. Лабораторная работа #3", sf::Style::Fullscreen);

  while (windowBox.isOpen()) {
    sf::Event event;
    while (windowBox.pollEvent(event)) {
      if (event.type == sf::Event::Closed ||
          (event.type == sf::Event::KeyPressed &&
           event.key.code == sf::Keyboard::Escape))
        windowBox.close();

      if (event.type == sf::Event::KeyPressed &&
          event.key.code == sf::Keyboard::Space)
        type = !type;
    }

    windowBox.clear(window->getWinBG());
    if (type)
      for (int i = 0; i < numberOfPoints; i++) {
        points[i].randomMotion(window->getWinSize().x, window->getWinSize().y);
        windowBox.draw(points[i].getPixel());
      }
    else
      for (int i = 0; i < numberOfPoints; i++) {
        points[i].rectilinearMotion(window->getWinSize().x,
                                    window->getWinSize().y);
        windowBox.draw(points[i].getPixel());
      }
    windowBox.display();
    sf::sleep(sf::milliseconds(30));
  }

  return 0;
}