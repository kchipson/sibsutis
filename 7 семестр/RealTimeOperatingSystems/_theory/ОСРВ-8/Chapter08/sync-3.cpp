#include <unistd.h>
#include <pthread.h>
#include <vg.h>
#include <stdlib.h>
#include <time.h>

pthread_barrier_t bar;
volatile int Sig;

void* A (void *line)
  {
  int x = 0;
  int f = Rect (0, 0, 10, 10);
  int d = (random() % 10000) + 10000;
  int sig;
  while (1)
    {
    MoveTo (x, (int)line, f); usleep (d);
    if (x == 320) 
      pthread_barrier_wait (&bar),
      d = (random() % 10000) + 10000;
    x++;
    if (x == 640) x = 0;
    if (sig != Sig) sig = Sig, d = (random() % 10000) + 10000;
    }
  }


int main ()
  {
  srandom (time (0));
  ConnectGraph ();
  pthread_barrier_init (&bar, 0, 4);
  pthread_create (0, 0, A, (void*)100);
  pthread_create (0, 0, A, (void*)200);
  pthread_create (0, 0, A, (void*)300);
  while (1)
    {
    char c = InputChar ();
    if ((c == 0) || (c == 'q')) break;
    if (c == ' ') Sig++;
    if (c == '\r') pthread_barrier_wait (&bar);
    }
  CloseGraph ();
  return 0;
  }
