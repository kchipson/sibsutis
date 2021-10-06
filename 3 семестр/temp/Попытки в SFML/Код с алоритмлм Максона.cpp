#include <SFML/Window.hpp>
#include <SFML/Graphics.hpp>
#include <cstdlib>
#include <cmath>
#include <windows.h>
#include <vector>
#include "treeproperties.hpp"
#include "treegraphics.hpp"

void zoomViewAt(sf::Vector2i pixel, sf::RenderWindow &window, sf::View &view,
                float zoom) {
  const sf::Vector2f beforeCoord{window.mapPixelToCoords(pixel)};
  view.zoom(zoom);
  window.setView(view);
  const sf::Vector2f afterCoord{window.mapPixelToCoords(pixel)};
  const sf::Vector2f offsetCoords{beforeCoord - afterCoord};
  view.move(offsetCoords);
  window.setView(view);
}
std::vector<sf::RectangleShape> rectangles;
std::vector<sf::Text> texts;
std::vector<sf::Vertex *> lines;
sf::Font font;

void positionAssignment(tree *p, int widthTree, int h, int w,
                        int heightBetweenElements, int y = 100,
                        int numerator = 1, int denominator = 2) {

  if (p != NULL) {
    /* Прямоугольник */
    sf::RectangleShape rectangle(sf::Vector2f(w, h));
    rectangle.setPosition((numerator)*widthTree / denominator - w / 2,
                          y - h / 2);
    rectangle.setFillColor(sf::Color(236, 192, 233, 255));
    rectangles.push_back(rectangle);
    /* ............. */

    /* Текст */
    char str[10];
    sf::Text text;
    text.setFont(font);
    int n = 30;
    text.setCharacterSize(n);
    text.setFillColor(sf::Color::Red);
    itoa(p->data, str, 10);
    text.setString(str);
    if ((p->data) < 10)
      text.setPosition((numerator)*widthTree / denominator - w / (n / 3),
                       y - h / 2);
    else if ((p->data) < 100)
      text.setPosition((numerator)*widthTree / denominator - w / (n / 5),
                       y - h / 2);
    else if ((p->data) < 1000)
      text.setPosition((numerator)*widthTree / denominator - w / (n / 6.66),
                       y - h / 2);
    else
      text.setPosition((numerator)*widthTree / denominator - w / 2, y - h / 2);
    texts.push_back(text);
    /* ..... */

    /* Левая линия */
    if (p->L != NULL) {
      sf::Vertex *line = new sf::Vertex[2];
      line[0] = sf::Vertex(sf::Vector2f(
          (numerator)*widthTree / denominator - w / 4, y + h / 2 + 1));
      line[1] = sf::Vertex(
          sf::Vector2f((numerator * 2 - 1) * widthTree / (denominator * 2),
                       y + heightBetweenElements + h / 2 - 1));
      line[0].color = sf::Color::Red;
      line[1].color = sf::Color::Red;
      lines.push_back(line);

      positionAssignment(p->L, widthTree, h, w, heightBetweenElements,
                         y + heightBetweenElements + h, numerator * 2 - 1,
                         denominator * 2);
    }
    /* ........... */

    /* Правая линия */
    if (p->R != NULL) {
      sf::Vertex *line = new sf::Vertex[2];
      line[0] = sf::Vertex(sf::Vector2f(
          (numerator)*widthTree / denominator + w / 4, y + h / 2 + 1));
      line[1] = sf::Vertex(
          sf::Vector2f((numerator * 2 + 1) * widthTree / (denominator * 2),
                       y + heightBetweenElements + h / 2 - 1));
      line[0].color = sf::Color::Red;
      line[1].color = sf::Color::Red;
      lines.push_back(line);

      positionAssignment(p->R, widthTree, h, w, heightBetweenElements,
                         y + heightBetweenElements + h, numerator * 2 + 1,
                         denominator * 2);
    }
    /* ............ */
  }
}
void draw(sf::RenderWindow &window) {
  int i = 0;
  for (i = 0; i < rectangles.size(); i++) {
    window.draw(rectangles[i]);
  }
  for (i = 0; i < texts.size(); i++) {
    window.draw(texts[i]);
  }
  for (i = 0; i < lines.size(); i++) {
    window.draw(lines[i], 2, sf::Lines);
  }
}

void treeGraphics(tree *p) {

  sf::RenderWindow window((sf::VideoMode::getFullscreenModes())[0], L"Дерево",
                          sf::Style::Fullscreen);

  font.loadFromFile("Banty Bold.ttf");
  window.setMouseCursorGrabbed(true);
  window.setFramerateLimit(60);
  window.requestFocus();

  int w = 120;
  int h = 40;
  int hbe = (w + w / 4) * pow(2, heightTree(p, 0) - 1) * 0.01;
  sf::View view(window.getDefaultView());

  view.move(((w + w / 4) * pow(2, heightTree(p, 0) - 1) - window.getSize().x) /
                2,
            0);              // уууууууу
  sf::View viewReset = view; // уууууууу
  window.setView(view);
  sf::Vector2f oldPos;
  bool moving = false;
  const float zoomAmount{1.3f}; // zoom by 30%

  positionAssignment(p, (w + w / 4) * pow(2, heightTree(p, 0) - 1), h, w, hbe);
  while (window.isOpen()) {
    sf::Event event;

    while (window.pollEvent(event)) {
      switch (event.type) {
      case sf::Event::Closed: // Событие закрытия
        window.close();
        break;
      case sf::Event::KeyPressed: // Нажатие клавиши
        switch (event.key.code) {
        case sf::Keyboard::Escape: // Esc
          window.close();
          break;
        case sf::Keyboard::Space: // Пробел
          view = viewReset;       // уууууууу
          window.setView(view);
          break;
        }
        break;
      case sf::Event::MouseWheelScrolled: // Скроллинг
        if (event.mouseWheelScroll.delta > 0)
          zoomViewAt({event.mouseWheelScroll.x, event.mouseWheelScroll.y},
                     window, view, (1.f / zoomAmount));
        else if (event.mouseWheelScroll.delta < 0)
          zoomViewAt({event.mouseWheelScroll.x, event.mouseWheelScroll.y},
                     window, view, zoomAmount);
        break;
      case sf::Event::MouseButtonPressed: // Нажатие кнопки мыши
        if (event.mouseButton.button == 0) { // ЛКМ
          moving = true;
          oldPos = window.mapPixelToCoords(
              sf::Vector2i(event.mouseButton.x, event.mouseButton.y));
        }
        break;
      case sf::Event::MouseButtonReleased: // Отпускание кнопки мыши
        if (event.mouseButton.button == 0) { // ЛКМ
          moving = false;
        }
        break;
      case sf::Event::MouseMoved: // Перемещение мыши
        if (moving) {
          //  Определение новой позиции в мировых координатах
          const sf::Vector2f newPos = window.mapPixelToCoords(
              sf::Vector2i(event.mouseMove.x, event.mouseMove.y));
          // Определение способа перемещения курсора
          // p.s Поменять местами для инвертирования
          const sf::Vector2f deltaPos = oldPos - newPos;

          // Перемещение камеры
          view.setCenter(view.getCenter() + deltaPos);
          // Обновление камеры
          window.setView(view);

          // Пересохранение позиции
          oldPos = window.mapPixelToCoords(
              sf::Vector2i(event.mouseMove.x, event.mouseMove.y));
        }
      }
    }
    window.clear(sf::Color(82, 82, 108, 255));
    draw(window);
    window.display();
  }
}
