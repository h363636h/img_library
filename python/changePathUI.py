#!/usr/bin/env python
# -*- coding:utf-8 -*-

import sys
import os
import subprocess
import glob

reload(sys)
sys.setdefaultencoding('utf-8')

try:
    from PySide import *
except ImportError:
    from PyQt4 import QtCore
    from PyQt4 import QtGui

try:
    import MySQLdb
except:
    print "no module named MySQLdb"

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="asset", charset="utf8")
cur = db.cursor()

db.query("set character_set_connection=utf8;")
db.query("set character_set_server=utf8;")
db.query("set character_set_client=utf8;")
db.query("set character_set_results=utf8;")

class pathUI(QtGui.QWidget):
    def __init__(self):
        super(pathUI, self).__init__()
        self.initUI()
        self.setMinimumSize(760,450)
        self.setMaximumSize(760,490)
        palette = self.palette()

        role = self.backgroundRole()
        palette.setColor(role, QtGui.QColor('#4a4a4a'))
        self.setPalette(palette)

        self.sel_dir=''

    def initUI(self):
        self.setStyleSheet("""
            .QMainWindow{
            font-family:arial;
            }
            .QPushButton{
                border-radius : 1px;
                background-color:#00A4E4;
                color:white;
                padding : 3px;
                height : 20px;
                width : 80px;
                font : bold;
            }

            .QPushButton:hover{
                border-radius : 1px;
                background-color : white;
                border : 2px solid #00A4E4;
                color:#00A4E4;
                font : bold;
            }
            .QComboBox{
                background-color:#4a4a4a;
                border : 1px solid #00A4E4;
                color : #ffffff;
                selection-background-color:#4a4a4a;
            }
            .QComboBox QAbstractItemView{
                border-radius: 0px;
                background-color: #4a4a4a;
                
            }
            .QComboBox:on{
                background-color:#4a4a4a;
            }
            .QComboBox::drop-down{
                border : none;
                background-color:#4a4a4a;
            }
            .QComboBox::down-arrow{
                image: url(/library/project/TD/astana/img/arrow.png);
                width : 18px;
                height : 18px;
                padding-right:15px;
            }
            .QLabel{
                color:white;
                font-size : 14px;
                font-family:"System	";
            }
            .QLineEdit{
                background-color:#4a4a4a;
                color:white;border: 1px solid #00A4E4;
            }
            .QListWidget{
                background-color:#4a4a4a;
                color:white;
                border: 1px solid #00A4E4;
                padding:5px;
            }
    
        """)
        self.setWindowTitle('ChangePath')

        self.setGeometry(650,400,760,450)
        self.setSizePolicy(QtGui.QSizePolicy.Expanding, QtGui.QSizePolicy.Fixed);

        self.label_version = QtGui.QLabel(self)
        self.label_version.setText("Maya Version")
        self.label_version.move(20, 30)

        self.combo_version = QtGui.QComboBox(self)
        self.items_maya = self.chk_maya_version()
        self.combo_version.addItems(self.items_maya)
        self.combo_version.move(140, 20)
        self.combo_version.resize(120,30)

        self.label_prj = QtGui.QLabel(self)
        self.label_prj.setText("Project Name")
        self.label_prj.move(20,70)

        self.combo_prj = QtGui.QComboBox(self)
        self.prj_list = self.project_list()
        self.combo_prj.addItems(self.prj_list)
        self.combo_prj.move(140,70)
        self.combo_prj.resize(500,20)

        self.button = QtGui.QPushButton("EXECUTE",self)
        self.button.resize(70, 30)
        self.button.move(670, 70)
        self.button.clicked.connect(self.cmd)

        self.list = QtGui.QListWidget(self)
        self.list.move(20, 150)
        self.list.resize(720, 230)


        self.button2 = QtGui.QPushButton("CLOSE", self)
        self.button2.resize(90, 30)
        self.button2.move(330, 400)
        self.button2.clicked.connect(self.exit)

        self.show()

    def exit(self):
        self.close()


    def chk_maya_version(self):
        #folder_list = glob.glob(r'C:/Program Files/Autodesk/Maya2*')
        folder_list = glob.glob('/usr/autodesk/maya2*')
        maya_list = []
        for list in folder_list:
            maya_list.append(list.split('/')[-1])
            maya_list.sort()
        return maya_list

    def project_list(self):
        query = "select distinct(project) from asset"
        cur.execute(query)
        select_rows = cur.fetchall()

        prj_list = []

        for prj in select_rows:
            prj_list.append(prj[0])
        return prj_list


    def cmd(self):
        self.list.clear()
        self.list.addItem("File read....")
        sel_maya = self.combo_version.currentText()  # 선택한 maya version
        sel_prj = self.combo_prj.currentText()

        command = "/usr/autodesk/maya/bin/mayapy /home/crystal/MG/asset/python/change_path.py %s" % (sel_prj)
        process = subprocess.Popen(command, shell=True, stdout=subprocess.PIPE, stdin=subprocess.PIPE,stderr=subprocess.PIPE).communicate()[0]
        self.list.addItem(process)

if __name__ == '__main__':
    myApp = QtGui.QApplication.instance()
    if not myApp:
        myApp = QtGui.QApplication(sys.argv)
    ui = pathUI()
    myApp.exec_()