#ifndef INPUTDIALOG_MIRONENKO_H
#define INPUTDIALOG_MIRONENKO_H

#include <QDialog>
#include <QLineEdit>

class QLineEdit;

class InputDialog_Mironenko : public QDialog{
    Q_OBJECT
private:
    QLineEdit * m_ptxtFirstName;
    QLineEdit * m_ptxtLastName;
public:
    InputDialog_Mironenko(QWidget* pwgt = nullptr);

    QString firstName() const;
    QString lastName() const;
};


#endif // INPUTDIALOG_MIRONENKO_H
