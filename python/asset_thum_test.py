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

project = 'TBD'

dir = "//home/crystal/Desktop/project_test/" + project.lower()

assetALL = sg.find('Asset', [['project.Project.name', 'is', project]], ['image', 'code'])



for asset in assetALL:
    asset_name = asset['code']
    asset_thum = asset['image']

    lookdevALL = sg.find_one('Version', [['project.Project.name', 'is', project],
                                                                    ['entity.Asset.code', 'is', asset_name],
                                                                    ['sg_task.Task.step.Step.id', 'is', 18]],
                                                        ['image', 'sg_path_to_movie'])
    lookdev_mov = lookdevALL['sg_path_to_movie']
    print lookdev_mov
    # lookdev_mov = str(lookdev_mov).replace("\\", "/")

    # print lookdev_mov
    # thum = "%s_" % (datetime.today().strftime('%Y%m%d')) + str(uuid.uuid4())[:8] + ".jpg"
    # thum_path = "/home/crystal/MG/asset/thumnail/small_thum/%s" % thum
    #
    # cate_arr = os.listdir(dir)
    # for cate in cate_arr:
    #     dir_cate = dir + "/" + cate
    #     asset_arr = os.listdir(dir_cate)
    #
    #     for asset2 in asset_arr:
    #         if asset_name == asset2:
    #             dir_asset = dir_cate + "/" + asset2
    #             lod_arr = os.listdir(dir_asset)
    #
    #             for lod in lod_arr:
    #                 dir_lod = dir_asset + "/" + lod
    #                 mtrl_arr = os.listdir(dir_lod)
    #
    #                 texture = "X"
    #                 model = "X"
    #                 rigging = "X"
    #                 lookdev = "X"
    #
    #                 for mtrl in mtrl_arr:
    #                     if mtrl == "texture":
    #                         texture = "O"
    #                     else:
    #                         pass
    #                     if mtrl == "model":
    #                         model = "O"
    #                     else:
    #                         pass
    #                     if mtrl == "rigging":
    #                         rigging = "O"
    #                     else:
    #                         pass
    #                     if mtrl == "lookdev":
    #                         lookdev = "O"
    #                     else:
    #                         pass
    #
    #                 query = "insert into asset(asset_name,path,full_path,thum,lod,texture,model,rigging,lookdev,project) values('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')" % (asset_name,dir_cate+"/",dir_asset+"/",thum,lod,texture,model,rigging,lookdev,project)
    #
    #                 cur.execute("set names utf8")
    #                 cur.execute(query)
    #                 db.commit()
    #
    #                 with Image(filename=asset_thum) as img:
    #                     try:
    #                         img.save(filename=thum_path)
    #                     except:
    #                         pass