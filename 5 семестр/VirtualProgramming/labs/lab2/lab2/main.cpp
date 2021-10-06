#include "startdialog_mironenko.h"
#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    StartDialog_Mironenko w;
    w.show();

    return a.exec();
}
