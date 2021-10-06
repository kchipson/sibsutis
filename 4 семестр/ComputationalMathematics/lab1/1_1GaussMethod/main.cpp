#include <iostream>
#include <fstream>

const int size = 3;


int main()
{
    std::ifstream file ("../in1.txt");

    double matrix[size][size+1] {0};

    /* Чтение матрицы */
    for (int i = 0 ; i < size; i++)
    {
        for (int j = 0 ; j < size + 1; j++)
        {
            file >> matrix[i][j];
        }
    }

    //    /* Вывод матрицы */
    for (int i = 0 ; i < size; i++)
    {
        for (int j = 0 ; j < size + 1; j++)
        {
            std::cout.width(10);
            std::cout << matrix[i][j];
        }
        std::cout << std::endl;
    }
    std::cout << std::endl;

    /* Прямой ход */
    for (int c = 0; c < size - 1; c++) { // Цикл по столбцам
        for (int i = c + 1; i < size; i++)  // Цикл по строкам
        {
            double coef = (matrix[i][c] / matrix[c][c]) * -1;
            for (int j = c; j < size + 1; j++) // Цикл по ячейкам
                matrix[i][j] += matrix[c][j] * coef;

        }
        for (int i = 0; i < size; i++) {
            for (int j = 0; j < size + 1; j++) {
                std::cout.width(10);
                std::cout << matrix[i][j];
            }
            std::cout << std::endl;
        }
        std::cout << std::endl;
    }



    /* Обратный ход */
    for (int c = size - 1 ; c > -1; c--)
    {
        for (int i = size - 1 ; i > c; i--)
            matrix[c][size] -=  matrix[c][i];

        matrix[c][size]	/= matrix[c][c];

        for (int i = 0 ; i < c; i++)
            matrix[i][c] *= matrix[c][size];
    }


//    std::cout << std::endl<< std::endl;
    for (int i = 0 ; i < size; i++)
    {
        std::cout.width(10);
        std::cout << matrix[i][size];
    }

}
