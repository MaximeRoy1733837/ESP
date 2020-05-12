import time
import datetime
import paho.mqtt.publish as publish
import random
import sys

print("Bienvenue dans la simulation du Siemens S7-1200")
print(" ")


def publishInfo(epoch, commande, quantite, temperature, humidite, quantiteBon, quantiteMauvais, bloque):
    publish.single("Mecanium/ESP/Epoch", epoch, hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})

    publish.single("Mecanium/ESP/Temps", datetime.datetime.now().strftime("%x %X"), hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})

    publish.single("Mecanium/ESP/Nom_commande", commande, hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})

    publish.single("Mecanium/ESP/Quantite_commande", quantite, hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})

    publish.single("Mecanium/ESP/Temperature", temperature, hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})

    publish.single("Mecanium/ESP/Humidite", humidite, hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})

    publish.single("Mecanium/ESP/Quantite_bon", quantiteBon, hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})

    publish.single("Mecanium/ESP/Quantite_mauvais", quantiteMauvais, hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})

    publish.single("Mecanium/ESP/Bloque", bloque, hostname="192.168.56.56",
                   auth={'username': "esp", 'password': "esp2020"})
    #print("Done")
    time.sleep(6)


def faireCommande():
    commande = input("Entrez le nom de la commande : ")
    quantite = input("Entrez la quantite de bouchon a produire : ")

    print("La commande est en cour...")

    quantiteBon = 0
    quantiteMauvais = 0

    try:
        while True:

            temperature = random.randint(18, 25)
            humidite = random.randint(18, 25)
            quantiteBon = quantiteBon + random.randint(5, 15)
            quantiteMauvais = quantiteMauvais + random.randint(0, 8)
            bloque = random.randint(0, 20)
            epoch = datetime.datetime.now().timestamp()

            if quantiteBon > int(quantite):
                quantiteBon = int(quantite)

            publishInfo(epoch, commande, quantite, temperature, humidite, quantiteBon, quantiteMauvais, bloque)

            if bloque == 5 or bloque == 10 or bloque == 15:
                arret = input("La machine c'est arrete, taper 'ok' pour continuer ou 'non' pour quitter : ")
                if arret == "ok":
                    print("La commande est en cour...")
                else:
                    sys.exit()

            if quantiteBon == int(quantite):
                print("Terminer")
                encore = input("Voulez-vous faire une autre commande? (oui ou non): ")
                if encore == "oui":
                    faireCommande()
                else:
                    sys.exit()

    except KeyboardInterrupt:
        print("Cleanup")


faireCommande()
