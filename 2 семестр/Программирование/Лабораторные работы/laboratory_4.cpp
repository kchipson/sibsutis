#include <stdlib.h> 
#include <iostream>
#include <ctime>
using namespace std;

void one(){
//��������� ��������� �������, ��������� �������� new � ������� malloc().
//1.����� ��������� ������������ ������ B  ����������� m x n. (n=5, m ������� � ����������). 
//��������� � ���������� �������. �������� ����� ������������ ������� �[m-1][n-1]  ����� �������� �� � ������ � �������,
// � ������� ���������� ������������ ������� �������� �������.
	const int n=5; // ���������� ��������� � ������
	typedef int str[n];//str - ����� ���: ������ (������) �� n ����� �����
	int i,j,m,max_i=0,max_j=0;
	str *B; // ��������� �� ������
	cout << "m =  ";
	cin >> m;
	B = new str[m]; // �������� ������ ��� ������� �� ������ a, m ����� �� n ��������� � ������ 
	if ( B == NULL ) 
	{   cout << "�� ������� �������� ������";
	exit(0);
	}

	// ��������� ������� ���������� �������
	for (i=0; i<m; i++){  
		for (j=0; j<n; j++){
			B[i][j]=rand()%101-50;
		}
	} 

	for (i=0; i<m; i++){  
		for (j=0; j<n; j++){
			if (B[i][j]>B[max_i][max_j]){
				max_i=i;
				max_j=j;
			}		
		}
	}
	typedef int str2[n-1];//str2 - ����� ���: ������ (������) �� n-1 ����� �����
	str2* C;
	C = (str2*)malloc((m-1)*sizeof(str2));
	
	if ( C == NULL ) 
	{   cout << "�� ������� �������� ������";
	exit(0); 
	}
	
	for (i=0; i<m; i++){  
		if (i<max_i){
			for (j=0; j<n; j++){
				if (j<max_j){
					C[i][j]=B[i][j];
				}	
				else if(j>max_j){
					C[i][j-1]=B[i][j];
				}	
			}
		}
		else if(i>max_i){
			for (j=0; j<n; j++){
				if (j<max_j){
					C[i-1][j]=B[i][j];
				}	
				else if(j>max_j){
					C[i-1][j-1]=B[i][j];
				}	
			}			
		}
	}
	cout<<"B ������: "<<endl;
	
	for (i=0; i<m; i++){  
		for (j=0; j<n; j++){
			cout.width(3);
			cout<<B[i][j]<<"  ";
		}
		cout<<endl;
	}
	
	
	cout<<"C ������: "<<endl;

	for (i=0; i<m-1; i++){  
		for (j=0; j<n-1; j++){
			cout.width(3);
			cout<<C[i][j]<<"  ";
		}
		cout<<endl;
	}
	
	cout<<endl;
	free(C);
	delete B; 

} 





void two(){ 
//��������� ��������� �������, ��������� �������� new � ������� malloc().
//2. ����� ��������� ������������ ������ �  �����������   m x n. ( m � n ������� � ����������).
//��������� ��� ���������� �������.  ������� ������ D  �������� m+1 ��  n+1, � ������� �������� �������� ������� � 
//� ����� ��������� ��������������� ����� � �������� ��������� ������� �.  
//� ������� D[m+1][n+1] ��������� ����� ���� ��������� ��������� �������.

	int n,m,i,j;
    cout << "������� n: ";
    cin >> n;
    cout << "������� m: ";
    cin >> m;
    typedef int str[n];//str - ����� ���: ������ (������) �� n ����� �����
	str* A;
	A = (str*)malloc((m)*sizeof(str));
	if ( A == NULL ){
		cout << "�� ������� �������� ������";
		exit(0); 
	}
	// ��������� ������� ���������� �������
	for (i=0; i<m; i++){  
		for (j=0; j<n; j++){
			A[i][j]=rand()%101-50;
		}
	} 
	
	
    int** D = new int*[n+1];
    for (int i = 0; i < m+1; i++){
        D[i] = new int[n+1];
    }
    
    if ( D == NULL ){
		cout << "�� ������� �������� ������";
		exit(0); 
	}
    int sum=0; // ����� ����� �������
    for (i=0;i<m;i++){  //���������� �������� ������� ������� � ������� �����
    	D[i][n]=0;
    	for (j=0; j<n;j++){
    		D[i][j]=A[i][j];
    		sum+=A[i][j];
    		D[i][n]+=A[i][j];
		}
	}
	
	for (i=0;i<n;i++){  //���������� ������� ������ ������
    	D[m][i]=0;
    	for (j=0; j<m;j++){
    		D[m][i]+=D[j][i];
		}	
	}
	D[m][n]=sum;



	for (i=0; i<m+1; i++){  // ����� ����������� �������
		for (j=0; j<n+1; j++){
			cout.width(3);
			cout<<D[i][j]<<"  ";
		}
		cout<<endl;
	} 
	
	free(A);
	delete D; 

} 


main(){ 
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text"); 
	srand(time(NULL));
    int choice; 
   	cout<<"Input number of task (Number from 1 to 2):"; 
    cin>>choice; 
    system("CLS");
    if(choice == 1){ 
        one(); 
    } 
    else if(choice == 2){ 
        two(); 
    }

system("PAUSE");
return 0; 
}




