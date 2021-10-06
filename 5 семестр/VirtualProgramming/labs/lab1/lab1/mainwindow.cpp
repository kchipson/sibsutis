#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "auth.h"
#include "ui_auth.h"
#include "QFileDialog"
#include <QTextDocumentWriter>

MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindow)
{
    setWindowFlags(Qt::Dialog | Qt::MSWindowsFixedSizeDialogHint);
    ui->setupUi(this);
    connect(ui->btn_Auth, SIGNAL(triggered()), this, SLOT(AboutAuth()));

    QAction *pactOpen = new QAction("File open action", 0);
    pactOpen -> setText("Открыть");
    pactOpen -> setShortcut(QKeySequence("CTRL+O"));
    pactOpen -> setToolTip("Открытие документа");
    pactOpen -> setStatusTip("Открыть файл");
    pactOpen -> setWhatsThis("Открыть файл");
    connect(pactOpen, SIGNAL(triggered()), SLOT(SlotOpen()));

    QAction *pactSave = new QAction("File save action", 0);
    pactSave -> setText("Сохранить");
    pactSave -> setShortcut(QKeySequence("CTRL+S"));
    pactSave -> setToolTip("Сохранение документа");
    pactSave -> setStatusTip("Сохранить файл");
    pactSave -> setWhatsThis("Сохранить файл");
    connect(pactSave, SIGNAL(triggered()), SLOT(SlotSave()));

    QAction *pactClear = new QAction("File clear action", 0);
    pactClear -> setText("Очистить");
    pactClear -> setShortcut(QKeySequence("CTRL+Q"));
    pactClear -> setToolTip("Очистить");
    pactClear -> setStatusTip("Очистить");
    pactSave -> setWhatsThis("Очистить");
    connect(pactClear, SIGNAL(triggered()), SLOT(SlotClear()));

    QMenu *pmnuFile = new QMenu("&файл");
    pmnuFile -> addAction(pactOpen);
    pmnuFile -> addAction(pactSave);
    pmnuFile -> addAction(pactClear);

    menuBar() -> addMenu(pmnuFile);

    ui -> mainToolBar -> addAction(pactOpen);
    ui -> mainToolBar -> addAction(pactSave);
    ui -> mainToolBar -> addAction(pactClear);
}

void MainWindow::AboutAuth(){
    auth *dlg = new auth();
    dlg -> show();
}

void MainWindow::SlotOpen(){
    QString filename = QFileDialog::getOpenFileName(0, "Открыть файл", QDir::currentPath(), "*.cpp *.txt");
    QFile file(filename);

    if (file.open(QIODevice::ReadOnly | QIODevice::Text))
        ui -> textEdit -> setPlainText(file.readAll());
}

void MainWindow::SlotSave(){
    QString filename = QFileDialog::getSaveFileName(0, "Сохранить файл", QDir::currentPath(), "*.cpp *.txt");
    QTextDocumentWriter writer;

    writer.setFileName(filename);
    writer.write(ui->textEdit->document());
}

void MainWindow::SlotClear(){
     ui->textEdit->clear();
}

MainWindow::~MainWindow()
{
    delete ui;
}


