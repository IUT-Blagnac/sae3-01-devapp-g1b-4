import datetime
import json
import yaml
import paho.mqtt.client as mqtt

with open("config_mqtt.yaml", "r") as stream:
    try:
        config = yaml.safe_load(stream)
    except yaml.YAMLError as exc:
        print(exc)


def get_data(mqtt, obj, msg):
    jsonMsg = json.loads(msg.payload)
    message = ""
    for i in range(config["frequency"]):

        date = datetime.datetime.now().strftime("%Y-%b-%d %H-%M-%S")
        message += date + "\n"
        if config["object"]["activity"]:
            if config["seuils"]["activity"] is not None:
                if config["seuils"]["activity"] < jsonMsg["object"]["activity"]:
                    message += "[Seuil dépassé!] "
            message += "Activité : " + str(jsonMsg["object"]["activity"]) + " PIR\n"

        if config["object"]["co2"]:
            if config["seuils"]["co2"] is not None:
                if config["seuils"]["co2"] < jsonMsg["object"]["co2"]:
                    message += "[Seuil dépassé!] "
            message += "Concentration CO2 : " + str(jsonMsg["object"]["co2"]) + " ppm\n"

        if config["object"]["humidity"]:
            if config["seuils"]["humidity"] is not None:
                if config["seuils"]["humidity"] < jsonMsg["object"]["humidity"]:
                    message += "[Seuil dépassé!] "
            message += "Humidité : " + str(jsonMsg["object"]["humidity"]) + " %\n"

        if config["object"]["illumination"]:
            if config["seuils"]["illumination"] is not None:
                if config["seuils"]["illumination"] < jsonMsg["object"]["illumination"]:
                    message += "[Seuil dépassé!] "
            message += "Éclairement : " + str(jsonMsg["object"]["illumination"]) + " lux\n"

        if config["object"]["infrared"]:
            if config["seuils"]["infrared"] is not None:
                if config["seuils"]["infrared"] < jsonMsg["object"]["infrared"]:
                    message += "[Seuil dépassé!] "
            message += "Infrarouge : " + str(jsonMsg["object"]["infrared"]) + " µm\n"

        if config["object"]["infrared_and_visible"]:
            if config["seuils"]["infrared_and_visible"] is not None:
                if config["seuils"]["infrared_and_visible"] < jsonMsg["object"]["infrared_and_visible"]:
                    message += "[Seuil dépassé!] "
            message += "Infrarouge visible : " + str(jsonMsg["object"]["infrared_and_visible"]) + " µm\n"

        if config["object"]["pressure"]:
            if config["seuils"]["pressure"] is not None:
                if config["seuils"]["pressure"] < jsonMsg["object"]["pressure"]:
                    message += "[Seuil dépassé!] "
            message += "Pression : " + str(jsonMsg["object"]["pressure"]) + " hPa\n"

        if config["object"]["temperature"]:
            if config["seuils"]["temperature"] is not None:
                if config["seuils"]["temperature"] < jsonMsg["object"]["temperature"]:
                    message += "[Seuil dépassé!] "
            message += "Température : " + str(jsonMsg["object"]["temperature"]) + " °C\n"

        if config["object"]["tvoc"]:
            if config["seuils"]["tvoc"] is not None:
                if config["seuils"]["tvoc"] < jsonMsg["object"]["tvoc"]:
                    message += "[Seuil dépassé!] "
            message += "Qualité de l'air : " + str(jsonMsg["object"]["tvoc"]) + " ppb\n"

        if i < 1:
            message += "\n"

    with open(date + " donnees.txt", "w", encoding="utf-8") as file:
        file.write(message)
        file.close()
    client.disconnect()


print("Connexion aux locaux de Blue Gym...")

client = mqtt.Client()
client.connect(config["servers"], config["port"], 600)

client.subscribe("application/1/device/+/event/up")

client.on_message = get_data

client.loop_forever()
