#ifndef ADDRECORD_H
#define ADDRECORD_H

#include <QWidget>
#include <QFileDialog>
#include <QBuffer>
#include <QMessageBox>
#include <QDebug>
#include "database.h"


namespace Ui {
class AddRecord;
}

class AddRecord : public QWidget
{
    Q_OBJECT

public:
    explicit AddRecord(QWidget *parent = nullptr);
    ~AddRecord();

private slots:
    void on_uploadPicture_clicked();

    void on_CancelButton_clicked();

    void on_SaveButton_clicked();

private:
    Ui::AddRecord *ui;
    DataBase* db;
    QString pathImage = "";


signals:
    void sendToWidget(const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment);
};

#endif // ADDRECORD_H
