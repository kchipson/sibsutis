#include <signal.h>
#include <stdio.h>
#include <pthread.h>

void sigcatch (int sig)
  {
  printf ("signal = %d\n", sig);
  }

void * t1 (void *foo)
  {
  sigset_t ss;
  sigemptyset (&ss), sigaddset (&ss, SIGINT);
  while (1)
    {
    sigsuspend (&ss);
    printf ("t1\n");
    }
  }

void * t2 (void *foo)
  {
  sigset_t ss;
  sigemptyset (&ss), sigaddset (&ss, SIGTERM);
  while (1)
    {
    sigsuspend (&ss);
    printf ("t2\n");
    }
  }

int main ()
  {
  struct sigaction sa;
  sigset_t ss;
  sa.sa_handler = sigcatch;
  sigemptyset (&ss);
  sa.sa_mask = ss;
  sa.sa_flags = 0;
  sigaction (SIGINT, &sa, 0);
  sigaction (SIGTERM, &sa, 0);
  
  pthread_create (0, 0, t1, 0);
  t2 (0);
  
  return 0;
  }
