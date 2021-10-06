#ifndef DOCWINDOW_MIRONENKO_H
#define DOCWINDOW_MIRONENKO_H

#include<QTextEdit>
#include<QFileDialog>
#include <QTextStream>


class DocWindow_Mironenko : public QTextEdit
{
    Q_OBJECT
private:
    QString m_strFileName;
public:
    DocWindow_Mironenko(QWidget * pwgt = nullptr);
signals:
    void changeWindowTitle(const QString&);

public slots:
    void slotLoad();
    void slotSave();
    void slotSaveAs();
};

#endif // DOCWINDOW_MIRONENKO_H
