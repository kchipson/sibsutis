#include "sdiprogram_mironenko.h"
#include "ui_sdiprogram_mironenko.h"

SDIProgram_Mironenko::SDIProgram_Mironenko(QWidget *parent) : QMainWindow(parent)
{
    QMenu *pmnuFile = new QMenu("&File");
    QMenu *pmnuHelp = new QMenu("&Help");

    DocWindow_Mironenko* pdoc = new DocWindow_Mironenko;

    pmnuFile->addAction("&Open...",
                       pdoc,
                       SLOT(slotLoad()),
                       QKeySequence("CTRL+O")
                       );
    pmnuFile->addAction("&Save",
                       pdoc,
                       SLOT(slotSave()),
                       QKeySequence("CTRL+S")
                       );
    pmnuFile->addAction("&Save As...",
                       pdoc,
                       SLOT(slotSaveAs()),
                       QKeySequence("CTRL+Shift+S")
                       );
    pmnuFile->addSeparator();
    pmnuFile->addAction("&Quit",
                       qApp,
                       SLOT(quit()),
                       QKeySequence("CTRL+Q")
                       );
    pmnuHelp->addAction("&Help",
                        this,
                        SLOT(slotAbout()),
                        QKeySequence(Qt::Key_F1)
                        );

    menuBar()->addMenu(pmnuFile);
    menuBar()->addMenu(pmnuHelp);

    setCentralWidget(pdoc);

    connect(pdoc, SIGNAL(changeWindowTitle(const QString&)), SLOT(slotChangeWindowTitle(const QString&)));

    statusBar()->showMessage("Ready",2000);
}

void SDIProgram_Mironenko::slotAbout(){
    QMessageBox::about(this, "Автор", "Мироненко Кирилл\nИП-811\n\n2020-2021 уч.год");
}

void SDIProgram_Mironenko::slotChangeWindowTitle(const QString& str){
    setWindowTitle(str);
}


SDIProgram_Mironenko::~SDIProgram_Mironenko()
{
}
