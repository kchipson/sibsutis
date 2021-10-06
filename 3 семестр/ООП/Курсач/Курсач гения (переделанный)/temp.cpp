//
// Created by kchipson on 11.01.2020.
//

#include "GameWindow.hpp"
#define BLINK_PERIOD 1.f

static uint8_t currentShip = 0 ; // Текущий корабль (Используется при заполнении массива кораблей)
static shipOrientationEnum currentShipOrientation = h ; // Текущий положение корабля (Используется при заполнении массива кораблей)

extern bool debug ;
extern uint8_t gameDifficulty ;

GameWindow::GameWindow()
{
  backgroundColor = sf::Color(107,109,232) ;

  gameTimeText.setFont(Assets::Instance().fontIron) ;
  gameTimeText.setCharacterSize(50) ;
  gameTimeText.setPosition(500, 520) ;

  for (sf::Text &text : playersText)
  {
    text.setFont(Assets::Instance().fontIron) ;
    text.setFillColor(sf::Color::White) ;
    text.setOutlineColor(sf::Color::Red) ;
    text.setOutlineThickness(0.f) ;
    text.setCharacterSize(50) ;
  }
  playersText[0].setString(L"Поле игрока") ;
  playersText[0].setPosition(135, 30) ;
  playersText[1].setString(L"Поле компьютера") ;
  playersText[1].setPosition(695, 30) ;

  playerBoard = new Board() ;
  computerBoard = new Board() ;
}
GameWindow::~GameWindow()
{
  delete playerBoard ;
  playerBoard = nullptr ;
  delete computerBoard ;
  computerBoard = nullptr ;
}


void GameWindow::playersTextColor() // TODO: как работает?
{
  float timer = blinkTimer.getElapsedTime().asSeconds() ;
  if (timer >= BLINK_PERIOD)
    blinkTimer.restart() ;
  sf::Color color(sf::Color::Red) ;

  if (gameState == playerShot)
  {
    playersText[0].setOutlineThickness(5.f) ;
    playersText[1].setOutlineThickness(0.f) ;
    color.a = (255 * timer / BLINK_PERIOD) ;
    playersText[0].setOutlineColor(color) ;
  }

  if (gameState == computerShot)
  {
    playersText[0].setOutlineThickness(0.f) ;
    playersText[1].setOutlineThickness(5.f) ;
    color.a = (255 * timer / BLINK_PERIOD) ;
    playersText[1].setOutlineColor(color) ;
  }
}

void GameWindow::drawBoards(sf::RenderWindow &window)
{
  for (uint8_t x = 0 ; x < playerBoard->getSize() ; x++)
    for (uint8_t y = 0 ; y < playerBoard->getSize() ; y++){
      playerBoard->getGrid()[x][y].setSprite(playerBoard->getGrid()[x][y].getState()) ;
      playerBoard->getGrid()[x][y].getSprite().setPosition(100 + 40 * x, 100 + 40 * y) ;
      window.draw(playerBoard->getGrid()[x][y].getSprite()) ;
    }

  for (uint8_t x = 0 ; x < computerBoard->getSize() ; x++)
    for (uint8_t y = 0 ; y < computerBoard->getSize() ; y++)
    {
      if (computerBoard->getGrid()[x][y].getState() == ship)
      {
        if (GlobalVars::Instance().debug)
          computerBoard->getGrid()[x][y].setSprite(ship) ;
        else
          computerBoard->getGrid()[x][y].setSprite(empty) ;
      }
      else
        computerBoard->getGrid()[x][y].setSprite(computerBoard->getGrid()[x][y].getState()) ;

      computerBoard->getGrid()[x][y].getSprite().setPosition(700 + 40 * x, 100 + 40 * y) ;
      window.draw(computerBoard->getGrid()[x][y].getSprite()) ;
    }

}

