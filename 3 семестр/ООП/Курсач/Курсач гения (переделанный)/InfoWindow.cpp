//
// Created by kchipson on 11.01.2020.
//

#include "InfoWindow.hpp"


InfoWindow::InfoWindow()
{
  backgroundColor = sf::Color(102, 165, 235);

  for (sf::Text &t : information)
  {
    t.setFont(Assets::Instance().fontMagnum) ;
    t.setFillColor(sf::Color::White) ;
    t.setOutlineColor(sf::Color::Black) ;
    t.setOutlineThickness(2.f) ;
    t.setCharacterSize(84) ;
  }

  information[0].setString(L"курсовой проект по ооп") ;
  information[0].setPosition(175, 25) ;
  information[1].setString(L"\"морской бой\"") ;
  information[1].setPosition(345, 115) ;
  information[2].setString(L"группа ип-811") ;
  information[2].setPosition(355, 280) ;
  information[3].setString(L"мироненко кирилл") ;
  information[3].setPosition(275, 350) ;
  information[4].setString(L"2019 - 2020 уч. год") ;
  information[4].setPosition(260, 500) ;
}

int InfoWindow::draw(sf::RenderWindow &window)
{
  window.setTitle("BattleShip | Information") ;

  sf::Event event ;
  while (true)
  {
    while(window.pollEvent(event))
      if (event.type == sf::Event::Closed)
        return -1 ;
      else if ((event.type == sf::Event::KeyReleased) and (event.key.code == sf::Keyboard::Escape))
        return 0 ;

    window.clear(backgroundColor) ;
    for (sf::Text &text : information)
      window.draw(text) ;
    window.display() ;
  }
}
