#include "inputdialog_mironenko.h"
#include <QLabel>
#include <QLayout>
#include <QString>
#include <QPushButton>

InputDialog_Mironenko::InputDialog_Mironenko(QWidget* pwgt) : QDialog(pwgt)
{
    m_ptxtFirstName = new QLineEdit;
    m_ptxtLastName = new QLineEdit;

    QLabel* plblFirstName = new QLabel("&Имя");
    QLabel* plblLastName = new QLabel("&Фамилия");

    plblFirstName->setBuddy(m_ptxtFirstName);
    plblLastName->setBuddy(m_ptxtLastName);

    QPushButton* pcmdOk = new QPushButton("&Ok");
    QPushButton* pcmdCancel = new QPushButton("&Cancel");

    connect(pcmdOk, SIGNAL(clicked()), SLOT(accept()));
    connect(pcmdCancel, SIGNAL(clicked()), SLOT(reject()));

    QGridLayout* ptopLayout = new QGridLayout;
    ptopLayout->addWidget(plblFirstName, 0, 0);
    ptopLayout->addWidget(plblLastName, 1, 0);
    ptopLayout->addWidget(m_ptxtFirstName, 0, 1);
    ptopLayout->addWidget(m_ptxtLastName, 1, 1);
    ptopLayout->addWidget(pcmdOk, 2, 0);
    ptopLayout->addWidget(pcmdCancel, 2, 1);
    setLayout(ptopLayout);
}

QString InputDialog_Mironenko::firstName() const
{
    return m_ptxtFirstName->text();
}

QString InputDialog_Mironenko::lastName() const
{
    return m_ptxtLastName->text();
}
