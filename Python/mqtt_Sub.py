import paho.mqtt.client as mqtt
import mysql.connector
from datetime import datetime, date

add_commande = (
        "INSERT INTO `tbl_commande` (`nom_commande`, `quantite_a_produire`)"
        " VALUES (%s, %s)")


def insert(add, data):
    connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
    cursor = connection.cursor(buffered=True)
    cursor.execute(add, data)
    #fonction arrête ici: ne s'ajout pas dans la bd
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
    client.subscribe("Mecanium/ESP/Nom_commande")
    client.subscribe("Mecanium/ESP/Quantite_commande")
    client.subscribe("Mecanium/ESP/Temperature")
    client.subscribe("Mecanium/ESP/Humidite")
    client.subscribe("Mecanium/ESP/Quantite_bon")
    client.subscribe("Mecanium/ESP/Quantite_mauvais")
    #client.subscribe("Mecanium/ESP/Bloque")


def on_message(client, userdata, msg):
    print(msg.topic + " " + str(msg.payload.decode("utf-8")))

    dataArray.append(str(msg.payload.decode("utf-8")))

    commande = 0
    id_commande = 0

    #commande marche pas: la commande sajout plein de fois
    #id_commande marche pas: reste toujours a 0

    if msg.topic == "Mecanium/ESP/Quantite_commande" and commande != 1:
        dataCommande = (dataArray[1], dataArray[2])
        connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
        cursor = connection.cursor(buffered=True)
        cursor.execute(add_commande, dataCommande)
        id_commande = cursor.lastrowid
        connection.commit()
        cursor.close()
        connection.close()
        commande = 1

    if msg.topic == "Mecanium/ESP/Temperature":
        #mgsDate = str(datetime.fromtimestamp(float(dataArray[0])))
        data_info = (0, dataArray[0], dataArray[3], 1, 1, id_commande)
        insertInfo(data_info)

    elif msg.topic == "Mecanium/ESP/Humidite":
        data_info = (0, dataArray[0], dataArray[4], 1, 2, id_commande)
        insertInfo(data_info)

    elif msg.topic == "Mecanium/ESP/Quantite_bon":
        data_info = (0, dataArray[0], dataArray[5], 1, 3, id_commande)
        insertInfo(data_info)

    elif msg.topic == "Mecanium/ESP/Quantite_mauvais":
        data_info = (0, dataArray[0], dataArray[6], 1, 4, id_commande)
        insertInfo(data_info)

        if int(dataArray[5]) >= int(dataArray[2]):
            cpt = 1
            while cpt <= 4:
                if cpt == 1:
                    dataHistory = (dataArray[0], dataArray[3], 1, cpt, id_commande)
                elif cpt == 2:
                    dataHistory = (dataArray[0], dataArray[4], 1, cpt, id_commande)
                elif cpt == 3:
                    dataHistory = (dataArray[0], dataArray[5], 1, cpt, id_commande)
                elif cpt == 4:
                    dataHistory = (dataArray[0], dataArray[6], 1, cpt, id_commande)

                insertHistory(dataHistory)
                commande = 0
                cpt = cpt + 1

        dataArray.clear()


client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("test.mosquitto.org", 1883, 60)

client.loop_forever()
