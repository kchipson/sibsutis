#include <SFML/Graphics.hpp>
#include <iostream>

void zoomViewAt(sf::Vector2i pixel, sf::RenderWindow &window, float zoom) {
  const sf::Vector2f beforeCoord{window.mapPixelToCoords(pixel)};
  sf::View view{window.getView()};
  view.zoom(zoom);
  window.setView(view);
  const sf::Vector2f afterCoord{window.mapPixelToCoords(pixel)};
  const sf::Vector2f offsetCoords{beforeCoord - afterCoord};
  view.move(offsetCoords);
  window.setView(view);
}

int main() {
  sf::RenderWindow window(sf::VideoMode(800, 600), "\"Zoom View At\" example",
                          sf::Style::Default);
  window.setFramerateLimit(60);
  sf::View view(window.getDefaultView());
  const float zoomAmount{1.1f}; // zoom by 10%

  sf::Texture texture;
  if (!texture.loadFromFile("ag80QzQ.png")) // feel free to download this image
                                            // from here:
                                            // http://i.imgur.com/ag80QzQ.png or
                                            // just use your own
  {
    std::cerr << "Could not load image.";
    return EXIT_FAILURE;
  }
  sf::Sprite sprite(texture);
  sprite.setScale({0.51f, 0.51f}); // fit default image into default window
                                   // size. you may need to adjust this if you
                                   // use a different image

  while (window.isOpen()) {
    sf::Event event;
    while (window.pollEvent(event)) {
      if (event.type == sf::Event::Closed ||
          event.type == sf::Event::KeyPressed &&
              event.key.code == sf::Keyboard::Escape)
        window.close();
      else if (event.type == sf::Event::KeyPressed) {
        if (event.key.code == sf::Keyboard::BackSpace) {
          view = window.getDefaultView();
          window.setView(view);
        }
      } else if (event.type == sf::Event::MouseWheelScrolled) {
        if (event.mouseWheelScroll.delta > 0)
          zoomViewAt({event.mouseWheelScroll.x, event.mouseWheelScroll.y},
                     window, (1.f / zoomAmount));
        else if (event.mouseWheelScroll.delta < 0)
          zoomViewAt({event.mouseWheelScroll.x, event.mouseWheelScroll.y},
                     window, zoomAmount);
      }
    }

    window.clear();
    window.draw(sprite);
    window.display();
  }

  return EXIT_SUCCESS;
}