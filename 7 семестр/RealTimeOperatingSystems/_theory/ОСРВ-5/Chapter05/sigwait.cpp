#include <signal.h>
#include <stdio.h>
#include <pthread.h>

void * t1 (void *foo)
  {
  sigset_t ss;
  sigemptyset (&ss), sigaddset (&ss, SIGINT);
  while (1)
    {
    sigwaitinfo (&ss, 0);
    printf ("t1\n");
    }
  }

void * t2 (void *foo)
  {
  sigset_t ss;
  sigemptyset (&ss), sigaddset (&ss, SIGTERM);
  while (1)
    {
    sigwaitinfo (&ss, 0);
    printf ("t2\n");
    }
  }

int main ()
  {
  sigset_t ss;
  sigemptyset (&ss);
  sigaddset (&ss, SIGINT), sigaddset (&ss, SIGTERM);
  pthread_sigmask (SIG_SETMASK, &ss, 0);
  
  pthread_create (0, 0, t1, 0);
  t2 (0);
  
  return 0;
  }
