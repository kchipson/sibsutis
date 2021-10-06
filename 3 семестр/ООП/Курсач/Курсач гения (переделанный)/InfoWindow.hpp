//
// Created by kchipson on 11.01.2020.
//

#ifndef INFOWINDOW_HPP
#define INFOWINDOW_HPP

#include "WindowInterface.hpp"
#include "Assets.hpp"

class InfoWindow : public WindowInterface {
  /* Поля */
private:
  sf::Color backgroundColor ;
  sf::Text information[5] ;

  /* Конструкторы и деструкторы */
public:
  InfoWindow() ;

  /* Методы */
public:
  int draw(sf::RenderWindow &window) override ;
} ;

#endif // INFOWINDOW_HPP
