#include <SFML/Graphics.hpp>

int main() {
  // Let setup a window
  sf::RenderWindow window(sf::VideoMode(640, 480), "SFML View Transformation");

  // Create something simple to draw
  sf::Texture texture;
  texture.loadFromFile("background.jpg");
  sf::Sprite background(texture);

  sf::Vector2f oldPos;
  bool moving = false;

  float zoom = 1;

  // Retrieve the window default view
  sf::View view = window.getDefaultView();

  while (window.isOpen()) {
    sf::Event event;
    while (window.pollEvent(event)) {
      switch (event.type) {
      case sf::Event::Closed:
        window.close();
        break;
      case sf::Event::MouseButtonPressed:
        // Mouse button is pressed, get the position and set moving as active
        if (event.mouseButton.button == 0) {
          moving = true;
          oldPos = window.mapPixelToCoords(
              sf::Vector2i(event.mouseButton.x, event.mouseButton.y));
        }
        break;
      case sf::Event::MouseButtonReleased:
        // Mouse button is released, no longer move
        if (event.mouseButton.button == 0) {
          moving = false;
        }
        break;
      case sf::Event::MouseMoved: {
        // Ignore mouse movement unless a button is pressed (see above)
        if (!moving)
          break;
        // Determine the new position in world coordinates
        const sf::Vector2f newPos = window.mapPixelToCoords(
            sf::Vector2i(event.mouseMove.x, event.mouseMove.y));
        // Determine how the cursor has moved
        // Swap these to invert the movement direction
        const sf::Vector2f deltaPos = oldPos - newPos;

        // Move our view accordingly and update the window
        view.setCenter(view.getCenter() + deltaPos);
        window.setView(view);

        // Save the new position as the old one
        // We're recalculating this, since we've changed the view
        oldPos = window.mapPixelToCoords(
            sf::Vector2i(event.mouseMove.x, event.mouseMove.y));
        break;
      }
      case sf::Event::MouseWheelScrolled:
        // Ignore the mouse wheel unless we're not moving
        if (moving)
          break;

        // Determine the scroll direction and adjust the zoom level
        // Again, you can swap these to invert the direction
        if (event.mouseWheelScroll.delta <= -1)
          zoom = std::min(2.f, zoom + .1f);
        else if (event.mouseWheelScroll.delta >= 1)
          zoom = std::max(.5f, zoom - .1f);

        // Update our view
        view.setSize(window.getDefaultView().getSize()); // Reset the size
        view.zoom(zoom); // Apply the zoom level (this transforms the view)
        window.setView(view);
        break;
      }
    }

    // Draw our simple scene
    window.clear(sf::Color::White);
    window.draw(background);
    window.display();
  }
}