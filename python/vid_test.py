import os
import sys
import shutil
import uuid

sys.path.append("/usr/lib/python2.7/site-packages/")

try:
    from ffmpy import FFmpeg
except:
    print "no module named ffmpy"

mov = "/home/crystal/MG/asset/thumnail/mov/dst_pr_neckbomb_outside_md_lookdev_precomp_v001.mov"

ff = FFmpeg(
    inputs = {'%s'%(mov) : None},
    outputs = {'%s'%(result) : '-c:v h264 -c:a ac3'}
)
ff.run()