BMP_32BIT_RED_MASK = 0x00ff0000
BMP_32BIT_GREEN_MASK = 0x0000ff00
BMP_32BIT_BLUE_MASK = 0x000000ff

BMP_16BIT_RED_MASK = 0x7c00
BMP_16BIT_GREEN_MASK = 0x03e0
BMP_16BIT_BLUE_MASK = 0x001f


class RGBQUAD:
    """ Структура для хранения красного, зеленого и синего канала и зарезервированного поля """

    def __init__(self, b, g, r, reserved):
        self.b = b
        self.g = g
        self.r = r
        self.reserved = reserved


class CIEXYZ:
    def __init__(self, _x, _y, _z):
        self.x = _x
        self.y = _y
        self.z = _z


class CIEXYZTRIPLE:
    """ Струтура, хранящая тройку CIEXYZ """

    def __init__(self, x, y, z):
        self.x = x
        self.y = y
        self.z = z


def convert(value, bits_from, bits_to):
    """ Функция для перевода значений из bits_from-битной диапозона в bits_to-битный """
    return int((value / (1 << bits_from)) * (1 << bits_to))


def read_int_from_file(binary_file, size):
    """ Функция считывает из файла binary_file ровно size байт и возвращает образуемое ими в little-endian число """
    return int.from_bytes(binary_file.read(size), byteorder="little")


def read_byte(binary_file):
    """Считывает из файла байт
    """
    return read_int_from_file(binary_file, 1)


def read_word(binary_file):
    """Считывает из файла машинное слово
    """
    return read_int_from_file(binary_file, 2)


def read_dword(binary_file):
    """Считывает з файла двойное машинное слово
    """
    return read_int_from_file(binary_file, 4)


def read_CIEXYZ(binary_file):
    """Считывет из файла структуру типа CIEXYZ
    """
    return CIEXYZ(
        read_dword(binary_file),
        read_dword(binary_file),
        read_dword(binary_file)
    )


def read_RGBQUAD(binary_file):
    """Считывает из файла структуру типа RGB_QUAD
    """
    return RGBQUAD(
        read_byte(binary_file),
        read_byte(binary_file),
        read_byte(binary_file),
        read_byte(binary_file)
    )


def read_CIEXYZTRIPLE(binary_file):
    """Считывае структуру типа CIEXYZTRIPLE
    """
    return CIEXYZTRIPLE(
        read_CIEXYZ(binary_file),
        read_CIEXYZ(binary_file),
        read_CIEXYZ(binary_file)
    )