void GameWindow::MouseDrawShip(sf::RenderWindow &window)
{
  sf::Sprite shipSprite(Assets::Instance().shipDeskTexture) ;
  sf::Vector2i mousePosition = sf::Mouse::getPosition(window) ;
  shipSprite.setOrigin(20, 20) ;
  if (currentShip == 0)
  {
    shipSprite.setTextureRect(sf::IntRect(240, 0, 160, 40)) ;
    playerBoard->getShips()[currentShip].setSize(4) ;
  }
  if (1 <= currentShip and currentShip <= 2)
  {
    shipSprite.setTextureRect(sf::IntRect(120, 0, 120, 40)) ;
    playerBoard->getShips()[currentShip].setSize(3) ;
  }
  if (3 <= currentShip and currentShip <= 5)
  {
    shipSprite.setTextureRect(sf::IntRect(40, 0, 80, 40)) ;
    playerBoard->getShips()[currentShip].setSize(2) ;
  }
  if (6 <= currentShip and currentShip <= 9)
  {
    shipSprite.setTextureRect(sf::IntRect(0, 0, 40, 40)) ;
    playerBoard->getShips()[currentShip].setSize(1) ;
  }

  shipSprite.setPosition((sf::Vector2f) mousePosition) ;
  shipSprite.setRotation(currentShipOrientation == v ? 90 : 0) ;

  window.draw(shipSprite) ;
}

void GameWindow::setShipOnField(sf::Vector2i mousePosition) //TODO ВЕРНУЦА
{
  for (uint8_t x = 0 ; x < playerBoard->getSize() ; x++)
  {
    for (uint8_t y = 0 ; y < playerBoard->getSize() ; y++)
    {
      if (sf::IntRect(playerBoard->getGrid()[x][y].getSprite().getGlobalBounds()).contains(mousePosition))
      {
        playerBoard->getShips()[currentShip].setOrientation(currentShipOrientation) ;
        playerBoard->getShips()[currentShip].setCoordinates(x, y) ;

        if ((currentShipOrientation == h &&
             x + playerBoard->getShips()[currentShip].getSize() > playerBoard->getSize())
            or
            (currentShipOrientation == v &&
             y + playerBoard->getShips()[currentShip].getSize() > playerBoard->getSize()))
          return ; // Если корабль выходит за границу сетки

        for (uint8_t count = 0 ; count < currentShip ; count++)
          if (isShipsCrossing(playerBoard->getShips()[count], playerBoard->getShips()[currentShip]))
            return ; // Если корабль (соприкасается с др.кораблем | пересекает др. корабль)

        if (currentShipOrientation == h)
        {
          for (uint8_t tmp = x; tmp < x + playerBoard->getShips()[currentShip].getSize() ; tmp++)
          {
            playerBoard->getGrid()[tmp][y].setState(cellEnum::ship) ;
          }
        }
        else
        {
          for (uint8_t tmp = y; tmp < y + playerBoard->getShips()[currentShip].getSize() ; tmp++)
          {
            playerBoard->getGrid()[x][tmp].setState(cellEnum::ship) ;
          }
        }
        currentShip++ ;

        if (currentShip == 10)
        {
          gameState = computerPlacesShips ;
          currentShip = 0 ;
        }
        return ;
      }
    }
  }
}

