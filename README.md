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
 * WiringPi (http://wiringpi.com/download-and-install/)
 * <code>w1-gpio</code> and <code>w1-therm</code> always enabled (http://www.raspberrypi.org/forums/viewtopic.php?t=35508&p=300363#p299548)

 
###Tutorials
 * MCP3008 + Moisture Sensor (http://computers.tutsplus.com/tutorials/build-a-raspberry-pi-moisture-sensor-to-monitor-your-plants--mac-52875)
 * 1-Wire Temprature Sensor (https://learn.adafruit.com/adafruits-raspberry-pi-lesson-11-ds18b20-temperature-sensing/hardware)
 * Webcam with fswebcam (http://www.raspberrypi.org/documentation/usage/webcams/)


###Updates
For the first time i will change everything witout a comment. If you update your code it is possible you must reconfigure raspiSensor.


###Screenshots
![](https://github.com/DevertNet/RaspiSensor/blob/master/img/screenshots/1.jpg)
![](https://github.com/DevertNet/RaspiSensor/blob/master/img/screenshots/2.jpg)

###Install
1. Install / Configureate all requirements (above)
2. Copy all files in your http-dir. For Apache and Lighttpd: <code>/var/www</code>
3. Create a MySQL Databse and import the default table from <code>/var/www/_db/tabledb.sql</code>
4. Change the mysql login/passwort in <code>/var/www/_py/config.json</code>
5. Create a cronjob (every 5 minutes) for the logger <code>/var/www/_py/sensor.py</code>
6. edit <code>sudo nano /var/www/_raspberry-remote/send.cpp</code>. On line 17 you must change the PIN number (see http://wiringpi.com/pins/)
7. Now run this command: <code>cd /var/www/_raspberry-remote</code> then <code>make send</code>
8. Make modul config editable: <code>sudo chmod 777 /var/www/_py/config.moduls.json</code>


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
			"name": "moisture1",
			"displayName": "Erdf.",
			"type": "mcp3008",
			"arguments": {
					"channel": 0,
					"minDataRaw": 0,
					"maxDataRaw": 1023,
					"dataRefinedInvert": 1
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


###Configurate Dashboard
Open the <code>index.php</code> with your browser and click on "Config". You can change the order with Drag&Drop.


###Sensor Types
MCP3008 (AD Converter, 8 Channels)
Normaly the mcp3008 outputs a value from 0 to 1023, but some sensors have a other minimum and maximum. As example a moiture sensor has the minimum at 470 and the maximum at 1023.
470 means the soil es very wet and 1023 is dry.
If the sensor outputs a value of 500 (wet):
500 / (1023/100) = 48% (wrong)
(500-470) / ( (1023 - 470) / 100 ) = 5.42% (correct, but we need 94.58%, so we invert the result with: 100-5.42 = 94.58%)
```json
"name": "moisture1",
"displayName": "Erdf.",
"type": "mcp3008",
"arguments": {
		"channel": 0,
		"minDataRaw": 0,
		"maxDataRaw": 1023,
		"dataRefinedInvert": 1
}
```

1-Wire Temprature Sensor (tested with DS18S20)
```json
"name": "temp1",
"displayName": "Temp.",
"type": "ds18s20",
"arguments": {
		"dirname": "10-000802292070"
}
```
Replace <code>10-000802292070</code> with your sensor name. You list all connected 1-wire sensors with this command: <code>dir /sys/bus/w1/devices/</code>


###Webcam
To display a webcam picture on the dashboard you need to save the captured image in your http-dir (e.g. <code>/var/www/test.jpg</code>). In the config of the webcamModul you must set the <code>Image Source</code> to <code>test.jpg</code> or any other URL of an webcam-image which is reachable over the internet.
Personaly i use fswebcam to capture every 5 seconds a image of my home.


###Credits
Raspberry-Remote (https://github.com/xkonni/raspberry-remote)
RC-Switch (https://github.com/r10r/rcswitch-pi)

###Todo
 * Installer
 * Manage Sensors over Dashboard
 * Configurate how many days/hours in the chart will displayed