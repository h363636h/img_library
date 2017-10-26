# -*- coding: utf-8 -*-
import os
import sys


reload(sys)
sys.setdefaultencoding('utf-8')

# project = sys.argv[1]
project = "tbd"

import glob
import shutil

import uuid

from distutils.dir_util import copy_tree
from datetime import datetime

try:
    import MySQLdb
except:
    print "no module names mysqldb"

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="asset", charset="utf8")
cur = db.cursor()

db.query("set character_set_connection=utf8;")
db.query("set character_set_server=utf8;")
db.query("set character_set_client=utf8;")

db.query("set character_set_results=utf8;")
db.query("set character_set_database=utf8;")

createDir = "//home/crystal/Desktop/project_test/"


class Folder_backup:
    def __init__(self):
        self.serverName = "//home/crystal/Desktop/test_iu"
        self.baseDir = self.serverName + "/project/"
        self.project = project
        self.prj(self.baseDir)

    def prj(self,baseDir):
        try:
            if not os.path.exists(createDir + self.project):
                os.umask(0)
                os.mkdir(createDir + self.project,0777)
            else:
                print "folder exists"
                pass
            dir = baseDir + self.project + "/assets/"
            print dir

            if os.path.isdir(dir):
                mtrl_arr = os.listdir(dir)
                for mtrl in mtrl_arr:
                    if mtrl == "model":
                        pass
                        self.model(self.project,dir,mtrl)
                    elif mtrl == "texture":
                        pass
                        self.texture(self.project,dir,mtrl)
                    elif mtrl == "rigging":
                        pass
                        self.rigging(self.project,dir,mtrl)
                    elif mtrl == "lookdev":
                        pass
                        self.lookdev(self.project,dir,mtrl)
            else:
                print dir + "Permission error"
                pass

        except Exception,e:
            pass
            print e

    def model(self,project,dir,model):
        # pass
        model_dir = dir + model
        if os.path.isdir(model_dir):   #model 폴더 존재할 경우 처리
            model_cate_arr = os.listdir(model_dir)
            for model_cate in model_cate_arr:   #model 내 category list 처리
                create_model_cate = createDir + project + "/" + model_cate
                if not os.path.exists(create_model_cate): #백업 폴더에 category까지 생성
                    try:
                        os.umask(0)
                        os.mkdir(create_model_cate,0777)
                    except Exception as e:
                        print e

                dir_model_cate = model_dir + "/" + model_cate
                if os.path.isdir(dir_model_cate):  #model/category 폴더 존재할 경우 처리
                    model_asset_arr = os.listdir(dir_model_cate)
                    for model_asset in model_asset_arr: #model/category 내 asset list 처리
                        create_model_asset = create_model_cate + "/" + model_asset
                        if not os.path.exists(create_model_asset):  #백업 폴더에 asset까지 생성
                            try:
                                os.umask(0)
                                os.mkdir(create_model_asset,0777)
                            except Exception as e:
                                print e

                        dir_model_asset = dir_model_cate + "/" + model_asset
                        if os.path.isdir(dir_model_asset): #model/category/asset 폴더 존재할 경우 처리
                            model_lod_arr = os.listdir(dir_model_asset)
                            for model_lod in model_lod_arr: #model/category/asset 내 lod list 처리
                                dir_model_lod = dir_model_asset + "/" + model_lod
                                if os.path.isdir(dir_model_lod):
                                    create_model_lod = create_model_asset + "/" + model_lod
                                    if not os.path.exists(create_model_lod):    #백업 폴더에 lod까지 생성
                                        try:
                                            os.umask(0)
                                            os.mkdir(create_model_lod,0777)
                                        except Exception as e:
                                            print e

                                model_dir_fi = create_model_lod + "/model/"
                                if not os.path.exists(model_dir_fi): #최종파일 넣을 model 폴더 까지 생성
                                    try:
                                        os.umask(0)
                                        os.mkdir(model_dir_fi,0777)
                                    except Exception as e:
                                        print e

                                if os.path.isdir(dir_model_lod):   #model/category/asset/lod 폴더 존재할 경우 처리
                                    model_mb_list = []
                                    model_mb_list.extend(glob.glob(dir_model_lod + "*.mb"))

                                    if model_mb_list == []: #폴더 밖에 최종 파일 없을 경우 -> 버전 폴더만 존재
                                        model_ver_list = []
                                        model_ver_arr = os.listdir(dir_model_lod)
                                        try:
                                            model_latest_version = max(model_ver_arr)
                                        except Exception,e:
                                            print e
                                        model_ver_list.extend(glob.glob(dir_model_lod + "/" + model_latest_version + "/geo/*.mb"))

                                        for ver in model_ver_list:
                                            shutil.copy2(ver,model_dir_fi)
                                    else:
                                        final_files = glob.glob(dir_model_lod + "/*.mb")
                                        for final_file in final_files:  #최종 파일 list 처리
                                            shutil.copy2(final_file,model_dir_fi)   #백업 경로에 최종 파일 복사
                                else:
                                    print dir_model_lod + "=> None"
                                    pass
                        else:
                            print dir_model_asset + "=> None"
                            pass
                    pass
                else:
                    print dir_model_cate + "=> None"
                    pass
        else:
            print model_dir + "=> None"
            pass
        print model_dir

    def texture(self,project,dir,texture):
        # pass
        texture_dir = dir + texture
        if os.path.isdir(texture_dir):  #texture 폴더 존재할 경우 처리
            texture_cate_arr = os.listdir(texture_dir)
            for texture_cate in texture_cate_arr:   #texture 내 category list 처리
                create_texture_cate = createDir + project + "/" + texture_cate
                if not os.path.exists(create_texture_cate):  #백업 폴더에 category까지 생성
                    try:
                        os.umask(0)
                        os.mkdir(create_texture_cate,0777)
                    except Exception,e:
                        print e

                dir_texture_cate = texture_dir + "/" + texture_cate
                if os.path.isdir(dir_texture_cate): #texture/category 폴더 존재할 경우 처리
                    texture_asset_arr = os.listdir(dir_texture_cate)
                    for texture_asset in texture_asset_arr: #texture/category 내 asset list 처리
                        create_texture_asset = create_texture_cate + "/" + texture_asset
                        if not os.path.exists(create_texture_asset): #백업 폴더에 asset까지 생성
                            try:
                                os.umask(0)
                                os.mkdir(create_texture_asset,0777)
                            except Exception,e:
                                print e

                        dir_texture_asset = dir_texture_cate + "/" + texture_asset
                        if os.path.isdir(dir_texture_asset):    #texture/category/asset 폴더 존재할 경우 처리
                            texture_lod_arr = os.listdir(dir_texture_asset)
                            for texture_lod in texture_lod_arr: #texture/category/asset 내 lod list 처리
                                dir_texture_lod = dir_texture_asset + "/" + texture_lod
                                if os.path.isdir(dir_texture_lod):
                                    create_texture_lod = create_texture_asset + "/" + texture_lod
                                    if not os.path.exists(create_texture_lod):   #백업 폴더에 lod까지 생성
                                        try:
                                            os.umask(0)
                                            os.mkdir(create_texture_lod,0777)
                                        except Exception,e:
                                            print e

                                texture_dir_fi = create_texture_lod + "/texture/"
                                if not os.path.exists(texture_dir_fi):   #최종 파일 넣을 texture 폴더 까지 생성
                                    try:
                                        os.umask(0)
                                        os.mkdir(texture_dir_fi,0777)
                                    except Exception,e:
                                        print e

                                if os.path.isdir(dir_texture_lod):  #texture/category/asset/lod 폴더 존재할 경우 처리
                                    texture_ver_arr = os.listdir(dir_texture_lod)   #texture/category/asset/lod/ 아래 version폴더 list 처리
                                    latest_version = max(texture_ver_arr)   #가장 최근 버전 출력

                                    if 'final' in texture_ver_arr:  #lod 아래 final 폴더 존재할 경우
                                        dir_texture_ver = dir_texture_lod + "/final"
                                    else:   #lod 아래 final 폴더 없을 경우, 최신 버전 폴더에서 처리
                                        dir_texture_ver = dir_texture_lod + "/" + latest_version

                                    final_files = glob.glob(dir_texture_ver)    #final or version 폴더 내 파일 처리
                                    for final_file in final_files:
                                        copy_tree(final_file,texture_dir_fi)
                                else:
                                    print dir_texture_lod +"=>None"
                                    pass
                        else:
                            print dir_texture_asset + "=>None"
                            pass
                else:
                    print dir_texture_cate + "=>None"
                    pass
        else:
            print texture_dir + "=>None"
            pass
        pass

    def rigging(self,project,dir,rigging):
        # pass
        rigging_dir = dir + rigging
        if os.path.isdir(rigging_dir):  #rigging 폴더 존재할 경우 처리
            rigging_cate_arr = os.listdir(rigging_dir)
            for rigging_cate in rigging_cate_arr:   #rigging 내 category list 처리
                create_rigging_cate = createDir + project + "/" + rigging_cate
                if not os.path.exists(create_rigging_cate):  #백업 폴더에 category까지 생성
                    try:
                        os.umask(0)
                        os.mkdir(create_rigging_cate,0777)
                    except Exception,e:
                        print e

                dir_rigging_cate = rigging_dir + "/" + rigging_cate
                if os.path.isdir(dir_rigging_cate): #rigging/category 폴더 존재할 경우 처리
                    rigging_asset_arr = os.listdir(dir_rigging_cate)
                    for rigging_asset in rigging_asset_arr: #rigging/category 내 asset list 처리
                        create_rigging_asset = create_rigging_cate + "/" + rigging_asset
                        if not os.path.exists(create_rigging_asset): #백업 폴더에 asset까지 생성
                            try:
                                os.umask(0)
                                os.mkdir(create_rigging_asset,0777)
                            except Exception,e:
                                print e

                        dir_rigging_asset = dir_rigging_cate + "/" + rigging_asset
                        if os.path.isdir(dir_rigging_asset):    #rigging/category/asset 폴더 존재할 경우 처리
                            rigging_lod_arr = os.listdir(dir_rigging_asset)
                            for rigging_lod in rigging_lod_arr: #rigging/category/asset 내 lod list 처리
                                dir_rigging_lod = dir_rigging_asset + "/" + rigging_lod
                                if os.path.isdir(dir_rigging_lod):
                                    create_rigging_lod = create_rigging_asset + "/" + rigging_lod
                                    if not os.path.exists(create_rigging_lod):
                                        try:
                                            os.umask(0)
                                            os.mkdir(create_rigging_lod,0777)
                                        except Exception,e:
                                            print e
                                rigging_dir_fi = create_rigging_lod + "/rigging/"
                                if not os.path.exists(rigging_dir_fi):   #최종 파일 넣을 rigging 폴더 까지 생성
                                    try:
                                        os.umask(0)
                                        os.mkdir(rigging_dir_fi,0777)
                                    except Exception,e:
                                        print e

                                if os.path.isdir(dir_rigging_lod):  #rigging/category/asset/lod 폴더 존재할 경우 처리
                                    rigging_mb_list = []
                                    rigging_mb_list.extend(glob.glob(dir_rigging_lod+"/*.mb"))

                                    if rigging_mb_list == []: #폴더 밖에 최종 파일 없을 경우 -> 버전 폴더만 존재
                                        rigging_ver_list = []
                                        rigging_ver_arr = os.listdir(dir_rigging_lod)
                                        rigging_latest_version = max(rigging_ver_arr)
                                        rigging_ver_list.extend(glob.glob(dir_rigging_lod + "/" + rigging_latest_version + "/*.mb"))

                                        for ver in rigging_ver_list:
                                            shutil.copy2(ver,rigging_dir_fi)
                                    else:

                                        final_files = glob.glob(dir_rigging_lod + "/*.mb")
                                        for final_file in final_files:  #최종 파일 list 처리
                                            shutil.copy2(final_file,rigging_dir_fi) #백업 경로에 최종 파일 복사
                                else:
                                    print dir_rigging_lod + "=>None"
                                    pass
                        else:
                            print dir_rigging_asset + "=>None"
                            pass
                else:
                    print dir_rigging_cate + "=>None"
                    pass
        else:
            print rigging_dir + "=>None"
            pass

    def lookdev(self,project,dir,lookdev):
        # pass
        lookdev_dir = dir + lookdev
        if os.path.isdir(lookdev_dir):  #lookdev 폴더 존재할 경우 처리
            lookdev_cate_arr = os.listdir(lookdev_dir)
            for lookdev_cate in lookdev_cate_arr:   #lookdev 내 category list 처리
                create_lookdev_cate = createDir + project +"/" + lookdev_cate
                if not os.path.exists(create_lookdev_cate):  #백업 폴더에 category 까지 생성
                    try:
                        os.umask(0)
                        os.mkdir(create_lookdev_cate,0777)
                    except Exception,e:
                        print e

                dir_lookdev_cate = lookdev_dir + "/" + lookdev_cate
                if os.path.isdir(dir_lookdev_cate): #lookdev/category 폴더 존재할 경우 처리
                    lookdev_asset_arr = os.listdir(dir_lookdev_cate)
                    for lookdev_asset in lookdev_asset_arr: #lookdev/category 내 asset list 처리
                        create_lookdev_asset = create_lookdev_cate + "/" + lookdev_asset
                        if not os.path.exists(create_lookdev_asset): #백업 폴더에 asset까지 생성
                            try:
                                os.umask(0)
                                os.mkdir(create_lookdev_asset,0777)
                            except Exception,e:
                                print e

                        dir_lookdev_asset = dir_lookdev_cate + "/" + lookdev_asset
                        if os.path.isdir(dir_lookdev_asset):    #lookdev/category/asset 폴더 존재할 경우 처리
                            lookdev_lod_arr = os.listdir(dir_lookdev_asset)
                            for lookdev_lod in lookdev_lod_arr: #lookdev/category/asset 내 lod list 처리
                                dir_lookdev_lod = dir_lookdev_asset + "/" + lookdev_lod
                                if os.path.isdir(dir_lookdev_lod):
                                    create_lookdev_lod = create_lookdev_asset + "/" + lookdev_lod
                                    try:
                                        os.umask(0)
                                        os.mkdir(create_lookdev_lod,0777)
                                    except Exception,e:
                                        print e

                                    lookdev_shader_arr = os.listdir(dir_lookdev_lod)
                                    for lookdev_shader in lookdev_shader_arr:
                                        ver_ext = ("*_[0-9].json","*[0-9].ma","*[0-9].xml") #버전 파일
                                        all_ext = ("*.json","*.ma","*.xml") #전체 파일

                                        if lookdev_shader == "shader":
                                            self.lookdev_shader(dir_lookdev_lod,create_lookdev_lod,all_ext,ver_ext)
                                        elif lookdev_shader == "vray":
                                            self.lookdev_vray(dir_lookdev_lod,create_lookdev_lod,all_ext,ver_ext)
                                        elif lookdev_shader == "arnold":
                                            self.lookdev_arnold(dir_lookdev_lod,create_lookdev_lod,all_ext,ver_ext)
                                        elif lookdev_shader == "redshift":
                                            self.lookdev_redshift(dir_lookdev_lod,create_lookdev_lod,all_ext,ver_ext)

                                else:
                                    print dir_lookdev_lod + "None"

                        else:
                            print dir_lookdev_cate + "=>None"
                else:
                    print dir_lookdev_cate + "=>None"
            pass
        else:
            print lookdev_dir + "=>None"


    def lookdev_shader(self,dir_lookdev_lod,create_lookdev_lod,all_ext,ver_ext):
        dir_lookdev_shader = dir_lookdev_lod + "/shader"
        create_lookdev_fi = create_lookdev_lod + "/lookdev"
        if not os.path.exists(create_lookdev_fi):  # 최종파일 넣을 lookdev 폴더 까지 생성
            try:
                os.umask(0)
                os.mkdir(create_lookdev_fi,0777)
            except Exception, e:
                print e

        all_list = []
        for ext in all_ext:
            all_list.extend(glob.glob(dir_lookdev_shader + "/" + ext))

        if all_list == []: #버전 폴더만 있을 경우
            shader_ver_list = []
            for ext in all_ext:
                shader_ver_arr = os.listdir(dir_lookdev_shader)
                shader_latest_version = max(shader_ver_arr)

                shader_ver_list.extend(glob.glob(dir_lookdev_shader + "/" + shader_latest_version + "/" + ext))
                for ver in shader_ver_list:
                    shutil.copy2(ver,create_lookdev_fi)
        else:   #버전 파일과 최종 파일이 같이 있는 경우
            ver_list = []
            for ext in ver_ext:
                ver_list.extend(glob.glob(dir_lookdev_shader + "/" + ext))

            print ver_list

            not_list = []
            for i in all_list:  # 버전 파일 아닌 것만 처리
                if i not in ver_list:
                    not_list.append(i)

            for a in not_list:
                shutil.copy2(a, create_lookdev_fi)


    def lookdev_vray(self,dir_lookdev_lod,create_lookdev_lod,all_ext,ver_ext):
        dir_lookdev_vray = dir_lookdev_lod + "/vray/shader"
        create_lookdev_vray = create_lookdev_lod + "/lookdev/vray"

        try:
            if not os.path.exists(create_lookdev_vray):  # vray 최종 파일 넣을 /lookdev/vray 폴더 생성
                try:
                    os.makedirs(create_lookdev_vray)
                except Exception, e:
                    print e
            else:
                pass
        except Exception, e:
            print e

        vray_shader_list = []

        for ext in all_ext:
            vray_shader_list.extend(glob.glob(dir_lookdev_vray + "/" + ext))

        if vray_shader_list == []:  # 폴더 밖에 최종 파일 없을 경우   -> 버전 폴더로 있을 경우
            vray_ver_list = []
            for ext in all_ext:
                vray_ver_arr = os.listdir(dir_lookdev_vray)
                vray_latest_version = max(vray_ver_arr)
                vray_ver_list.extend(glob.glob(dir_lookdev_vray + "/" + vray_latest_version + "/" + ext))
            for ver in vray_ver_list:
                shutil.copy2(ver, create_lookdev_vray)
        else:  # 폴더 밖 최종파일 있을 경우
            for ver in vray_shader_list:
                shutil.copy2(ver, create_lookdev_vray)

        ####scenes 폴더 있을 경우####
        dir_vray_scene = dir_lookdev_lod + "/vray/scenes"
        if os.path.isdir(dir_vray_scene):
            create_vray_scene = create_lookdev_vray + "/scenes"

            try:
                if not os.path.exists(create_vray_scene):
                    try:
                        os.umask(0)
                        os.mkdir(create_vray_scene,0777)
                    except Exception, e:
                        print e
                else:
                    pass
            except Exception, e:
                print e
            final_files = glob.glob(dir_vray_scene + "/*.mb")

            if final_files == []: #버전 폴더만 있을 경우
                vray_scene_arr = os.listdir(dir_vray_scene)
                vray_scene_latest = max(vray_scene_arr)
                vray_scene_files = glob.glob(dir_vray_scene+"/" + vray_scene_latest + "/*.mb")

                for vray_scene_file in vray_scene_files:
                    shutil.copy2(vray_scene_file,create_vray_scene)
            else:
                for final_file in final_files:
                    shutil.copy2(final_file, create_vray_scene)
        else:
            pass


    def lookdev_arnold(self,dir_lookdev_lod,create_lookdev_lod,all_ext,ver_ext):
        dir_lookdev_arnold = dir_lookdev_lod + "/arnold/shader"
        create_lookdev_arnold = create_lookdev_lod + "/lookdev/arnold"

        try:
            if not os.path.exists(create_lookdev_arnold):  # arnold 최종 파일 넣을 /lookdev/arnold 폴더 생성
                try:
                    os.makedirs(create_lookdev_arnold)
                except Exception, e:
                    print e
            else:
                pass
        except Exception, e:
            print e

        arnold_shader_list = []

        for ext in all_ext:
            arnold_shader_list.extend(glob.glob(dir_lookdev_arnold + "/" + ext))

        if arnold_shader_list == []:  # 폴더 밖에 최종 파일 없을 경우   -> 버전 폴더로 있을 경우
            arnold_ver_list = []
            for ext in all_ext:
                arnold_ver_arr = os.listdir(dir_lookdev_arnold)
                arnold_latest_version = max(arnold_ver_arr)
                arnold_ver_list.extend(glob.glob(dir_lookdev_arnold + "/" + arnold_latest_version + "/" + ext))
            for ver in arnold_ver_list:
                shutil.copy2(ver, create_lookdev_arnold)
        else:  # 폴더 밖 최종파일 있을 경우
            for ver in arnold_shader_list:
                shutil.copy2(ver, create_lookdev_arnold)

        ####scenes 폴더 있을 경우####
        dir_arnold_scene = dir_lookdev_lod + "/arnold/scenes"
        if os.path.isdir(dir_arnold_scene):
            create_arnold_scene = create_lookdev_arnold + "/scenes"

            try:
                if not os.path.exists(create_arnold_scene):
                    try:
                        os.umask(0)
                        os.mkdir(create_arnold_scene,0777)
                    except Exception, e:
                        print e
                else:
                    pass
            except Exception, e:
                print e
            final_files = glob.glob(dir_arnold_scene + "/*.mb")

            if final_files == []: #버전 폴더만 있을 경우
                arnold_scene_arr = os.listdir(dir_arnold_scene)
                arnold_scene_latest = max(arnold_scene_arr)
                arnold_scene_files = glob.glob(dir_arnold_scene+"/" + arnold_scene_latest + "/*.mb")

                for arnold_scene_file in arnold_scene_files:
                    shutil.copy2(arnold_scene_file,create_arnold_scene)
            else:
                for final_file in final_files:
                    shutil.copy2(final_file, create_arnold_scene)
        else:
            pass


    def lookdev_redshift(self,dir_lookdev_lod,create_lookdev_lod,all_ext,ver_ext):

        dir_lookdev_redshift = dir_lookdev_lod + "/redshift/shader"
        create_lookdev_redshift = create_lookdev_lod + "/lookdev/redshift"

        try:
            if not os.path.exists(create_lookdev_redshift):  # redshift 최종 파일 넣을 /lookdev/redshift 폴더 생성
                try:
                    os.makedirs(create_lookdev_redshift)
                except Exception, e:
                    print e
            else:
                pass
        except Exception, e:
            print e

        redshift_shader_list = []

        for ext in all_ext:
            redshift_shader_list.extend(glob.glob(dir_lookdev_redshift + "/" + ext))

        if redshift_shader_list == []:  # 폴더 밖에 최종 파일 없을 경우   -> 버전 폴더로 있을 경우
            redshift_ver_list = []
            for ext in all_ext:
                redshift_ver_arr = os.listdir(dir_lookdev_redshift)
                redshift_latest_version = max(redshift_ver_arr)
                redshift_ver_list.extend(glob.glob(dir_lookdev_redshift + "/" + redshift_latest_version + "/" + ext))
            for ver in redshift_ver_list:
                shutil.copy2(ver, create_lookdev_redshift)
        else:  # 폴더 밖 최종파일 있을 경우
            for ver in redshift_shader_list:
                shutil.copy2(ver, create_lookdev_redshift)

        ####scenes 폴더 있을 경우####
        dir_redshift_scene = dir_lookdev_lod + "/redshift/scenes"
        if os.path.isdir(dir_redshift_scene):
            create_redshift_scene = create_lookdev_redshift + "/scenes"

            try:
                if not os.path.exists(create_redshift_scene):
                    try:
                        os.umask(0)
                        os.mkdir(create_redshift_scene,0777)
                    except Exception, e:
                        print e
                else:
                    pass
            except Exception, e:
                print e
            final_files = glob.glob(dir_redshift_scene + "/*.mb")

            if final_files == []: #버전 폴더만 있을 경우
                redshift_scene_arr = os.listdir(dir_redshift_scene)
                redshift_scene_latest = max(redshift_scene_arr)
                redshift_scene_files = glob.glob(dir_redshift_scene+"/" + redshift_scene_latest + "/*.mb")

                for redshift_scene_file in redshift_scene_files:
                    shutil.copy2(redshift_scene_file,create_redshift_scene)
            else:
                for final_file in final_files:
                    shutil.copy2(final_file, create_redshift_scene)
        else:
            pass

class db_update:
    def __init__(self):
        self.project = project


folder = Folder_backup()