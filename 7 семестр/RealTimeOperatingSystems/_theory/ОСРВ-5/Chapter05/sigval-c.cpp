#include <signal.h>
#include <unistd.h>
#include <fcntl.h>

int main (int argc, char * argv[])
  {
  int pid;
  int fd = open ("/dev/shmem/sigval-s.pid", O_RDONLY);
  read (fd, &pid, 4);
  union sigval s;
  s.sival_int = argv[1][0];
  sigqueue (pid, 41, s);
  return 0;
  }

  
  