void GameWindow::placementShipsByComputer()
{
  for (uint8_t i = 0 ; i < 10 ; i++)
  {
    if (i == 0)
      computerBoard->getShips()[i].setSize(4) ;
    else if (1 <= i and i <= 2)
      computerBoard->getShips()[i].setSize(3) ;
    else if (3 <= i and i <= 5)
      computerBoard->getShips()[i].setSize(2) ;
    else
      computerBoard->getShips()[i].setSize(1) ;

    uint8_t x = 0, y = 0 ;
    bool generated = false ;
    do
    {
      x = rand() % 10 ;
      y = rand() % 10 ;
      if (rand() % 2)
        computerBoard->getShips()[i].changeOrientation() ;


      if ((computerBoard->getShips()[i].getOrientation() == h) and (x + computerBoard->getShips()[i].getSize() <= computerBoard->getSize())
                                                                   or
                                                                   (computerBoard->getShips()[i].getOrientation() == v) and (y + computerBoard->getShips()[i].getSize() <= computerBoard->getSize()))
      {
        computerBoard->getShips()[i].setCoordinates(x, y) ;
        bool correct = true ;
        for (uint8_t ship = 0 ; ship < i ; ship++)
          if (isShipsCrossing(computerBoard->getShips()[ship], computerBoard->getShips()[i]))
          {
            correct = false ;
            break ;
          }
        if (correct)
        {
          if(computerBoard->getShips()[i].getOrientation() == h)
          {
            for (uint8_t p_x = x ; p_x < x + computerBoard->getShips()[i].getSize() ; p_x++)
              computerBoard->getGrid()[p_x][y].setState(cellEnum::ship) ;
          }
          else
          {
            for (uint8_t p_y = y ; p_y < y + computerBoard->getShips()[i].getSize() ; p_y++)
              computerBoard->getGrid()[x][p_y].setState(cellEnum::ship) ;
          }
          generated = true ;
        }
      }

    } while (!generated);
  }
}

int8_t GameWindow::playerMakeShot(sf::Vector2i mousePosition)
{
  for (uint8_t x = 0 ; x < 10 ; x++)
  {
    for (uint8_t y = 0 ; y < 10 ; y++)
    {
      if (sf::IntRect(computerBoard->getGrid()[x][y].getSprite().getGlobalBounds()).contains(mousePosition))
      {
        if (computerBoard->getGrid()[x][y].getState() == empty)
        {
          computerBoard->getGrid()[x][y].setState(cellEnum::miss) ;
          return 0 ;
        }
        else if (computerBoard->getGrid()[x][y].getState() == ship)
        {
          for (uint8_t ship = 0 ; ship < 10 ; ship++)
            if (computerBoard->getShips()[ship].hasCoordinates(x, y))
            {
              computerBoard->getShips()[ship].setSinkingPart(x, y) ;
              break ;
            }
          computerBoard->getGrid()[x][y].setState(cellEnum::hit) ;
          return 1 ;
        }
        else
          return -1 ;
      }
    }
  }
  return -1 ;
}
int8_t GameWindow::computerMakeShot(sf::Clock &thinkingTimer) // TODO: Верный ли?
{
  static Ship *focusShip = nullptr ;
  float waitTime ;

  if (GlobalVars::Instance().debug)
    waitTime = 0.0f ;
  else
    waitTime = 2.0f ;

  if (thinkingTimer.getElapsedTime().asSeconds() < waitTime)
    return -1 ;
  uint8_t x = 0, y = 0 ;

  bool lucky ;
  if (GlobalVars::Instance().gameDifficulty == 0)
    lucky = true ;
  else if (GlobalVars::Instance().gameDifficulty == 1)
    lucky = rand() % 2 ;
  else if (GlobalVars::Instance().gameDifficulty == 2)
    lucky = false ;

  if (focusShip != nullptr)
  {
    int8_t shootIndex = focusShip->findUnSunkenPart() ;
    if (shootIndex >= 0)
    {
      coordinates *pos = focusShip->getCoordinates() ;
      uint8_t p_x = pos[shootIndex].x ;
      uint8_t p_y = pos[shootIndex].y ;

      if (lucky)
      {
        if (focusShip->getOrientation() == h)
          (p_y < 5) ?  p_y += 1:  p_y -= 1 ;
        else
          (p_x < 5) ?  p_x += 1:  p_x -= 1 ;
      }

      focusShip->setSinkingPart(p_x, p_y) ;
      if (playerBoard->getGrid()[p_x][p_y].getState() == ship)
        playerBoard->getGrid()[p_x][p_y].setState(cellEnum::hit) ;
      else
        playerBoard->getGrid()[p_x][p_y].setState(cellEnum::miss) ;
      thinkingTimer.restart() ;
    }
    else
      focusShip = nullptr ;

    if (!lucky)
      return 1 ;
    else
      return 0 ;
  }

  do
  {
    x = rand() % 10 ;
    y = rand() % 10 ;
    if (playerBoard->getGrid()[x][y].getState() == empty)
    {
      playerBoard->getGrid()[x][y].setState(cellEnum::miss) ;
      thinkingTimer.restart() ;
      return 0 ;
    }
    else if (playerBoard->getGrid()[x][y].getState() == ship)
    {
      for (uint8_t i = 0 ; i < 10 ; i++)
      {
        if (playerBoard->getShips()[i].hasCoordinates(x, y))
        {
          playerBoard->getShips()[i].setSinkingPart(x, y) ;
          if (!playerBoard->getShips()[i].isSunken() and (focusShip == nullptr))
            focusShip = &playerBoard->getShips()[i] ;
          break ;
        }
      }
      playerBoard->getGrid()[x][y].setState(cellEnum::hit) ;
      thinkingTimer.restart() ;
      return 1 ;
    }
  } while (true) ;
}

