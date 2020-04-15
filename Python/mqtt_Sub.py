import paho.mqtt.client as mqtt
import mysql.connector
from datetime import datetime, date


def insert(add, data):
    connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
    cursor = connection.cursor(buffered=True)
    cursor.execute(add, data)
    connection.commit()
    cursor.close()
    connection.close()


def insertInfo(data_info):
    add_info = (
        "INSERT INTO `tbl_info` (`epoch`, `date`, `valeur_capteur`, `id_machine`, `id_capteur`, `id_commande`)"
        " VALUES (%s, %s, %s, %s, %s, %s)")
    insert(add_info, data_info)


def insertHistory(dataHistory):
    add_history = (
        "INSERT INTO `tbl_historique` (`date_historique`, `valeur_capteur`, `id_machine`, `id_capteur`, `id_commande`)"
        " VALUES (%s, %s, %s, %s, %s)")
    insert(add_history, dataHistory)


def insertEvent(dataEvent):
    add_event = (
        "INSERT INTO `tbl_evenement` (`date_evenement`, `id_machine`, `id_type_evenement`)"
        " VALUES (%s, %s, %s)")
    insert(add_event, dataEvent)


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
        data_info = (0, dataArray[0], dataArray[2], 1, 1, dataArray[1])
        insertInfo(data_info)

    elif msg.topic == "Mecanium/ESP/Humidite":
        data_info = (0, dataArray[0], dataArray[3], 1, 2, dataArray[1])
        insertInfo(data_info)

    elif msg.topic == "Mecanium/ESP/Quantite_bon":
        data_info = (0, dataArray[0], dataArray[4], 1, 3, dataArray[1])
        insertInfo(data_info)

    elif msg.topic == "Mecanium/ESP/Quantite_mauvais":
        data_info = (0, dataArray[0], dataArray[5], 1, 4, dataArray[1])
        insertInfo(data_info)
        dataArray.clear()


client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("test.mosquitto.org", 1883, 60)

client.loop_forever()
