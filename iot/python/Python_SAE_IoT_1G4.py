import datetime
import json
import yaml
import paho.mqtt.client as mqtt

tabCo2 = []
tabTemp = []
tabHum = []

with open("config_mqtt.yaml", "r") as stream:
    try:
        config = yaml.safe_load(stream)
    except yaml.YAMLError as exc:
        print(exc)


def get_data(obj, msg):
    jsonMsg = json.loads(msg.payload)
    date = datetime.datetime.now().strftime("%Y-%b-%d %H-%M-%S")
    message = date + "\n"
    if config["object"]["activity"]:
        message += "Activité : " + str(jsonMsg["object"]["activity"]) + " PIR\n"
    if config["object"]["co2"]:
        if jsonMsg["object"]["co2"] > 1400:
            message += "[Attention, aérez si possible !] "
        message += "Concentration CO2 : " + str(jsonMsg["object"]["co2"]) + " ppm\n"
    if config["object"]["humidity"]:
        if jsonMsg["object"]["humidity"] > 0:
            message += "[Attention,] "
        message += "Humidité : " + str(jsonMsg["object"]["humidity"]) + " %\n"
    if config["object"]["illumination"]:
        if jsonMsg["object"]["illumination"] > 0:
            message += "[Attention,] "
        message += "Éclairement : " + str(jsonMsg["object"]["illumination"]) + " lux\n"
    if config["object"]["infrared"]:
        if jsonMsg["object"]["infrared"] > 0:
            message += "[Attention,] "
        message += "Infrarouge : " + str(jsonMsg["object"]["infrared"]) + " µm\n"
    if config["object"]["infrared_and_visible"]:
        if jsonMsg["object"]["infrared_and_visible"] > 0:
            message += "[Attention,] "
        message += "Infrarouge visible : " + str(jsonMsg["object"]["infrared_and_visible"]) + " µm\n"
    if config["object"]["pressure"]:
        if jsonMsg["object"]["pressure"] > 1000.0:
            message += "[Attention, risque de problèmes !] "
        message += "Pression : " + str(jsonMsg["object"]["pressure"]) + " hPa\n"
    if config["object"]["temperature"]:
        if jsonMsg["object"]["temperature"] > 70 or jsonMsg["object"]["temperature"] < -20:
            message += "[Attention, ] "
        message += "Température : " + str(jsonMsg["object"]["temperature"]) + " °C\n"
    if config["object"]["tvoc"]:
        if jsonMsg["object"]["tvoc"] > 60000:
            message += "[Attention, risque mortel !] "
        message += "Qualité de l'air : " + str(jsonMsg["object"]["tvoc"]) + " ppb\n"
    # moy_tableaux(donneeCo2, donneeTemp, donneeHum)
    with open(date+" donnees.txt", "w", encoding="utf-8") as a_file:
        a_file.write(message)
        a_file.close()
    client.disconnect()

"""
def moy_tableaux(dCo2, dTemp, dHum):
    global tabCo2, tabTemp, tabHum 
    tabCo2.append(dCo2)
    tabTemp.append(dTemp)
    tabHum.append(dHum)
    if len(tabCo2) >= 10:
        print(sum(tabCo2[len(tabCo2) - 10 :] ) / 10)
    if len(tabTemp) >= 10:
        print(sum(tabTemp[len(tabTemp) - 10 :] ) / 10)
    if len(tabHum) >= 10:
        print(sum(tabHum[len(tabHum) - 10 :] ) / 10)
"""

print("Connexion aux locaux de Blue Gym...")

client = mqtt.Client()
client.connect(config["servers"], config["port"], 600)

client.subscribe("application/1/device/+/event/up")

client.on_message = get_data

client.loop_forever()