from PyQt5.QtWidgets import *
from PyQt5.QtGui import *
import sys
from PIL import Image
import os
import numpy as np

# https://github.com/a1exdandy/BMP-USU-Python-Task/blob/master/bmp_module.py

# Некоторые необходимые константы

BMP_32BIT_BLUE_MASK = 0x000000ff
BMP_32BIT_GREEN_MASK = 0x0000ff00
BMP_32BIT_RED_MASK = 0x00ff0000
BMP_16BIT_BLUE_MASK = 0x001f
BMP_16BIT_GREEN_MASK = 0x03e0
BMP_16BIT_RED_MASK = 0x7c00
BI_RGB = 0
BI_RLE8 = 1
BI_RLE4 = 2
BI_BITFIELDS = 3
BI_JPEG = 4
BI_PNG = 5
BI_ALPHABITFIELDS = 6


def convert(value, bits_from, bits_to):
    """Функция для перевода значений из bits_from-битной диапозона в
    bits_to-битный
    """
    return int((value / (1 << bits_from)) * (1 << bits_to))


def color_from_tuple(rgb):
    """Получение целочисленного значения цвета из каналов
    """
    return rgb[0] << 16 | rgb[1] << 8 | rgb[2]


# Определение функций для считывания из двоичного
# файла элементарных типов данных
def read_int_from_file(binary_file, size):
    """Функция считывает из файла binary_file ровно size
    байт и возвращает образуемое ими в little-endian число
    """
    return int.from_bytes(
        binary_file.read(size),
        byteorder='little'
    )


def read_BYTE(binary_file):
    """Считывает из файла байт
    """
    return read_int_from_file(binary_file, 1)


def read_WORD(binary_file):
    """Считывает из файла машинное слово
    """
    return read_int_from_file(binary_file, 2)


def read_DWORD(binary_file):
    """Считывает з файла двойное машинное слово
    """
    return read_int_from_file(binary_file, 4)


def read_CIEXYZ(binary_file):
    """Считывет из файла структуру типа CIEXYZ
    """
    return CIEXYZ(
        read_DWORD(binary_file),
        read_DWORD(binary_file),
        read_DWORD(binary_file)
    )


def read_RGBQUAD(binary_file):
    """Считывает из файла структуру типа RGB_QUAD
    """
    return RGBQUAD(
        read_BYTE(binary_file),
        read_BYTE(binary_file),
        read_BYTE(binary_file),
        read_BYTE(binary_file)
    )


def read_CIEXYZTRIPLE(binary_file):
    """Считывае структуру типа CIEXYZTRIPLE
    """
    return CIEXYZTRIPLE(
        read_CIEXYZ(binary_file),
        read_CIEXYZ(binary_file),
        read_CIEXYZ(binary_file)
    )

# Определение некоторые типов, необходимых для
# работы с BMP-изображением


class CIEXYZ:
    """
    """
    def __init__(self, _x, _y, _z):
        self.x = _x
        self.y = _y
        self.z = _z


class RGBQUAD:
    """Структура для хранения красного, зеленого и синего канала
    и зарезервированного поля
    """
    def __init__(self, b, g, r, reserved):
        self.rgbBlue = b
        self.rgbGreen = g
        self.rgbRed = r
        self.rgbReserved = reserved


class CIEXYZTRIPLE:
    """Струтура, хранящая тройку CIEXYZ
    """
    def __init__(self, x, y, z):
        self.x = x
        self.y = y
        self.z = z


