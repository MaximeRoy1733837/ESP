import paho.mqtt.client as mqtt
import mysql.connector

connection = mysql.connector.connect(user='root', password='', host='localhost', database='bd_esp')
cursor = connection.cursor()

add_info = ("INSERT INTO tbl_info "
            "(date, nom_commande, quantite_produite, temperature, humidite, quantite_bon, quantite_mauvais)"
            "VALUES (%s, %s, %s, %s, %s, %s, %s)")


def on_connect(client, userdata, flags, rc):
    print("Connected with result code " + str(rc))
    client.subscribe("Temps")
    client.subscribe("Temperature")
    client.subscribe("Humidite")

def on_message(client, userdata, msg):
    print(msg.topic + " " + str(msg.payload))

    if msg.topic == "Temps":
        temps = msg.payload

    if msg.topic == "Temperature":
        temperature = msg.payload

    if msg.topic == "Humidite":
        humidite = msg.payload
        data = (1, "test", 0, 0, humidite, 0, 0)
        cursor.execute(add_info, data)
        print("Execute")


client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("test.mosquitto.org", 1883, 60)

connection.commit()
cursor.close()
connection.close()

client.loop_forever()
