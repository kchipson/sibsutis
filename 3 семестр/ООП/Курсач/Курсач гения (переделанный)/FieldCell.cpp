//
// Created by kchipson on 11.01.2020.
//

#include "FieldCell.hpp"

FieldCell::FieldCell() : cellState(cellEnum::empty) {
  sprite.setTexture(Assets::Instance().boardTexture);
}

FieldCell::FieldCell(cellEnum state): cellState(state)
{
  sprite.setTexture(Assets::Instance().boardTexture);
}

cellEnum FieldCell::getState()
{
  return this->cellState ;
}

void FieldCell::setState(cellEnum state)
{
  this->cellState = state ;
}

sf::Sprite& FieldCell::getSprite()
{
  return this->sprite ;
}

void FieldCell::setSprite(cellEnum state)
{
  switch (state){
  case empty:
    sprite.setTextureRect(sf::IntRect(0, 0, 40, 40));
    break;
  case ship:
    sprite.setTextureRect(sf::IntRect(160, 0, 40, 40));
    break;
  case miss:
    sprite.setTextureRect(sf::IntRect(40, 0, 40, 40));
    break;
  case hit:
    sprite.setTextureRect(sf::IntRect(80, 0, 40, 40));
    break;
  case kill:
    sprite.setTextureRect(sf::IntRect(120, 0, 40, 40));
    break;
  }
}
