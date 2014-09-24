class baaar:
	close = "asd"
	cursor = None
	#
	# Init
	#
	def __init__(self):
		pass

	def execute(self, das):
		pass


class fuubar:
	close = "asd"
	cursor = None
	#
	# Init
	#
	def __init__(self):
		pass

	def close(self):
		pass
	
	def cursor(self):
		return baaar()
	
	def commit(self):
		return baaar()
	
	def execute(self):
		pass
	
	
def connect(host, user, passwd, db):
	return fuubar()