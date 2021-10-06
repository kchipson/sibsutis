#include "helpinformation.h"
#include "ui_helpinformation.h"

HelpInformation::HelpInformation(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::HelpInformation)
{
    ui->setupUi(this);
    this->setMaximumSize(this->width(),this->height());
    this->setMinimumSize(this->width(),this->height());

//    QFile *File = new QFile(":/helpInformation/index.html");
//        File->open(QFile::ReadOnly | QFile::Text);
//        QString html = File->readAll();
//        QColor linkColor(Qt::blue);
//        QString sheet = QString::fromLatin1("a { text-decoration: underline; color: %1 }").arg(linkColor.name());
//        ui->textBrowser->document()->setDefaultStyleSheet(sheet);
//        ui->textBrowser->setHtml(html);
//        ui->textBrowser->setOpenLinks(false);
//        ui->textBrowser->setOpenExternalLinks(false);
//        File->close();


    connect(ui->textBrowser, SIGNAL(anchorClicked(QUrl)), this, SLOT(on_textBrowser_anchorClicked(QUrl)));
    connect(ui->nextButton, SIGNAL(clicked()), ui->textBrowser, SLOT(forward()));
    connect(ui->backButton, SIGNAL(clicked()), ui->textBrowser, SLOT(backward()));
    connect(ui->homeButton, SIGNAL(clicked()), ui->textBrowser, SLOT(home()));
    connect(ui->textBrowser, SIGNAL(forwardAvailable(bool)), ui->nextButton, SLOT(setEnabled(bool)));
    connect(ui->textBrowser, SIGNAL(backwardAvailable(bool)), ui->backButton, SLOT(setEnabled(bool)));
    ui->textBrowser->setSource(QUrl::fromLocalFile(":/helpInformation/index.html"));
}

HelpInformation::~HelpInformation()
{
    delete ui;
}

//void HelpInformation::on_textBrowser_anchorClicked(const QUrl &link)
//{
//    QString str = link.toString();
//    QFile *File= new QFile(":/helpInformation/"+str);
//    File->open(QFile::ReadOnly|QFile::Text);
//    QString html = File->readAll();
//    ui->textBrowser->setHtml(html);
//    File->close();
//}

