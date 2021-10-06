#include <iostream>
#include <regex>
#include <fstream>
#include <iomanip>

short currCellVar = 99 ; // адрес ячейки, в которую будет записана текущая (переменная || константа)
short currCellComm = 0 ; // адрес ячейки, в которую будет записана текущая команда


struct variable{
    variable(std::string title, short address){
        this->address = address ;
        this->title = title ;
    }
    std::string title ;
    short address ;
};

struct commandSA{
    commandSA(short cell, const std::string &command, short operand) {
        this->cell = cell ;
        this->command = command ;
        this->operand = operand ;
    }
    short cell ;  // адрес ячейки
    std::string command ; // команда (на языке Assembler)
    short operand ; // операнд (0..99)
};

std::map<std::string, short> startCommands ;  // Начало команд (всё ради goto :3) | Строка в SB, адрес ячейки в SA
std::vector<variable> variables ; // вектор с переменными и константами
std::vector<commandSA> commands ; // вектор с командами
std::vector<short> queueGoTo ;


const std::regex basicCheckLine(R"((\d+)\s+(REM|INPUT|PRINT|LET|GOTO|IF|END)\s*(.*))") ;

const std::regex varCheck(R"(([A-Z])\s*)") ;
const std::regex numCheck(R"((\-?\d+)\s*)") ;
const std::regex numLineCheck(R"((\d+)\s*)") ;


short checkPresenceVar(const std::string& str) ;

int commInput(const std::string& operand, const std::string& line) ;
int commPrint(const std::string& operand, const std::string& line) ;
int  commGoTo(const std::string& operand, const std::string& line) ;
int   commLet(const std::string& operand, const std::string& line) ;
int   commEnd(const std::string& operand, const std::string& line) ;
int    commIf(const std::string& operand, const std::string& line) ;

