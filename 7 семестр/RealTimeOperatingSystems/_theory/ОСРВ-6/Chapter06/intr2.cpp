#include <sys/neutrino.h>
#include <stdio.h>

struct sigevent ev1, ev2;
int counter = 0;

const struct sigevent* isr (void* area, int id)
  {
  if (++counter == 1000)
    {
    counter = 0;
    return &ev1;
    }
  else return 0;
  }


int main ()
  {
  unsigned int c1 = 0, c2 = 0;
  int pulse_buf [4];

  int chid = ChannelCreate (0);
  int coid = ConnectAttach (0, 0, chid, 0, 0);
  SIGEV_PULSE_INIT (&ev1, coid, 10, 0, 1);
  SIGEV_PULSE_INIT (&ev2, coid, 10, 0, 2);
  ThreadCtl (_NTO_TCTL_IO, 0);
  int isrid1 = InterruptAttach (0, isr, 0, 0, 0);
  int isrid2 = InterruptAttachEvent (1, &ev2, 0);
  do
    {
    MsgReceive (chid, pulse_buf, sizeof pulse_buf, 0);
    if (pulse_buf[2] == 1) c1++, printf ("%d\n", c1);
    if (pulse_buf[2] == 2) InterruptUnmask (1, isrid2), c2++, printf ("       %d\n", c2);
    }
  while (c1 < 10);
  InterruptDetach (isrid1);
  InterruptDetach (isrid2);
  return 0;
  }

  