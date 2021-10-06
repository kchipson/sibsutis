#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include <QMessageBox>
#include <QSqlTableModel>
#include <QDebug>

#include "addrecord.h"
#include "editrecord.h"
#include "helpinformation.h"
#include "database.h"


namespace Ui {
class MainWindow;
}

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    explicit MainWindow(QWidget *parent = nullptr);
    ~MainWindow();

public slots:
    void slotAdd();
    void slotEdit();
    void slotDel();
    void slotInfo();
    void slotAbout();
    void updateTable();
    void addRecordDataBase(const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment);
    void editRecordDataBase(const int &id, const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment);

signals:
    void sendForEdit(const int &ip, const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment);

private slots:
    void on_tableView_clicked(const QModelIndex &index);

private:
    Ui::MainWindow *ui;
    AddRecord  *addForm;
    EditRecord *editForm;
    DataBase* db;
    QSqlTableModel *model;
    int currRow = -1;
    int currID = -1;
};

#endif // MAINWINDOW_H
