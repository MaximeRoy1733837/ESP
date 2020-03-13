import paho.mqtt.client as mqtt
import mysql.connector
from datetime import datetime, date

add_info = ("INSERT INTO `tbl_info` (`epoch`, `nom_commande`, `date`, `quantite_produite`, `temperature`, `humidite`, `quantite_bon`, `quantite_mauvais`)" 
		    " VALUES (%s, %s, %s, %s, %s, %s, %s, %s)")

dataArray = []

def on_connect(client, userdata, flags, rc):
    print("Connected with result code " + str(rc))
    client.subscribe("Mecanium/ESP/Temps")
    client.subscribe("Mecanium/ESP/Temperature")
    client.subscribe("Mecanium/ESP/Humidite")


def on_message(client, userdata, msg):
    print(msg.topic + " " + str(msg.payload.decode("utf-8")))

    #if msg.topic == "Mecanium/ESP/Temps":
        #dataArray.append(str(msg.payload.decode("utf-8")))

    #if msg.topic == "Mecanium/ESP/Temperature":
        #dataArray.append(str(msg.payload.decode("utf-8")))

    dataArray.append(str(msg.payload.decode("utf-8")))

    if msg.topic == "Mecanium/ESP/Humidite":
        #humidite = str(msg.payload.decode("utf-8"))
        mgsDate = str(datetime.fromtimestamp(float(dataArray[0])))
        data = (dataArray[0], "test2", mgsDate, "0", dataArray[1], dataArray[2], "0", "0")
        connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
        cursor = connection.cursor(buffered=True)
        cursor.execute(add_info, data)
        connection.commit()
        cursor.close()
        connection.close()
        print(mgsDate)
        dataArray.clear()




client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("test.mosquitto.org", 1883, 60)


client.loop_forever()
