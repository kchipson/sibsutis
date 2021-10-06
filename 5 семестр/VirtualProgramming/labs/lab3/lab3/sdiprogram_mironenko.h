#ifndef SDIPROGRAM_MIRONENKO_H
#define SDIPROGRAM_MIRONENKO_H

#include <QMainWindow>
#include <QMessageBox>

#include "docwindow_mironenko.h"

class SDIProgram_Mironenko : public QMainWindow
{
    Q_OBJECT

public:
    SDIProgram_Mironenko(QWidget *parent = nullptr);
    ~SDIProgram_Mironenko();


public slots:
    void slotAbout();
    void slotChangeWindowTitle(const QString&);
};

#endif // SDIPROGRAM_MIRONENKO_H
