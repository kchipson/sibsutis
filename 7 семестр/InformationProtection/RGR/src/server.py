import json
from lib import *
import socket
import signal


class Server:
    def __init__(self, host: str = "localhost", port: int = 3000):
        self._host = host
        self._port = port
        self._buffer_size = 1024

        p = q = gen_prime(1 << 1023, (1 << 1024) - 1)
        while p == q:
            q = gen_prime(1 << 1023, (1 << 1024) - 1)

        self.n = p * q
        
        print(f"\t{p = }", f"\t{q = }", f"\t{self.n = }", '*' * 30, sep='\n')
        
        try:
            with open("registered_users.json", "r") as f:
                self._registered_users = json.load(f)
            print("[INFO] Загружена база с пользователями")
        except FileNotFoundError:
            with open("registered_users.json", "w") as f:
                self._registered_users = dict()
                json.dump(self._registered_users, f)
            print(
                "[ERROR] Не удалось загрузить базу с пользователями. Была создана новая")

    def run(self):
        sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        sock.bind((self._host, self._port))
        sock.listen()
        print("[INFO] Сервер запущен")
        
        while True:
            conn, addr = sock.accept()
            print(f"\n[INFO] Установлено новое соединение: {addr}")
            
            conn.send((bytes(str(self.n), encoding = "utf8")))

            print(f"[INFO] Пользователю {addr} отправлено n")
            
            data = conn.recv(self._buffer_size).decode("utf8")
            
            if data == "{register}":
                name = conn.recv(self._buffer_size).decode("utf8")
                v = int(conn.recv(self._buffer_size).decode("utf8"))
                
                if name not in self._registered_users.keys():
                    print(f"[INFO] Пользователь {addr} зарегистрировался с никнеймом '{name}' и ключом {v}")
                    self._registered_users[name] = v
                    with open("registered_users.json", "w") as f:
                        json.dump(self._registered_users, f)
                    conn.send((bytes("success", encoding = "utf8")))
                else:
                    print(f"[ERROR] Никнейм '{name}' уже зарегистрирован")
                    conn.send((bytes("already registered", encoding = "utf8")))

            
            if data == "{auth}":
                name = conn.recv(self._buffer_size).decode("utf8")
                v = self._registered_users[name]
                
                print(f"[INFO] Пользователь {addr} пытается авторизироваться под никнеймом '{name}'")

                print(f"[INFO] Аутентификация:")
                
                t = 20
                for i, _ in enumerate(range(t), 1):
                    x = int(conn.recv(self._buffer_size).decode("utf8"))

                    e = random.randint(0, 1)
                    conn.send((bytes(str(e), encoding = "utf8")))


                    y = int(conn.recv(self._buffer_size).decode("utf8"))

                    y2 = exponentiation_modulo(y, 2, self.n)
                    xv = x * exponentiation_modulo(v, e, self.n) % self.n
                    print(f"{i}.\n\t{x = }\n\t{e = }\n\t{y = }\n\t--\n\ty^2 % n = {y2}\n\tx * v^e % n = {xv}")
                    
                    if y2 == xv:
                        print(f"(success) y^2 == x * v^e % n\n")
                        if i == t:
                            print(f"[INFO] Аутентификация '{name}' пройдена успешно")
                            conn.send((bytes("success", encoding = "utf8")))
                        else:
                            conn.send((bytes("check", encoding = "utf8")))
                    else:
                        print(f"(fail) y^2 != x * v^e % n\n")
                        conn.send((bytes("fail", encoding = "utf8")))
                        print(f"[INFO] Аутентификация '{name}' не пройдена. Пользователь {addr} получает бан по ip")
                        break

            conn.close()
            print(f"[INFO] Соединение разорвано")
        
if __name__ == "__main__":

    signal.signal(signal.SIGINT, signal.SIG_DFL)
    server = Server()
    server.run()
    
