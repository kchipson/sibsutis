#ifndef EDITRECORD_H
#define EDITRECORD_H

#include <QWidget>
#include <QFileDialog>
#include <QMessageBox>
#include <QBuffer>
#include <QDebug>

namespace Ui {
class EditRecord;
}

class EditRecord : public QWidget
{
    Q_OBJECT

public:
    explicit EditRecord(QWidget *parent = nullptr);
    ~EditRecord();
public slots:
    void catchInfo(const int &id, const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment);

private slots:
    void on_uploadPicture_clicked();

    void on_CancelButton_clicked();

    void on_SaveButton_clicked();

signals:
    void sendToWidgetUpdate(const int &id, const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment);
private:
    Ui::EditRecord *ui;
    QString pathImage;
    QByteArray savePic;
    int id;
};

#endif // EDITRECORD_H
