#include "mainwindowmironenko.h"
#include "ui_mainwindowmironenko.h"

MainWindowMironenko::MainWindowMironenko(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindowMironenko)
{
    ui->setupUi(this);
    GraphicsMironenko* scene = new GraphicsMironenko;
    ui->graphicsView->setScene(scene);
}

MainWindowMironenko::~MainWindowMironenko()
{
    delete ui;
}
