#include "mainwindow.h"
#include <QApplication>
#include <QFile>
#include <QTextStream>
#include <QTranslator>
#include <QLibraryInfo>
#include <QSplashScreen>
#include <QTime>
#include <QPainter>

void LoadModules(QSplashScreen* psplash){
    QTime time;
    time.start();
    for(int i=0; i<100 ; ){
        if(time.elapsed() > 40){
            time.start();
            ++i;
        }
        psplash->showMessage("Loading modules: " + QString::number(i)+"%", Qt::AlignRight | Qt::AlignTop, Qt::green);
        qApp->processEvents();

    }
}

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    QFile f(":/style/style.qss");
    if (!f.exists())   {
        printf("Unable to set stylesheet, file not found\n");
    }
    else   {
        f.open(QFile::ReadOnly | QFile::Text);
        QTextStream ts(&f);
        qApp->setStyleSheet(ts.readAll());
    }
    QTranslator qtTranslator;
        qtTranslator.load("qt_ru",QLibraryInfo::location(QLibraryInfo::TranslationsPath));
        a.installTranslator(&qtTranslator);

    MainWindow w;
    QSplashScreen splash(QPixmap(":/images/load.jpg"));
    splash.show();
    LoadModules(&splash);
    splash.finish(&w);
    w.show();

    return a.exec();
}
