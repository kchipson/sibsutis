import random
import sys
from PyQt5.QtWidgets import QMenu
from PyQt5 import QtCore, QtGui, QtWidgets
from PyQt5.QtCore import QRect, QSize, QPoint, QLineF , QPointF
from PyQt5.Qt import *
from math import acos, degrees, sqrt


class Circle(QRect):

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)

    def set_text(self,text):
        self.text = text
    
    def set_transition(self, tr):
        self.transition = tr


class Window(QtWidgets.QMainWindow):

    def __init__(self):
        super(Window, self).__init__()

        # self.rect = QtCore.QRect()

        self.drag_position = QtCore.QPoint()

        st = ["p", "q", "r"]

        fun = {"p": {"0": "q", "1": "p"}, "q": {"0": "r", "1": "p"}, "r": {"0": "r", "1": "r"}}
        
        self.circles = dict()
        
        for i in st:
            coor = (random.randrange(self.width() - 100), random.randrange(self.height() - 100))
            c = Circle(*coor, 30, 30)
            c.set_text(i)
            a =dict()
            if (tmp := fun.get(i)):
                for key, val in tmp.items():
                    if not a.get(val):
                        a[val] = [key]
                    else:
                        a[val].append(key)
            c.set_transition(a)
            self.circles[i] = c

        self.current_circle = None

        self.resize(640, 480)



    def paintEvent(self, event):
        super().paintEvent(event)

        painter = QtGui.QPainter(self)
        painter.setRenderHint(QtGui.QPainter.Antialiasing)

        for key, circle in self.circles.items():
            painter.setPen(QtGui.QPen(QtCore.Qt.black, 4, QtCore.Qt.SolidLine))
            painter.drawEllipse(circle)
            painter.drawText(circle, Qt.AlignCenter, circle.text)
            for to, syms in circle.transition.items():
                start = circle.center()
                end = self.circles[to].center()
                painter.setPen(QtGui.QPen(Qt.black, 1, Qt.DashLine))
                painter.drawLine(start, end)

                painter.drawText((start.x() + end.x())//2, (start.y() + end.y())//2, ','.join(syms))


    def mousePressEvent(self, event):
        for key, circle in self.circles.items():
            line = QLineF(circle.center(), event.pos())

            if line.length() < circle.width() / 2:
                self.current_circle = circle
                self.drag_position = event.pos()
                break

    def mouseMoveEvent(self, event):
        if self.current_circle is not None:
            self.current_circle.translate(event.pos() - self.drag_position)
            self.drag_position = event.pos()
            self.update()

    def mouseReleaseEvent(self, event):
        self.current_circle = None


if __name__ == "__main__":

    # fun =  {"0": "r", "1": "r"}

    # a = dict()
    # for key, val in fun.items():
    #     if not a.get(val):
    #         a[val] = [key]
    #     else:
    #         a[val].append(key)

    # print({a[k]: [fun[k]] if not a.get(k) else a[k].append(fun[k]) for k in fun} )
    app = QtWidgets.QApplication(sys.argv)
    Rect = Window()
    Rect.show()
    sys.exit(app.exec_())
