//
// Created by kchipson on 11.01.2020.
//

#include "MainWindow.hpp"

MainWindow::MainWindow()
{
  background.setTexture(Assets::Instance().menuBackGround) ;
  background.setPosition(0, 0) ;

  // Элементы меню
  for (uint8_t i = 0 ; i < 3 ; i++)
  {
    menuText[i].setFont(Assets::Instance().fontMagnum) ;
    menuText[i].setFillColor(sf::Color::White) ;
    menuText[i].setOutlineColor(sf::Color::Black) ;
    menuText[i].setOutlineThickness(4.f) ;
    menuText[i].setCharacterSize(72) ;
    menuText[i].setPosition(50, 100 + 100 * i) ;
  }
  menuText[0].setString(L"Начать игру") ;
  menuText[1].setString(L"Инфо") ;
  menuText[2].setString(L"Выйти") ;

  // Сложности
  for (uint8_t i = 0 ; i < 3 ; i++)
  {
    difficultyText[i].setFont(Assets::Instance().fontIron) ;
    difficultyText[i].setOutlineColor(sf::Color::Black) ;
    difficultyText[i].setOutlineThickness(3.f) ;
    difficultyText[i].setCharacterSize(58) ;
    difficultyText[i].setPosition(1000, 410 + 55 * i) ;
  }
  difficultyText[0].setString(L"Eazy") ;
  difficultyText[0].setFillColor(sf::Color::Green) ;
  difficultyText[1].setString(L"Normal") ;
  difficultyText[1].setFillColor(sf::Color::Yellow) ;
  difficultyText[2].setString(L"Hard") ;
  difficultyText[2].setFillColor(sf::Color::Red) ;

}

int MainWindow::draw(sf::RenderWindow& window)
{

  window.setTitle("BattleShip | Menu") ;

  sf::Event event ;
  sf::Vector2i mousePosition ;
  while (true)
  {
    while(window.pollEvent(event))
    {
      if ((event.type == sf::Event::Closed) or ((event.type == sf::Event::KeyReleased) and (event.key.code == sf::Keyboard::Escape)))
        return -1 ;
      if (event.type == sf::Event::MouseButtonReleased and event.mouseButton.button == sf::Mouse::Left)
      {
        if (sf::IntRect(menuText[0].getGlobalBounds()).contains(sf::Mouse::getPosition(window)))
          return 1 ;
        else if (sf::IntRect(menuText[1].getGlobalBounds()).contains(sf::Mouse::getPosition(window)))
          return 2 ;
        else if (sf::IntRect(menuText[2].getGlobalBounds()).contains(sf::Mouse::getPosition(window)))
          return -1 ;

        for (uint8_t i = 0 ; i < 3 ; i++)
        {
          if (sf::IntRect(difficultyText[i].getGlobalBounds()).contains(sf::Mouse::getPosition(window)))
            GlobalVars::Instance().gameDifficulty = i ;
        }
      }
    }

    mousePosition = sf::Mouse::getPosition(window) ;
    hoverButtonsMenu(mousePosition) ;
    hoverButtonsDifficulty(mousePosition) ;

    window.clear() ;

    window.draw(background) ;
    for (sf::Text &textMenu : menuText)
      window.draw(textMenu) ;
    for (sf::Text &textDiff : difficultyText)
      window.draw(textDiff) ;

    window.display() ;
  }
}

void MainWindow::hoverButtonsMenu(sf::Vector2i mousePosition)
{
  for (sf::Text &textMenu : menuText)
  {
    if (sf::IntRect(textMenu.getGlobalBounds()).contains(mousePosition)){
      textMenu.setOutlineColor(sf::Color::Cyan) ;
    }
    else{
      textMenu.setOutlineColor(sf::Color::Black) ;
    }
  }
}

void MainWindow::hoverButtonsDifficulty(sf::Vector2i mousePosition)
{
  for (uint8_t i = 0 ; i < 3 ; i++)
    if (GlobalVars::Instance().gameDifficulty == i){
      difficultyText[i].setOutlineThickness(8.f) ;
      difficultyText[i].setStyle(sf::Text::Italic) ;
    }
    else{
      difficultyText[i].setOutlineColor(sf::Color::Black) ;
      difficultyText[i].setOutlineThickness(3.f) ;
      difficultyText[i].setStyle(sf::Text::Regular) ;
    }

  for (sf::Text &textDiff : difficultyText)
  {
    if (sf::IntRect(textDiff.getGlobalBounds()).contains(mousePosition))
      textDiff.setOutlineColor(sf::Color::Magenta) ;
    else
      textDiff.setOutlineColor(sf::Color::Black) ;
  }
}
