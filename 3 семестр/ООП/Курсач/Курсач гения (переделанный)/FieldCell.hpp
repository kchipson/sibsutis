#ifndef FIELDCELL_HPP
#define FIELDCELL_HPP

#include <SFML/Graphics.hpp>

#include "Assets.hpp"

enum cellEnum:uint8_t {empty, miss, hit, kill, ship} ;

class FieldCell { // Ячейка поля
  /* Поля */
private:
  cellEnum cellState ; // Состояние ячейки
  sf::Sprite sprite ;

  /* Конструкторы и деструкторы */
public:
  FieldCell() ;
  explicit FieldCell(cellEnum state) ;

public:
  /* Методы */
  cellEnum getState() ;
  void setState(cellEnum state) ;
  sf::Sprite& getSprite() ;
  void setSprite(cellEnum state) ;
};

#endif // FIELDCELL_HPP
