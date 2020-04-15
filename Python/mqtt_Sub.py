import paho.mqtt.client as mqtt
import mysql.connector
from datetime import datetime, date


def ajoutBD(data):
    add_info = (
        "INSERT INTO `tbl_info` (`epoch`, `date`, `valeur_capteur`, `id_machine`, `id_capteur`, `id_commande`)"
        " VALUES (%s, %s, %s, %s, %s, %s)")
    connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
    cursor = connection.cursor(buffered=True)
    cursor.execute(add_info, data)
    connection.commit()
    cursor.close()
    connection.close()


dataArray = []


def on_connect(client, userdata, flags, rc):
    # print("Connected with result code " + str(rc))
    print("Connecté sans erreur.")
    client.subscribe("Mecanium/ESP/Temps")
    client.subscribe("Mecanium/ESP/Commande")
    client.subscribe("Mecanium/ESP/Temperature")
    client.subscribe("Mecanium/ESP/Humidite")
    client.subscribe("Mecanium/ESP/Quantite_bon")
    client.subscribe("Mecanium/ESP/Quantite_mauvais")
    #client.subscribe("Mecanium/ESP/Bloque")


def on_message(client, userdata, msg):
    print(msg.topic + " " + str(msg.payload.decode("utf-8")))

    dataArray.append(str(msg.payload.decode("utf-8")))

    if msg.topic == "Mecanium/ESP/Temperature":
        #mgsDate = str(datetime.fromtimestamp(float(dataArray[0])))
        data = (0, dataArray[0], dataArray[2], 1, 1, dataArray[1])
        ajoutBD(data)

    elif msg.topic == "Mecanium/ESP/Humidite":
        data = (0, dataArray[0], dataArray[3], 1, 2, dataArray[1])
        ajoutBD(data)

    elif msg.topic == "Mecanium/ESP/Quantite_bon":
        data = (0, dataArray[0], dataArray[4], 1, 3, dataArray[1])
        ajoutBD(data)

    elif msg.topic == "Mecanium/ESP/Quantite_mauvais":
        data = (0, dataArray[0], dataArray[5], 1, 4, dataArray[1])
        ajoutBD(data)
        dataArray.clear()


client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("test.mosquitto.org", 1883, 60)

client.loop_forever()
