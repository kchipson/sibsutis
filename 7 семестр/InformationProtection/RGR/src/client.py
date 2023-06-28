import random

from lib import *
import socket

random.seed(1)

class Client:
    def __init__(self, name: str):
        self.name = name
        self._buffer_size = 1024
        
    def register(self, host: str = "localhost", port: int = 3000):
        print(f"[INFO] Попытка соединения с сервером для регистрации пользователя с ником '{self.name}'...")
        sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        sock.connect((host, port))
        print(f"[INFO] Соединение с сервером установлено")
        n = int(sock.recv(self._buffer_size).decode("utf8"))
        print(f"[INFO] С сервера получено n")
   
        sock.send((bytes("{register}", encoding = "utf8")))
        sock.send((bytes(self.name, encoding = "utf8")))
        
        self.s = gen_mutually_prime_big(n)
        v = exponentiation_modulo(self.s, 2, n)

        sock.send((bytes(str(v), encoding = "utf8")))

        status = sock.recv(self._buffer_size).decode("utf8")
        if status == "success":
            print(f"Вы были успешно зарегистрированы")
        elif status == "already registered":
            print(f"Пользователь с никнеймом '{self.name}' уже зарегистрирован")
        
        print(f"[INFO] Соединение с сервером разорвано\n")
        sock.close()

    def auth(self, host: str = "localhost", port: int = 3000):
        print(f"[INFO] Попытка соединения с сервером для авторизации пользователя с ником '{self.name}'...")
        sock = socket.socket()
        sock.connect((host, port))
        print(f"[INFO] Соединение с сервером установлено")
        
        sock.send((bytes("{auth}", encoding = "utf8")))
        
        n = int(sock.recv(self._buffer_size).decode("utf8"))
        print(f"[INFO] С сервера получено n")
        
        sock.send((bytes(self.name, encoding = "utf8")))
        
        while True:
            r = random.randrange(1, n - 1)
            x = exponentiation_modulo(r, 2, n)
            sock.send((bytes(str(x), encoding = "utf8")))
            
            e = int(sock.recv(self._buffer_size).decode("utf8"))

            y = r * self.s ** e % n

            sock.send((bytes(str(y), encoding = "utf8")))

            status = sock.recv(self._buffer_size).decode("utf8")
            if status == "success":
                print("Авторизация пройдена успешно")
                break
            elif status == "fail":
                print("В авторизации отказано. Аутентификация не пройдена")
                break
            elif status == "check":
                pass

        print(f"[INFO] Соединение с сервером разорвано\n")
        sock.close()


if __name__ == '__main__':

    alice = Client('Alice')
    alice.register()
    alice.auth()

    # Мошенник, пытающийся авторизоваться как Alice
    cheater = Client('Alice')
    cheater.s = 1000
    cheater.auth()