int main(int argc, char* argv[]) {
    /* Проверки корректности аргументов */
    if (argc != 3)
    {
        printf("\033[38;5;196mThe number of arguments does not match the condition!\033[0m \nThe translator launch command must look like: simpleBasic file.sb file.sa, where file.sb – name of the file that contains the program in Simple Basic, file.sa - translation result\n") ;
        return -1 ;
    }
    if(!regex_match(argv[1], std::regex(R"(\w+\.sb)"))){
        printf("\033[38;5;196mThe extension of the first argument, \"%s\", does not match the conditions\033[0m \nTThe translator launch command must look like: simpleBasic file.sb file.sa, where file.sb – name of the file that contains the program in Simple Basic, file.sa - translation result\n", argv[1]) ;
        return -1 ;
    }
    if(!regex_match(argv[2], std::regex(R"(\w+\.sa)"))){
        printf("\033[38;5;196mThe extension of the second argument, \"%s\", does not match the conditions\033[0m \nThe translator launch command must look like: simpleBasic file.sb file.sa, where file.sb – name of the file that contains the program in Simple Basic, file.sa - translation result\n", argv[1]) ;
        return -1 ;
    }

    /* Открытие входного файла */
    std::ifstream inFile(argv[1]) ;
    if(!inFile.is_open()){
        printf("\033[38;5;196mUnable to open the \"%s\" file. \033[0m \nCheck whether the file is in the directory, as well as access rights.\n", argv[1]) ;
        return -1 ;
    }

    std::string line ; // Строка
    short int prevLine = -1 ; // Номер предыдущей строки
    bool checkMainEnd = false ;
    std::cmatch parsedLine ; // Строка, разбитая по регулярке

    /* Построчное считывание */
    while (getline(inFile, line)){
        if (regex_match(line, std::regex(R"(\s*)")))
            continue ;
        if (!regex_match(line.c_str(), parsedLine, basicCheckLine)) {
            printf("\033[38;5;196mInvalid line\033[0m\n\"%s\"\n", line.c_str()) ;
            return -1 ;
        }
        short tmp = stoi(parsedLine[1]);
        if (prevLine >= tmp){
            printf("\033[38;5;196mInvalid line | The line number must increase and must not be repeated.\033[0m\n\"%s\"\n", line.c_str()) ;
            return -1 ;
        }
        prevLine = tmp ;
        std::string command = parsedLine[2] ;

        if (command == "REM"){
            continue ;
        }
        else if(command == "INPUT"){
            std::string operand = parsedLine[3] ;
            startCommands[parsedLine[1]] = currCellComm ;
            if (commInput(operand, line))
                return -1 ;

        }
        else if(command == "PRINT"){
            std::string operand = parsedLine[3] ;
            startCommands[parsedLine[1]] = currCellComm ;
            if (commPrint(operand, line))
                return -1 ;

        }

        else if(command == "GOTO"){
            std::string operand = parsedLine[3] ;
            startCommands[parsedLine[1]] = currCellComm ;
            if (commGoTo(operand, line))
                return -1 ;
        }
        else if(command == "LET"){
            std::string operand = parsedLine[3] ;
            startCommands[parsedLine[1]] = currCellComm ;
            if (commLet(operand, line))
                return -1 ;
        }
        else if(command == "END"){
            std::string operand = parsedLine[3] ;
            startCommands[parsedLine[1]] = currCellComm ;
            if (commEnd(operand, line))
                return -1 ;
            checkMainEnd = true ;
            break;
        }
        else if(command == "IF"){
            std::string operand = parsedLine[3] ;
            startCommands[parsedLine[1]] = currCellComm ;
            if (commIf(operand, line))
                return -1 ;
        }

        if (currCellComm > currCellVar){
            printf("\033[38;5;196mError ! The program didn't have enough memory!\033[0m\n") ;
            return -1 ;
        }
    }
    inFile.close();

    if (!checkMainEnd){
        printf("\033[38;5;196mError! The main end is not found!\033[0m\n") ;
        return -1 ;
    }


    /* Вторичный проход по goto */
    for (auto  &i : queueGoTo){
        if(startCommands.find(std::to_string(commands[i].operand)) == startCommands.end()){ // Если не нашел
            printf("\033[38;5;196mInvalid operand for \"goto\". | GoTo refers to a nonexistent string\033[0m\n") ;
            return -1 ;
        }
        else{
            short addressOperand = startCommands.find(std::to_string(commands[i].operand))->second ;
            commands[i].operand = addressOperand ;
        }
    }

    /* Запись в файл */
    std::ofstream outFile(argv[2]) ;
    if(!outFile.is_open()){
        printf("\033[38;5;196mUnable to open the \"%s\" file.\033[0m\n\tCheck your access rights.\n", argv[2]) ;
        return -1 ;
    }

    // Запись команд
    for (auto &i: commands)
        outFile << std::setfill('0') << std::setw(2) << i.cell << " " << i.command << " " << std::setfill('0') << std::setw(2) << i.operand << std::endl ;

    // Запись переменных
    for (int i = variables.size() - 1 ; i >=0 ; i--)
        if (regex_match(variables[i].title, varCheck))
            outFile << std::setfill('0') << std::setw(2) << variables[i].address << " " << "=" << " " << "0" << std::endl ;
        else{
            outFile << std::setfill('0') << std::setw(2) << variables[i].address << " = " ;
            outFile << std::hex << std::uppercase << stoi(variables[i].title) << std::dec << std::endl ;
        }
    outFile.close() ;
    return 0 ;
}


/// Проверка наличия переменной или константы в памяти (при отсутствии - создает)
/// \param str - переменная или константа
/// \return Адрес памяти SA
short checkPresenceVar(const std::string& str){
    for (short i = 0 ; i < variables.size() ; i++){
        if (variables[i].title == str)
            return i ;
    }
    variables.emplace_back(str, currCellVar--) ;
    return variables.size() - 1 ;
}

int commInput(const std::string& operand, const std::string& line){
    std::cmatch oper ; // для среза пробелов
    if (!regex_match(operand.c_str(), oper, varCheck)){
        printf("\033[38;5;196mInvalid line | Invalid variable for \"input\"\033[0m\n\"%s\"\n", line.c_str()) ;
        return -1 ;
    }
    short addressOperand = checkPresenceVar(oper[1]) ;
    commands.emplace_back(commandSA(currCellComm++, "READ  ", variables[addressOperand].address)) ;
    return 0 ;
}

