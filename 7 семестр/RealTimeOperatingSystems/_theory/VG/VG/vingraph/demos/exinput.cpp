#include <stdio.h>
#include <vingraph.h>

int main ()
  {
  char c, str [100];
  ConnectGraph ();
  Text (20, 20, "Press a key");
  int mytext = Text (20, 40, "");
  while (1)
    {
    c = InputChar ();
    if ((c == ' ') || (c == 0)) break;
    sprintf (str, "Code = %d", c);
    SetText (mytext, str);
    }
  CloseGraph ();
  return 0;
  }
