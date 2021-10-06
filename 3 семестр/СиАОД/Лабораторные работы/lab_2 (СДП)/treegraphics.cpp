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

void parameterProperties(tree *p, int screenWidth, int x, int y, int w, int h,
                         std::vector<sf::RectangleShape> &rectangles,
                         std::vector<sf::Text> &texts,
                         std::vector<sf::Vertex *> &lines, sf::Font &font,
                         int heightLevels) {
  screenWidth = screenWidth / 2;
  if (p != NULL) {
    /* Прямоугольник */
    sf::RectangleShape rectangle(sf::Vector2f(w, h));
    rectangle.setPosition(x, y);
    rectangle.setFillColor(sf::Color(236, 192, 233, 255));
    rectangles.push_back(rectangle);
    /* ............. */

    /* Текст */
    char str[10];
    sf::Text text;
    text.setFont(font);
    int n = w / 4;
    text.setCharacterSize(n);
    text.setFillColor(sf::Color::Red);
    itoa(p->data, str, 10);
    text.setString(str);
    if ((p->data) < 10)
      text.setPosition(x + w / (n / 15), y);
    else if ((p->data) < 100)
      text.setPosition(x + w / (n / 8), y);
    else if ((p->data) < 1000)
      text.setPosition(x + w / (n / 6), y);
    else
      text.setPosition(x + w / 2, y);
    texts.push_back(text);
    /* ..... */

    /* Левая линия */
    if (p->L != NULL) {

      sf::Vertex *line = new sf::Vertex[2];
      line[0] = sf::Vertex(sf::Vector2f(x + w / 4, y + h + 1));
      line[1] = sf::Vertex(sf::Vector2f(x + w / 2 - screenWidth,
                                        y + heightLevels - (h / 2) - 1));
      line[0].color = sf::Color::Red;
      line[1].color = sf::Color::Red;
      lines.push_back(line);

      parameterProperties(p->L, screenWidth, x - screenWidth,
                          y + heightLevels - (h / 2), w, h, rectangles, texts,
                          lines, font, heightLevels);
    }
    /* ........... */

    /* Правая линия */
    if (p->R != NULL) {

      sf::Vertex *line = new sf::Vertex[2];
      line[0] = sf::Vertex(sf::Vector2f(x + w * 3 / 4, y + h + 1));
      line[1] = sf::Vertex(sf::Vector2f(x + w / 2 + screenWidth,
                                        y + heightLevels - (h / 2) - 1));
      line[0].color = sf::Color::Red;
      line[1].color = sf::Color::Red;
      lines.push_back(line);
      parameterProperties(p->R, screenWidth, x + screenWidth,
                          y + heightLevels - (h / 2), w, h, rectangles, texts,
                          lines, font, heightLevels);
    }
    /* ............ */
  }
}
void draw(sf::RenderWindow &window, std::vector<sf::RectangleShape> rectangles,
          std::vector<sf::Text> texts, std::vector<sf::Vertex *> lines) {
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

void treeGraphics(tree *p, unsigned int heightLevels, float zoomAmount,
                  float sizeBlock) {
  //Фигуры
  std::vector<sf::RectangleShape> rectangles;
  unsigned int wBlock = 120 * sizeBlock; // ширина rectangle
  unsigned int hBlock = 40 * sizeBlock;  // высота rectangle
  unsigned int screenWidth = wBlock * 1.5 * (pow(2, heightTree(p, 0) - 1));
  std::vector<sf::Text> texts;
  std::vector<sf::Vertex *> lines;

  //Шрифт
  sf::Font font;
  font.loadFromFile("Banty Bold.ttf");

  //Окно
  sf::RenderWindow window((sf::VideoMode::getFullscreenModes())[0], L"Дерево",
                          sf::Style::Default);
  window.setFramerateLimit(60);
  window.requestFocus();

  parameterProperties(p, screenWidth / 2, (window.getSize().x - wBlock) / 2,
                      window.getSize().y / 10 - hBlock / 2, wBlock, hBlock,
                      rectangles, texts, lines, font, heightLevels);
  //Камера
  sf::View view(window.getDefaultView());

  window.setView(view);

  //Позиция камеры
  sf::Vector2f oldPos;

  //Движение мыши
  bool moving = false;

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
    draw(window, rectangles, texts, lines);
    window.display();
  }
}