void GameWindow::checkSunkenShips()
{
  coordinates *pos = nullptr ;
  coordinates check[8] ;
  for (uint8_t i = 0 ; i < 10 ; i++)
  {
    if (playerBoard->getShips()[i].isSunken())
    {
      pos = playerBoard->getShips()[i].getCoordinates() ;
      for (uint8_t partShip = 0 ; partShip < playerBoard->getShips()[i].getSize() ; partShip++)
      {
        for (coordinates &f : check)
          f = pos[partShip] ;
        check[0].x -= 1 ; // л (по час)
        check[1].x -= 1 ; check[1].y -= 1 ;
        check[2].y -= 1 ;
        check[3].x += 1 ; check[3].y -= 1 ;
        check[4].x += 1 ;
        check[5].x += 1 ; check[5].y += 1 ;
        check[6].y += 1 ;
        check[7].x -= 1 ; check[7].y += 1 ;

        for (coordinates &f : check)
          if(((f.x > -1) and (f.x < computerBoard->getSize())) and ((f.y > -1) and (f.y < computerBoard->getSize())) and (playerBoard->getGrid()[f.x][f.y].getState() == cellEnum::empty))
            playerBoard->getGrid()[f.x][f.y].setState(cellEnum::miss) ;
        playerBoard->getGrid()[pos[partShip].x][pos[partShip].y].setState(cellEnum::kill) ;
      }
    }
    if (computerBoard->getShips()[i].isSunken())
    {
      pos = computerBoard->getShips()[i].getCoordinates() ;
      for (uint8_t partShip = 0 ; partShip < computerBoard->getShips()[i].getSize() ; partShip++)
      {
        for (coordinates &f : check)
          f = pos[partShip] ;
        check[0].x -= 1 ; // л (по час)
        check[1].x -= 1 ; check[1].y -= 1 ;
        check[2].y -= 1 ;
        check[3].x += 1 ; check[3].y -= 1 ;
        check[4].x += 1 ;
        check[5].x += 1 ; check[5].y += 1 ;
        check[6].y += 1 ;
        check[7].x -= 1 ; check[7].y += 1 ;

        for (coordinates &f : check)
          if(((f.x > -1) and (f.x < computerBoard->getSize())) and ((f.y > -1) and (f.y < computerBoard->getSize())) and (computerBoard->getGrid()[f.x][f.y].getState() == cellEnum::empty))
            computerBoard->getGrid()[f.x][f.y].setState(cellEnum::miss) ;
        computerBoard->getGrid()[pos[partShip].x][pos[partShip].y].setState(cellEnum::kill) ;
      }
    }
  }
  pos = nullptr ;
}

