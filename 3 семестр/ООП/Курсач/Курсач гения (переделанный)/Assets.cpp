//
// Created by kchipson on 20.01.2020.
//

#include "Assets.hpp"

void Assets::Load()
{
  if (!boardTexture.loadFromFile("texture/boardTextures.png")) throw;
  if (!shipDeskTexture.loadFromFile("texture/shipDeckTextures.png")) throw;
  if (!menuBackGround.loadFromFile("texture/menuBackground.png")) throw;
  if (!fontIron.loadFromFile("texture/Iron.ttf")) throw;
  if (!fontMagnum.loadFromFile("texture/Magnum.ttf")) throw;
}

