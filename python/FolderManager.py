import sys
import os


# ------------------------
# Main Class
class FolderManager:
	def __init__(self):

		self.userName = os.getenv('USER')	# userName getting from environment value of OS
		self.serverName = "//iu"			# server name

		# version variables
		#	0 : asset
		#	1 : shot
		self.versions = [0, 0]

		# asset version variables
		#	0 : model	1 : texture		2 : Rigging		3 : Look-Dev
		self.verAsset = [
							[0, 0, 0, 0]
						]

		# shot version variables
		#	??? 
		self.verShot = ""

		# integration version variables
		self.verInt = 0

		# error message
		self.error = ""


	# -------- change server name
	def setServerName(self, sName): 
		self.serverName = "//" + sName

	# -------- make directory
	def makeDir(self, path) :
		dirTokenList = path.split('/')

		flag = 0
		updated = 0
		baseDir = self.serverName+'/project/'
		for dirToken in dirTokenList:
			if flag == 1 :
				baseDir += dirToken
				if os.path.isdir(baseDir) == False :					
					os.mkdir(baseDir)
					updated = 1
				baseDir += '/'

			if dirToken == "project" :
				flag = 1

		return updated



	# ---------------- For Asset Part ----------------

	# -------- get path related on asset
	#	prj : project name
	#	cat : category name
	#	asset : asset name
	#	task : task name
	#	ver : (development/publish) version(0 : return the path right before version)
	#	step : pipeline step name
	#	mode : 0 - development, >=1 - publish
	def getPathAsset(self, prj, cat, asset, task, ver, step, mode) :
		self.error = ""

		# -- varifying parameters
		if prj == "" :
			self.error = "There's no project name."
			return ""
		elif cat == "" :
			self.error = "There's no category name."
			return ""
		elif asset == "" :
			self.error = "There's no asset name."
			return ""
		elif task == "" :
			self.error = "There's no task name."
			return ""
		elif ver < 0 :
			self.error = "Wrong version number."
			return ""
		elif step == "" :
			self.error = "There's no pipeline step name."
			return ""
		elif mode < 0 :
			self.error = "Unrecognized mode."
			return ""

		# -- parse asset element & get path
		if step.lower().find("model") != -1 :
			return self.getPathModel(prj, cat, asset, task, ver, mode)	# in case of model
		elif step.lower().find("tex") != -1 :
			return self.getPathTex(prj, cat, asset, task, ver, mode) 	# in case of texture
		elif step.lower().find("rig") != -1 :
			return self.getPathRig(prj, cat, asset, task, ver, mode)	# in case of rigging
		elif step.lower().find("look") != -1 :
			return self.getPathLdev(prj, cat, asset, task, ver, mode)	# in case of look dev.
		else  :
			self.error = "Unrecognized task name."
			return "" # in case of error


	# -------- get path of the modeling	
	def getPathModel(self, prj, cat, asset, task, ver, mode) :

		# -- path version : 0
		if self.verAsset[self.versions[0]][0] == 0 :
			if len(task.split('_')) < 2 :
				self.error = "The task name deosn't have '_' meaning LOD."
				return ""

			basePath = self.serverName+'/project/'+prj
			if mode == 0 :	# -- in case of dev.
				if ver>0 :
					return (basePath+'/devl/model/'+cat+'/'+asset+'/'+task.split('_')[1]+'/v'+str(ver).zfill(2))
				else :
					return (basePath+'/devl/model/'+cat+'/'+asset+'/'+task.split('_')[1])
			else :			# -- in case of pub.
				if ver>0 :
					return (basePath+'/assets/model/'+cat+'/'+asset+'/'+task.split('_')[1]+'/v'+str(ver).zfill(2))
				else :
					return (basePath+'/assets/model/'+cat+'/'+asset+'/'+task.split('_')[1])
		
		# -- error : Unidentified model path version
		else :
			self.error = "Unidentified model path version"
			return ""


	# -------- get path of the texture
	def getPathTex(self, prj, cat, asset, task, ver, mode) :

		# -- path version : 0
		if self.verAsset[self.versions[0]][0] == 0 :
			if len(task.split('_')) < 2 :
				self.error = "The task name deosn't have '_' meaning LOD."
				return ""

			basePath = self.serverName+'/project/'+prj
			if mode == 0 :	# -- in case of dev.
				if ver>0 :
					return (basePath+'/devl/texture/'+cat+'/'+asset+'/'+task.split('_')[1]+'/v'+str(ver).zfill(2))
				else :
					return (basePath+'/devl/texture/'+cat+'/'+asset+'/'+task.split('_')[1])
			else :			# -- in case of pub.
				if ver>0 :
					return (basePath+'/assets/texture/'+cat+'/'+asset+'/'+task.split('_')[1]+'/v'+str(ver).zfill(2))
				else :
					return (basePath+'/assets/texture/'+cat+'/'+asset+'/'+task.split('_')[1])
		
		# -- error : Unidentified model path version
		else :
			self.error = "Unidentified texture path version"
			return ""


	# -------- get path of the rigging
	def getPathRig(self, prj, cat, asset, task, ver, mode) :

		# -- path version : 0
		if self.verAsset[self.versions[0]][0] == 0 :
			if len(task.split('_')) < 2 :
				self.error = "The task name deosn't have '_' meaning LOD."
				return ""

			basePath = self.serverName+'/project/'+prj
			if mode == 0 :	# -- in case of dev.
				if ver>0 :
					return (basePath+'/devl/rigging/'+cat+'/'+asset+'/'+task.split('_')[1]+'/v'+str(ver).zfill(2))
				else :
					return (basePath+'/devl/rigging/'+cat+'/'+asset+'/'+task.split('_')[1])
			else :			# -- in case of pub.
				if ver>0 :
					return (basePath+'/assets/rigging/'+cat+'/'+asset+'/'+task.split('_')[1]+'/v'+str(ver).zfill(2))
				else :
					return (basePath+'/assets/rigging/'+cat+'/'+asset+'/'+task.split('_')[1])
		
		# -- error : Unidentified model path version
		else :
			self.error = "Unidentified rigging path version"
			return ""


	# -------- get path of the look-dev. (ignore the version)
	def getPathLdev(self, prj, cat, asset, task, ver, mode) :

		# -- path version : 0
		if self.verAsset[self.versions[0]][0] == 0 :
			if len(task.split('_')) < 2 :
				self.error = "The task name deosn't have '_' meaning LOD."
				return ""

			basePath = self.serverName+'/project/'+prj
			if mode == 0 :	# -- in case of dev.
				return (basePath+'/devl/lookdev/devl/'+cat+'/'+asset+'/'+task.split('_')[1])
			else :			# -- in case of pub.
				return (basePath+'/assets/lookdev/'+cat+'/'+asset+'/'+task.split('_')[1])
		
		# -- error : Unidentified model path version
		else :
			self.error = "Unidentified look-dev. path version"
			return ""


	# -------- get path of the integration(ph, scan, track, mm, bglayout)
	#	...
	#	mode : 0 - development, 1 - publish(including model pub.), >1 (scan) texture publish
	def getPathInt(self, prj, catSq, assShot, task, mode) :

		# -- path version : 0
		if self.verInt == 0 :

			basePath = self.serverName+'/project/'+prj
			if task.find("ph")>=0 or task.find("scan")>=0 :	# -- in case of asset mode
				if mode == 0 :		# -- in case of dev.
					return (basePath+'/devl/integration/'+self.userName)
				elif mode == 1 :	# -- in case of model pub.
					return (basePath+'/assets/model/'+catSq+'/'+assShot+'/scan')
				else :				# -- in case of texture pub.
					return (basePath+'/assets/texture/'+catSq+'/'+assShot+'/scan')
			else :			# -- in case of shot mode
				if mode == 0 :		# -- in case of dev.
					return (basePath+'/sq/'+catSq+'/'+assShot+'/tracking/devl/'+self.userName)
				else :				# -- in case of pub.
					return (basePath+'/sq/'+catSq+'/'+assShot+'/tracking/pub')
		
		# -- error : Unidentified model path version
		else :
			self.error = "Unidentified integration path version"
			return ""

