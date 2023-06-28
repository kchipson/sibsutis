#include <stdio.h>

void display (const char *text)
  {
  printf ("\033[2J\033[10;37H%s\n", text);
  getchar ();
  }
// cc -o x2.so -shared x2.cpp
