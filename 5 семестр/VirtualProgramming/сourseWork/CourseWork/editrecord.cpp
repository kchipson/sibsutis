#include "editrecord.h"
#include "ui_editrecord.h"

EditRecord::EditRecord(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::EditRecord)
{
    ui->setupUi(this);
    this->setMaximumSize(this->width(),this->height());
    this->setMinimumSize(this->width(),this->height());
}

EditRecord::~EditRecord()
{
    delete ui;
}

void EditRecord::on_uploadPicture_clicked()
{
    pathImage = QFileDialog::getOpenFileName(nullptr, "Выберите изображение", QDir::currentPath(), "*.png *.jpg *.gif *.jpeg *.webp");
    if (pathImage != ""){
        QImage image(pathImage);
        QPixmap pic = QPixmap::fromImage(image);

        qDebug() << pathImage;

        QPixmap inPixmap;
        inPixmap.load(pathImage);
        QByteArray inByteArray;
        QBuffer inBuffer( &inByteArray);
        inBuffer.open(QIODevice::WriteOnly);
        inPixmap.save(&inBuffer, "PNG");

        savePic = inByteArray;
        ui->picture->setPixmap(pic);
        ui->picture->setPixmap(pic.scaled(ui->picture->width(),ui->picture->height(),Qt::KeepAspectRatio));
    }

}

void EditRecord::catchInfo(const int &id, const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment)
{
    this->id = id;
    ui->nameLineEdit->setText(name);
    ui->authorLineEdit->setText(author);
    ui->releaseDateEdit->setDate(QDate(releaseYear,1,1));
    ui->descriptionTextEdit->setText(description);
    ui->typeComboBox->setCurrentText(type);
    ui->genresLineEdit->setText(genres);
    ui->viewDateEdit->setDate(viewDate);
    ui->scoreComboBox->setCurrentIndex(score);
    ui->commentTextEdit->setText(comment);

    QPixmap img = QPixmap();
    savePic = pic;
    img.loadFromData(pic);
    ui->picture->setPixmap(img.scaled(ui->picture->width(),ui->picture->height(),Qt::KeepAspectRatio));
}


void EditRecord::on_CancelButton_clicked()
{
    this->close();
}

void EditRecord::on_SaveButton_clicked()
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
    if (comment == ""){
       QMessageBox::information(nullptr, "Уведомление", "Заполните поле \"Жанр(-ы)\"");
       return;
    }
    QByteArray pic = savePic;
    emit sendToWidgetUpdate(id, pic, name, author, releaseYear, description, type, genres, viewDate, score, comment);
    QMessageBox::information(nullptr, "Уведомление", "Запись успешно изменена!");

    close();
}
