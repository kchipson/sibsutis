#!/usr/bin/python3
# -*- coding: utf-8 -*-

from PIL import Image
import os
import numpy as np
import random

# https://pillow.readthedocs.io/en/stable/index.html


if __name__ == "__main__":
    path_ = os.path.dirname(__file__)
    filename = "CAT16"
    ext = 'bmp'

    if not os.path.exists(f"{path_}\\output"):
        os.mkdir(f"{path_}\\output")

    img = Image.open(f"{path_}\\input\\{filename}.{ext}")
    img_matrix = np.asarray(img.convert("RGB"))

    print(f"Исходный размер: {img.size}")


    for scale_size in [.1, .2, .3, .5, .8, 1, 2, 3, 5, 8, 10]:
        scaled_width = round(img.width * scale_size)
        scaled_height = round(img.height * scale_size)

        scaled_image = Image.new('RGB', (scaled_width, scaled_height))
        print(f'Размер, при коэффициенте масштабирования {scale_size}: {scaled_image.size}')

        tt = list()
        for row in range(scaled_height):
            tmp = list()
            for col in range(scaled_width):
                tmp.append(img_matrix[int(row // scale_size)][int(col // scale_size)])
            tt.append(tmp)
        tt = np.array(tt)
        new_img = Image.fromarray(tt, 'RGB')
        new_img.save(f"{path_}\\output\\{filename}_scale{scale_size}.{ext}", "BMP")
        new_img.show()