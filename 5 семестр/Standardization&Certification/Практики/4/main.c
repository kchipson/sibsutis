#include <stdio.h>

void multiplication(int n, float A[][n], float B[][n], float C[][n]){
    for ( int i = 0; i < n; i++ ) {
        for ( int j = 0; j < n; j++ ){
            C[i][j] = 0;
            for ( int k = 0; k < n; k++ )
                C[i][j] += A[i][k] * B[k][j];

        }

    }
    return;
}

int main() {
    int n = 3;
    printf("n: %d\n", n);
    float A[n][n];
    for ( int i = 0; i < n; i++ ) {
        for ( int j = 0; j < n; j++ )
            A[i][j] = j + 1 + i * n;
    }
    printf("A:\n");
    for (int i = 0; i < n; i++ ) {
        for (int j = 0; j < n; j++ )
        {
            printf("%12f ", A[i][j]);
        }
        printf( "\n" );
    }

    float B[n][n];
    for ( int i = 0; i < n; i++ ) {
        for ( int j = 0; j < n; j++ )
            B[i][j] = (i + 1) * (j + 1);
    }

    printf("B:\n");
    for (int i = 0; i < n; i++ ) {
        for (int j = 0; j < n; j++ )
        {
            printf("%12f ", B[i][j]);
        }
        printf( "\n" );
    }

    float C[n][n];
    multiplication(n, A, B, C);
    printf("C:\n");
    for (int i = 0; i < n; i++ ) {
        for (int j = 0; j < n; j++ )
        {
            printf("%12f ", C[i][j]);
        }
        printf( "\n" );
    }

    return 0;
}
