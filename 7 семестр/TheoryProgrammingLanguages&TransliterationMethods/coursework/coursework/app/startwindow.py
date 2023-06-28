from PyQt5 import QtCore, QtGui, QtWidgets

class Ui_StartWindow(object):
    def setupUi(self, StartWindow):
        StartWindow.setObjectName("StartWindow")
        StartWindow.setEnabled(True)
        StartWindow.resize(350, 400)
        StartWindow.setMinimumSize(QtCore.QSize(350, 400))
        StartWindow.setMaximumSize(QtCore.QSize(350, 400))
        StartWindow.setWindowIcon(self.icon)
        StartWindow.setStyleSheet("background-color: #6F83D6;")  
        
        self.verticalLayoutWidget = QtWidgets.QWidget(self)
        self.verticalLayoutWidget.setGeometry(QtCore.QRect(0, 0, 351, 401))
        self.verticalLayoutWidget.setObjectName("verticalLayoutWidget")
        
        self.verticalLayout = QtWidgets.QVBoxLayout(self.verticalLayoutWidget)
        self.verticalLayout.setSizeConstraint(QtWidgets.QLayout.SetMaximumSize)
        self.verticalLayout.setContentsMargins(40, 30, 40, 30)
        self.verticalLayout.setSpacing(25)
        self.verticalLayout.setObjectName("verticalLayout")
        
        sizePolicy = QtWidgets.QSizePolicy(QtWidgets.QSizePolicy.Minimum, QtWidgets.QSizePolicy.MinimumExpanding)
        sizePolicy.setHorizontalStretch(0)
        sizePolicy.setVerticalStretch(0)
        
        font = QtGui.QFont()
        font.setPointSize(18)
        font.setStrikeOut(False)
        font.setStyleStrategy(QtGui.QFont.PreferDefault)
        
        self.program_btn = QtWidgets.QPushButton(self.verticalLayoutWidget)
        sizePolicy.setHeightForWidth(self.program_btn.sizePolicy().hasHeightForWidth())
        self.program_btn.setSizePolicy(sizePolicy)
        self.program_btn.setFont(font)
        self.program_btn.setCursor(QtGui.QCursor(QtCore.Qt.PointingHandCursor))
        self.program_btn.setObjectName("program_btn")
        self.program_btn.setStyleSheet("background-color: #eb4f96;")
        self.verticalLayout.addWidget(self.program_btn)
        
        self.theme_btn = QtWidgets.QPushButton(self.verticalLayoutWidget)
        sizePolicy.setHeightForWidth(self.theme_btn.sizePolicy().hasHeightForWidth())
        self.theme_btn.setSizePolicy(sizePolicy)
        self.theme_btn.setFont(font)
        self.theme_btn.setCursor(QtGui.QCursor(QtCore.Qt.PointingHandCursor))
        self.theme_btn.setObjectName("theme_btn")
        self.theme_btn.setStyleSheet("background-color: #ba406f; color: #ffffff;")
        self.verticalLayout.addWidget(self.theme_btn)
        
        self.about_btn = QtWidgets.QPushButton(self.verticalLayoutWidget)
        sizePolicy.setHeightForWidth(self.about_btn.sizePolicy().hasHeightForWidth())
        self.about_btn.setSizePolicy(sizePolicy)
        self.about_btn.setFont(font)
        self.about_btn.setCursor(QtGui.QCursor(QtCore.Qt.PointingHandCursor))
        self.about_btn.setObjectName("about_btn")
        self.about_btn.setStyleSheet("background-color: #eb4f96;")
        self.verticalLayout.addWidget(self.about_btn)
        
        self.exit_btn = QtWidgets.QPushButton(self.verticalLayoutWidget)
        sizePolicy.setHeightForWidth(self.exit_btn.sizePolicy().hasHeightForWidth())
        self.exit_btn.setSizePolicy(sizePolicy)
        self.exit_btn.setFont(font)
        self.exit_btn.setCursor(QtGui.QCursor(QtCore.Qt.PointingHandCursor))
        self.exit_btn.setObjectName("exit_btn")
        self.exit_btn.setStyleSheet("background-color: #ba406f; color: #ffffff;")
        self.verticalLayout.addWidget(self.exit_btn)

        StartWindow.setLayout(self.verticalLayout)

        self.retranslateUi(StartWindow)
        QtCore.QMetaObject.connectSlotsByName(StartWindow)

    def retranslateUi(self, StartWindow):
        _translate = QtCore.QCoreApplication.translate
        StartWindow.setWindowTitle(_translate("StartWindow", "❤ ТЯПиМ ❤"))
        self.program_btn.setText(_translate("StartWindow", "Программа"))
        self.theme_btn.setText(_translate("StartWindow", "Тема"))
        self.about_btn.setText(_translate("StartWindow", "О программе"))
        self.exit_btn.setText(_translate("StartWindow", "Выход"))



class MessageBox(QtWidgets.QMessageBox):
    def __init__(self, parent=None):
        super().__init__(parent)
        grid_layout = self.layout()

        qt_msgboxex_icon_label = self.findChild(QtWidgets.QLabel, "qt_msgboxex_icon_label")
        qt_msgboxex_icon_label.deleteLater()

        qt_msgbox_label = self.findChild(QtWidgets.QLabel, "qt_msgbox_label")
        qt_msgbox_label.setAlignment(QtCore.Qt.AlignLeft)
        grid_layout.removeWidget(qt_msgbox_label)

        qt_msgbox_buttonbox = self.findChild(QtWidgets.QDialogButtonBox, "qt_msgbox_buttonbox")
        grid_layout.removeWidget(qt_msgbox_buttonbox)

        grid_layout.addWidget(qt_msgbox_label, 0, 0, alignment=QtCore.Qt.AlignLeft)
        grid_layout.addWidget(qt_msgbox_buttonbox, 1, 0, alignment=QtCore.Qt.AlignCenter)
