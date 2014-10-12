#!/bin/bash

# Restartet das Netzwerk, wenn kein Ping mehr auf die Fritzbox möglich
# Hintergrund: Raspberry PI hat das WLAN nach Fritzboxausfall nicht mehr aufgebaut (Ursache nicht gesucht)

FritzBox='192.168.178.1'

ping -c 1 192.168.178.1 > /dev/null
if [ $? -ne 0 ]; then
    {
    echo "Raspberry Offline"
    #sudo reboot 
    sudo ifdown wlan0
    sleep 5
    sudo ifup --force wlan0
    #echo "kein /etc/init.d/networking restart"
    }
else
    {
    echo "Raspberry Online"
    #/etc/init.d/networking restart
    }
fi
