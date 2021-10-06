#include "docwindow_mironenko.h"

DocWindow_Mironenko::DocWindow_Mironenko(QWidget* pwgt) : QTextEdit(pwgt)
{
}


void DocWindow_Mironenko::slotLoad()
{
    QString str = QFileDialog::getOpenFileName();
    if (str.isEmpty())
        return;

    QFile file(str);
    if (file.open(QIODevice::ReadOnly)){
        QTextStream stream(&file);
        setPlainText(stream.readAll());
        file.close();

        m_strFileName = str;

        emit changeWindowTitle(m_strFileName);
    }
}


void DocWindow_Mironenko::slotSaveAs(){
    QString str = QFileDialog::getSaveFileName(nullptr, m_strFileName);
    if (!str.isEmpty()){
        m_strFileName=str;
        slotSave();
    }
}


void DocWindow_Mironenko::slotSave(){
    if (m_strFileName.isEmpty()){
        slotSaveAs();
        return;
    }

    QFile file(m_strFileName);
    if (file.open(QIODevice::WriteOnly)){
        QTextStream(&file) << toPlainText();
        file.close();

        emit changeWindowTitle(m_strFileName);
    }
}