class BMPIMAGE:
    """
    Данные в формате BMP состоят из трёх основных блоков различного размера:
        1) Заголовок из структуры BITMAPFILEHEADER и блока
           BITMAPINFO.
           Последний содержит:
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
        if self.BMInfo.Header.bit_count == 24:
            self.PixelData = self.get_pixel_data_24bit(bmp_file)
        elif self.BMInfo.Header.bit_count == 16:
            self.PixelData = self.get_pixel_data_16bit(bmp_file)
        elif self.BMInfo.Header.bit_count == 32:
            self.PixelData = self.get_pixel_data_32bit(bmp_file)
        elif self.BMInfo.Header.bit_count == 8:
            self.PixelData = self.get_pixel_data_8bit(bmp_file)
        elif self.BMInfo.Header.bit_count == 4:
            self.PixelData = self.get_pixel_data_4bit(bmp_file)
        elif self.BMInfo.Header.bit_count == 1:
            self.PixelData = self.get_pixel_data_1bit(bmp_file)
        else:
            self.PixelData = None

    def info(self):
        """ Ф-я возвращает информацию о bmp-файле """
        return f"{self.BMFileHeader.info()}\n{self.BMInfo.info()}"

    def get_pixel_data_24bit(self, bmp_file):
        """ Ф-я считывает из файла двухмерный массив пикселей для 24 битных изображений без RLE-сжатия """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.height
        width = self.BMInfo.Header.width
        for i in range(height):
            bitmap.append(list())
            for j in range(width):
                blue = read_byte(bmp_file)
                green = read_byte(bmp_file)
                red = read_byte(bmp_file)
                bitmap[i].append((red, green, blue))
            # считываем лишние байты, т.к. строки в массиве пикселей выравнивются до кратности 4-ем
            bytes_count = 3 * width
            if bytes_count % 4 != 0:
                for j in range(4 - bytes_count % 4):
                    read_byte(bmp_file)
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

    def get_pixel_data_16_32bit(self, bmp_file, r_mask, g_mask, b_mask, bytes_per_pixel, bits_per_color):
        """ Ф-я считывает из файла двухмерный массив пикселей для 16/32 битных изображений без RLE-сжатия """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.height
        width = self.BMInfo.Header.width
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
                read_dword(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap

    def get_pixel_data_8bit(self, bmp_file):
        """ Ф-я считывает из файла двухмерный массив пикселей для 8 битных изображений без RLE-сжатия """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.height
        width = self.BMInfo.Header.width
        for i in range(height):
            bitmap.append(list())
            for j in range(width):
                color_idx = read_byte(bmp_file)
                red = self.BMInfo.Colors[color_idx].r
                green = self.BMInfo.Colors[color_idx].g
                blue = self.BMInfo.Colors[color_idx].b
                bitmap[i].append((red, green, blue))
            # считываем лишние байты, т.к. строки в массиве пикселей выравнивются до кратности 4-ем
            bytes_count = width
            if bytes_count % 4 != 0:
                for j in range(4 - bytes_count % 4):
                    read_byte(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap

    def get_pixel_data_4bit(self, bmp_file):
        """ Ф-я считывает из файла двухмерный массив пикселей для 4 битных изображений без RLE-сжатия """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.height
        width = self.BMInfo.Header.width
        scans_length = (width + 1) // 2
        for i in range(height):
            bitmap.append(list())
            for j in range(scans_length):
                double_color_idx = read_byte(bmp_file)
                first_color_idx = (double_color_idx & 0xF0) >> 4
                second_color_idx = double_color_idx & 0x0F
                red_first = self.BMInfo.Colors[first_color_idx].r
                green_first = self.BMInfo.Colors[first_color_idx].g
                blue_first = self.BMInfo.Colors[first_color_idx].b
                red_second = self.BMInfo.Colors[second_color_idx].r
                green_second = self.BMInfo.Colors[second_color_idx].g
                blue_second = self.BMInfo.Colors[second_color_idx].b
                bitmap[i].append((red_first, green_first, blue_first))
                bitmap[i].append((red_second, green_second, blue_second))
            # считываем лишние байты, т.к. строки в массиве пикселей выравнивются до кратности 4-ем
            bytes_count = scans_length
            if bytes_count % 4 != 0:
                for j in range(4 - bytes_count % 4):
                    read_byte(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap

    def get_pixel_data_1bit(self, bmp_file):
        """ Ф-я считывает из файла двухмерный массив пикселей для 1 битных изображений без RLE-сжатия """
        bitmap = list()
        # устанавливаем позицию массива пикселей
        bmp_file.seek(self.BMFileHeader.OffBits)
        height = self.BMInfo.Header.height
        width = self.BMInfo.Header.width
        scans_length = (width + 7) // 8
        for i in range(height):
            bitmap.append(list())
            for j in range(scans_length):
                color_idxs = read_byte(bmp_file)
                color_idxs = [int(x) for x in bin(color_idxs)[2:].zfill(8)]
                for k in color_idxs:
                    red = self.BMInfo.Colors[k].r
                    green = self.BMInfo.Colors[k].g
                    blue = self.BMInfo.Colors[k].b
                    bitmap[i].append((red, green, blue))
            # считываем лишние байты, т.к. строки в массиве пикселей выравнивются до кратности 4-ем
            bytes_count = scans_length
            if bytes_count % 4 != 0:
                for j in range(4 - bytes_count % 4):
                    read_byte(bmp_file)
        if self.BMInfo.Header.reversed:
            bitmap.reverse()
        return bitmap


class BITMAPFILEHEADER:
    """
    BITMAPFILEHEADER — 14-байтная структура, которая располагается в самом начале файла.
    Описание полей:
    название  - тип   - описание
    Type      - WORD  - Отметка для отличия формата от других (сигнатура формата). Может содержать единственное
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
        self.Type = read_word(bmp_file)
        self.Size = read_dword(bmp_file)
        self.Reserved1 = read_word(bmp_file)
        self.Reserved2 = read_word(bmp_file)
        self.OffBits = read_dword(bmp_file)

    def info(self):
        """ Ф-я возвращает инфомрацию о структуре """
        info_str = f"BITMAPFILEHEADER\n" \
                   f"Type:      {hex(self.Type)}\n" \
                   f"Size:      {self.Size}\n" \
                   f"Reserved1: {hex(self.Reserved1)}\n" \
                   f"Reserved2: {hex(self.Reserved2)}\n" \
                   f"OffBits:   {self.OffBits}\n"

        return info_str


