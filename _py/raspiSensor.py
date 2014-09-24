from __future__ import division


raspiSensorDev = True

#Imports
if raspiSensorDev:
	from dev import MySQLdb
else:
	import MySQLdb
import time
import re



#
# Sensor Object
#
class raspiSensorDB:
    sensorID = 0
    sensorType = None
    dataRaw = 0
    dataRefined = 0
    
    def __init__(self, sensorID, sensorType):
        self.sensorID = sensorID
        self.sensorType = sensorType
        
    def read(self):
        return self.sensorType.read()
        

class raspiSensor:
    #
    # Init
    #
    def __init__(self, host, port, user, password, database):
        self.db = MySQLdb.connect(host=host, # your host, usually localhost
                     user=user, # your username
                      passwd=password, # your password
                      db=database) # name of the data base
        self.dbCur = self.db.cursor()


    #
    # Add Sensor
    #
    def addSensor(self, sensorID, sensorType):
        return raspiSensorDB( sensorID, sensorType )


    #
    # Read Sensor and push to MySQL
    #
    def readSensor(self, sensor):
        result = sensor.read()
        
        self.addSensorData( sensorID = sensor.sensorID, 
                    sensorType = sensor.sensorType.name,
                    dataRaw = result['dataRaw'],
                    dataRefined = result['dataRefined'])
        
        return result


    #
    # Add Entry to sensorData table
    #
    def addSensorData(self, sensorID, sensorType, dataRaw, dataRefined):
        timestamp = int(time.time())
        self.dbCur.execute("INSERT INTO sensorData (sensorID, sensorType, dataRaw, dataRefined, date) VALUES('" + str(sensorID) + "', '" + str(sensorType) + "', " + str(dataRaw) + ", " + str(dataRefined) + ", " + str(timestamp) + ")")
        self.db.commit()



    #
    # Output the last 10 entry from sensorData table
    #
    def last10Entrys(self):
        self.dbCur.execute("SELECT * FROM sensorData ORDER BY id DESC LIMIT 10")
        return self.dbCur.fetchall()
        
        
        
    def __del__(self):
		self.db.close()