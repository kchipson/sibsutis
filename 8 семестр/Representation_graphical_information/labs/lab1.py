#!/usr/bin/python3
# -*- coding: utf-8 -*-

from PIL import Image
import os
import numpy as np

# https://en.wikipedia.org/wiki/BMP_file_format
# https://pillow.readthedocs.io/en/stable/index.html
# https://www.rapidtables.com/convert/image/rgb-to-grayscale.html

if __name__ == "__main__":
    path_ = os.path.dirname(__file__)
    filename = "_сarib_TC"
    ext = 'bmp'

    if not os.path.exists(f"{path_}\\output"):
        os.mkdir(f"{path_}\\output")

    img = Image.open(f"{path_}\\input\\{filename}.{ext}")
    print(
        f"Формат: {img.format}\nРазмер: {img.size}\nЦветовая модель: {img.mode}")

    img_matrix = np.asarray(img.convert("RGB"))

    img_matrix_average = np.copy(img_matrix)
    img_matrix_y1 = np.copy(img_matrix)
    img_matrix_y2 = np.copy(img_matrix)

    for row in range(img.height):
        for col in range(img.width):
            r, g, b = img_matrix[row, col]

            average = int(sum((r, g, b)) / 3)
            y1 = int(0.299 * r + 0.587 * g + 0.114 * b)
            y2 = int(0.2126 * r + 0.7152 * g + 0.0722 * b)

            img_matrix_average[row, col] = [average] * 3
            img_matrix_y1[row, col] = [y1] * 3
            img_matrix_y2[row, col] = [y2] * 3

    new_img = Image.fromarray(img_matrix_average, 'RGB')
    new_img.save(f"{path_}\\output\\{filename}_grayscale_average.{ext}", "BMP")
    new_img.show()

    new_img = Image.fromarray(img_matrix_y1, 'RGB')
    new_img.save(f"{path_}\\output\\{filename}_grayscale_y1.{ext}", "BMP")
    new_img.show()

    new_img = Image.fromarray(img_matrix_y2, 'RGB')
    new_img.save(f"{path_}\\output\\{filename}_grayscale_y2.{ext}", "BMP")
    new_img.show()


# img = img.convert("RGB")
# img_matrix  = img.load()

# for col in range(img.width):
#     for row in range(img.height):
#         r, g, b = img_matrix[col, row]
#         y1 = int(0.299 * r + 0.587 * g + 0.114 * b)
#         y2 = int(0.2126 * r + 0.7152 * g + 0.0722 * b)
#         average =  int(sum((r, g, b)) / 3)

#         img_matrix[col, row] = average,average,average
# img.show()
