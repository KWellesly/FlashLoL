import json

with open('staticChampData.json', 'r') as inputFile:
    data = json.load(inputFile)
    champions = {}
    for keys in data['keys']:
        champions[data['keys'][keys]] = {}

    #Refresh key and name set and champion list
    keyToName = {}
    nameToKey = {}
    lowerKeyToName = {}
    champList = []
    championKeysAndNames = {'keyToName' : keyToName, 'nameToKey' : nameToKey, 'lowerKeyToName' : lowerKeyToName}
    for keys in data['keys']:
        key = data['keys'][keys]
        name = data['data'][data['keys'][keys]]['name']
        keyToName[key] = name
        nameToKey[name] = key
        lowerKeyToName[key.lower()] = name
        champList.append(name.lower())
    with open('championList.json', 'w') as nameFile:
        json.dump(champList, nameFile)

    #Refresh champion images (icon)
    for names in data['data']:
        champions[names]['icon'] = data['data'][names]['image']['full']

    #Refresh abilities (text and images)
    for names in data['data']:
        abilitiesList = []
        for spells in data['data'][names]['spells']:
            ability = {}
            ability['image'] = spells['image']['full']
            ability['description'] = spells['description']
            abilitiesList.append(ability)
        champions[names]['abilities'] = abilitiesList

    #Compile data into one file
    netData = {'championKeysAndNames' : championKeysAndNames, 'data' : champions, 'version' : data['version']}
    with open('championPageData.json', 'w') as outFile:
        json.dump(netData, outFile)