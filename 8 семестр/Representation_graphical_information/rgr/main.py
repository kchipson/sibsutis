# 1.  Преобразовать True Color BMP файл в 16-цветный BMP файл.

import sys
from PIL import Image, ImageDraw
import os
from bmp import BMPIMAGE
import collections
from itertools import chain
from operator import itemgetter


def median_section(image_data: list, k: int):
    if k % 2:
        raise ValueError("k должно быть кратно 2")

    def split(parallelepiped: list):
        r_range = (
                max(parallelepiped, key=itemgetter(0), default=(0, 0, 0))[0]
                - min(parallelepiped, key=itemgetter(0), default=(0, 0, 0))[0])
        g_range = (
                max(parallelepiped, key=itemgetter(1), default=(0, 0, 0))[1]
                - min(parallelepiped, key=itemgetter(1), default=(0, 0, 0))[1])
        b_range = (
                max(parallelepiped, key=itemgetter(2), default=(0, 0, 0))[2]
                - min(parallelepiped, key=itemgetter(2), default=(0, 0, 0))[2])
        if r_range >= g_range >= b_range:
            parallelepiped.sort(key=itemgetter(0))
        elif g_range >= b_range >= r_range:
            parallelepiped.sort(key=itemgetter(1))
        else:
            parallelepiped.sort(key=itemgetter(2))
        return parallelepiped[len(parallelepiped) // 2:], parallelepiped[: len(parallelepiped) // 2]

    parallelepipeds = [list(set(chain.from_iterable(image_data)))]
    while len(parallelepipeds) < k:
        new_parallelepipeds = []
        for parallelepiped in parallelepipeds:
            new_parallelepipeds.extend(split(parallelepiped))
        parallelepipeds = new_parallelepipeds
    # print(parallelepipeds)
    print(len(parallelepipeds))

    palette = []
    pixel_indexes = {}
    for i, parallelepiped in enumerate(parallelepipeds):
        r_med = 0
        g_med = 0
        b_med = 0
        for pixel in parallelepiped:
            r_med += pixel[0] / len(parallelepiped)
            g_med += pixel[1] / len(parallelepiped)
            b_med += pixel[2] / len(parallelepiped)
            pixel_indexes[pixel] = i

        palette.append((int(r_med), int(g_med), int(b_med)))
    new_image_data = [[pixel_indexes[pixel] for pixel in line] for line in image_data]

    return new_image_data, palette


def main():
    path_ = os.path.dirname(__file__)

    input_filename = "input"
    input_ext = "bmp"
    output_filename = "output"
    output_ext = "bmp"

    bmp = BMPIMAGE(open(f"{path_}\\{input_filename}.{input_ext}", 'rb'))
    print(bmp.info())

    height = bmp.BMInfo.Header.height
    width = bmp.BMInfo.Header.width

    new_pixel_data, palette = median_section(bmp.PixelData, 1024)

    img = Image.open(f"{path_}\\{input_filename}.{input_ext}")
    img.show()

    img = Image.new("RGB", (width, height))
    draw = ImageDraw.Draw(img)

    for x in range(width):
        for y in range(height):
            draw.point((x, y), palette[new_pixel_data[y][x]])
    img.save(f"{path_}\\output.{output_ext}", "bmp")
    img.show()


if __name__ == "__main__":
    main()

# occurrence_colors = collections.Counter()
# for line in bmp.PixelData:
#     for cell in line:
#         occurrence_colors[cell] += 1

# def delta(color1, color2):
#     return sum([(x - y) ** 2 for x, y in zip(color1, color2)])
# most_common_color = [i[0] for i in list(occurrence_colors.items())]  # TODO: как вычленить 16 различных
# print(most_common_color)

