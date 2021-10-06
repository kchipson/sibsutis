#include "mironenkoform.h"
#include "ui_mironenkoform.h"

MironenkoForm::MironenkoForm(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::MironenkoForm)
{
    ui->setupUi(this);
    connect(ui->btnBox, SIGNAL(clicked()), this, SLOT(on_btnBox_clicked()));
}

MironenkoForm::~MironenkoForm()
{
    delete ui;
}

void MironenkoForm::recieveData(QString str){
    this->show();
    QStringList lst = str.split("*");
    ui->textEdit->setText(lst.at(0) + "\n\nв" + lst.at(1));
    QImage image(lst.at(1));
        ui->label->setPixmap(QPixmap::fromImage(image));
}

void MironenkoForm::on_btnBox_clicked(QAbstractButton *button)
{
    if (button->text() == "Сбросить"){
        ui->textEdit->clear();
        ui->label->clear();
    }
    else if(button->text() == "Сохранить"){
        QString filename = QFileDialog::getSaveFileName(nullptr, "Сохранить файл", QDir::currentPath(), "*.txt");
        QTextDocumentWriter writer;
        writer.setFileName(filename);
        writer.write(ui->textEdit->document());
    }
    else if(button->text() == "Открыть"){
        QString filename = QFileDialog::getOpenFileName(nullptr, "Открыть файл", QDir::currentPath(), "*.txt");
        QFile file(filename);
        if(file.open(QIODevice::ReadOnly | QIODevice::Text))
            ui->textEdit->setPlainText(file.readAll());
        QStringList inf = ui->textEdit->toPlainText().split("\n");
        QImage image(inf.at(6));
        ui->label->setPixmap(QPixmap::fromImage(image));
    }
}
