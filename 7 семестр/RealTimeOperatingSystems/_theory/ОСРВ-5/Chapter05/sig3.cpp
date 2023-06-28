#include <signal.h>
#include <stdio.h>
#include <unistd.h>
#include <errno.h>

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
    printf ("getchar = %d  errno = %d\n", c, errno);
    if (c == EOF && errno != EINTR) break;
    if (c == 'q') break;
    errno = 0;
    }
  return 0;
  }


  