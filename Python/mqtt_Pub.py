import time
import datetime
import paho.mqtt.publish as publish

try:
    while True:

        publish.single("Mecanium/ESP/Temps", str(datetime.datetime.now()), hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Temperature", 24, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Humidite", 18, hostname="test.mosquitto.org")
        print("Done")

        time.sleep(6)

except KeyboardInterrupt:
    print("Cleanup")