int commPrint(const std::string& operand, const std::string& line){
    std::cmatch oper ; // для среза пробелов
    if (!regex_match(operand.c_str(), oper, varCheck) && !regex_match(operand.c_str(), oper, numCheck)){
        printf("\033[38;5;196mInvalid line | Invalid operand for \"print\"\033[0m\n\"%s\"\n", line.c_str()) ;
        return -1 ;
    }
    if(regex_match(operand, numCheck)){
        short temp = stoi(operand) ;
        if (temp < -0x2000 || temp >0x1FFF){
            printf("\033[38;5;196mInvalid line | The valid range for the value of the number from -0x2000 to 0x1FFF inclusive\033[0m\n\"%s\"\n", line.c_str()) ;
            return -1 ;
        }
    }
    short addressOperand = checkPresenceVar(oper[1]) ;
    commands.emplace_back(commandSA(currCellComm++, "WRITE ", variables[addressOperand].address)) ;
    return 0 ;
}

int commGoTo(const std::string& operand, const std::string& line){
    if (!regex_match(operand, numLineCheck)){
        printf("\033[38;5;196mInvalid line | Invalid operand for \"goto\"\033[0m\n\"%s\"\n", line.c_str()) ;
        return -1 ;
    }

    if(startCommands.find(operand) == startCommands.end()){ // Если не нашел ранее
        commands.emplace_back(commandSA(currCellComm++, "JUMP  ", stoi(operand))) ;
        queueGoTo.emplace_back(commands.size() - 1) ;
    }
    else{
        short addressOperand = startCommands.find(operand)->second ;
        commands.emplace_back(commandSA(currCellComm++, "JUMP  ", addressOperand)) ;
    }
    return 0 ;
}

int commLet(const std::string& operand, const std::string& line){
    const std::regex letOneParamCheck(R"(([A-Z])\s*=\s*([A-Z]|-?\d+)\s*)") ;
    const std::regex letTwoParamCheck(R"(([A-Z])\s*=\s*([A-Z]|-?\d+)\s*([\+\-\*\/])\s*([A-Z]|-?\d+)\s*)") ;
    std::cmatch letLine ;
    if (!regex_match(operand.c_str(), letLine, letOneParamCheck) && !regex_match(operand.c_str(), letLine, letTwoParamCheck)){
        printf("\033[38;5;196mInvalid line | Invalid operand for \"let\"\033[0m \n\"%s\"\n", line.c_str()) ;
        return -1 ;
    }
    if(regex_match(operand, letOneParamCheck)){ // Если один аргумент
        std::string var   = letLine[1] ;
        std::string value = letLine[2] ;
        if(regex_match(value, numCheck)){
            short temp = stoi(value) ;
            if (temp < -0x2000 || temp >0x1FFF){
                printf("\033[38;5;196mInvalid line | The valid range for the value of the number from -0x2000 to 0x1FFF inclusive\033[0m \n\"%s\"\n", line.c_str()) ;
                return -1 ;
            }
        }

        short valueAddress = checkPresenceVar(value) ;
        commands.emplace_back(commandSA(currCellComm++, "LOAD  ", variables[valueAddress].address)) ;

        short varAddress = checkPresenceVar(var) ;
        commands.emplace_back(commandSA(currCellComm++, "STORE ", variables[varAddress].address)) ;
    }
    else{ // Если выражение (только простое)
        std::string var    = letLine[1] ;
        std::string value1 = letLine[2] ;
        std::string sign   = letLine[3] ;
        std::string value2 = letLine[4] ;
        /////////////////////////////////////// value1
        if(regex_match(value1, numCheck)){
            short temp = stoi(value1) ;
            if (temp < -0x2000 || temp >0x1FFF){
                printf("\033[38;5;196mInvalid line | The valid range for the value of the number from -0x2000 to 0x1FFF inclusive\033[0m \n\"%s\"\n", line.c_str()) ;
                return -1 ;
            }
        }
        short valueAddress1 = (short)checkPresenceVar(value1) ;
        commands.emplace_back(commandSA(currCellComm++, "LOAD  ", variables[valueAddress1].address)) ;
        /////////////////////////////////////// value2
        if(regex_match(value2, numCheck)){
            short temp = stoi(value2) ;
            if (temp < -0x2000 || temp >0x1FFF){
                printf("\033[38;5;196mInvalid line | The valid range for the value of the number from -0x2000 to 0x1FFF inclusive\033[0m \n\"%s\"\n", line.c_str()) ;
                return -1 ;
            }
        }
        short valueAddress2 = (short)checkPresenceVar(value2) ;

        /////////////////////////////////////// action
        if(sign == "+")
            commands.emplace_back(commandSA(currCellComm++, "ADD   ", variables[valueAddress2].address)) ;
        else if(sign == "-")
            commands.emplace_back(commandSA(currCellComm++, "SUB   ", variables[valueAddress2].address)) ;
        else if(sign == "*")
            commands.emplace_back(commandSA(currCellComm++, "MUL   ", variables[valueAddress2].address)) ;
        else if (sign == "/")
            commands.emplace_back(commandSA(currCellComm++, "DIVIDE", variables[valueAddress2].address)) ;

        //////////////////////////////////////// var
        short varAddress = checkPresenceVar(var) ;
        commands.emplace_back(commandSA(currCellComm++, "STORE ", variables[varAddress].address)) ;
    }
    return 0 ;
}

