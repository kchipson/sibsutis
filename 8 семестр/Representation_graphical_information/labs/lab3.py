#!/usr/bin/python3
# -*- coding: utf-8 -*-

from PIL import Image
import os
import numpy as np
import random

# https://pillow.readthedocs.io/en/stable/index.html

def test():
    a = np.array([])
    print(a)
    newrow = [1, 2, 3]
    a = np.vstack([a, newrow])
    print(a)
    exit()

if __name__ == "__main__":
    # test()
    path_ = os.path.dirname(__file__)
    filename = "_сarib_TC"
    ext = 'bmp'

    if not os.path.exists(f"{path_}\\output"):
        os.mkdir(f"{path_}\\output")

    img = Image.open(f"{path_}\\input\\{filename}.{ext}")
    img_matrix = np.asarray(img.convert("RGB"))


    # rot_img_matrix = np.rot90(img_matrix)
    
    # or
    
    # rot_img_matrix = img_matrix.transpose((1, 0, 2))
    # rot_img_matrix = rot_img_matrix[::-1]
    
    # or

    rot90 = list()
    for col in range(img.width):
        tmp = list()
        for row in range(img.height):
            tmp.append(img_matrix[img.height - row - 1][col])
        rot90.append(tmp)
    rot_img_matrix = np.array(rot90)

    new_img = Image.fromarray(rot_img_matrix, 'RGB')
    new_img.save(f"{path_}\\output\\{filename}_rot90.{ext}", "BMP")

    new_img.show()
