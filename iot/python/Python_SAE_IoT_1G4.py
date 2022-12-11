import datetime
import json
from time import sleep
import yaml
import paho.mqtt.client as mqtt
import os

with open("config_mqtt.yaml", "r") as stream:
    try:
        config = yaml.safe_load(stream)
    except yaml.YAMLError as exc:
        print(exc)

try:
    os.remove(config["name"] + "_activity_donnees.txt")
except OSError:
    pass
try:
    os.remove(config["name"] + "_co2_donnees.txt")
except OSError:
    pass
try:
    os.remove(config["name"] + "_humidity_donnees.txt")
except OSError:
    pass
try:
    os.remove(config["name"] + "_illumination_donnees.txt")
except OSError:
    pass
try:
    os.remove(config["name"] + "_infrared_donnees.txt")
except OSError:
    pass
try:
    os.remove(config["name"] + "_infrared_and_visible_donnees.txt")
except OSError:
    pass
try:
    os.remove(config["name"] + "_pressure_donnees.txt")
except OSError:
    pass
try:
    os.remove(config["name"] + "_temperature_donnees.txt")
except OSError:
    pass
try:
    os.remove(config["name"] + "_tvoc_donnees.txt")
except OSError:
    pass
try:
    os.remove("log.txt")
except OSError:
    pass


def get_data(mqtt, obj, msg):
    jsonMsg = json.loads(msg.payload)
    now = datetime.datetime.now()
    date = now.strftime("%Y-%b-%d %H-%M-%S")
    f = open("log.txt", "a")
    f.write(date + "\n")
    f.close()
    if config["object"]["activity"]:
        if config["seuils"]["activity"] is not None and config["seuils"]["activity"] < jsonMsg["object"]["activity"]:
            if now.hour > 18 or now.hour < 6:
                print("[Activité détecté en dehors des horaires!]")
        with open(config["name"] + "_activity_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["activity"]) + " PIR\n")
            file.close()
            
    if config["object"]["co2"]:
        if config["seuils"]["co2"][0] is not None and config["seuils"]["co2"][1] is not None and (
                config["seuils"]["co2"][1] < jsonMsg["object"]["co2"] or config["seuils"]["co2"][0] > jsonMsg["object"]["co2"]):
            print("[Seuil Concentration de CO2 dépassé]")
        with open(config["name"] + "_co2_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["co2"]) + " ppm\n")
            file.close()

    if config["object"]["humidity"]:
        if config["seuils"]["humidity"][0] is not None and config["seuils"]["humidity"][1] is not None and (
                config["seuils"]["humidity"][1] < jsonMsg["object"]["humidity"] or config["seuils"]["humidity"][0] >
                jsonMsg["object"]["humidity"]):
            print("[Seuil d'humidité dépassé]")
        with open(config["name"] + "_humidity_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["humidity"]) + " %\n")
            file.close()

    if config["object"]["illumination"]:
        if config["seuils"]["illumination"] is not None and config["seuils"]["illumination"] < jsonMsg["object"]["illumination"]:
            print("[Seuil d'intensité lumineuse dépassé!]")
        with open(config["name"] + "_illumination_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["illumination"]) + " lux\n")
            file.close()

    if config["object"]["infrared"]:
        if config["seuils"]["infrared"] is not None and config["seuils"]["infrared"] < jsonMsg["object"]["infrared"]:
            print("[Seuil d'infrarouge dépassé!]")
        with open(config["name"] + "_infrared_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["infrared"]) + " µm\n")
            file.close()

    if config["object"]["infrared_and_visible"]:
        if config["seuils"]["infrared_and_visible"] is not None and config["seuils"]["infrared_and_visible"] < jsonMsg["object"]["infrared_and_visible"]:
            print("[Seuil d'infrarouge visible dépassé!]")
        with open(config["name"] + "_infrared_and_visible_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["infrared_and_visible"]) + " µm\n")
            file.close()

    if config["object"]["pressure"]:
        if config["seuils"]["pressure"] is not None and config["seuils"]["pressure"] < jsonMsg["object"]["pressure"]:
            print("[Seuil de pression dépassé!]")
        with open(config["name"] + "_pressure_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["pressure"]) + " hPa\n")
            file.close()

    if config["object"]["temperature"]:
        if config["seuils"]["temperature"][1] is not None and config["seuils"]["temperature"][0] is not None and (
                config["seuils"]["temperature"][1] < jsonMsg["object"]["temperature"] or
                config["seuils"]["temperature"][0] > jsonMsg["object"]["temperature"]):
            print("[Seuil de temperature dépassé pour les produits de Blue Gym!]")
        with open(config["name"] + "_temperature_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["temperature"]) + " °C\n")
            file.close()

    if config["object"]["tvoc"]:
        if config["seuils"]["tvoc"] is not None and config["seuils"]["tvoc"] < jsonMsg["object"]["tvoc"]:
            print("[Seuil de qualité d'air dépassé!]")
        with open(config["name"] + "_tvoc_donnees.txt", "a", encoding="utf-8") as file:
            file.write(str(jsonMsg["object"]["tvoc"]) + " ppb\n")
            file.close()
            
    lines_in_file = open("log.txt", 'r').readlines()
    if len(lines_in_file) == config["frequency"]:
        os.remove("log.txt")
        client.disconnect()
    else:
        sleep(10)


print("Connexion aux locaux de Blue Gym...")

client = mqtt.Client()
client.connect(config["servers"], config["port"], 600)

if(config["frequency"] < 1):
    client.disconnect()

if(config["object"]["temperature"] == False and config["object"]["tvoc"] == False and config["object"]["pressure"] == False and config["object"]["infrared_and_visible"] == False and config["object"]["infrared"] == False and config["object"]["illumination"] == False and config["object"]["humidity"] == False and config["object"]["co2"] == False and config["object"]["activity"] == False):
    client.disconnect()

client.subscribe("application/1/device/+/event/up")

client.on_message = get_data

client.loop_forever()
