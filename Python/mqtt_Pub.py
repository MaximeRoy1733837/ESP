import time
import datetime
import paho.mqtt.publish as publish
import random
import sys


def faireCommande():
    commande = input("Entrez le nom de la commande : ")
    quantite = input("Entrez la quantite de bouchon a produire : ")

    temperature = 24
    humidite = 20
    quantiteBon = 0
    quantiteMauvais = 0
    bloque = 0

    try:
        while True:

            temperature = random.randint(18, 25)
            humidite = random.randint(18, 25)
            quantiteBon = quantiteBon + random.randint(5, 15)
            quantiteMauvais = quantiteMauvais + random.randint(0, 8)
            bloque = random.randint(0, 20)

            publish.single("Mecanium/ESP/Temps", str(datetime.datetime.now()), hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Nom_commande", commande, hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Quantite_commande", quantite, hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Temperature", temperature, hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Humidite", humidite, hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Quantite_bon", quantiteBon, hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Quantite_mauvais", quantiteMauvais, hostname="test.mosquitto.org")
            publish.single("Mecanium/ESP/Bloque", bloque, hostname="test.mosquitto.org")
            print("Done")

            time.sleep(6)

            if quantiteBon >= int(quantite):
                print("Terminer")
                encore = input("Voulez-vous faire une autre commande? (oui ou non): ")
                if encore == "oui":
                    faireCommande()
                else:
                    sys.exit()

    except KeyboardInterrupt:
        print("Cleanup")


faireCommande()