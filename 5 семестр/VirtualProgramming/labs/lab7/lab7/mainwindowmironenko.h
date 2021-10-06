#ifndef MAINWINDOWMIRONENKO_H
#define MAINWINDOWMIRONENKO_H

#include <QMainWindow>
#include "graphicsmironenko.h"

namespace Ui {
class MainWindowMironenko;
}

class MainWindowMironenko : public QMainWindow
{
    Q_OBJECT

public:
    explicit MainWindowMironenko(QWidget *parent = nullptr);
    ~MainWindowMironenko();

private:
    Ui::MainWindowMironenko *ui;
};

#endif // MAINWINDOWMIRONENKO_H
