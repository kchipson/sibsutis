#include "database.h"

DataBase::DataBase(QObject *parent) : QObject(parent)
{

}

DataBase::~DataBase()
{

}

/* Методы для подключения к базе данных
 * */
void DataBase::connectToDataBase()
{
    /* Перед подключением к базе данных производим проверку на её существование.
     * В зависимости от результата производим открытие базы данных или её восстановление
     * */
    if(!QFile(DATABASE_NAME).exists()){
        this->restoreDataBase();
    } else {
        this->openDataBase();
    }
}

/* Методы восстановления базы данных
 * */
bool DataBase::restoreDataBase()
{
    if(this->openDataBase()){
        if(!this->createTable()){
            return false;
        } else {
            return true;
        }
    } else {
        qDebug() << "Не удалось восстановить базу данных";
        return false;
    }
}

/* Метод для открытия базы данных
 * */
bool DataBase::openDataBase()
{
    /* База данных открывается по заданному пути
     * и имени базы данных, если она существует
     * */
    db = QSqlDatabase::addDatabase("QSQLITE");
    db.setDatabaseName(DATABASE_NAME);
    if(db.open()){
        return true;
    } else {
        return false;
    }
}

/* Методы закрытия базы данных
 * */
void DataBase::closeDataBase()
{
    db.close();
}

/* Метод для создания таблицы в базе данных
 * */
bool DataBase::createTable()
{
    /* В данном случае используется формирование сырого SQL-запроса
     * с последующим его выполнением.
     * */
    QSqlQuery query;
//    TABLE_ID    " INTEGER PRIMARY KEY AUTOINCREMENT, "
//    TABLE_PICTURE       " BLOB            NOT NULL,"
//    TABLE_NAME          " TINYTEXT        NOT NULL,"
//    TABLE_AUTHOR        " TINYTEXT        NOT NULL,"
//    TABLE_RELEASE_YEAR  " SMALLINT        NOT NULL,"

//    TABLE_DESCRIPTION   " TEXT            NOT NULL,"
//    TABLE_TYPE          " TINYINT         NOT NULL,"
//    TABLE_GENRES        " TEXT            NOT NULL,"

//    TABLE_VIEWDATE      "DATE             NOT NULL,"
//    TABLE_SCORE         "TINYINT          NOT NULL,"
//    TABLE_COMMENT       "TEXT             NOT NULL"
    if(!query.exec( "CREATE TABLE " TABLE " ("
                            TABLE_ID " INTEGER PRIMARY KEY AUTOINCREMENT, "
                            TABLE_PICTURE       " BLOB            NOT NULL,"
                            TABLE_NAME          " TINYTEXT        NOT NULL,"
                            TABLE_AUTHOR        " TINYTEXT        NOT NULL,"
                            TABLE_RELEASE_YEAR  " INT             NOT NULL,"
                            TABLE_DESCRIPTION   " TEXT            NOT NULL,"
                            TABLE_TYPE          " TINYTEXT        NOT NULL,"
                            TABLE_GENRES        " TINYTEXT        NOT NULL,"
                            TABLE_VIEWDATE      " DATE            NOT NULL,"
                            TABLE_SCORE         " TINYINT         NOT NULL,"
                            TABLE_COMMENT        " TEXT           NOT NULL"
                        " )"
                    )){
        qDebug() << "DataBase: error of create " << TABLE;
        qDebug() << query.lastError().text();
        return false;
    } else {
        return true;
    }
}

/* Метод для вставки записи в базу данных
 * */
bool DataBase::insertIntoTable(const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment)
{

    QSqlQuery query;

    query.prepare("INSERT INTO " TABLE " ( "
                                  TABLE_PICTURE ", "
                                  TABLE_NAME ", "
                                  TABLE_AUTHOR ", "
                                  TABLE_RELEASE_YEAR ", "
                                  TABLE_DESCRIPTION ", "
                                  TABLE_TYPE ", "
                                  TABLE_GENRES ", "
                                  TABLE_VIEWDATE ", "
                                  TABLE_SCORE ", "
                                  TABLE_COMMENT " ) "
                    "VALUES (:Pic, :Name, :Author, :ReleaseYear, :Description, :Type, :Genres, :ViewDate, :Score, :Comment)");

    query.bindValue(":Pic", pic);
    query.bindValue(":Name", name);
    query.bindValue(":Author", author);
    query.bindValue(":ReleaseYear", releaseYear);

    query.bindValue(":Description",    description);
    query.bindValue(":Type",     type);
    query.bindValue(":Genres",     genres);
    query.bindValue(":ViewDate",     viewDate);
    query.bindValue(":Score",     score);
    query.bindValue(":Comment",     comment);

    // После чего выполняется запросом методdом exec()QQQ
    if(!query.exec()){
        qDebug() << "error insert into " << TABLE;
        qDebug() << query.lastError().text();
        return false;
    } else {
        return true;
    }
}

bool DataBase::editInTable(const int &id, const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment)
{
    QSqlQuery query(db);

    query.prepare("UPDATE " TABLE " SET "
                              TABLE_PICTURE         "=:Pic, "
                              TABLE_NAME            "=:Name, "
                              TABLE_AUTHOR          "=:Author, "
                              TABLE_RELEASE_YEAR    "=:ReleaseYear, "
                              TABLE_DESCRIPTION     "=:Description, "
                              TABLE_TYPE            "=:Type, "
                              TABLE_GENRES          "=:Genres, "
                              TABLE_VIEWDATE        "=:ViewDate, "
                              TABLE_SCORE           "=:Score, "
                              TABLE_COMMENT         "=:Comment "
                            "WHERE " TABLE_ID "=:Id");


    query.bindValue(":Pic", pic);
    query.bindValue(":Name", name);
    query.bindValue(":Author", author);
    query.bindValue(":ReleaseYear", releaseYear);

    query.bindValue(":Description",    description);
    query.bindValue(":Type",     type);
    query.bindValue(":Genres",     genres);
    query.bindValue(":ViewDate",     viewDate);
    query.bindValue(":Score",     score);
    query.bindValue(":Comment",     comment);
    query.bindValue(":Id",     id);
    if(!query.exec()){
        qDebug() << "ERROR: Can't edit record in table " << TABLE;
        qDebug() << query.lastError().text();
        return false;
    }
    else
        return true;

}

bool DataBase::deleteFromDatabase(const int id)
{
    QSqlQuery query(db);

    query.prepare("DELETE FROM " TABLE " WHERE " TABLE_ID "= :ID ;");
    query.bindValue(":ID", id);

    if(!query.exec()){
        qDebug() << "ERROR: Can't delete from table " << TABLE;
        qDebug() << query.lastError().text();
        return false;
    } else {
        return true;
    }


}
