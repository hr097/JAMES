
/*
 NOTE :

 (*) Remaining work:
 1)  Internet status light remaining (combined with esp8266)
 2)  hardware integration of status lights(especially internet status)
 3)  wifi ssid & password changing for each class
 4)  HTML pages changed for each class

*/

 
#include <ESP8266WiFi.h> // library for connecting wifi
#include <WiFiClient.h> // library for connectiong wifi
#include <ESP8266WebServer.h> //library for intiating web server
#include <FS.h>   //library for using File System Headers

const char* titleFile = "/title-icon.png"; // title bar icon for webpage

//ESP8266 Access Point Mode configuration

const char *ssid = "MSCIT-5";
const char *password = "root@it4ict";

#define system_command 4 //D2 (system_command to start esp32 & rfid reader system On/Off)

/* System Web server Configuration */

ESP8266WebServer server(80); // at port 80 all communication will be done

// web page code in flash memory

const char webpage[] PROGMEM = R"=====(
<!DOCTYPE html>
<html>

<head>
    <title>JPD | AMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="title.png">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }
    body
    {   
        height:90%;
    }

    header {
        background-color: #034078;
        color: white;
        width:100%

    }

    footer {
        background-color: #034078;
        bottom: 0;
        color: white;
        padding: 20px;
        font-size: 15px;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    html {
        font-family: Arial;
        display: inline-block;
        margin: 0px auto;
        text-align: center;
    }

    body {
        background-color: rgb(243, 227, 170);
    }


    img {
        height: 200px;
        width: 300px;
    }

  
    .content {
        padding: 50px;
        height: 100%;
        
    }

    .card-grid {
        max-width: 800px;
        margin: 0 auto;
        display: grid;
        grid-gap: 2rem;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .card {
        background-color: white;
        box-shadow: 2px 2px 12px 1px rgba(140, 140, 140, 0.5);
        height:320px;
        width: 400px;
        position: relative;
        left: 50%;
        transform: translate(-50%, 0);
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #034078;
    }
    #stationID 
    {
        padding:10px;
        text-decoration: underline;
    }
    .button {
        border:none;
        color: white;
        padding: 10px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    #b1
    {
        background-color: green;
    }
    #b2
    {
        background-color: red;
    }
    .button:hover {
     color: rgb(0, 0, 0);
    }

    @media screen and (max-width: 768px) {
        img {
            height: 160px;
            width: 250px;
        }

        footer {
            font-size: 10px;
        }

        .card {
            height: 350px;
            width: 350px;
        }
    }

    @media screen and (max-width: 480px) {
        img {
            height: 100px;
            width: 140px;
        }
        header {
            width: 100%;
        }
        footer {
            font-size: 10px;
        }

        .card {
            height: 300px;
            width: 120%;
        }
    }
    @media screen and (max-width: 380px) {
        img {
            height: 100px;
            width: 140px;
        }
        header {
            width: 100%;
        }
        footer {
            font-size: 10px;
            padding:5px;
            
        }

        .card {
            width: 120%;
        }
    }

</style>

<body>
    <header>
        <img src="header.png" alt="">
    </header>

    <div class="content">
        <div class="card-grid">
            <div class="card">
               
                <h1 id="stationID">MSCIT-5</h1>
                <br>
                <br>
                <br>
                <br>
                <h2>Reader status : <strong id="state" style="color:red">OFF</strong></h2> 
                <br>
                <br>
                <br>
                <br>
                <button id="b1" class="button" onclick="send(1)">Active</button>
                <button id="b2" class="button" onclick="send(0)">Deactive</button>
            </div>
        </div>
    </div>
    <footer>
        <p>Copyrights © 2022. All Rights Reserved. Powered by JPD | AMS.</p>
    </footer>
<script>
function send(system_command_status) 
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById("state").innerHTML = this.responseText;
        if(this.responseText == "ON")
        document.getElementById("state").style.color = "green";
        else
        document.getElementById("state").style.color = "red";
    }
  };
  xhttp.open("GET", "system_command_set?state="+system_command_status, true);
  xhttp.send();
}
</script>
</center>
</body>
</html>
)=====";


// send html page to web server for hosting on IP 192.168.4.1
void handleRoot(){
  server.sendHeader("Location",webpage,true);   //Redirect to our html web page
  server.send(302, "text/html","");
}

void system_command_control()  //system status checking in received Response from webpage
{

 String state = "OFF";
 String act_state = server.arg("state");

 if(act_state == "1")
 {
  digitalWrite(system_command,HIGH); //system_command ON
  state = "ON"; //state channge
 }
 else
 {
  digitalWrite(system_command,LOW); //system_command OFF
  state = "OFF";  //state channge

 }
 server.send(200, "text/plane", state); //send back updated state[on/off] page to web server
}

void handleWebRequests() // sending image to Web server for hosting in webpage
{
  if(loadFromSpiffs(server.uri())) return; // fetch required image file from file system (flash memory)
  String message = "File Not Detected\n\n"; //error in fetching image file
  
  message += "URI: ";
  message += server.uri();
  message += "\nMethod: ";
  message += (server.method() == HTTP_GET)?"GET":"POST";
  message += "\nArguments: ";
  message += server.args();
  message += "\n";
  for (uint8_t i=0; i<server.args(); i++){
    message += " NAME:"+server.argName(i) + "\n VALUE:" + server.arg(i) + "\n";
  }
  server.send(404, "text/plain", message); //send image to web-server
  Serial.println(message);
}

void setup() {

  // seting up communication with PC via serial port
  Serial.begin(115200); //baud rate of communication
  Serial.println();

  pinMode(system_command,OUTPUT); // system command light configuration

  //Initialize File System
  SPIFFS.begin();
  Serial.println("File System Initialized");

  //Initialize Access Point Mode
  WiFi.softAP(ssid,password);  
  IPAddress myIP = WiFi.softAPIP();
  Serial.print("Web Server IP:");
  Serial.println(myIP);

  //Initialize Webserver
  server.on("/",handleRoot);//serevr ON
  server.on("/system_command_set", system_command_control); //call system command and put intial state of command on web server
  server.onNotFound(handleWebRequests); //Set server all paths  which are not found so we can handle as per URI
  server.begin();   //web server start
}

void loop() {
 server.handleClient(); // communication ongoing when request come from webpage(webserver) to Esp8266
}

bool loadFromSpiffs(String path)
{ // file system image type decision and fetching
  String dataType = "text/plain";

  //choose file type
  if(path.endsWith(".src")) path = path.substring(0, path.lastIndexOf("."));
  else if(path.endsWith(".html")) dataType = "text/html";
  else if(path.endsWith(".htm")) dataType = "text/html";
  else if(path.endsWith(".css")) dataType = "text/css";
  else if(path.endsWith(".js")) dataType = "application/javascript";
  else if(path.endsWith(".png")) dataType = "image/png";
  else if(path.endsWith(".gif")) dataType = "image/gif";
  else if(path.endsWith(".jpg")) dataType = "image/jpeg";
  else if(path.endsWith(".ico")) dataType = "image/x-icon";
  
  File dataFile = SPIFFS.open(path.c_str(), "r");
  if (server.hasArg("download")) dataType = "application/octet-stream";
  if (server.streamFile(dataFile, dataType) != dataFile.size()) { //render file to webpage using web server
  }

  dataFile.close(); //close data file
  return true;
}
