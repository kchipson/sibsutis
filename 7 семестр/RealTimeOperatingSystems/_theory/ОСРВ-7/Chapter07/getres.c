#include <time.h>

int main ()
  {
  struct timespec t;
  clock_getres (CLOCK_REALTIME, &t);
  printf ("tv.sec=%d tv.nsec=%d\n", t.tv_sec, t.tv_nsec);
  return 0;
  }
