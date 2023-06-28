#include <libc.h>

void sigcatch (int sig)
  {
  printf ("\033[2J\033[?25h");
  exit (0);
  }

int main ()
  {
  printf ("\033[2J\033[?25l");
  signal (SIGINT, sigcatch);
  for (int i = 1; i < 40; i++)
    {
    printf ("\033[10;%dH*", i);
    fflush (stdout);
    usleep (100000);
    printf ("\033[10;%dH ", i);
    }
  return 0;
  }
