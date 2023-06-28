#include <pthread.h>
#include <unistd.h>
#include <semaphore.h>
#include <math.h>
#include <vg.h>
#include <stdio.h>

sem_t sem;

struct tQE
  {
  tQE *Next;
  };

struct tQ
  {
  private:
  tQE *Head, *Tail;
  pthread_mutex_t m;
  public:
  tQE* get ();
  void put (tQE*);
  tQ ();
  ~tQ ();
  };

tQ::tQ ()
  {
  printf ("tQ constr.\n");
  Head = 0, Tail = 0;
  pthread_mutex_init (&m, 0);
  }

tQ::~tQ ()
  {
  printf ("tQ destr.\n");
  pthread_mutex_destroy (&m);
  }

tQE* tQ::get ()
  {
  tQE *p;
  pthread_mutex_lock (&m);
  p = Head;
  if (p) Head = Head->Next;
  pthread_mutex_unlock (&m);
  return p;
  }

void tQ::put (tQE* p)
  {
  p->Next = 0;
  pthread_mutex_lock (&m);
  if (Head == 0) Head = Tail = p;
  else Tail->Next = p, Tail = p;
  pthread_mutex_unlock (&m);
  }

struct tTask : tQE
  {
  int x, y;
  };

tQ Queue;

void* B (void* foo)
  {
  tTask *p;
  while (1)
    {
    sem_wait (&sem);
    p = (tTask*)Queue.get ();
    int f = Ellipse (p->x, p->y, 1, 1);
    for (int i = 0; i < 200; i++)
      Enlarge (f, 1, 1), usleep (20000);
    Delete (f);
    delete p;
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
  pthread_create (0, 0, B, 0);
  pthread_create (0, 0, B, 0);
  while (1)
    {
    char c;
    tTask *p;
    c = InputChar ();
    if ((c == 0) || (c == 'q')) break;
    p = new tTask;
    p->x = cx, p->y = cy, Queue.put (p), sem_post (&sem);
    }
  CloseGraph ();
  return 0;
  }
