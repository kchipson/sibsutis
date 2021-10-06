#include "mainwindow.h"
#include "ui_mainwindow.h"

#include <QLabel>

MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindow)
{
    ui->setupUi(this);

    this->setMaximumSize(this->width(),this->height());
    this->setMinimumSize(this->width(),this->height());

    db = new DataBase();
    db->connectToDataBase();

    model = new QSqlTableModel;
    model->setTable(TABLE);
    model->setHeaderData(0, Qt::Horizontal, "id");

    ui->tableView->setModel(model);
    ui->tableView->setColumnHidden(0, true);
    ui->tableView->setSelectionBehavior(QAbstractItemView::SelectRows);
    ui->tableView->setSelectionMode(QAbstractItemView::SingleSelection);

    updateTable();

    editForm = new EditRecord();
    editForm->setWindowModality(Qt::ApplicationModal);
    addForm = new AddRecord();
    addForm->setWindowModality(Qt::ApplicationModal);

    connect(addForm, SIGNAL(sendToWidget(QByteArray, QString, QString, int, QString, QString, QString, QDate, qint8, QString)), this, SLOT(addRecordDataBase(QByteArray, QString, QString, int, QString, QString, QString, QDate, qint8, QString)));
    connect(this, SIGNAL(sendForEdit(int, QByteArray, QString, QString, int, QString, QString, QString, QDate, qint8, QString)), editForm, SLOT(catchInfo(int, QByteArray, QString, QString, int, QString, QString, QString, QDate, qint8, QString)));
    connect(editForm, SIGNAL(sendToWidgetUpdate(int, QByteArray, QString, QString, int, QString, QString, QString, QDate, qint8, QString)), this, SLOT(editRecordDataBase(int, QByteArray, QString, QString, int, QString, QString, QString, QDate, qint8, QString)));

    connect(ui->menu1_add_record,  SIGNAL(triggered()), this, SLOT(slotAdd()));
    connect(ui->addButton,         SIGNAL(clicked()), this, SLOT(slotAdd()));
    connect(ui->menu1_edit_record, SIGNAL(triggered()), this, SLOT(slotEdit()));
    connect(ui->editButton,        SIGNAL(clicked()), this, SLOT(slotEdit()));
    connect(ui->menu1_del_record,  SIGNAL(triggered()), this, SLOT(slotDel()));
    connect(ui->delButton,         SIGNAL(clicked()), this, SLOT(slotDel()));
    connect(ui->menu1_exit,        SIGNAL(triggered()), qApp, SLOT(quit()));
    connect(ui->menu2_help,        SIGNAL(triggered()), this, SLOT(slotInfo()));
    connect(ui->menu2_about,       SIGNAL(triggered()), this, SLOT(slotAbout()));
}


MainWindow::~MainWindow()
{
    delete ui;
}

void MainWindow::updateTable(){
        currRow = -1;
        currID = -1;
        model->select();
        model->setSort(8,Qt::AscendingOrder);
        if (currRow == -1){
            ui->menu1_edit_record->setEnabled(false);
            ui->menu1_del_record->setEnabled(false);
            ui->editButton->setEnabled(false);
            ui->delButton->setEnabled(false);
        }
        else{
            ui->menu1_edit_record->setEnabled(true);
            ui->menu1_del_record->setEnabled(true);
            ui->editButton->setEnabled(true);
            ui->delButton->setEnabled(true);
        }
        if (model->rowCount() == 0){
            ui->label->show();
            ui->tableView->hide();
            return;
        }
         ui->label->hide();
         ui->tableView->show();
         QPixmap pic = QPixmap();
        for (int i = 0; i < model->rowCount(); i++){
            pic.loadFromData(model->data(model->index(i, 1)).toByteArray());
            QLabel *imageLabel = new QLabel();
            imageLabel->setPixmap(pic.scaled(150, 400, Qt::KeepAspectRatio));
            ui->tableView->setIndexWidget(model->index(i, 1), imageLabel);
        }
        ui->tableView->horizontalHeader()->setSectionResizeMode(1, QHeaderView::ResizeToContents);
        ui->tableView->horizontalHeader()->setSectionResizeMode(2, QHeaderView::Stretch);
        ui->tableView->horizontalHeader()->setSectionResizeMode(3, QHeaderView::Stretch);
        ui->tableView->horizontalHeader()->setSectionResizeMode(4, QHeaderView::ResizeToContents);
        ui->tableView->horizontalHeader()->setSectionResizeMode(5, QHeaderView::Stretch);
        ui->tableView->horizontalHeader()->setSectionResizeMode(6, QHeaderView::ResizeToContents);
        ui->tableView->horizontalHeader()->setSectionResizeMode(7, QHeaderView::Stretch);
        ui->tableView->horizontalHeader()->setSectionResizeMode(8, QHeaderView::ResizeToContents);
        ui->tableView->horizontalHeader()->setSectionResizeMode(9, QHeaderView::ResizeToContents);
        ui->tableView->horizontalHeader()->setSectionResizeMode(10, QHeaderView::Stretch);

        ui->tableView->verticalHeader()->setSectionResizeMode(QHeaderView::ResizeToContents);
        ui->tableView->setEditTriggers(QAbstractItemView::NoEditTriggers);
}

