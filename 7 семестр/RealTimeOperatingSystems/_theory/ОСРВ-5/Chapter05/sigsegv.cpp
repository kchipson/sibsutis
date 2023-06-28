#include <signal.h>
#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>

void sigcatch (int sig, siginfo_t* info, ucontext_t* uc)
  {
  printf ("sigsegv: %d %d %d\n", info->si_signo, info->si_code, info->si_value.sival_ptr);
  exit (sig);
  }

int main ()
  {
  struct sigaction sa;
  sigset_t smask;
  sa.sa_sigaction = sigcatch;
  sigemptyset (&smask);
  sigaddset (&smask, SIGSEGV);
  sa.sa_mask = smask;
  sa.sa_flags = SA_SIGINFO;
  sigaction (SIGSEGV, &sa, 0);
  int x, *p;
  p = (int*)1000;
  x = *p;
  return 0;
  }


  