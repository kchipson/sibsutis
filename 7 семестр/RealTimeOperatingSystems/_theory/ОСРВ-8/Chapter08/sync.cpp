#include <unistd.h>
#include <pthread.h>
#include <vg.h>
#include <semaphore.h>

sem_t sem;

void* A (void* foo)
  {
  int x = 0;
  int f = Rect (0, 0, 10, 10);
  while (1)
    {
    MoveTo (x, 200, f); usleep (30000);
    if (x == 320) sem_post (&sem);
    x++;
    if (x == 640) x = 0;
    }
  }

void* B (void* foo)
  {
  int x = 0;
  int f = Rect (0, 0, 10, 10);
  while (1)
    {
    MoveTo (x, 300, f); usleep (20000);
    if (x == 320) sem_wait (&sem);
    x++;
    if (x == 640) x = 0;
    }
  }

int main ()
  {
  ConnectGraph ();
  sem_init (&sem, 0, 0);
  pthread_create (0, 0, A, 0);
  pthread_create (0, 0, B, 0);
  InputChar ();
  CloseGraph ();
  return 0;
  }
