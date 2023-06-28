#!/usr/bin/python3
# -*- coding: utf-8 -*-

from PIL import Image
import os
import numpy as np
import random

# https://pillow.readthedocs.io/en/stable/index.html


def random_pixel() -> (int, int, int):
    return ([random.randint(0, 255) for _ in range(3)])


if __name__ == "__main__":
    path_ = os.path.dirname(__file__)
    filename = "_сarib_TC"
    ext = 'bmp'

    if not os.path.exists(f"{path_}\\output"):
        os.mkdir(f"{path_}\\output")

    img = Image.open(f"{path_}\\input\\{filename}.{ext}")
    img_matrix = np.asarray(img)

    for row in range(img.height):
        for col in range(img.width):
            if row < 15 or col < 15 or row > img.height - 15 or col > img.width - 15:
                img_matrix[row][col] = random_pixel()

    new_img = Image.fromarray(img_matrix)
    new_img.save(f"{path_}\\output\\{filename}_frame.{ext}", "BMP")

    new_img.show()
