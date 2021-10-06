//
// Created by kchipson on 11.01.2020.
//

#ifndef MAINWINDOW_HPP
#define MAINWINDOW_HPP

#include "WindowInterface.hpp"
#include "Assets.hpp"
#include "GlobalVars.hpp"
class MainWindow : public WindowInterface {
  /* Поля */
private:
  sf::Sprite background ;
  sf::Text menuText[3] ;
  sf::Text difficultyText[3] ;

  /* Конструкторы и деструкторы */
public:
  MainWindow() ;

  /* Методы */
public:
  int draw(sf::RenderWindow& window) override ;
private:
  void hoverButtonsMenu(sf::Vector2i mousePosition) ;
  void hoverButtonsDifficulty(sf::Vector2i mousePosition) ;
} ;

#endif // MAINWINDOW_HPP

