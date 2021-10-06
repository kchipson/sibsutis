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

int **genRandMatrix(int intsize, int intmaxValue)
{
	int **arr = new int *[intsize];
	for (int i = 0; i < intsize; i++)
	{
		arr[i] = genRandArray(rand() % 10 + 1, intmaxValue);
	}
	return arr;
};

void printMatrix(int **matrix, int intmaxValue)
{
	for (int i = 0; i < intmaxValue; i++)
	{
		cout << matrix[i][0] << ": ";
		for (int j = 0; j < matrix[i][0] - 1; j++)
		{

			cout << matrix[i][j + 1] << " | ";
		}
		cout << matrix[i][(matrix[i][0] - 1)];
		cout << endl;
	}
};

int main()
{
	srand(time(0));
	int size = rand() % 10 + 1;
	cout << size << endl;
	int maxValue = 100;
	int **matrix = genRandMatrix(size, maxValue);
	printMatrix(matrix, size);

	//очистка выделенной памяти
	for (int i = 0; i < size; i++)
	{
		delete[] matrix[i];
	}
	delete[] matrix;
};
