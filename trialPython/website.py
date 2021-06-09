from flask import Flask, request, jsonify
from datetime import datetime

app = Flask(__name__)

ipToLocation ={}
ipToTime = {}

@app.route("/")  
def home():
	return "Hello! this is the main page <h1>HELLO</h1>" 

@app.route("/ip", methods=["GET"])
def getIp():
    ip =  request.remote_addr
    now = datetime.now()
    ipToTime[ip]=now
    return ipToTime

if __name__ == "__main__":
    app.run()
