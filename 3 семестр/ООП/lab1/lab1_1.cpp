#include <iostream>
#include <cstdlib>
#include <ctime>

using namespace std;

int *genRandArray(int size, int maxValue)
{
	int *arr = new int[size + 1];
	arr[0] = size;
	for (int i = 0; i < size; i++)
	{
		arr[i + 1] = rand() % maxValue;
	}
	return arr;
};

void print(int *arr)
{
	for (int i = 0; i < arr[0]; i++)
	{
		cout << arr[i + 1] << " | ";
		}
};

int main()
{
	srand(time(0));
	int size = rand() % 10 + 1;
	cout << size << ": ";
	int maxValue = 100;
	int *arr = genRandArray(size, maxValue);
	print(arr);
	//очистка выделенной памяти
	delete[] arr;
};
