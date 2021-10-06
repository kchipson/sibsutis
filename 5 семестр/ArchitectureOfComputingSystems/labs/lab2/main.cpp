#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <ctype.h>
#include <string.h>
#include <stdint.h>
#include <math.h>


void getNameCPU(char cpuname[]) {
    FILE *fp;
    if ((fp = fopen("/proc/cpuinfo", "r")) == NULL) {
        printf("Can't open /proc/cpuinfo \n");
        return;
    }
    size_t m = 0;
    char *line = NULL;
    while (getline(&line, &m, fp) > 0) {
        if (strstr(line, "model name")) {
            strcpy(cpuname, &line[13]);
            break;
        }
    }
    for (int i = 0; i < 60; i++)
        if (cpuname[i] == '\n'){
            cpuname[i] = '\0';
            break;
        }
    fclose(fp);
}


int getParameters(int argc, char *argv[], long long &launchCount)
{
    for (int i = 1 ; i < argc ; i++)
    {
        if (strcmp("-l", argv[i]) == 0 || strcmp("--launch-count", argv[i]) == 0)
        {
            i++;
            size_t len = strlen(argv[i]);
            for (size_t j = 0 ; j < len ; j++)
                if (!isdigit(argv[i][j])){
                    printf("Error in arguments: invalid value for --launch-count!\nThe value must be a number!\n");
                    return 1;
                }
            launchCount = atoll(argv[i]);
        }
        else {
            printf("Error in arguments: unknown key \"%s\"\n", argv[i]);
            return 1;
        }
    }
    return 0;
}
void DGEMM(int** matrixA, int** matrixB, int** matrixC, long long matrixSize){
    for (long long i = 0; i < matrixSize; i++)
        for (long long j = 0; j < matrixSize; j++){
            matrixC[i][j] += 0;
            for (long long k = 0; k < matrixSize; k++)
                matrixC[i][j] += matrixA[i][k] * matrixB[k][j];
        }
}
void DGEMM(long long** matrixA, long long** matrixB, long long** matrixC, long long matrixSize){
    for (long long i = 0; i < matrixSize; i++)
        for (long long j = 0; j < matrixSize; j++){
            matrixC[i][j] += 0;
            for (long long k = 0; k < matrixSize; k++)
                matrixC[i][j] += matrixA[i][k] * matrixB[k][j];
        }
}

void DGEMM(double** matrixA, double** matrixB, double** matrixC, long long matrixSize){
    for (long long i = 0; i < matrixSize; i++)
        for (long long j = 0; j < matrixSize; j++){
            matrixC[i][j] += 0;
            for (long long k = 0; k < matrixSize; k++)
                matrixC[i][j] += matrixA[i][k] * matrixB[k][j];
        }
}

int outToCSV(char* nameCPU, char* type, long long launchCount, double averageTime, double* time, double dispersion, long long matrixSize)
{
    FILE *fp;
    if (!(fp = fopen("output.csv", "a"))){
        printf("Error: can't open/find output.csv\n");
        return 1;
    }    
    fprintf(fp, "%s;%s;%s;%s;%lld;%lld;%s;%e;%e;%e;%e;\n",
            nameCPU, 
            "matrixMultiplication",
            type,
            "O0",
            launchCount,
            launchCount * matrixSize * matrixSize,
            "clock()",
            averageTime,
            sqrt(abs(dispersion)),
            abs(dispersion) / averageTime,
            (launchCount * matrixSize * matrixSize) / averageTime);
    fclose(fp);
    return 0;
}

