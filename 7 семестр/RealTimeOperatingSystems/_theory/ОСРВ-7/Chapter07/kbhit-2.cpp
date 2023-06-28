#include <sys/neutrino.h>
#include <time.h>
#include <unistd.h>

int kbhit ()
  {
  char c;
  struct timespec timeout = {0, 1000000};
  timer_timeout (CLOCK_MONOTONIC, _NTO_TIMEOUT_SEND | _NTO_TIMEOUT_REPLY, 0, &timeout, 0);
  if (read (0, &c, 1) < 0) return 0;
  return c;
  }

int main ()
  {
  while (1)
    {
    write (1, "1", 1);
    delay (100);
    if (kbhit ()) break;
    }
  return 0;
  }
