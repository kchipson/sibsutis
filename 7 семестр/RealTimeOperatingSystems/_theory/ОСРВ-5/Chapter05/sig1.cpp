#include <signal.h>
#include <unistd.h>

volatile char C = 'A';

void sigcatch (int signo)
  {
  C++;
  }


int main ()
  {
  signal (SIGINT, sigcatch);
  while (1) write (1, &C, 1), sleep (3);
  return 0;
  }

