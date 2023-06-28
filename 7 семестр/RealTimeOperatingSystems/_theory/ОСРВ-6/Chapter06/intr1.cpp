#include <sys/neutrino.h>
#include <stdio.h>

struct sigevent ev;
int counter = 0;

const struct sigevent* isr (void* area, int id)
  {
  if (++counter == 1000)
    {
    counter = 0;
    return &ev;
    }
  else return 0;
  }


int main ()
  {
  unsigned int c = 0;
  SIGEV_INTR_INIT (&ev);
  ThreadCtl (_NTO_TCTL_IO, 0);
  int isrid = InterruptAttach (0, isr, 0, 0, 0);
  do
    {
    InterruptWait (0, 0);
    c++;
    printf ("%d\n", c);
    }
  while (c < 10);
  InterruptDetach (isrid);
  return 0;
  }

  