#include <signal.h>
#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <fcntl.h>
#include <process.h>

char c = 'a';

void sigcatch (int sig, siginfo_t* info, ucontext_t* uc)
  {
  c = (char)info->si_value.sival_int;
  }

int main ()
  {
  struct sigaction sa;
  sigset_t smask;
  sa.sa_sigaction = sigcatch;
  sigemptyset (&smask);
  sigaddset (&smask, 41);
  sa.sa_mask = smask;
  sa.sa_flags = SA_SIGINFO;
  sigaction (41, &sa, 0);

  int fd = open ("/dev/shmem/sigval-s.pid", O_CREAT + O_RDWR, 0666);
  int pid = getpid ();
  write (fd, &pid, 4);
  close (fd);

  while (1) write (1, &c, 1), usleep (100000);
  return 0;
  }


  