bool GameWindow::isShipsCrossing(Ship &first, Ship &second)
{
  coordinates *pos ;
  pos = second.getCoordinates() ;

  // Пересечение кораблей
  for (uint8_t z = 0 ; z < second.getSize() ; z++)
    if (first.hasCoordinates(pos[z].x, pos[z].y))
      return true ;

  // Соприкосновение кораблей
  coordinates check[8] ;
  for (uint8_t z = 0 ; z < second.getSize() ; z++)
  {
    for (coordinates &f : check)
      f = pos[z] ;

    check[0].x -= 1 ; // л (по час)
    check[1].x -= 1 ; check[1].y -= 1 ;
    check[2].y -= 1 ;
    check[3].x += 1 ; check[3].y -= 1 ;
    check[4].x += 1 ;
    check[5].x += 1 ; check[5].y += 1 ;
    check[6].y += 1 ;
    check[7].x -= 1 ; check[7].y += 1 ;

    for (coordinates &ch : check)
      if (first.hasCoordinates(ch.x, ch.y))
        return true ;
  }

  pos = nullptr ;
  return false ;
}

bool GameWindow::isEndgame()
{
  for (uint8_t x = 0 ; x < 10 ; x++)
  {
    if (!playerBoard->getShips()[x].isSunken())
      return false ;
    if (!computerBoard->getShips()[x].isSunken())
      return false ;
  }

  return true ;
}



int GameWindow::draw(sf::RenderWindow &window)
{
  window.setTitle("BattleShip | Game") ;
  currentShip = 0 ;
  currentShipOrientation = h ;

  std::ostringstream gameTimeString ;
  sf::Clock gameTime;
  sf::Clock thinkTime ;
  blinkTimer.restart() ;


  gameState = playerPlacesShips ;

  sf::Event event ;
  while (true)
  {
    gameTimeString << (int) gameTime.getElapsedTime().asSeconds() ;
    gameTimeText.setString("Time: " + gameTimeString.str()) ;
    gameTimeString.str("") ;

    window.clear(backgroundColor) ; // Очистка экрана

    window.draw(gameTimeText) ; // Отрисовка времени

    drawBoards(window) ; // Отрисовка досок
    playersTextColor() ; // Задание свойств подписей полей
    for (sf::Text &text : playersText) // Отрисовка подписей полей
      window.draw(text) ;

    if (gameState == playerPlacesShips)
    {
      MouseDrawShip(window) ;
    }

    if (gameState == computerPlacesShips)
    {
      placementShipsByComputer() ;
      gameState = playerShot ;
    }

    if (gameState == computerShot)
    {
      int8_t result = computerMakeShot(thinkTime) ;
      if (result >= 0)
      {
        checkSunkenShips() ;
        if (result == 0)
          gameState = playerShot ;

        if (isEndgame())
          gameState = computerEndGame;
      }
    }

    if (gameState == playerEndGame)
    {
      playersText[0].setString("YOU WON!!!") ;
      playersText[1].setString("") ;
    }

    if (gameState == computerEndGame)
    {
      playersText[0].setString("") ;
      playersText[1].setString("COMP WON!!!") ;
    }

    while (window.pollEvent(event))
    {
      if (event.type == sf::Event::Closed)
        return -1 ;
      else if (event.type == sf::Event::KeyReleased and event.key.code == sf::Keyboard::Escape)
        return 0 ;

      if (gameState == playerPlacesShips)
      {
        if (event.type == sf::Event::MouseButtonReleased and event.mouseButton.button == sf::Mouse::Right)
          currentShipOrientation == h ? currentShipOrientation = v : currentShipOrientation = h ;

        if (event.type == sf::Event::MouseButtonReleased and event.mouseButton.button == sf::Mouse::Left)
          setShipOnField(sf::Mouse::getPosition(window)) ;
      }

      if (gameState == playerShot)
      {
        if (event.type == sf::Event::MouseButtonReleased and event.mouseButton.button == sf::Mouse::Left)
        {
          int8_t result = playerMakeShot(sf::Mouse::getPosition(window)) ;
          if (result >= 0)
          {
            checkSunkenShips() ;
            if (result == 0)
            {
              gameState = computerShot ;
              thinkTime.restart() ;
            }
            if (isEndgame())
              gameState = playerEndGame;
          }
        }
      }
    }

    window.display() ;
  }
}