# Определение структур для работы с BMP-изображением
class BMPIMAGE:
    """Данные в формате BMP состоят из трёх основных блоков
    различного размера:
        1) Заголовок из структуры BITMAPFILEHEADER и блока
           BITMAPINFO. Последний содержит:
            1) Информационные поля.
            2) Битовые маски для извлечения значений цветовых
               каналов (опциональные).
            3) Таблица цветов (опциональная).
        2) Цветовой профиль (опциональный).
        3) Пиксельные данные.
    """
    def __init__(self, bmp_file):
        self.BMFileHeader = BITMAPFILEHEADER(bmp_file)
        self.BMInfo = BITMAPINFO(bmp_file)
        # В зависимости от битности изображения инициализируем
        # пиксельные данные разными способами
        if self.BMInfo.Header.BitCount == 24:
            self.PixelData = self.get_pixel_data_24bit(bmp_file)
        elif self.BMInfo.Header.BitCount == 16:
            self.PixelData = self.get_pixel_data_16bit(bmp_file)
        elif self.BMInfo.Header.BitCount == 32:
            self.PixelData = self.get_pixel_data_32bit(bmp_file)
        elif self.BMInfo.Header.BitCount == 8:
            self.PixelData = self.get_pixel_data_8bit(bmp_file)
        elif self.BMInfo.Header.BitCount == 4:
            self.PixelData = self.get_pixel_data_4bit(bmp_file)
        elif self.BMInfo.Header.BitCount == 1:
            self.PixelData = self.get_pixel_data_1bit(bmp_file)
        else:
            self.PixelData = None

    def info(self):
        """Ф-я возвращает информацию о bmp-файле
        """
        return self.BMFileHeader.info() + '\n' + \
            self.BMInfo.info()

    def get_pixel_data_24bit(self, bmp_file):
        """Ф-я считывает из файла двухмерный массив пикселей
        для 24 битных изображений без RLE-сжатия
        """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.Height
        width = self.BMInfo.Header.Width
        for i in range(height):
            bitmap.append(list())
            for j in range(width):
                blue = read_BYTE(bmp_file)
                green = read_BYTE(bmp_file)
                red = read_BYTE(bmp_file)
                bitmap[i].append((red, green, blue))
            # считываем лишние байты, т.к. строки в массиве
            # пикселей выравнивются до кратности 4-ем
            bytes_count = 3 * width
            if bytes_count % 4 != 0:
                for j in range(4 - bytes_count % 4):
                    read_BYTE(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap

    def get_pixel_data_16bit(self, bmp_file):
        bitmap = self.get_pixel_data_16_32bit(
            bmp_file,
            BMP_16BIT_RED_MASK,
            BMP_16BIT_GREEN_MASK,
            BMP_16BIT_BLUE_MASK,
            2, 5
        )
        return bitmap

    def get_pixel_data_32bit(self, bmp_file):
        bitmap = self.get_pixel_data_16_32bit(
            bmp_file,
            BMP_32BIT_RED_MASK,
            BMP_32BIT_GREEN_MASK,
            BMP_32BIT_BLUE_MASK,
            4, 8
        )
        return bitmap

    def get_pixel_data_16_32bit(self, bmp_file, r_mask, g_mask, b_mask,
                                bytes_per_pixel, bits_per_color):
        """
        Ф-я считывает из файла двухмерный массив пикселей
        для 16/32 битных изображений без RLE-сжатия
        """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.Height
        width = self.BMInfo.Header.Width
        for i in range(height):
            bitmap.append(list())
            for j in range(width):
                rgb = read_int_from_file(bmp_file, bytes_per_pixel)
                red = (rgb & r_mask) >> 2 * bits_per_color
                green = (rgb & g_mask) >> bits_per_color
                blue = rgb & b_mask
                red = convert(red, bits_per_color, 8)
                green = convert(green, bits_per_color, 8)
                blue = convert(blue, bits_per_color, 8)
                bitmap[i].append((red, green, blue))
            bytes_count = bytes_per_pixel * width
            if bytes_count % 4 != 0:
                read_DWORD(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap

    def get_pixel_data_8bit(self, bmp_file):
        """Ф-я считывает из файла двухмерный массив пикселей
        для 8 битных изображений без RLE-сжатия
        """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.Height
        width = self.BMInfo.Header.Width
        for i in range(height):
            bitmap.append(list())
            for j in range(width):
                color_idx = read_BYTE(bmp_file)
                red = self.BMInfo.Colors[color_idx].rgbRed
                green = self.BMInfo.Colors[color_idx].rgbGreen
                blue = self.BMInfo.Colors[color_idx].rgbBlue
                # print(rgb, red, green, blue)
                bitmap[i].append((red, green, blue))
            # считываем лишние байты, т.к. строки в массиве
            # пикселей выравнивются до кратности 4-ем
            bytes_count = width
            if bytes_count % 4 != 0:
                for j in range(4 - bytes_count % 4):
                    read_BYTE(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap

    def get_pixel_data_4bit(self, bmp_file):
        """Ф-я считывает из файла двухмерный массив пикселей
        для 4 битных изображений без RLE-сжатия
        """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.Height
        width = self.BMInfo.Header.Width
        scans_length = (width + 1) // 2
        for i in range(height):
            bitmap.append(list())
            for j in range(scans_length):
                double_color_idx = read_BYTE(bmp_file)
                first_color_idx = (double_color_idx & 0xF0) >> 4
                second_color_idx = double_color_idx & 0x0F
                red_first = self.BMInfo.Colors[first_color_idx].rgbRed
                green_first = self.BMInfo.Colors[first_color_idx].rgbGreen
                blue_first = self.BMInfo.Colors[first_color_idx].rgbBlue
                red_second = self.BMInfo.Colors[second_color_idx].rgbRed
                green_second = self.BMInfo.Colors[second_color_idx].rgbGreen
                blue_second = self.BMInfo.Colors[second_color_idx].rgbBlue
                bitmap[i].append((red_first, green_first, blue_first))
                bitmap[i].append((red_second, green_second, blue_second))
            # считываем лишние байты, т.к. строки в массиве
            # пикселей выравнивются до кратности 4-ем
            bytes_count = scans_length
            if bytes_count % 4 != 0:
                for j in range(4 - bytes_count % 4):
                    read_BYTE(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap

    def get_pixel_data_1bit(self, bmp_file):
        """Ф-я считывает из файла двухмерный массив пикселей
        для 1 битных изображений без RLE-сжатия
        """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.Height
        width = self.BMInfo.Header.Width
        scans_length = (width + 7) // 8
        for i in range(height):
            bitmap.append(list())
            for j in range(scans_length):
                color_idxs = read_BYTE(bmp_file)
                color_idxs = [int(x) for x in bin(color_idxs)[2:].zfill(8)]
                for k in color_idxs:
                    red = self.BMInfo.Colors[k].rgbRed
                    green = self.BMInfo.Colors[k].rgbGreen
                    blue = self.BMInfo.Colors[k].rgbBlue
                    bitmap[i].append((red, green, blue))
            # считываем лишние байты, т.к. строки в массиве
            # пикселей выравнивются до кратности 4-ем
            bytes_count = scans_length
            if bytes_count % 4 != 0:
                for j in range(4 - bytes_count % 4):
                    read_BYTE(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap


class BITMAPFILEHEADER:
    """BITMAPFILEHEADER — 14-байтная структура, которая
    располагается в самом начале файла.
    Описание полей: название - тип - описание
    Type - WORD - Отметка для отличия формата от других
    (сигнатура формата). Может содержать единственное
    значение 0x4D42/0x424D (little-endian/big-endian).
    Size      - DWORD - Размер файла в байтах.
    Reserved1 - WORD  - Зарезервированы и должны
                        содержать ноль.
    Reserved2 - WORD  - Зарезервированы и должны
                        содержать ноль.
    OffBits   - DWORD - Положение пиксельных данных
                        относительной начала данной
                        структуры (в байтах).
    """
    def __init__(self, bmp_file):
        self.Type = read_WORD(bmp_file)
        self.Size = read_DWORD(bmp_file)
        self.Reserved1 = read_WORD(bmp_file)
        self.Reserved2 = read_WORD(bmp_file)
        self.OffBits = read_DWORD(bmp_file)

    def info(self):
        """Ф-я возвращает инфомрацию о структуре
        """
        info_str = 'BITMAPFILEHEADER\n' \
            'Type:      {Type}\n' \
            'Size:      {Size}\n' \
            'Reserved1: {Reserved1}\n' \
            'Reserved2: {Reserved2}\n' \
            'OffBits:   {OffBits}\n'.format(
                Type=hex(self.Type),
                Size=self.Size,
                Reserved1=hex(self.Reserved1),
                Reserved2=hex(self.Reserved2),
                OffBits=hex(self.OffBits)
            )
        return info_str


class BITMAPINFO:
    """BITMAPINFO в файле идёт сразу за
    BITMAPFILEHEADER.
    Блок BITMAPINFO состоит из трёх частей:
        1) Структура с информационными полями.
        2) Битовые маски для извлечения значений
        цветовых каналов (присутствуют не всегда).
        3) Таблица цветов (присутствует не всегда).
    """
    def __init__(self, bmp_file):
        self.Header = BITMAPINFOHEADER(bmp_file)
        if self.Header.BitCount <= 8:
            self.ColorsSize = 2 ** self.Header.BitCount
        else:
            self.ColorsSize = 0
        # print(self.Header.info())
        self.Colors = list()  # RGBQUAD
        for i in range(self.ColorsSize):
            self.Colors.append(read_RGBQUAD(bmp_file))

    def info(self):
        """Ф-я возвращает инфомрацию о структуре
        """
        info_str = self.Header.info()
        if self.ColorsSize > 0:
            info_str += \
                'Colors Table Size: {ColorsSize}\n' \
                'COLORS TABLE\n'.format(
                    ColorsSize=self.ColorsSize
                )
        # print(self.ColorsSize)
        for i in range(self.ColorsSize):
            info_str += \
                '{number} : R {red} G {green} B {blue}\n'.format(
                    number=i + 1,
                    red=self.Colors[i].rgbRed,
                    green=self.Colors[i].rgbGreen,
                    blue=self.Colors[i].rgbBlue
                )
        return info_str


class BITMAPINFOHEADER:
    """Структура с информационными полями
    В зависимости от размера существует 4 версии
    данной структуры.
    Описание полей: название - тип - описание
    Версия BITMAPCOREHEADER (12 байт)
    Size     - DWORD - Размер данной структуры в байтах,
                       указывающий так же на версию структуры.
    Width    - WORD  - Ширина (Width) и высота (bcHeight) растра в
    Height   - WORD  - пикселях. Указываются целым числом без знака.
                       Значение 0 не документировано.
    Planes   - WORD  - В BMP допустимо только значение 1. Это поле
                       используется в значках и курсорах Windows.
    BitCount - WORD  - Количество бит на пиксель.
    Версия BITMAPINFOHEADER (40 байт)
    Size          - DWORD - Размер данной структуры в байтах,
                            указывающий так же на версию структуры.
    Width         - LONG  - Ширина растра в пикселях. Указывается
                            целым числом со знаком. Ноль и
                            отрицательные не документированя
    Height        - LONG  - Целое число со знаком, содержащее два
                            параметра: высота растра в пикселях
                            (абсолютное значение числа) и порядок
                            следования строк в двумерных массивах
                            (знак числа). Нулевое значение не
                            документировано.
    Planes        - WORD  - В BMP допустимо только значение 1. Это
                            поле используется в значках и курсорах
                            Windows.
    BitCount      - WORD  - Количество бит на пиксель.
    Compression   - DWORD - Указывает на способ хранения пикселей.
    SizeImage     - DWORD - Размер пиксельных данных в байтах.
                            Может быть обнулено если хранение
                            осуществляется двумерным массивом.
    XPelsPerMeter - LONG  - Количество пикселей на метр
    YPelsPerMeter - LONG  - по горизонтали и вертикали.
    ClrUsed       - DWORD - Размер таблицы цветов в ячейках.
    ClrImportant  - DWORD - Количество ячеек от начала таблицы
                            цветов до последней используемой
                            (включая её саму).
    Допольнительные поля версии BITMAPV4HEADER (108 байт)
    RedMask    - DWORD        - Битовые маски для извлечения
    GreenMask  - DWORD        - значений каналов: интенсивность
    BlueMask   - DWORD        - красного, зелёного, синего
    AlphaMask  - DWORD        - и значение альфа-канала.
    CSType     - DWORD        - Вид цветового пространства.
    Endpoints  - CIEXYZTRIPLE - Значение этих четырёх полей
                                берётся во внимание
    GammaRed   - DWORD        - только если поле CSType содержит
                                0 (LCS_CALIBRATED_RGB).
    GammaGreen - DWORD        - Тогда конечные точки и значения
                                гаммы для трёх
    GammaBlue  - DWORD        - цветовых компонент указываются
                                в этих полях.
    Допольнительные поля версии BITMAPV5HEADER (124 байт)
    Intenе      - DWORD - Предпочтения при рендеринге растра.
    ProfileData - DWORD - Смещение в байтах цветового профиля
                          от начала BITMAPINFO.
    ProfileSize - DWORD - Если в BMP непосредственно включается
                          цветовой профиль, то здесь указывается
                          его размер в байтах.
    Reserved    - DWORD - Зарезервировано и должно быть обнулено.
    """
    def __init__(self, bmp_file):
        self.Size = read_DWORD(bmp_file)
        self.type_of_struct = None
        # определяем тип структуры BITMAPINFOHEADER
        # по её размеру и инициализируем её:
        #   12 - BITMAPCOREHEADER
        #   40 - BITMAPINFOHEADER
        #   108 - BITMAPV4HEADER
        #   124 - BITMAPV5HEADER
        if self.Size == 12:
            self.type_of_struct = 'BITMAPCOREHEADER'
            self.init_BITMAPCOREHEADER(bmp_file)
        elif self.Size == 40:
            self.type_of_struct = 'BITMAPINFOHEADER'
            self.init_BITMAPINFOHEADER(bmp_file)
        elif self.Size == 108:
            # тип BITMAPV4HEADER является расширеной
            # версией типа BITMAPINFOHEADER, по этому
            # считываем сначало информацию для
            # BITMAPINFOHEADER, а потом для BITMAPV4HEADER
            self.type_of_struct = 'BITMAPV4HEADER'
            self.init_BITMAPINFOHEADER(bmp_file)
            self.init_BITMAPV4HEADER(bmp_file)
        elif self.Size == 124:
            # см. выше
            self.type_of_struct = 'BITMAPV5HEADER'
            self.init_BITMAPINFOHEADER(bmp_file)
            self.init_BITMAPV4HEADER(bmp_file)
            self.init_BITMAPV5HEADER(bmp_file)
        else:
            print('Error type of file')
            exit(-1)

    def init_BITMAPCOREHEADER(self, bmp_file):
        """Инициализация структуры типа BITMAPCOREHEADER
        """
        self.Width = read_WORD(bmp_file)
        self.Height = read_WORD(bmp_file)
        # порядок строк идет в обратном порядке
        self.reversed = True
        self.Planes = read_WORD(bmp_file)
        self.BitCount = read_WORD(bmp_file)

    def init_BITMAPINFOHEADER(self, bmp_file):
        """Инициализация структуры типа BITMAPINFOHEADER
        """
        self.Width = read_DWORD(bmp_file)
        self.Height = read_DWORD(bmp_file)
        # если self.Height > 0, то порядок строк идет в
        # в обратном порядке, иначе в прямом
        if self.Height & 0x80000000:
            self.Height = (self.Height - 1) ^ 0xffffffff
            self.reversed = False
        else:
            self.reversed = True
        self.Planes = read_WORD(bmp_file)
        self.BitCount = read_WORD(bmp_file)
        self.Compression = read_DWORD(bmp_file)
        self.SizeImage = read_DWORD(bmp_file)
        self.XPelsPerMeter = read_DWORD(bmp_file)
        self.YPelsPerMeter = read_DWORD(bmp_file)
        self.ClrUsed = read_DWORD(bmp_file)
        self.ClrImportant = read_DWORD(bmp_file)

    def init_BITMAPV4HEADER(self, bmp_file):
        """Инициализация дополнительных полей структуры
        типа BITMAPV4HEADER
        """
        self.RedMask = read_DWORD(bmp_file)
        self.GreenMask = read_DWORD(bmp_file)
        self.BlueMask = read_DWORD(bmp_file)
        self.AlphaMask = read_DWORD(bmp_file)
        self.CSType = read_DWORD(bmp_file)
        self.Endpoints = read_CIEXYZTRIPLE(bmp_file)
        self.GammaRed = read_DWORD(bmp_file)
        self.GammaGreen = read_DWORD(bmp_file)
        self.GammaBlue = read_DWORD(bmp_file)

    def init_BITMAPV5HEADER(self, bmp_file):
        """Инициализация дополнительных полей структуры
        типа BITMAPV5HEADER
        """
        self.Intent = read_DWORD(bmp_file)
        self.ProfileData = read_DWORD(bmp_file)
        self.ProfileSize = read_DWORD(bmp_file)
        self.Reserved = read_DWORD(bmp_file)

    def info(self):
        """Ф-я возвращает инфомрацию о структуре
        """
        info_str = '{Type}\n' \
            'Width: {Width}\n' \
            'Height: {Height}\n' \
            'Planes: {Planes}\n' \
            'BitCount: {BitCount}\n'.format(
                Type=self.type_of_struct,
                Width=self.Width,
                Height=self.Height,
                Planes=self.Planes,
                BitCount=self.BitCount
            )
        if self.type_of_struct == 'BITMAPCOREHEADER':
            return info_str

        info_str += \
            'Compression: {Compression}\n' \
            'SizeImage: {SizeImage}\n' \
            'XPelsPerMeter: {XPelsPerMeter}\n' \
            'YPelsPerMeter: {YPelsPerMeter}\n' \
            'ClrUsed: {ClrUsed}\n' \
            'ClrImportant: {ClrImportant}\n'.format(
                Compression=self.Compression,
                SizeImage=self.SizeImage,
                XPelsPerMeter=self.XPelsPerMeter,
                YPelsPerMeter=self.YPelsPerMeter,
                BitCount=self.BitCount,
                ClrUsed=self.ClrUsed,
                ClrImportant=self.ClrImportant
            )
        if self.type_of_struct == 'BITMAPINFOHEADER':
            return info_str

        info_str += \
            'RedMask: {RedMask}\n' \
            'GreenMask: {GreenMask}\n' \
            'BlueMask: {BlueMask}\n' \
            'AlphaMask: {AlphaMask}\n' \
            'CSType: {CSType}\n' \
            'Endpoints: {x1}\t{y1}\t{z1}\n' \
            '           {x2}\t{y2}\t{z2}\n' \
            '           {x3}\t{y3}\t{z3}\n' \
            'GammaRed: {GammaRed}\n' \
            'GammaGreen: {GammaGreen}\n' \
            'GammaBlue: {GammaBlue}\n'.format(
                RedMask=self.RedMask,
                GreenMask=self.GreenMask,
                BlueMask=self.BlueMask,
                AlphaMask=self.AlphaMask,
                CSType=self.CSType,
                x1=self.Endpoints.x.x,
                y1=self.Endpoints.x.y,
                z1=self.Endpoints.x.z,
                x2=self.Endpoints.y.x,
                y2=self.Endpoints.y.y,
                z2=self.Endpoints.y.z,
                x3=self.Endpoints.z.x,
                y3=self.Endpoints.z.y,
                z3=self.Endpoints.z.z,
                GammaRed=self.GammaRed,
                GammaGreen=self.GammaGreen,
                GammaBlue=self.GammaBlue
            )
        if self.type_of_struct == 'BITMAPV4HEADER':
            return info_str

        info_str += \
            'Intent: {Intent}\n' \
            'ProfileData: {ProfileData}\n' \
            'ProfileSize: {ProfileSize}\n' \
            'Reserved: {Reserved}\n'.format(
                Intent=self.Intent,
                ProfileData=self.ProfileData,
                ProfileSize=self.ProfileSize,
                Reserved=self.Reserved,
            )
        if self.type_of_struct == 'BITMAPV5HEADER':
            return info_str
        else:
            print('Struct type not found')
            exit(-2)


if __name__ == '__main__':

    # https://en.wikipedia.org/wiki/BMP_file_format
    path_ = os.path.dirname(__file__)
    
    filename = "_сarib_TC"
    # filename = "CAT16"
    # filename = "CAT256"

    ext = 'bmp'

    if not os.path.exists(f"{path_}\\output"):
        os.mkdir(f"{path_}\\output")

    bmp = BMPIMAGE(open(f"{path_}\\input\\{filename}.{ext}", 'rb'))
    print(bmp.info())
    height = bmp.BMInfo.Header.Height
    width = bmp.BMInfo.Header.Width

    
    img = Image.open(f"{path_}\\input\\{filename}.{ext}")
    img_matrix = np.asarray(img.convert("RGB"))

    img_matrix_average = np.copy(img_matrix)
    img_matrix_y1 = np.copy(img_matrix)
    img_matrix_y2 = np.copy(img_matrix)

    for row in range(height):
        for col in range(width):
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





    # app = QApplication(sys.argv)

    # # Создаем изображение нужного размера
    # # и заполняем его пикселями нужного цвета
    # img = QImage(width, height, QImage.Format_RGB32)
    # for i in range(height):
    #     for j in range(width):
    #         img.setPixel(
    #             j,
    #             i,
    #             color_from_tuple(bmp.PixelData[i][j])
    #         )

    # def resizing(event):
    #     w = event.size().width()
    #     h = event.size().height()
    #     new_w = 0
    #     new_h = 0
    #     if w / h < width / height:
    #         new_w = w
    #         new_h = int(w / width * height)
    #     else:
    #         new_w = int(h / height * width)
    #         new_h = h
    #     label.setPixmap(
    #         QPixmap.fromImage(img).scaled(
    #             new_w,
    #             new_h
    #         )
    #     )
    #     label.adjustSize()

    # main_widget = QWidget()

    # label = QLabel('', main_widget)
    # label.setPixmap(QPixmap.fromImage(img))

    # main_widget.resizeEvent = resizing
    # main_widget.setMinimumSize(1, 1)
    # main_widget.resize(640, 480)
    # main_widget.show()

    # app.exec_()