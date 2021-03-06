#!/usr/bin/env python
# -*- coding:utf-8 -*-

import sys
reload(sys)
sys.setdefaultencoding('utf-8')
project = "tbd"

import os
import maya.cmds as cmds

import maya
# import maya.standalone
# maya.standalone.initialize(name="python")

try:
    import maya._OpenMaya as om
    import maya.standalone as standalone
    standalone.initialize(name="python")
except:
    print "마야를 초기화 할 수 없습니다"
    pass

import maya.cmds as cmds

print "2 => " + project



def change():
    for (path, dir, files) in os.walk('//home/crystal/Desktop/project_test/'+project):
        for filename in files:
            ext = os.path.splitext(filename)[-1]
            if ext == ".mb" or ext == ".ma":
                maya_scene_filename = "%s/%s" % (path, filename)

                try:
                    cmds.file(maya_scene_filename, open=True)
                    file_node_list = cmds.ls(type='file')

                    for f in file_node_list:
                        try:
                            texture_filename = cmds.getAttr(f + '.fileTextureName') #get texture file name
                            if texture_filename[0] == "\\":
                                texture_filename = texture_filename.replace("\\", "/")
                            texture_path_split = texture_filename.split('/tex/')

                            if maya_scene_filename.find('lookdev') != -1:   #lookdev에 있는 file일 경우
                                dir_sp = maya_scene_filename.split('/lookdev')
                                change_path = dir_sp[0] + "/texture/tex/" + texture_path_split[-1]
                                cmds.setAttr("%s.fileTextureName" % f, change_path, type="string")

                            elif maya_scene_filename.find('model') != -1:
                                dir_sp = maya_scene_filename.split('/model')
                                change_path = dir_sp[0] + "/texture/tex/" + texture_path_split[-1]
                                cmds.setAttr("%s.fileTextureName" % f, change_path, type="string")

                            elif maya_scene_filename.find("rigging") != -1:
                                dir_sp = maya_scene_filename.split('/rigging')
                                change_path = dir_sp[0] + "/texture/tex/" + texture_path_split[-1]
                                cmds.setAttr("%s.fileTextureName" % f, change_path, type="string")
                        except:
                            pass

                    cmds.file(rename=maya_scene_filename)
                    if ext == ".mb":
                        cmds.file(save=True, type="mayaBinary")
                    elif ext == ".ma":
                        cmds.file(f=True, type="mayaAscii", save=True)

                except:
                    print "파일을 여는 도중 에러가 발생했습니다"
                    pass
change()