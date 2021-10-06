#!/bin/bash

# echo "MemoryType;BlockSize;ElementType;BufferSize;LaunchNum;Timer;WriteTime;AverageWriteTime;WriteBandwidth;AbsError(write);RelError(write);ReadTime;AverageReadTime;ReadBandwidth;AbsError(read);RelError(read);" > ./output.csv

# make

# array=(256 2048 4096 8192 16384) # KiB
# for i in ${array[@]}; 
# do
# ./main.out -b $i\Kb -m RAM -l 10
# done

# # mv ./output.csv ./output_RAM.csv
# # echo "MemoryType;BlockSize;ElementType;BufferSize;LaunchNum;Timer;WriteTime;AverageWriteTime;WriteBandwidth;AbsError(write);RelError(write);ReadTime;AverageReadTime;ReadBandwidth;AbsError(read);RelError(read);" > ./output.csv
# for (( i=1; i<=20; i+=1 ))
# do
# ./main.out -b $(($i*4))\Mb -m SSD -l 10
# done

gnuplot ./graphs.plg
