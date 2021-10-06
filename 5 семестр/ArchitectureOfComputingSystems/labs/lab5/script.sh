#!/bin/bash

echo "Type;ThreadsCount;MatrixSize;Time;Timer;" > ./output.csv
make

size=256

from=1
to=16
step=2

for (( i=$from; i<=$to; i*=$step ))
do
./main.out -s $size -t $i
done

filename=$(echo output_$size\_$from\_$to\_$step)
echo $filename
mv ./output.csv ./$filename.csv

gnuplot -e "inFile='$filename.csv';outFile='$filename.png';titleName='Matrix $size x $size'" ./graphs.plg
