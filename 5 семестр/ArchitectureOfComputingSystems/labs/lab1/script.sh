#!/bin/bash


echo "Дата: $(date +"%d-%m-%Y");"
echo
echo "Имя учетной записи: $(whoami);"
echo "Доменное имя ПК:    $(hostname);"
echo


processor=$(lscpu)
# processor_model=$(echo "$processor" | grep "Имя модели"  | sed 's/Имя модели: [ \t]*//')
processor_model=$(echo "$processor" | sed -n 's|^Имя модели:[ \t]*||p')
processor_architecture=$(echo "$processor" | sed -n 's|^Архитектура:[ \t]*||p')
processor_clock_frequency=$(echo "$processor" | sed -n 's|^CPU MHz:[ \t]*||p')
processor_cores=$(echo "$processor" | sed -n 's|^CPU(s):[ \t]*||p')
processor_threads_per_core=$(echo "$processor" | sed -n 's|^Thread(s) per core:[ \t]*||p')

echo "Процессор:"
echo "  • Модель                          – $processor_model"
echo "  • Архитектура                     – $processor_architecture"
echo "  • Тактовая частота                – $processor_clock_frequency MHz"
echo "  • Количество ядер                 – $processor_cores"
echo "  • Количество потоков на одно ядро – $processor_threads_per_core"
echo

RAM=$(free -h)
RAM_all=$(echo "$RAM"  | grep "Mem" | awk '{ print $2 }')
RAM_available=$(echo "$RAM"  | grep "Mem" | awk '{ print $7 }')
SWAP_all=$(echo "$RAM"  | grep "Swap" | awk '{ print $2 }')
SWAP_available=$(echo "$RAM"  | grep "Swap" | awk '{ print $4 }')

echo "Оперативная память:"
echo "  • Всего    – $RAM_all"
echo "  • Доступно – $RAM_available"
echo

hardDrive=$(df -h 2> /dev/null| grep '/$')
hardDrive_all=$(echo "$hardDrive" | awk '{ print $2 }')
hardDrive_available=$(echo "$hardDrive" | awk '{ print $4 }')
hardDrive_root=$(echo "$hardDrive" | awk '{ print $1 }')

echo "Жесткий диск:"
echo "  • Всего    – $hardDrive_all"
echo "  • Доступно – $hardDrive_available"
echo "  • Смонтировано в корневую директорию / – $hardDrive_root"
echo "  • SWAP всего    – $SWAP_all"
echo "  • SWAP доступно – $SWAP_available"
echo

networkNames=$(ip address show | awk '/^[0-9]+:/ { print $2 }' | sed 's|:||')
echo "Сетевые интерфейсы:"
echo "  • Количество сетевых интерфейсов – $(echo $networkNames | wc -w)"
echo 

temp=$(mktemp)
num=0
for name in $networkNames; do
    num=$(($num + 1))
    mac=$(ip address show "$name" | grep 'link' | awk 'NR==1{print $2}')
    ip=$(ip address show "$name" | grep 'inet' | awk 'NR==1{print $2}')    
    echo "$num|$name|$mac|$ip" >> $temp
done
column -t -s '|' -N '#','Имя сетевого интерфейса','МАС адрес','IP адрес' $temp
rm $temp
