//
// Created by kchipson on 20.01.2020.
//

#ifndef GLOBALVARS_HPP
#define GLOBALVARS_HPP

#include <cstdint>
class GlobalVars{
public:
  bool debug = false ;
  uint8_t gameDifficulty = 1 ;

public:
  static GlobalVars& Instance()
  {
    static GlobalVars s ;
    return s ;
  }
private:
  GlobalVars() {} ;
  ~GlobalVars() {} ;
  GlobalVars(GlobalVars const&) = delete ;
  GlobalVars& operator= (GlobalVars const&) = delete ;
};
#endif // GLOBALVARS_HPP
