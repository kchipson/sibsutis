#include "Application.hpp"
#include "Assets.hpp"
#include "GlobalVars.hpp"
#include <cstring>
#include <ctime>

int main(int argc, char* argv[])
{

  srand(time(0)) ;

  if (argc > 1) {
    // включить дебаг режим
    if (strcmp(argv[1], "-d") == 0) {
      GlobalVars::Instance().debug = true ;
    }
  }
  Assets::Instance().Load() ; // Загружаем ресурсы

  Application* app = new Application ;
  app->run() ;

  return 0 ;
}
