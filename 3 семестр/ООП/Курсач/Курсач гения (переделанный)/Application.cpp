//
// Created by kchipson on 11.01.2020.
//

#include "Application.hpp"

enum stateEnum:int8_t {end = -1, winMain, winGame, winInfo} ;

void Application::run()
{
  sf::RenderWindow window (sf::VideoMode(1200, 600), "BattleShip", sf::Style::Close) ;
  window.setFramerateLimit(60) ;

  WindowInterface* currentWindow = nullptr ;

  int8_t gameState = winMain ;

  while (gameState != stateEnum::end)
  {
    switch (gameState)
    {
    case winMain:
      currentWindow = new MainWindow ;
      gameState =  currentWindow -> draw(window) ;
      delete currentWindow ;
      break;

    case winGame:
      currentWindow = new GameWindow ;
      gameState = currentWindow -> draw(window) ;
      delete currentWindow ;
      break;

    case winInfo:
      currentWindow = new InfoWindow ;
      gameState = currentWindow->draw(window) ;
      delete currentWindow ;
      break;

    default:
      gameState = stateEnum::end ;
      break;
    }
  }

  if (window.isOpen())
  {
    window.close() ;
  }
}
