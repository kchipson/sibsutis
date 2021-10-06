#ifndef DATABASE_H
#define DATABASE_H

#include <QObject>
#include <QSql>
#include <QSqlQuery>
#include <QSqlError>
#include <QSqlDatabase>
#include <QFile>
#include <QDate>
#include <QDebug>

/* Директивы имен таблицы, полей таблицы и базы данных */
#define DATABASE_NAME       "DataBase.db"

#define TABLE                   "Movies"

#define TABLE_ID                "_id"
#define TABLE_PICTURE           "Picture"

#define TABLE_NAME              "Name"
#define TABLE_AUTHOR            "Author"
#define TABLE_RELEASE_YEAR      "Release"


#define TABLE_DESCRIPTION       "Description"
#define TABLE_TYPE              "Type"
#define TABLE_GENRES            "Genres"

#define TABLE_VIEWDATE          "ViewDate"
#define TABLE_SCORE             "Score"
#define TABLE_COMMENT           "Comment"

class DataBase : public QObject
{
    Q_OBJECT
public:
    explicit DataBase(QObject *parent = nullptr);
    ~DataBase();
    /* Методы для непосредственной работы с классом
     * Подключение к базе данных и вставка записей в таблицу
     * */
    void connectToDataBase();
    bool insertIntoTable(const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear);
    bool insertIntoTable(const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment);
    bool editInTable(const int &id, const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment);
    bool deleteFromDatabase(const int id);
private:
    // Сам объект базы данных, с которым будет производиться работа
    QSqlDatabase    db;

private:
    /* Внутренние методы для работы с базой данных
     * */
    bool openDataBase();
    bool restoreDataBase();
    void closeDataBase();
    bool createTable();
};

#endif // DATABASE_H
