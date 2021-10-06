#!/bin/bash

echo "Type;MatrixSize;Time;Timer;" > ./output.csv
make


array=(100 200 300 400 500 600 700 800 900 1000 1100 1200 1300 1400 1500)
for i in ${array[@]}; 
do
./main.out -s $i
done

gnuplot ./graphs.plg
