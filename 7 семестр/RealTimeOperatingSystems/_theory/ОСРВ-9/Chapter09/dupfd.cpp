#include <stdio.h>
#include <unistd.h>
#include <fcntl.h>
#include <process.h>

int main ()
  {
  char buf [100];
  
  int fd = open ("100.data", O_CREAT | O_RDWR, 0666);
  for (int i = 0; i < 100; i++) buf [i] = i;
  write (fd, buf, 100);
  lseek (fd, 55, SEEK_SET);
  int p = fork ();
  if (p == 0) 
    while (1)
      {
      char x, n;
      sleep (2);
      n = read (fd, &x, 1);
      if (n != 1) break;
      printf ("child: %d\n", x);
      }
  else
    {
    sleep (1);
    while (1)
      {
      char x, n;
      sleep (2);
      n = read (fd, &x, 1);
      if (n != 1) break;
      printf ("parent: %d\n", x);
      }
    }
  return 0;
  }

