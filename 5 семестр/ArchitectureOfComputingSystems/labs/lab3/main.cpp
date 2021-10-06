#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <ctype.h>
#include <string.h>
#include <stdint.h>


int getParameters(int argc, char *argv[], char* memType, long long &blockSize, long long &launchCount)
{
    for (int i = 1 ; i < argc ; i++)
    {
        if (strcmp("-m", argv[i]) == 0 || strcmp("--memory-type", argv[i]) == 0)
        {
            i++;
            // if (strcmp("RAM", argv[i]) == 0 || strcmp("SSD", argv[i]) == 0 || strcmp("flash", argv[i]) == 0) == 0 || strcmp("HDD", argv[i]) == 0) == 0 )
            if (strcmp("RAM", argv[i]) == 0 || strcmp("SSD", argv[i]) == 0)
                strcpy(memType, argv[i]);
            else {
                printf("Error in arguments: invalid value for --memory-type! (possible RAM, SSD)\n");
                return 1;
            }
        }
        else if (strcmp("-b", argv[i]) == 0 || strcmp("--block-size", argv[i]) == 0)
        {
            i++;
            size_t len = strlen(argv[i]);
            int coeff = 1;

            if (argv[i][len-1] == 'b') {
                if (argv[i][len-2] == 'K')
                    coeff = 1024;
                else if (argv[i][len-2] == 'M')
                    coeff = 1024 * 1024;
                else {
                    printf("Error in arguments: invalid value for --block-size!\nIncorrect unit of measurement (possible Mb, Kb, or no unit of measurement if you need to set the size in bytes)\n");
                    return 1;
                }
                argv[i][len - 2] = '\0';
                len -= 2;
            }
            for (size_t j = 0 ; j < len; j++)
                if (!isdigit(argv[i][j])){
                    printf("Error in arguments: invalid value for --block-size!\nThe value must be a number!\n");
                    return 1;
                }
            blockSize = atoll(argv[i]) * coeff;
        }
        else if (strcmp("-l", argv[i]) == 0 || strcmp("--launch-count", argv[i]) == 0)
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

int testRAM(long long memSize, double &writeTime, double &readTime)
{
    uint8_t* origArr = (uint8_t*) malloc(memSize / sizeof(uint8_t));
    uint8_t* newArr = (uint8_t*) malloc(memSize / sizeof(uint8_t));
    clock_t start, stop;

    for (long long i = 0; i < memSize; i++)
        origArr[i] = rand() % 256;
    
    start = clock();
    for (long long i = 0; i < memSize; i++)
        newArr[i] = origArr[i];
    stop = clock();

    writeTime = ((double)(stop - start)) / CLOCKS_PER_SEC;
    readTime = writeTime;
    
    free(origArr);
    free(newArr);
    
    return 0;
}


int testStorageDevice(char* filepath, long long memSize, double &writeTime, double &readTime)
{
    uint8_t* arr = (uint8_t*) malloc(memSize / sizeof(uint8_t));
    FILE *fp;
    clock_t start, stop;

    for (long long i = 0; i < memSize; i++)
        arr[i] = rand() % 256;
        
    if ((fp = fopen(filepath, "w")) == NULL) {
        printf("Error: can't open file \"%s\"\n", filepath);
        return 1;
    }

    start = clock();
    for (long long i = 0; i < memSize; i++)
        fprintf(fp, "%c", arr[i]);
    stop = clock();
    writeTime = ((double)(stop - start)) / CLOCKS_PER_SEC;
    fclose(fp);

    if ((fp = fopen(filepath, "r")) == NULL) {
        printf("Error: can't open file \"%s\"\n", filepath);
        return 1;
    }

    start = clock();
    for (long long i = 0; i < memSize; i++)
        fscanf(fp, "%c", &arr[i]);
    stop = clock();
    readTime = ((double)(stop - start)) / CLOCKS_PER_SEC;
    fclose(fp);
    free(arr);
    if (-1 == remove(filepath))
        printf("Error: failed to delete file \"%s\"\n", filepath);
    return 0;
}


int outToCSV(char* memType, long long blockSize, long long launchCount, double* writeTime, double averageWriteTime, double* readTime, double averageReadTime)
{
    FILE *fp;
    if (!(fp = fopen("output.csv", "a"))){
        printf("Error: can't open/find output.csv\n");
        return 1;
    }    
    for (long long i = 0; i < launchCount; i++)
        fprintf(fp, "%s;%lld;%s;%lu;%lld;%s;%e;%e;%e;%e;%e;%e;%e;%e;%e;%e;\n",
        memType, 
        blockSize, 
        "uint8_t", 
        sizeof(uint8_t),
        i + 1,
        "clock()",
        writeTime[i],
        averageWriteTime,
        blockSize / averageWriteTime * 1e6,
        abs(writeTime[i] - averageWriteTime),
        abs(writeTime[i] - averageWriteTime) / averageWriteTime * 100,
        readTime[i],
        averageReadTime,
        blockSize / averageReadTime * 1e6,
        abs(readTime[i] - averageReadTime),
        abs(readTime[i] - averageReadTime) / averageReadTime * 100);

    return 0;
}


int main(int argc, char *argv[]) {
    srand(time(0));
    
    char* memType = (char*) malloc(6);
    strcpy(memType, "RAM\0");
    long long blockSize = 1024;
    long long launchCount = 1;

    if (getParameters(argc, argv, memType, blockSize, launchCount))
        return 1;
    printf("arguments:\n");
    printf("memType = %s \n", memType);
    printf("blockSize = %lld bytes \n", blockSize);
    printf("launchCount = %lld \n", launchCount);


    double writeTimeSum = 0;
    double readTimeSum = 0;
    double writeTime[launchCount];
    double readTime[launchCount];

    for (long long i = 0; i < launchCount; i++) {
        
        if (strcmp("RAM", memType) == 0){
            if (testRAM(blockSize, writeTime[i], readTime[i]))
                return 1;
        }
        else {
            char filepath[1024];
            if (strcmp("SSD", memType) == 0)
                strcpy (filepath, "TestSSD.txt");
            if (testStorageDevice(filepath, blockSize, writeTime[i], readTime[i]))
                return 1;
        }
        writeTimeSum += writeTime[i];
        readTimeSum += readTime[i];
    }



    outToCSV(memType, blockSize, launchCount, writeTime, writeTimeSum / launchCount, readTime, readTimeSum / launchCount);
    free(memType);
    return 0;
}
