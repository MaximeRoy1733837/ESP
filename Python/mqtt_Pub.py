import time
import datetime
import paho.mqtt.publish as publish
import random
import sys
import mysql.connector


add_commande = (
    "INSERT INTO `tbl_commande` (`nom_commande`, `quantite_a_produire`)"
    " VALUES (%s, %s)")

commande = input("Entrez le nom de la commande : ")
quantite = input("Entrez la quantite de bouchon a produire : ")
id_commande = 0

dataCommande = (commande, quantite)
connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
cursor = connection.cursor(buffered=True)
cursor.execute(add_commande, dataCommande)
id_commande = cursor.lastrowid
connection.commit()
cursor.close()
connection.close()

temperature = 24
humidite = 20
quantiteBon = 0
quantiteMauvais = 0
ifBloque = 0

try:
    while True:

        bloque = 0
        temperature = random.randint(18, 25)
        humidite = random.randint(18, 25)
        quantiteBon = quantiteBon + random.randint(5, 15)
        quantiteMauvais = quantiteMauvais + random.randint(0, 8)
        ifBloque = random.randint(0, 5)
        if ifBloque == 3:
            bloque = 1

        publish.single("Mecanium/ESP/Temps", str(datetime.datetime.now()), hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Commande", id_commande, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Temperature", temperature, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Humidite", humidite, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Quantite_bon", quantiteBon, hostname="test.mosquitto.org")
        publish.single("Mecanium/ESP/Quantite_mauvais", quantiteMauvais, hostname="test.mosquitto.org")
        #publish.single("Mecanium/ESP/Bloque", bloque, hostname="test.mosquitto.org")
        print("Done")

        time.sleep(6)

        if quantiteBon >= int(quantite):
            print("Terminer")
            cpt = 1
            while cpt <= 4:
                if cpt == 1:
                    dataHistory = (str(datetime.datetime.now()), temperature, 1, cpt, id_commande)
                elif cpt == 2:
                    dataHistory = (str(datetime.datetime.now()), humidite, 1, cpt, id_commande)
                elif cpt == 3:
                    dataHistory = (str(datetime.datetime.now()), quantiteBon, 1, cpt, id_commande)
                elif cpt == 4:
                    dataHistory = (str(datetime.datetime.now()), quantiteMauvais, 1, cpt, id_commande)

                insertHistory(dataHistory)
                cpt = cpt + 1
            sys.exit()

except KeyboardInterrupt:
    print("Cleanup")