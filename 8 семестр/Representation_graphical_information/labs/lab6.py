#!/usr/bin/python3
# -*- coding: utf-8 -*-

from PIL import Image
import os
import numpy as np

# https://pillow.readthedocs.io/en/stable/index.html

if __name__ == "__main__":
    path_ = os.path.dirname(__file__)
    filename = "_сarib_TC"
    ext = "bmp"

    if not os.path.exists(f"{path_}\\output"):
        os.mkdir(f"{path_}\\output")

    img = Image.open(f"{path_}\\input\\{filename}.{ext}")
    img_matrix = np.asarray(img.convert("RGB"))

    logo_filename = "logo_back"
    logo_ext = "png"

    logo = Image.open(f"{path_}\\input\\{logo_filename}.{logo_ext}")
    logo_matrix = np.asarray(logo.convert("RGB"))

    assert logo.height < img.height and logo.width < img.width

    k = .5
    for row in range(logo.height):
        for col in range(logo.width):
            if not np.array_equal(logo_matrix[row, col], np.array([255, 174, 201])):
                center_h, center_w = int((img.height - logo.height) // 2), int((img.width - logo.width) // 2)
                r, g, b = [int(img_matrix[row + center_h][col + center_w][i] * k + logo_matrix[row][col][i] * (1 - k)) for i in range(3)]

                img_matrix[row + ((img.height - logo.height) // 2)][col + (img.width - logo.width) // 2] = r, g, b

    new_img = Image.fromarray(img_matrix, 'RGB')
    new_img.save(f"{path_}\\output\\{filename}_watermark.{ext}", "BMP")

    new_img.show()
