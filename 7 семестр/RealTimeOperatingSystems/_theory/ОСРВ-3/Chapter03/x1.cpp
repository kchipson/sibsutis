#include <vg.h>

void display (const char *text)
  {
  ConnectGraph ("display");
  Ellipse (100, 100, 200, 200);
  Text (120, 150, text);
  InputChar ();
  CloseGraph ();
  }
// cc -o x1.so -shared x1.cpp -l vg
