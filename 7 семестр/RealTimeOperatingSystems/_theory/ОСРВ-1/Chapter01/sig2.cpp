#include <libc.h>

int flag = 0;

void sigcatch (int sig)
  {
  flag++;
  }

int main ()
  {
  printf ("\033[2J\033[?25l");
  signal (SIGINT, sigcatch);
  for (int i = 1; flag == 0 && i < 40; i++)
    {
    printf ("\033[10;%dH*", i);
    fflush (stdout);
    usleep (100000);
    printf ("\033[10;%dH ", i);
    }
  printf ("\033[2J\033[?25h");
  return 0;
  }
