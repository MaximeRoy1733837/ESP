import RPi.GPIO as GPIO
import dht11
import time
import datetime
import paho.mqtt.publish as publish

GPIO.setwarnings(True)
GPIO.setmode(GPIO.BCM)

instance = dht11.DHT11(pin=18)

try:
    while True:
        result = instance.read()
        if result.is_valid():

            publish.single("Mecanium/ESP/Temps", str(datetime.datetime.now()), hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Temperature", result.temperature, hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Humidite", result.humidity, hostname="test.mosquitto.org")
            print("Done")

        time.sleep(6)

except KeyboardInterrupt:
    print("Cleanup")
    GPIO.cleanup()