class mcp3008:
    name = "mcp3008"
    channel = 0
	minDataRaw = 0
	maxDataRaw = 1023
	dataRefinedInvert = 0
    
    def __init__(self):
        from dev import spidev
        self.spi = spidev.SpiDev()
        self.spi.open(0,1)

    def read(self):
        if ((self.channel > 7) or (self.channel < 0)):
            return -1
        r = self.spi.xfer2([1,(8+self.channel)<<4,0])
        adcout = ((r[1]&3) << 8) + r[2]
        
        dataRaw = adcout - minDataRaw
        dataRefined = round( dataRaw / ( (maxDataRaw-minDataRaw) / 100), 2 )
		
		if ( int(dataRefinedInvert) == 1)
			dataRefined = 100 - dataRefined
		
        return { "dataRaw":dataRaw, "dataRefined":dataRefined }