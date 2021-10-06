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

void positionAssignment(tree *p, float x, float y) {
  // определяем прямоугольник размером 120x50
  float h = 50;
  float w = 120;
  if (p != NULL) {
    /* Прямоугольник */
    sf::RectangleShape rectangle(sf::Vector2f(w, h));
    rectangle.setPosition(x - w / 2, y - h / 2);
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
      text.setPosition(x - w / (n / 3), y - h / 2);
    else if ((p->data) < 100)
      text.setPosition(x - w / (n / 5), y - h / 2);
    else if ((p->data) < 1000)
      text.setPosition(x - w / (n / 6.66), y - h / 2);
    else
      text.setPosition(x - w / 2, y - h / 2);
    texts.push_back(text);
    /* ..... */

    /* Левая линия */
    int depth = heightTree(p, false);
    if (p->L != NULL) {
      sf::Vertex *line = new sf::Vertex[2];
      line[0] = sf::Vertex(sf::Vector2f(x - w / 4, y + h / 2+1));
      line[1] = sf::Vertex(
          sf::Vector2f(x - w / 2 * pow(2, depth) - w / 2, y + h * 2-1));
      line[0].color = sf::Color::Red;
      line[1].color = sf::Color::Red;
      lines.push_back(line);
      positionAssignment(p->L, x - w / 2 * pow(2, depth) - w / 2,
                         y + h *2 + h / 2);
    }
    /* ........... */

    /* Правая линия */
    if (p->R != NULL) {
      sf::Vertex *line = new sf::Vertex[2];
      line[0] = sf::Vertex(sf::Vector2f(x + w / 4, y + h / 2+1));
      line[1] = sf::Vertex(
          sf::Vector2f(x + w / 2 * pow(2, depth) + w / 2, y + h * 2-1));
      line[0].color = sf::Color::Red;
      line[1].color = sf::Color::Red;
      lines.push_back(line);
      positionAssignment(p->R, x + w / 2 * pow(2, depth) + w / 2,
                         y + h * 2 + h / 2);
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

  sf::View view(window.getDefaultView());

  sf::Vector2f oldPos;
  bool moving = false;
  const float zoomAmount{1.3f}; // zoom by 30%

  positionAssignment(p, window.getSize().x / 2, window.getSize().y / 20);
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
          view = window.getDefaultView();
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