int commEnd(const std::string& operand, const std::string& line){
    if(!regex_match(operand, std::regex(R"(\s*)"))){
        printf("\033[38;5;196mInvalid line | There should be nothing after \"end\"\033[0m\n\"%s\"\n", line.c_str()) ;
        return -1 ;
    }
    commands.emplace_back(commandSA(currCellComm++, "HALT  ", 0)) ;
    return 0 ;
}

int commIf(const std::string& operand, const std::string& line){
    std::cmatch ifLine ;
    const std::regex ifConditionCheck(R"(([A-Z]|-?\d+)\s*(=|<|>)\s*([A-Z]|-?\d+)\s+(INPUT|PRINT|LET|GOTO|END)\s*(.*))") ;
    if(!regex_match(operand.c_str(), ifLine, ifConditionCheck)){
        printf("\033[38;5;196mInvalid line | There should be nothing after \"if\"\033[0m\n\"%s\"\n", line.c_str()) ;
        return -1 ;
    }
    std::string value1    = ifLine[1] ;
    std::string condition = ifLine[2] ;
    std::string value2    = ifLine[3] ;
    std::string comm      = ifLine[4] ;
    std::string op        = ifLine[5] ;
    short addressvalue1 = checkPresenceVar(value1) ;
    short addressvalue2 = checkPresenceVar(value2) ;
    if (condition == "="){
        commands.emplace_back(commandSA(currCellComm++, "LOAD  ", variables[addressvalue1].address)) ;
        commands.emplace_back(commandSA(currCellComm++, "SUB   ", variables[addressvalue2].address)) ;
        commands.emplace_back(commandSA(currCellComm++, "JZ    ", currCellComm + 2)) ; // если условие выполняется, то через строку
    }
    else{
        if (condition == "<"){
            commands.emplace_back(commandSA(currCellComm++, "LOAD  ", variables[addressvalue1].address)) ;
            commands.emplace_back(commandSA(currCellComm++, "SUB   ", variables[addressvalue2].address)) ;
        }
        else{
            commands.emplace_back(commandSA(currCellComm++, "LOAD  ", variables[addressvalue2].address)) ;
            commands.emplace_back(commandSA(currCellComm++, "SUB   ", variables[addressvalue1].address)) ;
        }
        commands.emplace_back(commandSA(currCellComm++, "JNEG  ", currCellComm + 2)) ; // если условие выполняется, то через строку
    }

    commands.emplace_back(commandSA(currCellComm++, "JUMP  ", -1)) ; // пока -1
    short temp = commands.size() - 1 ;
    if (comm == "INPUT"){
        if (commInput(op, line))
            return -1 ;
    }
    else if (comm == "PRINT"){
        if (commPrint(op, line))
            return -1 ;
    }  
    else if (comm == "LET"){
        if (commLet(op, line))
            return -1 ;
    }
    else if (comm == "GOTO"){
        if (commGoTo(op, line))
            return -1 ;
    }
    else if (comm == "END"){
        if (commEnd(op, line))
            return -1 ;
    }

    commands[temp].operand = currCellComm ;
    return 0 ;
}