#include "auth.h"
#include "ui_auth.h"

auth::auth(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::auth)
{
    setWindowFlags(Qt::Dialog | Qt::MSWindowsFixedSizeDialogHint);
    ui->setupUi(this);
}

auth::~auth()
{
    delete ui;
}
