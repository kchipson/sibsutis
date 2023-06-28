import os
import sys
import random

from PIL import Image

from PyQt5.QtWidgets import *
from PyQt5.QtGui import *
from PyQt5.QtCore import *


class RGB:
    """Структура для хранения красного, зеленого и синего канала
    и зарезервированного поля
    """

    def __init__(self, r, g, b):
        self.r = r
        self.g = g
        self.b = b

    def __repr__(self):
        return f"R{self.r}  G{self.g}  B{self.b}"


def read_int_from_file(binary_file, size):
    """Функция считывает из файла binary_file ровно size
    байт и возвращает образуемое ими в little-endian число
    """
    return int.from_bytes(
        binary_file.read(size),
        byteorder='little'
    )


def read_BYTE(binary_file):
    return read_int_from_file(binary_file, 1)


def read_WORD(binary_file):
    return read_int_from_file(binary_file, 2)


def read_RGB(binary_file):
    return RGB(
        read_BYTE(binary_file),
        read_BYTE(binary_file),
        read_BYTE(binary_file)
    )


class PCXIMAGE:
    def __init__(self, pcx_file):
        self.header = PCXFILEHEADER(pcx_file)
        self.width = self.header.x_max + 1
        self.height = self.header.y_max + 1

        byte_beacon_num = pcx_file.seek(-769, 2)
        byte_beacon = True if (hex(int.from_bytes(pcx_file.read(1), byteorder="little")) == hex(
            0xC) or hex(int.from_bytes(pcx_file.read(1), byteorder="little")) == hex(0xA)) else False

        if byte_beacon:
            self.colormap = list()
            for i in range(256):
                self.colormap.append(read_RGB(pcx_file))
        else:
            self.colormap = self.header.colormap

        self.img_arr = list()
        pcx_file.seek(128, 0)
        while (byte := pcx_file.read(1)):
            if byte_beacon and not pcx_file.tell() < byte_beacon_num:
                break

            byte = int.from_bytes(byte, byteorder='little')

            if (byte >> 6) == 0b11:
                counter = byte & 0x3F
                byte = pcx_file.read(1)
                byte = int.from_bytes(byte, byteorder='little')
                for i in range(counter):
                    self.img_arr.append(self.colormap[byte])
                # self.img_arr = self.img_arr + ([self.colormap[byte]] * counter)
            else:
                self.img_arr.append(self.colormap[byte])

        print(len(self.img_arr), self.width * self.height)

    def info(self):
        return self.header.info()


class PCXFILEHEADER:
    """ Структура с информационными полями (128) """

    def __init__(self, pcx_file):
        self.manufacturer = read_BYTE(pcx_file)
        self.version = read_BYTE(pcx_file)
        self.encoding = read_BYTE(pcx_file)
        self.bits_per_pixel = read_BYTE(pcx_file)
        self.x_min = read_WORD(pcx_file)
        self.y_min = read_WORD(pcx_file)
        self.x_max = read_WORD(pcx_file)
        self.y_max = read_WORD(pcx_file)
        self.hdpi = read_WORD(pcx_file)
        self.vdpi = read_WORD(pcx_file)
        self.colormap = list()
        for i in range(16):
            self.colormap.append(read_RGB(pcx_file))
        self.reserved = read_BYTE(pcx_file)
        self.num_planes = read_BYTE(pcx_file)
        self.bytes_per_line = read_WORD(pcx_file)
        self.palette_info = read_WORD(pcx_file)
        self.h_screen_size = read_WORD(pcx_file)
        self.v_screen_size = read_WORD(pcx_file)
        self.filler = read_int_from_file(pcx_file, 54)

    def info(self):
        """ Ф-я возвращает информацию о структуре """

        info_str = f"PCXFILEHEADER\n" \
            f"  Manufacturer: {self.manufacturer}\n" \
            f"  Version: {self.version}\n" \
            f"  Encoding: {self.encoding}\n" \
            f"  BitsPerPixel: {self.bits_per_pixel}\n" \
            f"  Xmin: {self.x_min}\n" \
            f"  Ymin: {self.y_min}\n" \
            f"  Xmax: {self.x_max}\n" \
            f"  Ymax: {self.y_max}\n" \
            f"  HDpi: {self.hdpi}\n" \
            f"  VDpi: {self.vdpi}\n" \
            f"  Colormap: {[str(i) for i in self.colormap]}\n" \
            f"  Reserved: {self.reserved}\n" \
            f"  NPlanes: {self.num_planes}\n" \
            f"  BytesPerLine: {self.bytes_per_line}\n" \
            f"  PaletteInfo: {self.palette_info}\n" \
            f"  HscreenSize: {self.h_screen_size}\n" \
            f"  VscreenSize: {self.v_screen_size}\n" \
            f"  Filler: {self.filler}"
        return info_str


class Widget(QWidget):
    def __init__(self):
        super().__init__()

        file = open("input\CAT256.PCX", 'rb')
        
        self.pcx = PCXIMAGE(file)
        print(self.pcx.info())

        self.resize(self.pcx.width, self.pcx.height)
        self.setWindowTitle('Лабораторная работа #8')
        self.center()

    def paintEvent(self, event):
        super().paintEvent(event)

        painter = QPainter(self)
        painter.setBrush(Qt.black)
        painter.drawRect(self.rect())

        painter.setPen(QColor(0xff, 0xff, 0xff))
        painter.drawPoint(self.width() // 2, self.height() // 2)
        for i in range(self.pcx.width):
            for j in range(self.pcx.height):
                color = self.pcx.img_arr[j * self.pcx.header.bytes_per_line + i]
                painter.setPen(QColor(color.r, color.g, color.b))
                painter.drawPoint(i, j)

    def center(self):
        qr = self.frameGeometry()
        cp = QDesktopWidget().availableGeometry().center()
        qr.moveCenter(cp)
        self.move(qr.topLeft())


# https://wasm.in/blogs/o-formate-pcx.104/
# https://web.archive.org/web/20100206055706/http://www.qzx.com/pc-gpe/pcx.txt

if __name__ == '__main__':
    app = QApplication(sys.argv)
    w = Widget()
    w.show()
    sys.exit(app.exec_())
