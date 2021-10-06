#ifndef STARTDIALOG_MIRONENKO_H
#define STARTDIALOG_MIRONENKO_H

#include <QWidget>
#include <QPushButton>
#include <QMessageBox>
#include "inputdialog_mironenko.h"


class StartDialog_Mironenko : public QPushButton
{
        Q_OBJECT
public:
    StartDialog_Mironenko(QWidget * pwgt = nullptr);
public slots:
    void slotButtonClicked();
};

#endif // STARTDIALOG_MIRONENKO_H
