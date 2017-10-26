import sys
sys.path.remove('/usr/autodesk/maya/lib/python2.7/site-packages')

import maya.standalone

maya.standalone.initialize()

import maya.cmds as cmds

maya_scene_filename = "/library/project/TD/astana/packaging_script/_MGWORKS/AST_PACKAGING/mc_geo/ast_mc_geo_ch_rig_fin.mb"
cmds.file(maya_scene_filename, open=True)
file_node_list = cmds.ls(type='file')
print file_node_list