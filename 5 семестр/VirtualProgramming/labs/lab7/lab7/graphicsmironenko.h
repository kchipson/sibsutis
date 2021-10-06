#ifndef GRAPHICSMIRONENKO_H
#define GRAPHICSMIRONENKO_H

#include <QWidget>
#include <QGraphicsScene>
#include <QGraphicsItem>
#include <QGraphicsEllipseItem>
#include <QTime>
#include <QTimer>

class GraphicsMironenko : public QGraphicsScene
{
    Q_OBJECT
public:
    GraphicsMironenko(QObject* parent= nullptr);
    QGraphicsItem* itemCollidesWith(QGraphicsItem* item);
    void Init();
private:
    QGraphicsRectItem* walls[4];
    QGraphicsPixmapItem* mouse;

    int speed;
    double dx, dy;
public slots:
    void MoveMouse();
};

#endif // GRAPHICSMIRONENKO_H
