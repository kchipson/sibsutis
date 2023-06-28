#include <dlfcn.h>
#include <stdio.h>
#include <stdlib.h>

typedef void (*func) (const char *);

int main ()
  {
  void *h;
  if (getenv ("PHOTON") != 0)
    h = dlopen ("./x1.so", RTLD_NOW);
  else
    h = dlopen ("./x2.so", RTLD_NOW);
  func f = (func) dlsym (h, "display__FPCc");
  (*f) ("Hello");
  dlclose (h);
  return 0;
  }
