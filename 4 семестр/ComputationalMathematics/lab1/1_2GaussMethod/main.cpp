#include <iostream>
#include <fstream>
const int size = 3 ;

void printMatrix(double **m){
    for (int i = 0 ; i < size ; i++)
    {
        for (int j = 0 ; j < size + 1 ; j++)
        {
            std::cout.width(10) ;
            std::cout << m[i][j] ;
        }
        std::cout << "\n" ;
    }
    std::cout << "\n\n" ;
}
int main() {
    std::ifstream file("../in1.txt") ;

    double** matrix;
    /* Выделение памяти */
    matrix = new double*[size] ;
    for (int i = 0 ; i < size ; i++)
        matrix[i] = new double[size + 1] ;

    /* Чтение матрицы */
    for (int i = 0 ; i < size ; i++)
        for (int j = 0; j < size + 1 ; j++)
            file >> matrix[i][j] ;

    printMatrix(matrix) ;

    /* Прямой ход */
    for (int c = 0 ; c < size - 1 ; c++){ // Цикл по столбцам
        int max = c ;
        for (int i = c + 1 ; i < size ; i++)  // Цикл по строкам
            if (std::abs(matrix[max][c]) < std::abs(matrix[i][c]))
                max = i ;
        if (max != c){
            double * temp = matrix[max] ;
            matrix[max] = matrix[c] ;
            matrix[c] = temp ;
            std::cout << "\033[32m\tПроизошел свап!\033[0m\n" ;
            printMatrix(matrix) ;
        }

        for (int i = c + 1; i < size; i++)  // Цикл по строкам
        {
            double coef = (matrix[i][c] / matrix[c][c]) * -1;
            for (int j = c; j < size + 1; j++) // Цикл по ячейкам
                matrix[i][j] += matrix[c][j] * coef;
        }
        printMatrix(matrix) ;
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
