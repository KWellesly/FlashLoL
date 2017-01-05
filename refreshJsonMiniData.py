import json
import urllib.request

#Retrieve JSON static data
sCDSite = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=all&api_key=RGAPI-f5b88a22-b760-4ea8-8d62-2127a752d3c3"
staticChampionData = json.loads(urllib.request.urlopen(sCDSite).read().decode())
sIDSite = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/item?itemListData=all&api_key=RGAPI-f5b88a22-b760-4ea8-8d62-2127a752d3c3"
staticItemData = json.loads(urllib.request.urlopen(sIDSite).read().decode())

champions = {}
for keys in staticChampionData['keys']:
    champions[staticChampionData['keys'][keys]] = {}

#Refresh key and name set and champion list
keyToName = {}
nameToKey = {}
lowerKeyToName = {}
champList = []
championKeysAndNames = {'keyToName' : keyToName, 'nameToKey' : nameToKey, 'lowerKeyToName' : lowerKeyToName}
for keys in staticChampionData['keys']:
    key = staticChampionData['keys'][keys]
    name = staticChampionData['data'][staticChampionData['keys'][keys]]['name']
    keyToName[key] = name
    nameToKey[name] = key
    lowerKeyToName[key.lower()] = name
    champList.append(name.lower())
with open('championList.json', 'w') as nameFile:
    json.dump(champList, nameFile)

#Refresh champion images (icon)
for names in staticChampionData['data']:
    champions[names]['icon'] = staticChampionData['data'][names]['image']['full']

#Refresh abilities (text and images)
for names in staticChampionData['data']:
    abilitiesList = []
    for spells in staticChampionData['data'][names]['spells']:
        ability = {}
        ability['image'] = spells['image']['full']
        ability['description'] = spells['description']
        abilitiesList.append(ability)
    champions[names]['abilities'] = abilitiesList

#Refresh Recommended Build data
for names in staticChampionData['data']:
    itemization = {}
    for each in (staticChampionData['data'][names]['recommended']):
        if each['map'] == "SR":
            for eachBuildType in each['blocks']:
                if eachBuildType['type'] != "siegeOffense" and eachBuildType['type'] != "siegeDefense":
                    recommendedBuild = []
                    for eachItem in eachBuildType['items']:
                        recommendedBuild.append({'id' : eachItem['id'], 'count' : eachItem['count'], 'image' : staticItemData['data'][str(eachItem['id'])]['image']['full'], 'name' : staticItemData['data'][str(eachItem['id'])]['name']})
                    itemization[eachBuildType['type']] = recommendedBuild
    champions[names]['recommended'] = itemization;

with open('championDescriptions.json', 'r') as descriptionFile:
    descriptions = json.load(descriptionFile)
    for names in staticChampionData['data']:
        champions[names]['description'] = descriptions[names]

#Compile data into one file
netData = {'championKeysAndNames' : championKeysAndNames, 'data' : champions, 'version' : staticChampionData['version']}
with open('championPageData.json', 'w') as outFile:
    json.dump(netData, outFile)