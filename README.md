RaspiSensor
===========

Another Control Panel / Dashboard for the Raspberry Pi with sensors.


Supported Sensors:

 * MCP3008 (AD Converter, 8 Channels)
 * 1-Wire Temprature Sensor (tested with DS18S20)
 * 433mhz transmitter
 * Webcam

###!!!Incomplete Docs!!!
This documentation is currently not complete, but it gives a experienced developer a hint how to use this tool. 
In the next weeks i want to create a simple installer and better docs for everyone!


###Screenshots
![](https://github.com/DevertNet/RaspiSensor/blob/master/img/screenshots/1.jpg)
![](https://github.com/DevertNet/RaspiSensor/blob/master/img/screenshots/2.jpg)

###Install
1. Create a MySQL Databse and import the default table from <code>_db/tabledb.sql</code>
2. Change the mysql login/passwort in <code>api_v2/inc/raspiSensor.php</code>
3. Change the mysql login/passwort in <code>_py/config.json</code>
4. Create a cronjob (every 5 minutes) for the looger <code>_py/sensor.py</code>


###Create new Sensor
To create a new sensor edit <code>_py/config.json</code>
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
			"type": "mcp3008",
			"arguments": {
					"channel": 5
			}
		},
		{
			"name": "test2",
			"type": "ds18s20",
			"arguments": {
					"dirname": "10-000802292070"
			}
			
		}
	]
}
```
Now edit <code>api_v2/inc/raspiSensor.php</code>:
```php
// replace "temp1" with the sensor name from the sensor.py
// replace "chart_temp_last7days" with a unqie name (will be used as html element id)
$outArray['lineChart'][] = array( 	"name" => "Temp.", 
	"data" => raspiSensorGetSensorDataLastDays($mysqli, 'temp1', 7), 
	"widget" => array("id"=>"chart_temp_last7days", "options"=>array())
);
```
edit <code>index.php</code>. Use the <code>id</code> from <code>raspiSensor.php</code>
```php
<div id="chart_temp_last7days" style="width: 100%; height: 300px;"></div>
```


###Python SensorTypes
MCP3008 (AD Converter, 8 Channels)
```python
raspiSensor.sensorMCP3008( channel = 0 )
```

1-Wire Temprature Sensor (tested with DS18S20)
```python
raspiSensor.sensorDS18S20( dirname = '10-000802292070'
```
Replace <code>10-000802292070</code> with your sensor name. You find all connected 1-wire sensors here: <code>/sys/bus/w1/devices/</code>