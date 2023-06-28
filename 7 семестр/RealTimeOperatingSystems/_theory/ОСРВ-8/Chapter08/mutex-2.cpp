#include <unistd.h>
#include <pthread.h>
#include <vg.h>
#include <stdio.h>

pthread_mutex_t m;

void* A (void* foo)
  {
  int stat;
  int x = 0;
  int f = Rect (0, 0, 10, 10);
  while (1)
    {
    MoveTo (x, 200, f); usleep (30000);
    if (x == 320) stat = pthread_mutex_unlock (&m), printf ("unlock: %d\n", stat);
    x++;
    if (x == 640) x = 0;
    }
  }

void* B (void* foo)
  {
  int stat;
  int x = 0;
  int f = Rect (0, 0, 10, 10);
  while (1)
    {
    MoveTo (x, 300, f); usleep (20000);
    if (x == 320) stat = pthread_mutex_lock (&m), printf ("lock: %d\n", stat);
    x++;
    if (x == 640) x = 0;
    }
  }

int main ()
  {
  ConnectGraph ();
  pthread_mutex_init (&m, 0);
  pthread_create (0, 0, A, 0);
  pthread_create (0, 0, B, 0);
  InputChar ();
  CloseGraph ();
  return 0;
  }
