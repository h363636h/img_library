import os
import glob
import shutil
from distutils.dir_util import copy_tree

serverName = "//iu"
baseDir = serverName + "/project/"

createDir = "//home/crystal/Desktop/project_test/"

projects = os.listdir(baseDir)

for project in projects:
    if len(project) == 3:
        print project

        if not os.path.isdir(createDir + project):
            os.mkdir(createDir+project)
        else:
            pass

        dir = baseDir + project + '/assets/'
        print dir

        try:
            mtrl_arr = os.listdir(dir)
            for mtrl in mtrl_arr:
                if mtrl == "model":
                    model_dir = dir + mtrl
                    print model_dir
                    model_cate_arr = os.listdir(model_dir)

                    for model_cate in model_cate_arr:
                        print model_cate
                        create_model_cate = createDir + project + "/" + model_cate
                        if not os.path.isdir(create_model_cate):
                            os.mkdir(create_model_cate)


                        dir_model_cate = model_dir + "/" + model_cate
                        model_asset_arr = os.listdir(dir_model_cate)

                        for model_asset in model_asset_arr:
                            print model_asset
                            create_model_asset = create_model_cate + "/" + model_asset
                            if not os.path.isdir(create_model_asset):
                                os.mkdir(create_model_asset)
                            dir_model_asset = dir_model_cate + "/" + model_asset
                            model_lod_arr = os.listdir(dir_model_asset)

                            for model_lod in model_lod_arr:
                                print model_lod
                                create_model_lod = create_model_asset + "/" + model_lod
                                if not os.path.isdir(create_model_lod):
                                    os.mkdir(create_model_lod)
                                dir_model_lod = dir_model_asset + "/" + model_lod

                                model_dir_fi = create_model_lod + "/model/"
                                if not os.path.isdir(model_dir_fi):
                                    os.mkdir(model_dir_fi)
                                final_files = glob.glob(dir_model_lod + "/*.mb")
                                for final_file in final_files:
                                    shutil.copy2(final_file , model_dir_fi)

                elif mtrl == "texture":
                    texture_dir = dir + mtrl
                    texture_cate_arr = os.listdir(texture_dir)

                    for texture_cate in texture_cate_arr:
                        create_texture_cate = createDir + project + "/" + texture_cate
                        if not os.path.isdir(create_texture_cate):
                            os.mkdir(create_texture_cate)
                        dir_texture_cate = texture_dir + "/" + texture_cate
                        texture_asset_arr = os.listdir(dir_texture_cate)

                        for texture_asset in texture_asset_arr:
                            create_texture_asset = create_texture_cate + "/" + texture_asset
                            if not os.path.isdir(create_texture_asset):
                                os.mkdir(create_texture_asset)
                            dir_texture_asset = dir_texture_cate + "/" + texture_asset
                            texture_lod_arr = os.listdir(dir_texture_asset)

                            for texture_lod in texture_lod_arr:
                                create_texture_lod = create_texture_asset + "/" + texture_lod
                                if not os.path.isdir(create_texture_lod):
                                    os.mkdir(create_texture_lod)
                                dir_texture_lod = dir_texture_asset + "/" + texture_lod
                                texture_dir_fi = create_texture_lod + "/texture/"
                                if not os.path.isdir(texture_dir_fi):
                                    os.mkdir(texture_dir_fi)

                                texture_ver_arr = os.listdir(dir_texture_lod)
                                latest_version = max(texture_ver_arr)

                                if 'final' in texture_ver_arr:
                                    dir_texture_ver = dir_texture_lod + "/final"
                                else:
                                    dir_texture_ver = dir_texture_lod + "/" + latest_version
                                final_files = glob.glob(dir_texture_ver)
                                for final_file in final_files:
                                    copy_tree(final_file,texture_dir_fi)

                elif mtrl == "rigging":
                    rigging_dir = dir + mtrl
                    rigging_cate_arr = os.listdir(rigging_dir)

                    for rigging_cate in rigging_cate_arr:
                        create_rigging_cate = createDir + project + "/" + rigging_cate
                        if not os.path.isdir(create_rigging_cate):
                            os.mkdir(create_rigging_cate)

                        dir_rigging_cate = rigging_dir + "/" + rigging_cate
                        rigging_asset_arr = os.listdir(dir_rigging_cate)

                        for rigging_asset in rigging_asset_arr:
                            create_rigging_asset = create_rigging_cate + "/" + rigging_asset
                            if not os.path.isdir(create_rigging_asset):
                                os.mkdir(create_rigging_asset)
                            dir_rigging_asset = dir_rigging_cate + "/" + rigging_asset
                            rigging_lod_arr = os.listdir(dir_rigging_asset)

                            for rigging_lod in rigging_lod_arr:
                                create_rigging_lod = create_rigging_asset + "/" + rigging_lod
                                if not os.path.isdir(create_rigging_lod):
                                    os.mkdir(create_rigging_lod)
                                dir_rigging_lod = dir_rigging_asset + "/" + rigging_lod

                                rigging_dir_fi = create_rigging_lod + "/rigging/"

                                if not os.path.isdir(rigging_dir_fi):
                                    os.mkdir(rigging_dir_fi)

                                final_files = glob.glob(dir_rigging_lod + "/*.mb")
                                for final_file in final_files:
                                    shutil.copy2(final_file , rigging_dir_fi)


                elif mtrl == "lookdev":
                    lookdev_dir = dir + mtrl
                    lookdev_cate_arr = os.listdir(lookdev_dir)

                    for lookdev_cate in lookdev_cate_arr:
                        create_lookdev_cate = createDir + project + "/" + lookdev_cate
                        if not os.path.isdir(create_lookdev_cate):
                            os.mkdir(create_lookdev_cate)
                        dir_lookdev_cate = lookdev_dir + "/" + lookdev_cate
                        lookdev_asset_arr = os.listdir(dir_lookdev_cate)

                        for lookdev_asset in lookdev_asset_arr:
                            create_lookdev_asset = create_lookdev_cate + "/" + lookdev_asset
                            if not os.path.isdir(create_lookdev_asset):
                                os.mkdir(create_lookdev_asset)
                            dir_lookdev_asset = dir_lookdev_cate + "/" + lookdev_asset
                            lookdev_lod_arr = os.listdir(dir_lookdev_asset)

                            for lookdev_lod in lookdev_lod_arr:
                                dir_lookdev_lod = dir_lookdev_asset + "/" + lookdev_lod
                                if os.path.isdir(dir_lookdev_lod) == True: #Only lod folder
                                    create_lookdev_lod = create_lookdev_asset + "/" + lookdev_lod
                                    if not os.path.isdir(create_lookdev_lod):
                                        os.mkdir(create_lookdev_lod)
                                else:
                                    pass

                                lookdev_shader_arr = os.listdir(dir_lookdev_lod)
                                for lookdev_shader in lookdev_shader_arr:
                                    ext = ("*.json", "*.ma", "*.xml")
                                    if lookdev_shader == "shader":
                                        # pass
                                        dir_lookdev_shader = dir_lookdev_lod + "/shader"
                                        create_lookdev_fi = create_lookdev_lod + "/lookdev"
                                        if not os.path.isdir(create_lookdev_fi):
                                            os.mkdir(create_lookdev_fi)

                                        list = []

                                        for e in ext:
                                            list.extend(glob.glob(dir_lookdev_shader + "/" + e))
                                            print e

                                        for a in list:
                                            shutil.copy2(a,create_lookdev_fi)

                                    elif lookdev_shader == "vray":
                                        dir_lookdev_vray = dir_lookdev_lod + "/vray/shader"
                                        create_lookdev_vray = create_lookdev_lod + "/lookdev/vray"

                                        try:
                                            if not os.path.isdir(create_lookdev_vray):
                                                os.makedirs(create_lookdev_vray)
                                            else:
                                                pass
                                        except Exception, e:
                                            print e

                                        list2 = []

                                        for e in ext:
                                            list2.extend(glob.glob(dir_lookdev_vray + "/" + e))

                                        for a in list2:
                                            shutil.copy2(a,create_lookdev_vray)

                                    elif lookdev_shader == "arnold":
                                        dir_lookdev_arnold = dir_lookdev_lod + "/arnold/shader"
                                        create_lookdev_arnold= create_lookdev_lod + "/lookdev/arnold"

                                        try:

                                            if not os.path.isdir(create_lookdev_arnold):
                                                os.makedirs(create_lookdev_arnold)
                                            else:
                                                pass
                                        except Exception, e:
                                            print e

                                        list3 = []

                                        for e in ext:
                                            list3.extend(glob.glob(dir_lookdev_arnold + "/" + e))

                                        for a in list3:
                                            shutil.copy2(a, create_lookdev_arnold)

        except Exception, e:
            print e
            pass