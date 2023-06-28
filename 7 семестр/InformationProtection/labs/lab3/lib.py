import math
import random
import sys


def exponentiation_modulo(a: int, x: int, p: int) -> int:
    if p == 0:
        raise ValueError("Модуль не может быть равен нулю")
    if x < 0:
        raise ValueError("Показатель не может быть отрицательным")
    result = 1
    a = a % p
    if a == 0:
        return 0
    while x > 0:
        if x & 1 == 1:
            result = (result * a) % p
        a = (a ** 2) % p
        x >>= 1
    return result

def is_prime(p: int, trials: int=20) -> bool:

    if p == 2 or p == 3:
        return True
    
    if p < 2 or not (p & 1):
        return False
    
    for _ in range(trials):
        a = random.randint(2, p - 1)
        if exponentiation_modulo(a, (p - 1), p) != 1 or math.gcd(p, a) > 1:
            return False
    return True


def gen_prime(left: int, right: int) -> int:
    while True:
        p = random.randint(left, right)
        if is_prime(p):
            return p
        

def gen_safe_prime(a: int, b: int) -> int:
    if a > b:
        a, b = b, a
    while True:
        q = gen_prime(a // 2, (b - 1) // 2)
        if is_prime(p := q * 2 + 1):
            return p

def gen_g(p: int) -> int:
    while True:
        g = random.randrange(2, p)
        if pow(g, (p - 1) // 2, p) != 1:
            return g

def gen_mutually_prime(p):
    while True:
        if math.gcd(p, b := random.randrange(2, p)) == 1:
            return b
        
def generalized_euclidean_algorithm(a: int, b: int) -> list[int, int, int]:

    if a <= 0 or b <= 0:
        raise ValueError("Числа могут быть только натуральными")
    if a > b:
        a, b = b, a
    u = [a, 1, 0]
    v = [b, 0, 1]
    while v[0] != 0:
        q = u[0] // v[0]
        t = [u[0] % v[0], u[1] - q * v[1], u[2] - q * v[2]]
        u, v = v, t
    return u

def inverse(n, p):
    gcd, inv, _ = generalized_euclidean_algorithm(n, p)
    assert gcd == 1
    if inv < 0 :
        inv += p
    return inv