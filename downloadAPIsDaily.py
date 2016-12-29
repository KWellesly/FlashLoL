import sched, time
import urllib.request
import json




s = sched.scheduler(time.time, time.sleep)

def dlAPIs(sc):
    riotFile = "http://ddragon.leagueoflegends.com/cdn/6.24.1/data/en_US/summoner.json"
    ##Summoner spells... change to whatever file is needed
    riotFile = "http://ddragon.leagueoflegends.com/cdn/6.24.1/data/en_US/summoner.json"
    riotFile = urllib.request.urlopen(riotFile).read().decode()
##    print (riotFile)

    dlRiotFile = open("LoLSummonerSpells.txt", "w")
    dlRiotFile.write(riotFile)
    
    
    print ("Doing stuff...")
    
    
    s.enter(86400, 1, dlAPIs, (sc,))

s.enter(86400, 1, dlAPIs, (s,))
s.run()

