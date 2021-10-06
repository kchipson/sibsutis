#include "startdialog_mironenko.h"

StartDialog_Mironenko::StartDialog_Mironenko(QWidget * pwgt): QPushButton("Нажми", pwgt)
{
    this -> setGeometry(0, 0, 400, 200);

    connect(this, SIGNAL(clicked()), SLOT(slotButtonClicked()));
}

void StartDialog_Mironenko::slotButtonClicked()
{
    InputDialog_Mironenko* pInputDialog = new InputDialog_Mironenko;
    if(pInputDialog -> exec() == QDialog::Accepted)
    {
        QMessageBox::information(
            nullptr,
            "Ваша информация:",
            "Имя:           "
            + pInputDialog -> firstName()
            + "\nФамилия:  "
            + pInputDialog -> lastName()
        );
    }
    delete pInputDialog;
}
