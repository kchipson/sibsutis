#include <stdio.h>
#include <stdlib.h>
#include <string.h>
main()
{char pr[80], s1[80], s2[80], s3[80];
int i, j;
printf("Vvedite slova \n");
gets(s1);
gets(s2);
gets(s3);
printf ("Vvedite pristavky \n");
gets(pr);
printf ("Slova s pristavkoy %s: ", pr);
for (i=0,j=0;pr[i]!='\0';i++){
    if (pr[i]==s1[i])
        j++;}
    if (j==i)
        printf("%s ",s1);      
for (i=0,j=0;pr[i]!='\0';i++)
    if (pr[i]==s2[i])
        j++;
    if (j==i)
        puts (s2);
for (i=0,j=0;pr[i]!='\0';i++)
    if (pr[i]==s3[i])
        j++;
    if (j==i)
        puts (s3);   
system ("PAUSE");
return 0;      
}
