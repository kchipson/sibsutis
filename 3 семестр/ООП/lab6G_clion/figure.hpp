//
// Created by kchipson on 20.12.2019.
//

#ifndef FIGURE_HPP
#define FIGURE_HPP

class Figure {
  /* Методы */
public:
  virtual void straightMove() = 0;
  virtual void rotateMove() = 0;
  virtual void draw() = 0;
};

#endif // CLION_FIGURE_HPP
