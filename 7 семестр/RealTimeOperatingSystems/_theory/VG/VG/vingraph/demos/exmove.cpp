#include <unistd.h>
#include <stdlib.h>
#include <vingraph.h>

int main ()
  {
  putenv ("VGOSC=1");
  ConnectGraph ();
  Fill (0, RGB (255, 242, 205));
  int c1 = RGB (38, 176, 136);
  int f1 = Rect (10, 200, 50, 50, 0, c1);
  Fill (f1, c1);
  int c2 = RGB (48, 200, 240);
  int f2 = Ellipse (580, 200, 50, 50, c2);
  Fill (f2, c2);
  usleep (1000000);
  for (int i = 320; i; i--)
    Move (f1, 2, 0), Move (f2, -3, 0), usleep (20000);
  CloseGraph ();
  return 0;
  }