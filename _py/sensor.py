#!/usr/bin/python
import raspiSensor


rs = raspiSensor.raspiSensor( )

test = rs.addSensor(sensorID = 'moisture1', 
                    sensorType = raspiSensor.sensorMCP3008( channel = 0 )
                    )

result = rs.readSensor( test )
print result



termo = rs.addSensor(sensorID = 'temp1', 
                    sensorType = raspiSensor.sensorDS18S20( dirname = '10-000802292070' )
                    )

result = rs.readSensor( termo )
print result



# Debug
print "Last 10 Entrys:"
for row in rs.last10Entrys() :
    print row