class BITMAPINFO:
    """
    BITMAPINFO в файле идёт сразу за BITMAPFILEHEADE
    Блок BITMAPINFO состоит из трёх частей:
        1) Структура с информационными полями.
        2) Битовые маски для извлечения значений цветовых каналов (присутствуют не всегда).
        3) Таблица цветов (присутствует не всегда).
    """

    def __init__(self, bmp_file):
        self.Header = BITMAPINFOHEADER(bmp_file)
        if self.Header.bit_count <= 8:
            self.ColorsSize = 2 ** self.Header.bit_count
        else:
            self.ColorsSize = 0
        self.Colors = list()  # RGBQUAD
        for i in range(self.ColorsSize):
            self.Colors.append(read_RGBQUAD(bmp_file))

    def info(self):
        """ Ф-я возвращает инфомрацию о структуре """
        info_str = self.Header.info()
        if self.ColorsSize > 0:
            info_str += \
                f"Colors Table Size: {self.ColorsSize}\n" \
                "COLORS TABLE\n"
        for i in range(self.ColorsSize):
            info_str += f"{i + 1} : R {self.Colors[i].r} G {self.Colors[i].g} B {self.Colors[i].b}\n"
        return info_str


class BITMAPINFOHEADER:
    """
    Структура с информационными полями
    В зависимости от размера существует 4 версии данной структуры.
    Описание полей:
    название      - тип          - описание

    Версия BITMAPCOREHEADER (12 байт)
    Size          - DWORD        - Размер данной структуры в байтах,
                                   указывающий так же на версию структуры.
    Width         - WORD         - Ширина (Width) и высота (bcHeight) растра в
    Height        - WORD         - пикселях. Указываются целым числом без знака.
                                   Значение 0 не документировано.
    Planes        - WORD         - В BMP допустимо только значение 1. Это поле
                                   используется в значках и курсорах Windows.
    BitCount      - WORD         - Количество бит на пиксель.

    Версия BITMAPINFOHEADER (40 байт)
    Size          - DWORD        - Размер данной структуры в байтах,
                                   указывающий так же на версию структуры.
    Width         - LONG         - Ширина растра в пикселях. Указывается
                                   целым числом со знаком. Ноль и
                                   отрицательные не документированя
    Height        - LONG         - Целое число со знаком, содержащее два
                                   параметра: высота растра в пикселях
                                   (абсолютное значение числа) и порядок
                                   следования строк в двумерных массивах
                                   (знак числа). Нулевое значение не
                                   документировано.
    Planes        - WORD         - В BMP допустимо только значение 1. Это
                                   поле используется в значках и курсорах
                                   Windows.
    BitCount      - WORD         - Количество бит на пиксель.
    Compression   - DWORD        - Указывает на способ хранения пикселей.
    SizeImage     - DWORD        - Размер пиксельных данных в байтах.
                                   Может быть обнулено если хранение
                                   осуществляется двумерным массивом.
    XPelsPerMeter - LONG         - Количество пикселей на метр по горизонтали
    YPelsPerMeter - LONG         - Количество пикселей на метр по вертикали
    ClrUsed       - DWORD        - Размер таблицы цветов в ячейках.
    ClrImportant  - DWORD        - Количество ячеек от начала таблицы
                                   цветов до последней используемой
                                   (включая её саму).

    Допольнительные поля версии BITMAPV4HEADER (108 байт)
    RedMask       - DWORD        - Битовые маски для извлечения
    GreenMask     - DWORD        - значений каналов: интенсивность
    BlueMask      - DWORD        - красного, зелёного, синего
    AlphaMask     - DWORD        - и значение альфа-канала.
    CSType        - DWORD        - Вид цветового пространства.
    Endpoints     - CIEXYZTRIPLE - Значение этих четырёх полей
                                   берётся во внимание
    GammaRed      - DWORD        - только если поле CSType содержит
                                   0 (LCS_CALIBRATED_RGB).
    GammaGreen    - DWORD        - Тогда конечные точки и значения
                                   гаммы для трёх
    GammaBlue     - DWORD        - цветовых компонент указываются
                                   в этих полях.

    Допольнительные поля версии BITMAPV5HEADER (124 байт)
    Intenе        - DWORD        - Предпочтения при рендеринге растра.
    ProfileData   - DWORD        - Смещение в байтах цветового профиля
                                   от начала BITMAPINFO.
    ProfileSize   - DWORD        - Если в BMP непосредственно включается
                                   цветовой профиль, то здесь указывается
                                   его размер в байтах.
    Reserved      - DWORD        - Зарезервировано и должно быть обнулено.
    """

    def __init__(self, bmp_file):
        self.size = read_dword(bmp_file)
        self.type_of_struct = None
        if self.size == 12:
            self.type_of_struct = "BITMAPCOREHEADER"
            self.init_BITMAPCOREHEADER(bmp_file)
        elif self.size == 40:
            self.type_of_struct = "BITMAPINFOHEADER"
            self.init_BITMAPINFOHEADER(bmp_file)
        elif self.size == 108:
            self.type_of_struct = "BITMAPV4HEADER"
            self.init_BITMAPINFOHEADER(bmp_file)
            self.init_BITMAPV4HEADER(bmp_file)
        elif self.size == 124:
            self.type_of_struct = "BITMAPV5HEADER"
            self.init_BITMAPINFOHEADER(bmp_file)
            self.init_BITMAPV4HEADER(bmp_file)
            self.init_BITMAPV5HEADER(bmp_file)
        else:
            print("Error type of file")
            exit(-1)

    def init_BITMAPCOREHEADER(self, bmp_file):
        """ Инициализация структуры типа BITMAPCOREHEADER """
        self.width = read_word(bmp_file)
        self.height = read_word(bmp_file)
        # порядок строк идет в обратном порядке
        self.reversed = True
        self.planes = read_word(bmp_file)
        self.bit_count = read_word(bmp_file)

    def init_BITMAPINFOHEADER(self, bmp_file):
        """ Инициализация структуры типа BITMAPINFOHEADER """
        self.width = read_dword(bmp_file)
        self.height = read_dword(bmp_file)
        # если self.Height > 0, то порядок строк идет в
        # в обратном порядке, иначе в прямом
        if self.height & 0x80000000:
            self.height = (self.height - 1) ^ 0xffffffff
            self.reversed = False
        else:
            self.reversed = True
        self.planes = read_word(bmp_file)
        self.bit_count = read_word(bmp_file)
        self.compression = read_dword(bmp_file)
        self.size_image = read_dword(bmp_file)
        self.x_pels_per_meter = read_dword(bmp_file)
        self.y_pels_per_meter = read_dword(bmp_file)
        self.colors_used = read_dword(bmp_file)
        self.colors_important = read_dword(bmp_file)

    def init_BITMAPV4HEADER(self, bmp_file):
        """ Инициализация дополнительных полей структуры типа BITMAPV4HEADER """
        self.red_mask = read_dword(bmp_file)
        self.green_mask = read_dword(bmp_file)
        self.blue_mask = read_dword(bmp_file)
        self.alpha_mask = read_dword(bmp_file)
        self.cs_type = read_dword(bmp_file)
        self.endpoints = read_CIEXYZTRIPLE(bmp_file)
        self.gamma_red = read_dword(bmp_file)
        self.gamma_green = read_dword(bmp_file)
        self.gamma_blue = read_dword(bmp_file)

    def init_BITMAPV5HEADER(self, bmp_file):
        """ Инициализация дополнительных полей структуры типа BITMAPV5HEADER """
        self.intent = read_dword(bmp_file)
        self.profile_data = read_dword(bmp_file)
        self.profile_size = read_dword(bmp_file)
        self.reserved = read_dword(bmp_file)

    def info(self):
        """ Ф-я возвращает инфомрацию о структуре """
        info_str = f"{self.type_of_struct}\n" \
                   f"Width: {self.width}\n" \
                   f"Height: {self.height}\n" \
                   f"Planes: {self.planes}\n" \
                   f"BitCount: {self.bit_count}\n"

        if self.type_of_struct == "BITMAPCOREHEADER":
            return info_str

        info_str += \
            f"Compression: {self.compression}\n" \
            f"SizeImage: {self.size_image}\n" \
            f"XPelsPerMeter: {self.x_pels_per_meter}\n" \
            f"YPelsPerMeter: {self.y_pels_per_meter}\n" \
            f"ClrUsed: {self.colors_used}\n" \
            f"ClrImportant: {self.colors_important}\n"

        if self.type_of_struct == "BITMAPINFOHEADER":
            return info_str

        info_str += \
            f"RedMask: {self.red_mask}\n" \
            f"GreenMask: {self.green_mask}\n" \
            f"BlueMask: {self.blue_mask}\n" \
            f"AlphaMask: {self.alpha_mask}\n" \
            f"CSType: {self.cs_type}\n" \
            f"Endpoints: {self.endpoints.x.x}\t{self.endpoints.x.y}\t{self.endpoints.x.z}\n" \
            f"           {self.endpoints.y.x}\t{self.endpoints.y.y}\t{self.endpoints.y.z}\n" \
            f"           {self.endpoints.z.x}\t{self.endpoints.z.y}\t{self.endpoints.z.z}\n" \
            f"GammaRed: {self.gamma_red}\n" \
            f"GammaGreen: {self.gamma_green}\n" \
            f"GammaBlue: {self.gamma_blue}\n"

        if self.type_of_struct == "BITMAPV4HEADER":
            return info_str

        info_str += \
            f"Intent: {self.intent}\n" \
            f"ProfileData: {self.profile_data}\n" \
            f"ProfileSize: {self.profile_size}\n" \
            f"Reserved: {self.reserved}\n"

        if self.type_of_struct == "BITMAPV5HEADER":
            return info_str
        else:
            print("Struct type not found")
            exit(-2)
