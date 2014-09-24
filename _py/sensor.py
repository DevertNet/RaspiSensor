import json
import os
from raspiSensor import raspiSensor
import sensors


script_dir = os.path.dirname(__file__) #<-- absolute dir the script is in

json_data=open( os.path.join(script_dir, "config.json") )
config = json.load(json_data)
json_data.close()


rs = raspiSensor( host = config['mysql']['host'],
				 port = config['mysql']['port'],
				 user = config['mysql']['user'],
				 password = config['mysql']['password'],
				 database = config['mysql']['database'] )

for sensor in config['sensors']:
	#Get the sensor class by string
	sensorClassRaw = getattr(sensors, sensor['type'])
	sensorClass = sensorClassRaw()
	
	#pass arguments to the instance of the sensor
	for key, value in sensor['arguments'].iteritems():
		setattr(sensorClass, key, value)
	
	#read the value
	test = rs.addSensor(sensorID = sensor['name'], 
                    sensorType = sensorClass
                    )

	result = rs.readSensor( test )
	print result



