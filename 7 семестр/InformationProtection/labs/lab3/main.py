from lib import *
import shutil
import hashlib
import os
import sys


def read_file(filename: str, ext: str = 'txt') -> bytearray:
    with open(filename + '.' + ext, 'rb') as f:
        return bytearray(f.read())


def main():
    try:
        shutil.rmtree('signatures')
    except OSError:
        pass
    os.mkdir('signatures')

    file = 'input'
    ext = 'txt'
    file_byte = read_file(file)

    #################### Подпись Эль-Гамаля #########################
    # Открыты: y, p, g, r, s
    
    hash = hashlib.md5(file_byte)
    hash_16 = hash.hexdigest()
    hash_10 = int(hash_16, base=16)
    
    p = gen_safe_prime(1 << hash.digest_size * 8 + 1,
                       1 << hash.digest_size * 8 + 5)
    g = gen_g(p)
    
    x = random.randrange(2, p - 1)  # Закрытый ключ
    y = pow(g, x, p)  # Открытый ключ
    
    k = gen_mutually_prime(p - 1)
    r = pow(g, k, p)

    u = (hash_10 - x * r) % (p - 1)
    kk = inverse(k, p - 1)
    s = kk * u % (p - 1)

    with open("signatures/elgamal_" + file + '.' + ext + '.' + 'txt', 'w') as f:
        f.write(str(s))


    # Проверка подписи
    yr = pow(y, r, p) * pow(r, s, p) % p
    gh = pow(g, hash_10, p)
    assert yr == gh
    print("#################### Подпись Эль-Гамаля #########################",
          f"{hash_16 = }",
          f"{hash_10 = }",
          f"{p = }",
          f"{g = }",
          f"{x = }",
          f"{y = }",
          f"{k = }",
          f"{r = }",
          f"{u = }",
          f"{kk = }",
          f"{s = }",
          '-'*10,
          f"{yr = } == {gh = }",
          sep='\n'
         )

    
    #################### Подпись RSA #########################
    # Открыты: n, d

    p = q = gen_prime(1 << hash.digest_size * 8 // 2 + 1, 1 << hash.digest_size * 8 // 2 + 5)
    while p == q:
        q = gen_prime(1 << hash.digest_size * 8 // 2 + 1, 1 << hash.digest_size * 8 // 2 + 5)
    
    n = p * q
    
    phi = (p - 1) * (q - 1)
    
    d = gen_mutually_prime(phi) # Открытый ключ
    c = inverse(d, phi) # Закрытый ключ
    
    s = exponentiation_modulo(hash_10, c, n)  # Подпись
    
    with open("signatures/rsa_" + file + '.' + ext + '.' + 'txt', 'w') as f:
        f.write(str(s))


    # Проверка подписи
    e = exponentiation_modulo(s, d, n)
    assert e == hash_10
    print("\n\n#################### Подпись RSA #########################",
          f"{hash_16 = }",
          f"{hash_10 = }",
          f"{p = }",
          f"{q = }",
          f"{n = }",
          f"{phi = }",
          f"{d = }",
          f"{c = }",
          f"{s = }",
          '-'*10,
          f"{e = } == {hash_10 = }",
          sep='\n'
         )
    
    
    #################### Подпись ГОСТ #########################
    # Открыты: p, q, a
    
    q = gen_prime(1 << 255, (1 << 256) - 1)
    
    while True:
        b = random.randint(math.ceil((1 << 1023) / q), ((1 << 1024) - 1) // q)
        p = b * q + 1
        if is_prime(p):
            break
        
    while True:  # Находим a
        g = random.randrange(2, p - 1)
        if (a := exponentiation_modulo(g, b, p)) > 1:
            break
        
    assert 0 < hash_10 < q
    
    while True:
        k = random.randrange(1, q)
        r = exponentiation_modulo(a, k, p) % q
        if r == 0:
            continue
        s = (k * hash_10 % q + x * r % q) % q
        if s != 0:
            break
    
    with open("signatures/gost_" + file + '.' + ext + '.' + 'txt', 'w') as f:
        f.write(str(s))

    # Проверка подписи
    assert 0 < r < q
    assert 0 < s < q
    hh = inverse(h, q)
    u1 = s * hh % q
    u2 = -r * hh % q
    v = exponentiation_modulo(a, u1, p) * exponentiation_modulo(y, u2, p) % p % q
    assert v == r
    print("\n\n#################### Подпись ГОСТ #########################",
          f"{hash_16 = }",
          f"{hash_10 = }",
          f"{q = }",
          f"{p = }",
          f"{a = }",
          f"{k = }",
          f"{r = }",
          f"{s = }",
          '-'*10,
          f"{v = } == {r = }",
          sep='\n'
         )
    
    
def test():
    file = 'input'
    ext = 'jpg'
    file_byte = read_file(file, ext)
    print(file_byte)


if __name__ == "__main__":
    main()
    # test()
