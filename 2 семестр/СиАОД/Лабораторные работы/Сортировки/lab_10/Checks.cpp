#include <math.h>

extern int M_real, C_real;
extern double M_theoretical, C_theoretical;

int CheckSum(int *A, int n) // Контрольная сумма
{
  int sum = 0;
  for (int i = 0; i < n; i++)
    sum += A[i];
  return sum;
}
int RunNumber(int *A, int n) // Число неубывающих серий
{
  int sequence = 1;
  for (int i = 0; i < n - 1; i++)
    if (A[i] > A[i + 1])
      sequence++;
  return sequence;
}


int BSearch1(int *A, int n,int X){
	C_real=0;
	C_theoretical=(int)log2(n)+1;
	int L=0,R=n-1,m,find_int=-1;
	bool find = false;
	
	while(L<=R){
		m = floor((float)(L+R)/(float)2);
		C_real++;
		if(A[m] == X){
			find = true;
			find_int = m;
			break;
		}
		C_real++;
		if(A[m]<X){
			L=m+1;
		}else{
			R=m-1;
		}
	}
	return (find ? find_int : -1);
}

int BSearch2(int *A, int n,int X){
	C_theoretical=(int)log2(n)+1;
	C_real=0;
	int L=0,R=n-1,m;
	bool find = false;
	
	while(L<R){
		m = (L+R)/2;
		C_real++;
		if(A[m]<X){
			L=m+1;
		}else{
			R=m;
		}
	}
	if(A[R]==X){
		find = true;
	}else{
		find = false;
	}

	return (find ? R : -1);
}