void MainWindow::slotAdd(){
    addForm->show();
 }

void MainWindow::addRecordDataBase(const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment)
{
    db->insertIntoTable(pic, name, author, releaseYear, description, type, genres, viewDate, score, comment);
    updateTable();
    currRow = -1;
    currID = -1;
}


void MainWindow::slotEdit(){

//        qDebug() << currRow;
        if(currRow != -1)
        {
            QString name = model->data(model->index(currRow, 2)).toString();
            QString author = model->data(model->index(currRow, 3)).toString();
            int releaseYear = model->data(model->index(currRow, 4)).toDate().year();

            QString description = model->data(model->index(currRow, 5)).toString();

            QString type =  model->data(model->index(currRow, 6)).toString();
            QString genres =  model->data(model->index(currRow, 7)).toString();


            QDate viewDate = model->data(model->index(currRow, 8)).toDate();

            qint8 score =  (qint8) model->data(model->index(currRow, 9)).toInt();
            QString comment = model->data(model->index(currRow, 10)).toString();

            QByteArray inByteArray = model->data(model->index(currRow, 1)).toByteArray();
            emit sendForEdit(currID, inByteArray, name, author, releaseYear, description, type, genres, viewDate, score, comment);
            editForm->show();
        }

}

void MainWindow::editRecordDataBase(const int &id, const QByteArray &pic, const QString &name, const QString &author, const int &releaseYear, const QString &description, const QString &type,  const QString &genres,  const QDate &viewDate, const qint8 &score, const QString &comment)
{
    currRow = -1;
    currID = -1;
    db->editInTable(id,pic, name, author, releaseYear, description, type, genres, viewDate, score, comment);
    updateTable();
}

void MainWindow::slotDel(){
//    int n = QMessageBox::warning(0,
//                                 "Удаление",
//                                 "Вы действительно хотите удалить запись?",
//                                 "Да",
//                                 "Нет",
//                                 QString(),
//                                 0,
//                                 1
//                                );
//    if(!n) {
    //    }
    if(currRow != -1)
    {
    db->deleteFromDatabase(currID);
    updateTable();
    QMessageBox::information(nullptr, "Уведомление", "запись успешно удалена");
    currRow = -1;
    currID = -1;
    }

}


void MainWindow::slotInfo(){
    HelpInformation* form = new HelpInformation();
    form->setWindowModality(Qt::ApplicationModal);
    form->show();
}


void MainWindow::slotAbout(){
    QMessageBox::about(this, "О программе", "Версия: 0.0.1 Alpha\n\nРазработчик: Мироненко Кирилл, ИП-811\n\n            © 2020-2021 уч.год, СибГУТИ");
}

void MainWindow::on_tableView_clicked(const QModelIndex &index)
{
    ui->menu1_edit_record->setEnabled(true);
    ui->menu1_del_record->setEnabled(true);
    ui->editButton->setEnabled(true);
    ui->delButton->setEnabled(true);
    currID = model->data(model->index(index.row(), 0)).toInt();
    currRow = index.row();
}

