//
// Created by kchipson on 20.01.2020.
//

#ifndef ASSETS_HPP
#define ASSETS_HPP

#include <SFML/Graphics.hpp>
class Assets
{
public:
  sf::Texture boardTexture;
  sf::Texture shipDeskTexture;
  sf::Texture menuBackGround;
  sf::Font fontIron;
  sf::Font fontMagnum;
public:
  static Assets& Instance()
  {
    static Assets s;
    return s;
  }
  void Load();
private:
  Assets() {};
  ~Assets() {};
  Assets(Assets const&) = delete;
  Assets& operator= (Assets const&) = delete;
};

#endif // ASSETS_HPP
