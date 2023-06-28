/*
  mount_fd -t type mntpoint
  for non-root
*/

int main (int argc, char * argv [])
  {
  char com [200];

  if (argc < 4) 
    printf ("%s: too few arguments\n", argv[0]), exit (1);
  if (argc > 4) 
    printf ("%s: too many arguments\n", argv[0]), exit (1);

  sprintf (com, "mount -t %s /dev/fd0 %s", argv[2], argv[3]);
  return system (com);
  }
