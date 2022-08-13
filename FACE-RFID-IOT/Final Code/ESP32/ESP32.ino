/*
 NOTE :

 (*) Remaining work:
 1)  Internet status light remaining  [COLOR REMAINING-{suggestion:whitefor esp8266 and esp32 combine light}]
 2)  hardware integration of status lights(especially internet status)
 3)  wifi ssid & password changing
 4)  uid starting digit change
 5)  lights for Invalid card response & Unverified attedance

*/
 


#include <SPI.h>         //library for serial peripheral interface devices
#include <MFRC522.h>     //library for RFID reader
#include <ArduinoJson.h> //library to store data in json format in arduino
#include <WiFi.h>        // library for connecting wifi & internet
#include <HTTPClient.h> //library to connect with API

#define SS_PIN 21  //(D21)- SDA pin of rfid reader
#define RST_PIN 22 //(D22)- Reset pin of rfid reader

#define Rfid_status 2          // D2  - Rfid read status [Blue light]
#define Attendance_status 4    // D4  - Attedance Verified status [Green light]
#define Invalid_card_status 15 // D15 - Invalid card scanned / failure (verification of attedance) [Red light] 
#define Internet_status 5      // D5  - System connection with Active Internet connection
#define control_status 13      // D13 - System control pin ESP32 & READER Online/Offline

// Global storage variables 

String Rfid_tag_ID = "";      // storing read tag ID
String last_read_tag_ID = ""; // for storing last read tag ID to confirm once scanned card can't be rescanned immediately

StaticJsonDocument<128> UID_JSON; // JSON storage for Api POST request

// RFID reader configuration

MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance/object.

// Wifi & API configuration

// api configuration
const char *serverName = "http://killing-winters.000webhostapp.com/api/add"; // Domain name with full URL path to an api for HTTP POST Request

//wifi configuration
char WIFI_SSID[3][30] = {"Jeshvi","winter", "VNSGU"}; // Wifi ssid array to store multiple wifi because in case of one connection failure system can auto connect with another wifi available
char WIFI_PASSWORD[3][30] = {"Winterisgreat97","password", "12345678"}; // ssid -password mapped
char connection_req_ssid[30]; // temporary SSID for debugging purpose
int connection_index = 0; // counter for ssid and password from array

WiFiClient client; // object for wifi client
HTTPClient http;   // object for http client for API

/* wifi setup */

bool establish_secure_connection(unsigned long int baud_rate, const char *Ssid, const char *Password) // function for connecting to wifi
{
    SPI.begin();        // Initiate  SPI bus
    mfrc522.PCD_Init(); // Initiate MFRC522

    int counter = 1, i = 0;
    bool connection_flag = true;
    char connection_req_ssid[30];

    /*Open Serial Communication (Esp32-PC) */
    Serial.begin(baud_rate);

    /* Connection intiating with WIFI */
    WiFi.begin(Ssid, Password);

    Serial.println();
    Serial.printf("Connecting to %s ", WIFI_SSID[connection_index]);

    while(WiFi.status() != WL_CONNECTED)
    {
        delay(500);
        Serial.print(".");
        counter = counter + 1;
        if(counter > 30) // If in 30 sec ESP32 is failed to connect to wifi then switch to another network following by same network connecting once again
        {
            connection_flag = false; // connection failed
            break;
        }
        connection_flag = true; // connection succeed
    }

    if (connection_flag == true) // if succeed then
    { 
        
        /* System online Configuration  */
        
        pinMode(control_status, INPUT); //configure
        digitalWrite(control_status, LOW); //set intial status

        pinMode(Attendance_status, OUTPUT);
        digitalWrite(Attendance_status, LOW);

        pinMode(Rfid_status, OUTPUT);
        digitalWrite(Rfid_status, LOW);

        pinMode(Invalid_card_status, OUTPUT);
        digitalWrite(Invalid_card_status, LOW);

        pinMode(Internet_status, OUTPUT);
        digitalWrite(Internet_status, LOW); // Intial status in-active


        /***********************************/

        Serial.println();
        Serial.printf("Connected to %s with IP address : ", WIFI_SSID[connection_index]); //Print ssid name
        Serial.print(WiFi.localIP()); //Print IP address of wifi connection

        Serial.println();
        Serial.println("Internet status = CONNECTED"); 

        Serial.println(" ");
        Serial.println("Esp32 is ready to serve :)"); // system online debug message
        Serial.println(" ");
    }
    else // if not succeed then 
    {
        Serial.println();
        Serial.printf("Failed to connect : %s", WIFI_SSID[connection_index]);

        digitalWrite(Internet_status,LOW); // Internet status in-active
        Serial.println();
        Serial.println("Internet status = NOT_CONNECTED"); // Debug statement

        if (connection_index < 2) // array iteration for 0 & 1 & 2 ssid test one by one
        {
            i = 0;
            while (WIFI_SSID[connection_index + 1][i] != '\0')  // converting 2D array into 1D string {char array}
            {
                connection_req_ssid[i] = WIFI_SSID[connection_index + 1][i];
                i++;
            }

            connection_req_ssid[i] = '\0';
        }
        else //reset index and start from first ssid again
        {
            i = 0;
            while (WIFI_SSID[0][i] != '\0') // converting 2D array into 1D string {char array}
            {
                connection_req_ssid[i] = WIFI_SSID[0][i];
                i++;
            }

            connection_req_ssid[i] = '\0';
        }

        delay(500);
        Serial.println();
        Serial.printf("Trying to connect :%s", connection_req_ssid);
        delay(500); // necessary to write here otherwise not work because below return statement executes faster
    }

    return(connection_flag);
}

