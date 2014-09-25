RaspiSensor
===========

Another Control Panel / Dashboard for the Raspberry Pi with sensors.


Supported Sensors:

 * mcp3008 (AD Converter, 8 Channels)
 * Moisture Sensor (with mcp3008)
 * 1-Wire Temprature Sensor (tested with DS18S20)
 * 433mhz transmitter
 * Webcam
 
###Requirements
 * Python 2.7 (pre-installed)
 * MySQL (http://www.ducky-pond.com/posts/2014/Feb/how-to-install-and-optimize-mysql-on-raspberry-pi/)
 * Python Dev (<code>sudo apt-get install python-dev</code>)
 * Python MySQLdb (<code>sudo apt-get install python-mysqldb</code>)
 * <code>w1-gpio</code> and <code>w1-therm</code> enabled (http://www.raspberrypi.org/forums/viewtopic.php?t=35508&p=300363#p299548)
 
###Tutorials
 * MCP3008 + Moisture Sensor (http://computers.tutsplus.com/tutorials/build-a-raspberry-pi-moisture-sensor-to-monitor-your-plants--mac-52875)
 * 1-Wire Temprature Sensor (https://learn.adafruit.com/adafruits-raspberry-pi-lesson-11-ds18b20-temperature-sensing/hardware)

###Updates
For the first time i will change everything witout a comment. If you update your code it is possible you must reconfigure raspiSensor.

###Screenshots
![](https://github.com/DevertNet/RaspiSensor/blob/master/img/screenshots/1.jpg)
![](https://github.com/DevertNet/RaspiSensor/blob/master/img/screenshots/2.jpg)

###Install
1. Create a MySQL Databse and import the default table from <code>_db/tabledb.sql</code>
2. Change the mysql login/passwort in <code>_py/config.json</code>
3. Create a cronjob (every 5 minutes) for the looger <code>_py/sensor.py</code>


###Create new Sensor
To create a new sensor edit <code>_py/config.json</code>. You can find the avaible sensor types in the next section ;)
```json
{
    "mysql": {
		"host": "127.0.0.1",
		"port": "3306",
		"user": "root",
		"password": "root",
		"database": "rpi"
	},
	
	"sensors": [
		{
			"name": "test1",
			"displayName": "Test 1",
			"type": "mcp3008",
			"arguments": {
					"channel": 5
			}
		},
		{
			"name": "test2",
			"displayName": "Test 2",
			"type": "ds18s20",
			"arguments": {
					"dirname": "10-000802292070"
			}
			
		}
	]
}
```

edit <code>index.php</code>. Use the <code>name</code> from <code>config.json</code>
```php
<div id="chart_test1_last7days" style="width: 100%; height: 300px;"></div>
<div id="chart_test1_last24hours" style="width: 100%; height: 300px;"></div>
<div id="chart_test1_current" style="width: 100%; height: 300px;"></div>
```


###Sensor Types
MCP3008 (AD Converter, 8 Channels)
```json
"type": "mcp3008",
"arguments": {
		"channel": 5
}
```

1-Wire Temprature Sensor (tested with DS18S20)
```json
"type": "ds18s20",
"arguments": {
		"dirname": "10-000802292070"
}
```
Replace <code>10-000802292070</code> with your sensor name. You list all connected 1-wire sensors with this command: <code>dir /sys/bus/w1/devices/</code>