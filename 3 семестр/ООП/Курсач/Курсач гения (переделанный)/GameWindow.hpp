#ifndef GAMEWINDOW_HPP
#define GAMEWINDOW_HPP

#include <SFML/Graphics.hpp>
#include <iostream>

#include "WindowInterface.hpp"

#include "Board.hpp"
#include "Assets.hpp"
#include "GlobalVars.hpp"


enum gameEnum:uint8_t {playerPlacesShips,
                       computerPlacesShips,
                       playerShot,
                       computerShot,
                       playerEndGame,
                       computerEndGame
} ;

class GameWindow : public WindowInterface {
  /* Поля */
private:
  sf::Color  backgroundColor ;
  sf::Clock blinkTimer ;

  sf::Text moveText;
  sf::Text playersText[2] ;

  Board *playerBoard, *computerBoard ;

  gameEnum gameState ;  // состояние игры на данный момент

  /* Конструкторы и деструкторы */
public:
  GameWindow() ;
  ~GameWindow()  ;

  /* Методы */
private:
  void currentMoveText() ;
  void drawBoards(sf::RenderWindow &window) ;

  void MouseDrawShip(sf::RenderWindow &window) ;
  void setShipOnField(sf::Vector2i mousePosition) ;

  void placementShipsByComputer() ;

  int8_t playerMakeShot(sf::Vector2i mousePosition) ;
  int8_t computerMakeShot(sf::Clock &thinkingTimer) ;

  void checkSunkenShips() ; // Проверка затонувших
  bool isShipsCrossing(Ship &first, Ship &second) ; // Проверка на соприкосновение
  bool isEndgame() ;

public:
  int draw(sf::RenderWindow &window) override;
};

#endif // GAMEWINDOW_HPP