void setup()
{

    /*Connection with Wifi and Internet */

    while (!establish_secure_connection(115200, WIFI_SSID[connection_index], WIFI_PASSWORD[connection_index])) 
    {

        if (connection_index < 2)
        {
            connection_index = connection_index + 1; // changing ssid everytime at connection failure
        }
        else
        {
            connection_index = 0; //reset index
        }
    }
}

void sendToApi() // function to send Attedance data to an API
{
    UID_JSON["api_token"] = "40kbno9qesgzah1k5reiznwtr9yco2vlfgzw9nu5"; //Api Token for security
    http.begin(client, serverName); //connection with Web-serevr & Api
    http.addHeader("Content-Type", "application/json"); //specifying Type of data

    String httpRequestData = "";// prepare data to be send here as Plain Text But Json Format

    serializeJson(UID_JSON, httpRequestData); //convert to JSON

    Serial.println("POST Request Data to be send (JSON Format) : " + httpRequestData); //Simple string print of JSON data

    int httpResponseCode = http.POST(httpRequestData); //POST data to an api and get Response code from api

    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode); //print Response code
    
    String payload = http.getString(); //wait for Api Response about given Attedance data
    Serial.println(payload); //print Response

    if(httpResponseCode == 200 && payload=="1")
    {   
        Serial.println(" ");
        Serial.println("-->Attedance verified by an Api ! ;)");
        digitalWrite(Attendance_status, HIGH); // display status of Attedance verification
    }
    else
    {  
        Serial.println(" ");
        Serial.println("Something went wrong:( ->(Rescan this card after another card scan !)");
        digitalWrite(Invalid_card_status, HIGH);
    }

    http.end(); // free http resourse
    UID_JSON.clear(); // clear JSON data for preparing new Attedance data object for an api
}
void loop()
{

  if(digitalRead(control_status) == HIGH) // if system gets command from Esp8266 to be online then system will work else don't
  {
      
    if(WiFi.status() == WL_CONNECTED) // if wifi gets connected
    {
      digitalWrite(Internet_status,HIGH); // Internet status active
      Serial.println();
      Serial.println("Internet status = CONNECTED");

        if (mfrc522.PICC_IsNewCardPresent()) // Look for new rfid card tag
        {

            if (mfrc522.PICC_ReadCardSerial()) // read UID from present card
            {

                for (byte i = 0; i < mfrc522.uid.size; i++) // extract read UID in String format
                {
                    Rfid_tag_ID.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
                    Rfid_tag_ID.concat(String(mfrc522.uid.uidByte[i], HEX));
                }

                Rfid_tag_ID.toUpperCase(); // Read ID Convert to upperCase
                Rfid_tag_ID.trim();        // Trim First white space

                if(last_read_tag_ID != Rfid_tag_ID) // quick fix for valid card scanned once can't be rescanned imediately by the system in case of long time card presence near system
                {
                    digitalWrite(Rfid_status, HIGH); // display rfid read successfully 

                    Serial.print("Read UID tag :"); 
                    Serial.println(Rfid_tag_ID);    //  display UID read UID

                    if (Rfid_tag_ID.startsWith("05 8")) // check if UID is starting with proper Institution given card numbers
                    {
                        UID_JSON["data"] = Rfid_tag_ID; // make property field in JSON Object

                        if (WiFi.status() == WL_CONNECTED) // if wifi connection is active
                        {
                            sendToApi(); // send Object as POST request to an api
                        }
                        else
                        {
                            Serial.println("WiFi Disconnected ! :(");
                            digitalWrite(Internet_status, LOW); // display internet status
                            
                            Serial.println();
                            Serial.println("Internet status = NOT_CONNECTED");

                            Serial.println();
                            Serial.println("Connection lost trying to reconnect...");

                            while (!establish_secure_connection(115200, WIFI_SSID[connection_index], WIFI_PASSWORD[connection_index])) //same as above explanation in setup() given
                            {
                                if (connection_index < 2)
                                {
                                    connection_index = connection_index + 1;
                                }
                                else
                                {
                                    connection_index = 0;
                                }
                            }

                            sendToApi(); // after connection we can send request for read UID data Object
                        }

                        last_read_tag_ID = Rfid_tag_ID; // copy id for cross checking fix for prevent rescanning ;)
                    }
                    else
                    {    
                        Serial.println();
                        Serial.println("Invalid card scanned ;)!");

                        digitalWrite(Invalid_card_status, HIGH);
                    }
                }

                Rfid_tag_ID = ""; //make empty UID for surity purpose

                /* all light set status for next card reading */
                
                delay(500);
                digitalWrite(Rfid_status, LOW);
                digitalWrite(Invalid_card_status, LOW);
                digitalWrite(Attendance_status, LOW);
            }
            else
            {   
                Serial.println(" ");
                Serial.println("Unable to Read card UID! ");
            }
        }
        else
        {
            Serial.println("Scan Your Attedance ID card... ");
            delay(500);
        }
    }
    else // if internet is not available or get disconnected in between
    {
        Serial.println("WiFi Disconnected ! :(");
        digitalWrite(Internet_status, LOW); //display status
        
        Serial.println();
        Serial.println("Internet status = NOT_CONNECTED"); 

        Serial.println();
        Serial.println("Connection lost trying to reconnect...");

        // same process explained in setup()
        while (!establish_secure_connection(115200, WIFI_SSID[connection_index], WIFI_PASSWORD[connection_index])) 
        {
            if (connection_index < 2)
            {
                connection_index = connection_index + 1;
            }
            else
            {
                connection_index = 0;
            }
        }
    }
  }
  else
  {
    last_read_tag_ID = "";
    Rfid_tag_ID = "";  
  }
}
