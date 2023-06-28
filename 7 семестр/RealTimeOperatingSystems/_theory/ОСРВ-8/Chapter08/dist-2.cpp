#include <pthread.h>
#include <unistd.h>
#include <semaphore.h>
#include <math.h>
#include <vg.h>


sem_t sem, sem2;

struct tTask
  {
  int x, y;
  } T;

void* B (void* foo)
  {
  int x, y;
  while (1)
    {
    sem_wait (&sem);
    x = T.x, y = T.y;
    int f = Ellipse (x, y, 1, 1);
    for (int i = 0; i < 200; i++)
      Enlarge (f, 1, 1), usleep (20000);
    Delete (f);
    sem_post (&sem2);
    }
  }

int cx, cy;
void* A (void* foo)
  {
  int p = Pixel (0, 0);
  float t = 0.0;  
  while (1)
    {
    cx = (int)(200.0 * cos (t) + 320);
    cy = (int)(50.0 * sin (t) + 240);
    MoveTo (cx, cy, p), usleep (20000);
    t += 0.05;
    }
  }

int main ()
  {
  ConnectGraph ();
  sem_init (&sem, 0, 0);
  pthread_create (0, 0, A, 0);
  sem_init (&sem2, 0, 2);
  pthread_create (0, 0, B, 0);
  pthread_create (0, 0, B, 0);
  while (1)
    {
    char c;
    sem_wait (&sem2);
    c = InputChar ();
    if ((c == 0) || (c == 'q')) break;
    T.x = cx, T.y = cy, sem_post (&sem);
    }
  CloseGraph ();
  return 0;
  }
