# -*- coding: utf-8 -*-
import os
import sys
reload(sys)
sys.setdefaultencoding('utf-8')

sys.path.append("/usr/lib/python2.7/site-packages/")
sys.path.append("/mgscript/script/Linux/Python27/lib/python2.7/site-packages/")

try:
    from wand.image import Image
except:
    print "no module named Image"

try:
    from shotgun_api3 import Shotgun
except:
    print "no module named Shotgun"

try:
    import MySQLdb
except:
    print "no module named MySQLdb"

import shutil
from datetime import datetime

import uuid
import urllib

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="asset", charset="utf8")
cur = db.cursor()

db.query("set character_set_connection=utf8;")
db.query("set character_set_server=utf8;")
db.query("set character_set_client=utf8;")

db.query("set character_set_results=utf8;")


SERVER_PATH = "http://show.macrograph.co.kr"
SCRIPT_NAME = "testapi"
SCRIPT_KEY = "b4332cb2077957915585fafdf27f252bdaf8a3ada1450970d0c69743253de823"

sg = Shotgun(SERVER_PATH, SCRIPT_NAME, SCRIPT_KEY)

field = ['name','sg_status','sg_description','image','start_date','end_date']
projectsALL = sg.find('Project',[],field)


for project in projectsALL:
    project_name = project['name']
    status = project['sg_status']
    description = project['sg_description']
    thumbnail = project['image']
    start_date = project['start_date']
    end_date = project['end_date']

    if thumbnail == None:
        thum = "noimage.jpg"
    else:
        thum = "%s_" % (datetime.today().strftime('%Y%m%d')) + str(uuid.uuid4())[:8] + ".jpg"
    thum_path = "/home/crystal/MG/asset/thumnail/small_thum/%s" % thum

    if status == "Complete":
        stat = "com"

    else:
        stat = "ing"

    thumbnail_file = urllib.URLopener()
    thumbnail_file.retrieve(thumbnail,thum_path)

    low = project_name.lower()
    if low.find('test') >=0 or low =='vfx-제작3실' or low == 'vfx총괄실' or low == 'template project' or low =='big buck bunny':
        pass
    else:
        query = "insert into project(img,project_name,start_date,end_date,stat) values('%s','%s','%s','%s','%s')"%(thum,project_name,start_date,end_date,stat)
        cur.execute("set names utf8")
        cur.execute(query)
        db.commit()