int main(int argc, char *argv[]) {
    srand(time(0));
    long long matrixSize = 100;
    long long launchCount = 100;
    char cpuname[60];
    getNameCPU(cpuname);
    
    clock_t start, stop;

    if (getParameters(argc, argv, launchCount))
        return 1;
    printf("matrixSize = %lld\n", matrixSize);
    printf("launchCount = %lld\n", launchCount);

    double timeSum = 0;
    double dispersion = 0;
    double summand1 = 0;
    double summand2 = 0;
    double time[launchCount];

    //////////////////////////
    timeSum = 0;
    summand1 = 0;
    summand2 = 0;
    

    int **matrixA_i = new int*[matrixSize];
    int **matrixB_i = new int*[matrixSize];
    int **matrixRes_i = new int*[matrixSize];

    for (long long i = 0; i < matrixSize; i++) {
        matrixA_i[i] = new int[matrixSize];
        matrixB_i[i] = new int[matrixSize];
        matrixRes_i[i] = new int[matrixSize];
        for (long long j = 0; j < matrixSize; j++) {
            matrixA_i[i][j] = rand() / 10000;
            matrixB_i[i][j] = rand() / 10000;
            matrixRes_i[i][j] = 0;
        }
    }

    for (long long i = 0; i < launchCount; i++) {
        start = clock();
        DGEMM(matrixA_i, matrixB_i, matrixRes_i, matrixSize);
        stop = clock();
        time[i] = ((double)(stop - start)) / CLOCKS_PER_SEC;
        timeSum += time[i];
        summand1 += time[i] * time[i];
        summand2 += time[i];
    }

    dispersion = summand1 / launchCount - summand2 / launchCount;

    outToCSV(cpuname, (char*)"int**", launchCount, timeSum / launchCount, time, dispersion, matrixSize);

    for (long long i = 0; i < matrixSize; i++) {
        delete(matrixA_i[i]);
        delete(matrixB_i[i]);
        delete(matrixRes_i[i]);
    }
    delete[](matrixA_i);
    delete[](matrixB_i);
    delete[](matrixRes_i);
    //////////////////////////
    timeSum = 0;
    summand1 = 0;
    summand2 = 0;

    long long **matrixA_ll = new long long*[matrixSize];
    long long  **matrixB_ll = new long long*[matrixSize];
    long long  **matrixRes_ll = new long long*[matrixSize];

    for (long long i = 0; i < matrixSize; i++) {
        matrixA_ll[i] = new long long[matrixSize];
        matrixB_ll[i] = new long long[matrixSize];
        matrixRes_ll[i] = new long long[matrixSize];
        for (long long j = 0; j < matrixSize; j++) {
            matrixA_ll[i][j] = rand() / 10000;
            matrixB_ll[i][j] = rand() / 10000;
            matrixRes_ll[i][j] = 0;
        }
    }

    for (long long i = 0; i < launchCount; i++) {
        start = clock();
        DGEMM(matrixA_ll, matrixB_ll, matrixRes_ll, matrixSize);
        stop = clock();
        time[i] = ((double)(stop - start)) / CLOCKS_PER_SEC;
        timeSum += time[i];
        summand1 += time[i] * time[i];
        summand2 += time[i];
    }

    dispersion = summand1 / launchCount - summand2 / launchCount;

    outToCSV(cpuname, (char*)"long long**", launchCount, timeSum / launchCount, time, dispersion, matrixSize);

    for (long long i = 0; i < matrixSize; i++) {
        delete(matrixA_ll[i]);
        delete(matrixB_ll[i]);
        delete(matrixRes_ll[i]);
    }
    delete[](matrixA_ll);
    delete[](matrixB_ll);
    delete[](matrixRes_ll);
    //////////////////////////
    timeSum = 0;
    summand1 = 0;
    summand2 = 0;

    double **matrixA_d = new double*[matrixSize];
    double **matrixB_d = new double*[matrixSize];
    double **matrixRes_d = new double*[matrixSize];

    for (long long i = 0; i < matrixSize; i++) {
        matrixA_d[i] = new double[matrixSize];
        matrixB_d[i] = new double[matrixSize];
        matrixRes_d[i] = new double[matrixSize];
        for (long long j = 0; j < matrixSize; j++) {
            matrixA_d[i][j] = rand() / 10000 + (double)rand() / RAND_MAX;
            matrixB_d[i][j] = rand() / 10000 + (double)rand() / RAND_MAX;
            matrixRes_d[i][j] = 0;
        }
    }

    for (long long i = 0; i < launchCount; i++) {
        start = clock();
        DGEMM(matrixA_d, matrixB_d, matrixRes_d, matrixSize);
        stop = clock();
        time[i] = ((double)(stop - start)) / CLOCKS_PER_SEC;
        timeSum += time[i];
        summand1 += time[i] * time[i];
        summand2 += time[i];
    }

    dispersion = summand1 / launchCount - summand2 / launchCount;

    outToCSV(cpuname, (char*)"double**", launchCount, timeSum / launchCount, time, dispersion, matrixSize);

    for (long long i = 0; i < matrixSize; i++) {
        delete(matrixA_d[i]);
        delete(matrixB_d[i]);
        delete(matrixRes_d[i]);
    }
    delete[](matrixA_d);
    delete[](matrixB_d);
    delete[](matrixRes_d);
    return 0;
}
