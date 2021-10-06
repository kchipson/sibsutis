#ifndef HELPINFORMATION_H
#define HELPINFORMATION_H

#include <QWidget>
#include <QFile>

namespace Ui {
class HelpInformation;
}

class HelpInformation : public QWidget
{
    Q_OBJECT

public:
    explicit HelpInformation(QWidget *parent = nullptr);
    ~HelpInformation();

private slots:
//    void on_textBrowser_anchorClicked(const QUrl &link);


private:
    Ui::HelpInformation *ui;
};

#endif // HELPINFORMATION_H
