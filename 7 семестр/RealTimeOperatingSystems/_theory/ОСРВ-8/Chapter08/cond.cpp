#include <pthread.h>
#include <unistd.h>
#include <stdio.h>
#include <vg.h>
#include <sched.h>

pthread_cond_t cond;
pthread_mutex_t mut;

volatile int A = 0, B = 0, C = 0;

void* X (void* foo)
  {
  int c = RGB (38, 132, 197);
  while (1)
    {
    pthread_mutex_lock (&mut);
    while (!(!A && C))
      pthread_cond_wait (&cond, &mut);
    pthread_mutex_unlock (&mut);
    int f = Rect (100, 100, 100, 100);
    Fill (f, c);
    usleep (500000);
    Delete (f);
    c *= 3;
    }
  }
  
void* Y (void* foo)
  {
  int c = RGB (250, 63, 85);
  while (1)
    {
    pthread_mutex_lock (&mut);
    while (!((!A && B) || (A && !C)))
      pthread_cond_wait (&cond, &mut);
    pthread_mutex_unlock (&mut);
    int f = Ellipse (440, 100, 100, 100);
    Fill (f, c);
    usleep (700000);
    Delete (f);
    c *= 3;
    }
  }
  
int main ()
  {
  char c, str [100];
  ConnectGraph ();
  pthread_cond_init (&cond, 0);
  pthread_mutex_init (&mut, 0);
  pthread_create (0, 0, &X, 0);
  pthread_create (0, 0, &Y, 0);
  Text (300, 230, "A  B  C");
  int t = Text (300, 250, "");
  while (1)
    {
    sprintf (str, "%d  %d  %d", A, B, C);
    SetText (t, str);
    c = InputChar ();
    if ((c == 0) || (c == 'q')) break;
    if (c == 'a') A ^= 1;
    if (c == 'b') B ^= 1;
    if (c == 'c') C ^= 1;
    pthread_cond_broadcast (&cond);
    }  
  CloseGraph ();
  return 0;
  }
