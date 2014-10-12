#!/bin/bash

# Webcam Logitech C170
# -S = Skip Frames
# -F = Capture Frames
# -r = Resolution
# -b = BackgroundMode
# -l = Loop Mode, take every x seconds a pic
# --jpeg = JPG Quality
# --exec "" = Do Something
# sudo fswebcam -S 50 -F 1 -r 1024x768 --jpeg 80 --exec "sudo cp /var/www/test.jpg /var/www/camlog/cam_%s.jpg" /var/www/test.jpg

if ! pgrep fswebcam >/dev/null;then (
 echo "fswebcam cont run: restart it!"
 #sudo fswebcam -b -l 10 -S 50 -F 1 -r 1024x768 --timestamp "%Y-%m-%d %H:%M:%S (%Z)"  --jpeg 80 --exec "sudo cp /var/www/test.jpg /var/www/camlog/cam_%s.jpg" /var/www/test.jpg
 sudo fswebcam -b -l 5 -S 50 -F 1 -r 320x240 --timestamp "%Y-%m-%d %H:%M:%S (%Z)"  --jpeg 60 /var/www/test.jpg
);fi
