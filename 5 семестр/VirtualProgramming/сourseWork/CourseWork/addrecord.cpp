#include "addrecord.h"
#include "ui_addrecord.h"

AddRecord::AddRecord(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::AddRecord)
{
    ui->setupUi(this);
    this->setMaximumSize(this->width(),this->height());
    this->setMinimumSize(this->width(),this->height());
    ui->viewDateEdit->setDate(QDate::currentDate());
    ui->releaseDateEdit->setDate(QDate::currentDate());
}

AddRecord::~AddRecord()
{
    delete ui;
}

void AddRecord::on_uploadPicture_clicked()
{
    pathImage = QFileDialog::getOpenFileName(nullptr, "Выберите изображение", QDir::currentPath(), "*.png *.jpg *.gif *.jpeg *.webp");
    if (pathImage != ""){
        QImage image(pathImage);
        QPixmap pic = QPixmap::fromImage(image);
        ui->picture->setPixmap(pic);
        ui->picture->setPixmap(pic.scaled(ui->picture->width(),ui->picture->height(),Qt::KeepAspectRatio));
        ui->uploadPicture->setText("Изменить изображение");
    }

}

void AddRecord::on_CancelButton_clicked()
{

    ui->picture->clear();
    ui->picture->setText("Изображение\nотсутствует");
    ui->nameLineEdit->clear();
    ui->authorLineEdit->clear();
    ui->descriptionTextEdit->clear();
    ui->typeComboBox->setCurrentIndex(0);
    ui->genresLineEdit->clear();
    ui->scoreComboBox->setCurrentIndex(0);
    ui->commentTextEdit->clear();
     pathImage = "";
    ui->viewDateEdit->setDate(QDate::currentDate());
    ui->releaseDateEdit->setDate(QDate::currentDate());
    close();
}

void AddRecord::on_SaveButton_clicked()
{

    QString name = ui->nameLineEdit->text();
    if (name == ""){
       QMessageBox::information(nullptr, "Уведомление", "Заполните поле \"Название\"");
       return;
    }
    QString author = ui->authorLineEdit->text();
    if (author == ""){
       QMessageBox::information(nullptr, "Уведомление", "Заполните поле \"Автор(-ы)\"");
       return;
    }
    int releaseYear = ui->releaseDateEdit->date().year();

    QString description = ui->descriptionTextEdit->toPlainText();
    if (description == ""){
       QMessageBox::information(nullptr, "Уведомление", "Заполните поле \"Описание\"");
       return;
    }
    QString type = ui->typeComboBox->currentText();

    QString genres = ui->genresLineEdit->text();
    if (genres == ""){
       QMessageBox::information(nullptr, "Уведомление", "Заполните поле \"Жанр(-ы)\"");
       return;
    }

    QDate viewDate = ui->viewDateEdit->date();
    qint8 score =  (qint8) ui->scoreComboBox->currentIndex();
    QString comment = ui->commentTextEdit->toPlainText();
    if (pathImage == ""){
       QMessageBox::information(nullptr, "Уведомление", "Загрузите изображение");
       return;
    }
    QPixmap inPixmap;
    inPixmap.load(pathImage);
    QByteArray inByteArray;
    QBuffer inBuffer( &inByteArray);
    inBuffer.open(QIODevice::WriteOnly);
    inPixmap.save(&inBuffer, "PNG");

    emit sendToWidget(inByteArray,name, author, releaseYear, description, type, genres, viewDate, score, comment);
    QMessageBox::information(nullptr, "Уведомление", "Запись успешно добавлена!");

    ui->picture->clear();
    ui->picture->setText("Изображение\nотсутствует");
    ui->nameLineEdit->clear();
    ui->authorLineEdit->clear();
    ui->releaseDateEdit->clear();
    ui->descriptionTextEdit->clear();
    ui->typeComboBox->setCurrentIndex(0);
    ui->genresLineEdit->clear();
    ui->viewDateEdit->clear();
    ui->scoreComboBox->setCurrentIndex(0);
    ui->commentTextEdit->clear();

    pathImage = "";
    ui->viewDateEdit->setDate(QDate::currentDate());
    ui->releaseDateEdit->setDate(QDate::currentDate());
    close();



}
