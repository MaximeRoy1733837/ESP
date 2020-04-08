import time
import datetime
import paho.mqtt.publish as publish
import random
import sys

temperature = 24
humidite = 20
commande = input("Entrez le nom de la commande : ")
quantite = input("Entrez la quantite de bouchon a produire : ")
quantiteBon = 0
quantiteMauvais = 0
ifBloque = 0

try:
    while True:

        bloque = "non"
        temperature = random.randint(18, 25)
        humidite = random.randint(18, 25)
        quantiteBon = quantiteBon + 10
        quantiteMauvais = quantiteMauvais + 2
        ifBloque = random.randint(0, 5)
        if ifBloque == 3:
            bloque = "oui"

        publish.single("Mecanium/ESP/Temps", str(datetime.datetime.now()), hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Temperature", temperature, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Humidite", humidite, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Commande", commande, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Quantite", quantite, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Quantite_bon", quantiteBon, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Quantite_mauvais", quantiteMauvais, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Bloque", bloque, hostname="test.mosquitto.org")
        print("Done")

        time.sleep(6)

        if quantiteBon >= int(quantite):
            print("Terminer")
            sys.exit()

except KeyboardInterrupt:
    print("Cleanup")