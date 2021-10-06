//
// Created by kchipson on 19.02.2020.
//

#ifndef MYTERM_H
#define MYTERM_H

enum colors{};

class myTerm {
public:
    /* МЕТОДЫ */
    void clrScr (); /* Производит очистку и перемещение курсора в левый верхний угол экрана */
    void  goToXY (int numRow, int numCol); /* Перемещает курсор в указанную позицию */
    void getScreenSize (int * rows, int * cols); /* Определяет размер экрана терминала (количество строк и столбцов) */
    void setFgColor (enum colors); /* Устанавливает цвет последующих выводимых символов */
    void setBgColor (enum colors); /* Устанавливает цвет фона последующих выводимых символов */
};


#endif //MYTERM_H
