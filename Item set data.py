import urllib.request
import json


siteChampID = "http://ddragon.leagueoflegends.com/cdn/6.24.1/data/en_US/champion.json"
siteChampIDJson = json.loads(urllib.request.urlopen(siteChampID).read().decode())

itemsetAPI = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=recommended&api_key=RGAPI-fad4a1e2-48d4-4e6b-aae8-b7e088d7d6b1"
itemsetJson = json.loads(urllib.request.urlopen(itemsetAPI).read().decode())

itemID = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/item?api_key=RGAPI-fad4a1e2-48d4-4e6b-aae8-b7e088d7d6b1"
itemIDJson = json.loads(urllib.request.urlopen(itemID).read().decode())





                       
champion = input("Please enter a champion you'd like to see a build for: ")
champID = (siteChampIDJson["data"][champion]["key"])

##print (itemsetJson["data"][champion]["recommended"][0]["mode"])


for each in (itemsetJson["data"][champion]["recommended"]):
    if each["map"] == "SR":
        for eachBuildType in each["blocks"]:
            if eachBuildType["type"] != "siegeOffense" and eachBuildType["type"] != "siegeDefense":
                print (eachBuildType["type"])
                for eachItem in eachBuildType["items"]:
                    itemID = str(eachItem["id"])
                    print (itemID + " " + itemIDJson["data"][itemID]["name"])
                
                

                print ()
                print ()













