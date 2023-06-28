#include <signal.h>
#include <time.h>
#include <stdio.h>
#include "raw.h"

void timed_gets (char* s, int tout)
  {
  static int timer = 0;
  static struct sigevent ev;
  static struct itimerspec timeout = {0, 0, 0, 0};
  char c;
  if (timer == 0)
    {
    SIGEV_UNBLOCK_INIT (&ev);
    timer_create (CLOCK_MONOTONIC, &ev, &timer);
    }
  timeout.it_value.tv_sec = tout;
  setraw ();
  while ((c = getchar ()) != EOF)
    {
    putchar (c);
    *s++ = c;
    timer_settime (timer, 0, &timeout, 0);
    }
  *s = 0;
  unsetraw ();
  }

int main ()
  {
  char str [1000];
  while (1)
    {
    printf ("ENTER: ");
    timed_gets (str, 1);
    if (str[0] == 3) break;
    printf (" = %s\n", str);
    }
  printf ("\n");
  return 0;
  }
