#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <thread>
#include "../constants.hpp"


#define PORT 2007

void* sendingMsgs(int clientSocketHandle) {
    char msg[MSG_SIZE+1];
    char *pos;
    char c;

    while (true) {
        fgets(msg, sizeof(msg), stdin);

        if ((pos = strchr(msg, '\n')) != nullptr)
        {
            *pos = '\0';
        }
        else
        {
            fprintf(stdout, "[Notification]\tСоообщение превысило допустимую длину. Сообщение обрезано до %d символов\n", MSG_SIZE);
            msg[sizeof(msg)-1] = '\0';
            while ((c = getchar()) != EOF && c != '\n');
        }
        if(send(clientSocketHandle, msg, sizeof(msg), 0) < 0)
            fprintf(stderr, "[Error]\tНе удалось отправить сообщение.\nПроверьте подключение и повторите попытку\n");
    }
    return nullptr;
}

int connectServer(const char*  host, const char* port, const char* name){

    int clientSocket = socket(AF_INET, SOCK_STREAM, 0);
    if (clientSocket == -1)
    {
        fprintf(stderr, "[Error]\tНе удалось создать clientSocket\n");
        return -1;
    }

    struct sockaddr_in clientAddr;
    clientAddr.sin_family = AF_INET;
    clientAddr.sin_port = htons(strtol(port, nullptr, 0));
    if (inet_aton(host, &clientAddr.sin_addr) == 0) {
        fprintf(stderr, "[Error]\tНекорректный IP\n");
        return -1;
    }

    if(connect(clientSocket, (struct sockaddr *) &clientAddr, sizeof(sockaddr_in)) < 0){
        fprintf(stderr, "[Error]\tНе удалось подключиться к серверу.\nПроверьте подключение и доступность сервера\n");
        return -1;
    }
    
    if(send(clientSocket, name, sizeof(name), 0) < 0){
        fprintf(stderr, "[Error]\tНе удалось отправить никнейм на сервер.\nПроверьте подключение и повторите попытку\n");
        return -1;
    }

    return clientSocket;
}

int main(int argc, char *argv[]) {
    if(argc != 4)
    {
        fprintf(stderr, "./client [host] [port] [nickname]\nНапример, \"./client 127.0.0.1 2007 qwerty\"\n*Предупреждение: длина никнейма не должна превышать %d, иначе он будет обрезан\n*Предупреждение:сообщение не должно превышать %d, иначе оно будет обрезано\n", MAX_NICKNAME_SIZE, MSG_SIZE);
        return 1;
    }

    char name[MAX_NICKNAME_SIZE+1]{'\0'};
    if (strlen(argv[3]) > MAX_NICKNAME_SIZE){
        argv[3][MAX_NICKNAME_SIZE] = '\0';
        fprintf(stdout, "[Notification]\tДлина никнейка превышает допустимое значение(%d). Никнейм обрезан до \"%s\"\n", MAX_NICKNAME_SIZE, argv[3]);
    }

    strcpy(name, argv[3]);
    int clientSocket;
    if ((clientSocket = connectServer(argv[1], argv[2], name)) == -1){
        return 3;
    }

    fprintf(stdout, "\n******************************* CHAT *******************************\n");
    std::thread thread(sendingMsgs, clientSocket);
    thread.detach();

    int bytesRecv;
    char msg[BUFFER_SIZE];
    while ((bytesRecv = recv(clientSocket, msg, sizeof(msg), 0))) {
        if(bytesRecv < 0) {
            fprintf(stderr, "[Error]\tОшибка при получении сообщения от сервера\n");
        }
        else {
            fprintf(stdout, "%s\n", msg);
        }
        memset(msg, '\0', sizeof(msg));

    }
    std::cerr << "[Error]\tСервер упал\n" << std::endl;
    close(clientSocket);

    return 0;
}
