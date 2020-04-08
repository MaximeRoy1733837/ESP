import paho.mqtt.client as mqtt
import mysql.connector
from datetime import datetime, date

add_info = ("INSERT INTO `tbl_info` (`epoch`, `nom_commande`, `date`, `quantite_produite`, `temperature`, `humidite`, `quantite_bon`, `quantite_mauvais`, `bloque`)" 
		    " VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)")

add_history = ("INSERT INTO `tbl_historique` (`nom_commande`, `date_historique`, `quantite_produite`, `temperature`, `humidite`, `quantite_bon`, `quantite_mauvais`)"
		    " VALUES (%s, %s, %s, %s, %s, %s, %s)")

dataArray = []

def on_connect(client, userdata, flags, rc):
    #print("Connected with result code " + str(rc))
    print("Connecté sans erreur.")
    client.subscribe("Mecanium/ESP/Temps")
    client.subscribe("Mecanium/ESP/Temperature")
    client.subscribe("Mecanium/ESP/Humidite")
    client.subscribe("Mecanium/ESP/Commande")
    client.subscribe("Mecanium/ESP/Quantite")
    client.subscribe("Mecanium/ESP/Quantite_bon")
    client.subscribe("Mecanium/ESP/Quantite_mauvais")
    client.subscribe("Mecanium/ESP/Bloque")

def on_message(client, userdata, msg):
    dataArray.clear()
    print(msg.topic + " " + str(msg.payload.decode("utf-8")))

    dataArray.append(str(msg.payload.decode("utf-8")))

    if msg.topic == "Mecanium/ESP/Bloque":
        #humidite = str(msg.payload.decode("utf-8"))
        mgsDate = str(datetime.fromtimestamp(float(dataArray[0])))
        data = (dataArray[0], dataArray[3], mgsDate, dataArray[4], dataArray[1], dataArray[2], dataArray[5], dataArray[6], dataArray[7])
        connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
        cursor = connection.cursor(buffered=True)
        cursor.execute(add_info, data)
        connection.commit()
        cursor.close()
        connection.close()

    if msg.topic == "Mecanium/ESP/Bloque" and dataArray[5] >= dataArray[4]:
        print("Terminer")
        mgsDate1 = str(datetime.fromtimestamp(float(dataArray[0])))
        dataHistory = (dataArray[3], mgsDate1, dataArray[4], dataArray[1], dataArray[2], dataArray[5], dataArray[6])
        connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
        cursor = connection.cursor(buffered=True)
        cursor.execute(add_history, dataHistory)
        connection.commit()
        cursor.close()
        connection.close()

    dataArray.clear()

client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("test.mosquitto.org", 1883, 60)

client.loop_forever()
