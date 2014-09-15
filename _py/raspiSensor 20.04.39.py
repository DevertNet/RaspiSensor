from __future__ import division
import MySQLdb
import time
import re

raspiSensorDev = False

#
# MCP3008
#
class sensorMCP3008:
    name = "mcp3008"
    channel = 0
    
    def __init__(self, channel):
        if raspiSensorDev:
            from dev import spidev
        else:
            import spidev
        self.spi = spidev.SpiDev()
        self.spi.open(0,1)
        
        self.channel = channel

    def read(self):
        if ((self.channel > 7) or (self.channel < 0)):
            return -1
        r = self.spi.xfer2([1,(8+self.channel)<<4,0])
        adcout = ((r[1]&3) << 8) + r[2]
        
        dataRaw = adcout
        dataRefined = round( dataRaw / (1023 / 100), 2 )
        return { "dataRaw":dataRaw, "dataRefined":dataRefined }


#
# DS18S20
#
class sensorDS18S20:
    name = "ds18s20"
    dirname = 0
    
    def __init__(self, dirname):
        self.dirname = dirname

    def read(self):
        if raspiSensorDev:
            path = self.dirname
        else:
            path = "/sys/bus/w1/devices/"+self.dirname+"/w1_slave"
            
        with open (path, "r") as myfile:
            data=myfile.read().replace('\n', '')
        
        regex = re.compile(ur't=([0-9]{2,6})$')
        result = re.findall(regex, data)
        dataRaw = int(result[0])
        dataRefined = round( dataRaw / 1000, 2 )
        return { "dataRaw":dataRaw, "dataRefined":dataRefined }



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
    def __init__(self):
        self.db = MySQLdb.connect(host="0.0.0.0", # your host, usually localhost
                     user="root", # your username
                      passwd="167946", # your password
                      db="rpi") # name of the data base
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