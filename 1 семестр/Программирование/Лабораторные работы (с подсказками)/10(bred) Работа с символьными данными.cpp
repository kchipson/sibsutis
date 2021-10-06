
#include <iostream>
#include <string.h> 
using namespace std;


void one() {

char text[2000],pri[10], slovo[100][100]; 
int i=0, j=0, t=0; 
cout<<"Введите текст: \n"; 
gets(text); 
while (text[t] != '\0') { 
	if (text[t]!=' ' && text[t]!=',' && text[t]!='\0') {
		slovo[i][j]=text[t];	
		j++; 
	}
	else
	{
		slovo[i][j+1]='\0'; 
		i++, j=0; 
	} 
strlwr(slovo[i]);
t++; 
} 



cout<<"Введете приставку: "; 
gets(pri); 
strlwr(pri);
cout<<endl<<endl<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<endl<<"Слова с приставкой "<<pri<<":"<<endl<<endl; 

for (j=0; j<=i; j++) 
if (strncmp (pri, slovo[j], strlen(pri)) == 0) 
cout<<slovo[j]<<endl; 

}


void two(){ 
//2.	Во введенном тексте найти количество  повторений каждого слова. Одинаковые слова дважды не выводить.
	char text[2000], slovo[100][100]; 
	int i=0, j=0, t=0, count=1; 
	
	
	cout<<"Введите текст: \n"; 
	gets(text); 
	while (text[t] != '\0') { 
		if (text[t]!=' ' && text[t]!=',' && text[t]!='\0') {
			slovo[i][j]=text[t];	
			j++; 
		}
		else
		{
			slovo[i][j+1]='\0'; 
			i++, j=0; 
		} 
	strlwr(slovo[i]);
	t++; 
	} 

	cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<endl;
	for (j=0; j<=i; j++) {
		if (slovo[j][0] != '\0'){
			for (int k=j+1; k <= i; k++) {
				if (!strcmp(slovo[j], slovo[k])) {//Если нашлось два одинаковых слова
					count++;
					slovo[k][0] = '\0';
				}
			}
			cout<<"\nВхождение слова "<<slovo[j]<<" в текст: "<<count;
			count=1;
		}
				
	}

	

}

void three(){ 
//3.	Список фамилий вводится через запятую в виде строки. Упорядочить   фамилии по алфавиту.
	char text[2000], slovo[100][100], fam[100][100],c[100]; 
	int i=0, j=0, t=0, count=1; 
	
	
	cout<<"Введите фамилии: \n"; 
	gets(text); 
	while (text[t] != '\0') { 
		if (text[t]!=' ' && text[t]!=',' && text[t]!='\0') {
			slovo[i][j]=text[t];	
			j++; 
		}
		else
		{
			slovo[i][j+1]='\0'; 
			i++, j=0; 
		} 
		
		strupr(slovo[i]);
		t++; 
	} 
	
	
	for (j = 0; j <= i; j++ ) 
		for (int k =j+1; k <=i; k++ ){
			if ( strcmp(slovo[k],slovo[j])<0 ){ 
				strcpy(c,slovo[k]);
				strcpy(slovo[k],slovo[j]);
				strcpy(slovo[j],c);
			}
		}
		
	for (j = 0; j <= i; j++ ) 
	cout<<slovo[j]<<endl;
		
} 
 

main(){ 
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text");
    int choice; 
    cout<<"Input number of task (Number from 1 to 3): "; 
    (cin>>choice).get();
    if(choice == 1){ 
        one(); 
    } 
    else if(choice == 2){ 
        two(); 
    } 
    else if(choice == 3){ 
        three(); 
    } 

return 0; 
}
