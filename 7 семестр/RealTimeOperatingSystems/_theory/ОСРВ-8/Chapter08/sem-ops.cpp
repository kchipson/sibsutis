#include <semaphore.h>

int main ()
  {
  sem_t sem;
  sem_init (&sem, 0, 1);
  sem_wait (&sem);
  sem_post (&sem);
  return 0;
  }

/*
cc -g sem-ops.cpp
gdb ./a.out
(gdb) r
(gdb) b main
(gdb) c
(gdb) s
(gdb) display/i $pc
(gdb) si
(gdb) si
(gdb) ...
(gdb) 
(gdb) q

*/
