#ifndef MIRONENKOFORM_H
#define MIRONENKOFORM_H

#include <QWidget>
#include <QAbstractButton>
#include <QFileDialog>
#include <QTextDocumentWriter>
#include <QMessageBox>

namespace Ui {
class MironenkoForm;
}

class MironenkoForm : public QDialog
{
    Q_OBJECT

public:
    explicit MironenkoForm(QWidget *parent = nullptr);
    ~MironenkoForm();

private:
    Ui::MironenkoForm *ui;
public slots:
    void recieveData(QString str);
private slots:
    void on_btnBox_clicked(QAbstractButton *button);
};

#endif // MIRONENKOFORM_H
