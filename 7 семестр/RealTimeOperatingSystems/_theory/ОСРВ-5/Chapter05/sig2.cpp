#include <signal.h>
#include <stdio.h>
#include <unistd.h>

void sigcatch (int sig)
  {
  printf ("signal %d\n", sig);
  }

int main ()
  {
  char c;
  for (int i=1; i <= 31; i++) signal (i, sigcatch);
  while (1)
    {
    c = getchar ();
    write (1, &c, 1);
    if (c == 'q') break;
    }
  return 0;
  }


  