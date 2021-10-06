#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <ctype.h>
#include <string.h>
#include <stdint.h>
#include <pthread.h>
#include <omp.h>

struct DGEMMArgs {
    double **matrixA;
    double **matrixB;
    double **matrixRes;
    long long matrixSize;
    long long  from;
    long long  to;
};

int getParameters(int argc, char *argv[], long long &matrixSize,long long &threadsCount){
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
        else if (strcmp("-t", argv[i]) == 0 || strcmp("--threads-count", argv[i]) == 0)
        {
            i++;
            size_t len = strlen(argv[i]);
            for (size_t j = 0 ; j < len ; j++)
                if (!isdigit(argv[i][j])){
                    printf("Error in arguments: invalid value for --threads-count!\nThe value must be a number!\n");
                    return 1;
                }
            threadsCount = atoll(argv[i]);
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

void * DGEMM_BLASS_ForThread(void *threadArgs){
    DGEMMArgs *arg = (struct DGEMMArgs*) threadArgs;
    for (long long i = arg->from; i < arg->to; i++)
        for (long long j = 0; j < arg->matrixSize; j++){
            arg->matrixRes[i][j] = 0;
            for (long long k = 0; k < arg->matrixSize; k++)
                arg->matrixRes[i][j] += arg->matrixA[i][k] * arg->matrixB[k][j];
        }
    return nullptr;
}

void DGEMM_BLASS_openMP(double** matrixA, double** matrixB, double** matrixRes, long long matrixSize){
    long long i, j, k;
    #pragma omp parallel for private(i, j, k) shared (matrixA, matrixB, matrixRes)
        for (i = 0; i < matrixSize; ++i)
            for (j = 0; j < matrixSize; ++j) {
                matrixRes[i][j] = 0;
                for (k = 0; k < matrixSize; ++k)
                    matrixRes[i][j] += matrixA[i][k] * matrixB[k][j];
            }
}

int outToCSV(char* type, long long threadsCount, long long matrixSize, double time){
    FILE *fp;
    if (!(fp = fopen("output.csv", "a"))){
        printf("Error: can't open/find output.csv\n");
        return 1;
    }
    // fprintf(fp, "Type;threadsCount;matrixSize;time;Timer;\n");
    fprintf(fp, "%s;%lld;%lld;%e;%s;\n",
            type,
            threadsCount,
            matrixSize,
            time,
            "clock_gettime()");
    
    fclose(fp);
    return 0;
}

int main(int argc, char *argv[]) {
    srand(time(0));
    struct timespec mt1{}, mt2{};
    double time;

    long long matrixSize = 10;
    long long threadsCount = 1;

    if (getParameters(argc, argv, matrixSize, threadsCount))
        return 1;
    printf("arguments:\n");
    printf("matrixSize = %lld \n", matrixSize);
    printf("threadsCount = %lld \n", threadsCount);

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

    /////////////////////////////////////

    time = 0;

    DGEMMArgs* argsThreads = new DGEMMArgs[threadsCount];
    pthread_t *threads = new pthread_t[threadsCount];

    int status = 0;
    for (long long i = 0; i < threadsCount; i++) {
        argsThreads[i].matrixA = matrixA;
        argsThreads[i].matrixB = matrixB;
        argsThreads[i].matrixRes = matrixRes;
        argsThreads[i].matrixSize = matrixSize;
        argsThreads[i].from = matrixSize / threadsCount * i;
        argsThreads[i].to = matrixSize / threadsCount * (i + 1);
    }
    clock_gettime(CLOCK_REALTIME, &mt1);
    for (long long i = 0; i < threadsCount; i++)
        if (pthread_create(&threads[i], NULL, DGEMM_BLASS_ForThread, &argsThreads[i])) {
            printf("Error: Creating thread #%lld", i);
            return 1;
        }
    for (long long i = 0; i < threadsCount; i++)
        status += pthread_join(threads[i], nullptr);
    if (status != 0)
        printf("Error: Matrix multiplication failed (POSIX) \n");

    clock_gettime(CLOCK_REALTIME, &mt2);
    time = (double) (mt2.tv_sec - mt1.tv_sec) + (double) (mt2.tv_nsec - mt1.tv_nsec) / 1e9;
    outToCSV((char*)"POSIX", threadsCount, matrixSize, time);




    /////////////////////////////////////
    time = 0;
    omp_set_dynamic(0);
    omp_set_num_threads(threadsCount);
    clock_gettime(CLOCK_REALTIME, &mt1);
    DGEMM_BLASS_openMP(matrixA, matrixB ,matrixRes, matrixSize);
    clock_gettime(CLOCK_REALTIME, &mt2);
    time = (double) (mt2.tv_sec - mt1.tv_sec) + (double) (mt2.tv_nsec - mt1.tv_nsec) / 1e9;
    outToCSV((char*)"OpenMP", threadsCount, matrixSize, time);


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


