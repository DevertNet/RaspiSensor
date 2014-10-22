import re

class ds18s20:
    name = "ds18s20"
    dirname = 0
    
    def __init__(self):
        pass

    def read(self):
        #path = self.dirname
        path = "/sys/bus/w1/devices/"+self.dirname+"/w1_slave"
            
        with open (path, "r") as myfile:
            data=myfile.read().replace('\n', '')
        
        regex = re.compile(ur't=([0-9]{2,6})$')
        result = re.findall(regex, data)
        dataRaw = float(result[0])
        dataRefined = round( dataRaw / 1000, 2 )
        return { "dataRaw":dataRaw, "dataRefined":dataRefined }