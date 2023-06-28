#include <signal.h>
#include <time.h>
#include <unistd.h>

int kbhit ()
  {
  static int timer = 0;
  static struct sigevent ev;
  static struct itimerspec timeout = {0, 1, 0, 0};
  static struct itimerspec disarm  = {0, 0, 0, 0};
  char c;
  if (timer == 0)
    {
    SIGEV_UNBLOCK_INIT (&ev);
    timer_create (CLOCK_MONOTONIC, &ev, &timer);
    }
  timer_settime (timer, 0, &timeout, 0);
  if (read (0, &c, 1) < 0) return 0;
  timer_settime (timer, 0, &disarm, 0);
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
