#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include <QFileDialog>
#include <QMessageBox>
#include "mironenkoform.h"

namespace Ui {
class MainWindow;
}

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    explicit MainWindow(QWidget *parent = nullptr);
    ~MainWindow();

private:
    Ui::MainWindow *ui;
    MironenkoForm *myform;

signals:
    void sendData(QString str);
private slots:
    void btnReadyClicked();
    void btnUploadPhotoClicked();
};

#endif // MAINWINDOW_H
