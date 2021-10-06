#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <ctype.h>
#include <string.h>
#include <stdint.h>


int getParameters(int argc, char *argv[], long long &matrixSize){
    for (int i = 1 ; i < argc ; i++)
    {
        if (strcmp("-s", argv[i]) == 0 || strcmp("--matrix-size", argv[i]) == 0)
        {
            i++;
            size_t len = strlen(argv[i]);
            for (size_t j = 0 ; j < len; j++)
                if (!isdigit(argv[i][j])){
                    printf("Error in arguments: invalid value for --matrix-size!\nThe value must be a number!\n");
                    return 1;
                }
            matrixSize = atoll(argv[i]);
        }
        else {
            printf("Error in arguments: unknown key \"%s\"\n", argv[i]);
            return 1;
        }
    }
    return 0;
}

void printMatrix(double **matrix, long long size){
    for (long long i = 0; i < size; i++) {
        for (long long j = 0; j < size; j++)
            printf("%.6f ", matrix[i][j]);
        printf("\n");
    }
}

void DGEMM(double** matrixA, double** matrixB, double** matrixC, long long matrixSize){
    for (long long i = 0; i < matrixSize; i++)
        for (long long j = 0; j < matrixSize; j++)
            for (long long k = 0; k < matrixSize; k++)
                matrixC[i][j] += matrixA[i][k] * matrixB[k][j];

}
void DGEMM_opt1(double** matrixA, double** matrixB, double** matrixC, long long matrixSize){
    for (long long i = 0; i < matrixSize; i++)
        for (long long k = 0; k < matrixSize; k++)
            for (long long j = 0; j < matrixSize; j++)
                matrixC[i][j] += (double)matrixA[i][k] * matrixB[k][j];
}

int outToCSV(char* type, long long matrixSize, double Time){
    FILE *fp;
    if (!(fp = fopen("output.csv", "a"))){
        printf("Error: can't open/find output.csv\n");
        return 1;
    }
    fprintf(fp, "%s;%lld;%e;%s;\n", type, matrixSize, Time, "clock()");
    fclose(fp);
    return 0;
}

int main(int argc, char *argv[]) {
    srand(time(0));
    long long matrixSize = 10;
    clock_t start, stop;

    if (getParameters(argc, argv, matrixSize))
        return 1;
    printf("arguments:\n");
    printf("matrixSize = %lld\n", matrixSize);


    double **matrixA = new double*[matrixSize];
    double **matrixB = new double*[matrixSize];
    double **matrixRes = new double*[matrixSize];

    for (long long i = 0; i < matrixSize; i++) {
        matrixA[i] = new double[matrixSize];
        matrixB[i] = new double[matrixSize];
        matrixRes[i] = new double[matrixSize];
        for (long long j = 0; j < matrixSize; j++) {
            matrixA[i][j] = rand() / 10000 + (double)rand() / RAND_MAX;
            matrixB[i][j] = rand() / 10000 + (double)rand() / RAND_MAX;
            matrixRes[i][j] = 0;
        }
    }
        

    double time;

    start = clock();
    DGEMM(matrixA, matrixB, matrixRes, matrixSize);
    stop = clock();
    time = ((double)(stop - start)) / CLOCKS_PER_SEC;

    outToCSV((char*)"usual", matrixSize, time);

    for (long long i = 0; i < matrixSize; i++)
        for (long long j = 0; j < matrixSize; j++)
            matrixRes[i][j] = 0;


    start = clock();
    DGEMM_opt1(matrixA, matrixB, matrixRes, matrixSize);
    stop = clock();

    time = ((double)(stop - start)) / CLOCKS_PER_SEC;
    
    outToCSV((char*)"line-by-line", matrixSize, time);


    for (long long i = 0; i < matrixSize; i++) {
        delete(matrixA[i]);
        delete(matrixB[i]);
        delete(matrixRes[i]);
    }
    delete[](matrixA);
    delete[](matrixB);
    delete[](matrixRes);
    return 0;
}

// Кэш-промахи:
// sudo perf stat -e cache-references,cache-misses  ./main.out -s 500
