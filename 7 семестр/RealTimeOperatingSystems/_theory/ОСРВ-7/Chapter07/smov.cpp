#include <unistd.h>
#include <signal.h>
#include <time.h>
#include <pthread.h>
#include <stdlib.h>
#include <vg.h>

const int x1 = 0, x2 = 600;

void* Fly (void *foo)
  {
  int c = RGB (98, 113, 160);
  int f = Rect (0, 0, 20, 20, 0, c);
  Fill (f, c);
  for (int i = x1; i < x2; i++)
    MoveTo (i, 100, f), delay (10);
//  Delete (f);
  }

void* StableFly (void *foo)
  {
  int c = RGB (98, 113, 160);
  int f = Rect (0, 0, 20, 20, 0, c);
  Fill (f, c);
  sigset_t ss;
  sigemptyset (&ss), sigaddset (&ss, 42);
  pthread_sigmask (SIG_BLOCK, &ss, 0);
  struct sigevent ev;
  SIGEV_SIGNAL_THREAD_INIT (&ev, 42, 0, 0);
  int timer;
  timer_create (CLOCK_MONOTONIC, &ev, &timer);
  struct itimerspec ts;
  ts.it_value.tv_sec = 0;
  ts.it_value.tv_nsec = 10000000;
  ts.it_interval.tv_sec = 0;
  ts.it_interval.tv_nsec = 10000000;
  timer_settime (timer, 0, &ts, 0);
  for (int i = x1; i < x2; i++)
    MoveTo (i, 200, f), sigwaitinfo (&ss, 0);
  timer_delete (timer);
//  Delete (f);
  }


int main ()
  {
  putenv ("VGOSC=1");
  ConnectGraph ();
  Fill (0, RGB(255, 255, 193));
  int c = RGB (0, 128, 112);
  Text (10, 100, "Fly        (100 points/sec)", c);
  Text (10, 200, "Stable Fly (100 points/sec)", c);
  pthread_create (0, 0, Fly, 0);
  pthread_create (0, 0, StableFly, 0);
  pthread_join (2, 0);
  pthread_join (3, 0);
  Text (300, 400, "PRESS ANY KEY", c);
  InputChar ();
  CloseGraph ();
  return 0;
  }
  