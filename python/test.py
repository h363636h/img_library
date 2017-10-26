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



query = "select project_name from project"
cur.execute(query)
select_rows = cur.fetchall()

prj_list = []
for prj in select_rows:
    prj_list.append(prj[0])
print prj_list
