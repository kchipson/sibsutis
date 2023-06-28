#include <unistd.h>
#include <vingraph.h>

int main ()
  {
  ConnectGraph ();
  Fill (0, RGB (255, 242, 205));
  int f1 = Rect (280, 190, 50, 50, 0, RGB (38, 176, 136));
  int f2 = Ellipse (370, 210, 200, 200, RGB (48, 200, 240));
  usleep (1000000);
  for (int i = 240; i; i--)
    Enlarge (f1, 2, 2), Enlarge (f2, -1, -1), delay (20);
  CloseGraph ();
  return 0;
  }
