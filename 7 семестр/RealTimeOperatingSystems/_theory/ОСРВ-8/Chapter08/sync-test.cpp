#include <pthread.h>
#include <semaphore.h>
#include <stdio.h>
#include <unistd.h>
#include <sched.h>

sem_t sem;
pthread_barrier_t bar;

void* T1 (void* foo)
  {
  sem_wait (&sem);
  putchar ('A');
  setprio (0, 11);
  pthread_barrier_wait (&bar);
  putchar ('I');
  sem_wait (&sem);
  putchar ('I');
  sem_post (&sem);
  pthread_join (2, 0);
  putchar ('T');
  }

void* T2 (void* foo)
  {
  pthread_barrier_wait (&bar);
  putchar ('M');
  sem_post (&sem);
  putchar ('R');
  sched_yield ();
  putchar ('U');
  }

void* T3 (void* foo)
  {
  putchar ('V');
  sem_post (&sem);
  putchar ('L');
  sched_yield ();
  putchar ('D');
  pthread_barrier_wait (&bar);
  sem_wait (&sem);
  putchar ('P');
  setprio (0, 9);
  putchar ('I');
  sched_yield ();
  putchar ('N');
  }


int main ()
  {
  sem_init (&sem, 0, 0);
  pthread_barrier_init (&bar, 0, 3);
  pthread_create (0, 0, T2, 0);
  pthread_create (0, 0, T3, 0);
  T1 (0);
  pthread_join (2, 0);
  pthread_join (3, 0);
  putchar ('\n');
  fflush (stdout);
  return 0;
  }
  