#!/usr/bin/python3
# -*- coding: utf-8 -*-

from PIL import Image
import io
import os
import numpy as np



if __name__ == "__main__":
    path_ = os.path.dirname(__file__)

    image_name = "_сarib_TC"
    image_ext = 'bmp'

    secret_name = "secret"
    secret_ext = 'txt'
    

    if not os.path.exists(f"{path_}\\output"):
        os.mkdir(f"{path_}\\output")

    img = Image.open(f"{path_}\\input\\{image_name}.{image_ext}")
    img_bytes = io.BytesIO()
    img.save(img_bytes, "BMP")
    img_bytes = bytearray(img_bytes.getvalue())
    
    header_size = 54 # 54 - размер заголовка при BITMAPINFOHEADER (ver #3)


    with open(f"{path_}\\input\\{secret_name}" + '.' + secret_ext, 'rb') as f:
        text_bytes = bytearray(f.read())


    if len(text_bytes) * 8 > img.width * img.height * 3:
        print(f"Текстовый файл превышает максимально допустимый размер для данного изображения ({img.width * img.height * 3 / 8} байт)")
        exit()

    """Кодирование информации в файл"""

    text_bits = ''.join([bin(b)[2:].zfill(8) for b in text_bytes])
    text_bits_size = bin(len(text_bits))[2:].zfill(32)
    print(f"Размер закодированного текста: {int(text_bits_size, 2)} бит")
    
    for i, bit in enumerate(text_bits_size):
        img_bytes[i + header_size] &= ~1
        img_bytes[i + header_size] |= int(bit)
    

    for i, bit in enumerate(text_bits):
        img_bytes[i + len(text_bits_size) + header_size] &= ~1
        img_bytes[i + len(text_bits_size) + header_size] |= int(bit)

    new_img = Image.open(io.BytesIO(img_bytes))
    new_img.save(f"{path_}\\output\\{image_name}_steganography.{image_ext}", "BMP")
    new_img.show()

    """Чтение закодированной информации с файла"""
    
    img = Image.open(f"{path_}\\output\\{image_name}_steganography.{image_ext}")
    img_bytes = io.BytesIO()
    img.save(img_bytes, "BMP")
    img_bytes = bytearray(img_bytes.getvalue())
    img_bytes = img_bytes[header_size:]

    text_size = int("".join(str(img_bytes[i] & 1) for i in range(len(text_bits_size))), 2)
    print(f"Размер расшифрованного текста: {text_size} бит")

    text_bits = str()
    for i in range(text_size):
        text_bits += str(img_bytes[i + len(text_bits_size)] & 1)

    text = bytes.fromhex(hex(int(text_bits, 2))[2:]).decode(encoding="utf8")
    print(f"Расшифрованный текст:\n{text}")