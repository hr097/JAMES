

// lights code
// proper comments
//internet status light implementation

#include <SPI.h>
#include <MFRC522.h>
#include <ArduinoJson.h>
#include <WiFi.h>
#include <HTTPClient.h>

#define SS_PIN 21 // SDA pin of rfid reader
#define RST_PIN 22 // Reset pin of rfid reader

#define Rfid_status 2 //D2
#define Attendance_status 4 //D4
#define Invalid_card 15 //D15
#define Internet_status 5 //D5

// storage

String  Rfid_tag_ID=""; // storing read tag ID
String  last_read_tag_ID= ""; // for storing last read tag ID

StaticJsonDocument<128> UID_JSON; 


// RFID reader configuration

MFRC522 mfrc522(SS_PIN,RST_PIN);   // Create MFRC522 instance/object.


// Wifi & API configuration


const char* serverName = "http://killing-winters.000webhostapp.com/api/add"; // Domain Name with full URL Path for HTTP POST Request

char WIFI_SSID[3][30]={"Jeshvi","ABCD","winter"};
char WIFI_PASSWORD[3][30]={"Winterisgreat97","12345678","12345678#"};
char connection_req_ssid[30];
int connection_index = 0;

WiFiClient client;
HTTPClient http;


/* wifi setup */

bool establish_secure_connection(unsigned long int baud_rate,const char *Ssid,const char *Password)
{
  SPI.begin();      // Initiate  SPI bus
  mfrc522.PCD_Init();   // Initiate MFRC522 
  
  int counter = 1,i=0;
  bool connection_flag=true;
  char connection_req_ssid[30];
  
  /*Open Serial Communication (Esp-PC) */
  Serial.begin(baud_rate);

  /* Connection intiating with WIFI */
  WiFi.begin(Ssid,Password);
  
  Serial.println();
  Serial.printf("Connecting to %s ",WIFI_SSID[connection_index]);
  
  while(WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
    counter = counter + 1;
    if(counter>30) // If in 30 sec Esp8266 is failed to connect switch to New network and try to connect it
    {
      connection_flag=false;
      break;
    }
    connection_flag=true;
  }

  if(connection_flag==true)
  {  
     Serial.println();
     Serial.printf("Connected to %s with IP address : ",WIFI_SSID[connection_index]);
     Serial.print(WiFi.localIP());

     digitalWrite(Internet_status,HIGH);// Internet is Active
     Serial.println();
     Serial.println("Internet status = CONNECTED"); // Debug statement


    UID_JSON["api_token"] = "40kbno9qesgzah1k5reiznwtr9yco2vlfgzw9nu5";  
    http.begin(client, serverName);
    http.addHeader("Content-Type", "application/json");
   
     /* System start Configuration Indication */

     pinMode(Attendance_status,OUTPUT);
     digitalWrite(Attendance_status,LOW);

     pinMode(Rfid_status,OUTPUT);
     digitalWrite(Rfid_status,LOW);

     pinMode(Invalid_card,OUTPUT);
     digitalWrite(Invalid_card,LOW);

     pinMode(Internet_status,OUTPUT);
     digitalWrite(Internet_status,HIGH);
     
     Serial.println(" ");
     Serial.println("Esp32 is ready to serve"); 
     Serial.println("Scan New Card.");
     Serial.println(" ");
     
  }
  else
  {   
      Serial.println();
      Serial.printf("Failed to connect : %s",WIFI_SSID[connection_index]);
      
      digitalWrite(Internet_status,LOW);
      Serial.println();
      Serial.println("Internet status = NOT_CONNECTED"); // Debug statement
   
      if(connection_index<2)
      {   
        i=0;
        while(WIFI_SSID[connection_index+1][i]!='\0')
        {
          connection_req_ssid[i]=WIFI_SSID[connection_index+1][i];
          i++;
        }

         connection_req_ssid[i] ='\0';
      }
      else
      {
        i=0;
        while(WIFI_SSID[0][i]!='\0')
        {
          connection_req_ssid[i]=WIFI_SSID[0][i];
          i++;
        }

         connection_req_ssid[i] ='\0';
  
       }

     delay(500);
     Serial.println();
     Serial.printf("Trying to connect :%s",connection_req_ssid);
     delay(500); // necessary to write here otherwise not work because below return execute faster 
  }

 return (connection_flag);
}


void setup() {
  
  /*Connection with Wifi and Internet */

 while(!establish_secure_connection(115200,WIFI_SSID[connection_index],WIFI_PASSWORD[connection_index]))
  {    
     
     if(connection_index<2)
      {
      connection_index = connection_index + 1; 
      }
      else
      {
        connection_index = 0;
      }
  }

}

void sendToApi()
{
       String httpRequestData = "";

       serializeJson(UID_JSON,httpRequestData);

       Serial.println("Request JSON format : "+httpRequestData);

       int httpResponseCode = http.POST(httpRequestData);
     
       Serial.print("HTTP Response code: ");
       Serial.println(httpResponseCode);
        
       http.end();

       if(httpResponseCode==200)
       {
           Serial.println("Tag Id forwarded to api !");
           digitalWrite(Attendance_status,HIGH);
       }
       else
       {
           Serial.println("Rescan this card after another card scan !");
       }
}
void loop() {

  if(WiFi.status()== WL_CONNECTED)
  {
    
  
  if(mfrc522.PICC_IsNewCardPresent()) // Look for new cards
  {

      if(mfrc522.PICC_ReadCardSerial())
      {
        
           for(byte i = 0; i < mfrc522.uid.size; i++)
           {
             Rfid_tag_ID.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
             Rfid_tag_ID.concat(String(mfrc522.uid.uidByte[i], HEX));
           }
           
           Rfid_tag_ID.toUpperCase(); //Read ID Convert to upperCase 
           Rfid_tag_ID.trim(); // Trim First space

           if(last_read_tag_ID!=Rfid_tag_ID)
           {
            
           digitalWrite(Rfid_status,HIGH);

           Serial.print("Read UID tag :"); // Show UID on serial monitor===Debug statement
           Serial.println(Rfid_tag_ID); //Debug statement

           if(Rfid_tag_ID.startsWith("05 8"))
           {
          
           UID_JSON["data"] = Rfid_tag_ID;


           if(WiFi.status()== WL_CONNECTED)
           {
             sendToApi();
           }
           else
           {  
                 Serial.println("WiFi Disconnected !");
                 digitalWrite(Internet_status,LOW);
                 Serial.println();
                 Serial.println("Internet status = NOT_CONNECTED"); // Debug statement

                 Serial.println();
                 Serial.println("Connection lost trying to reconnect...");
                 
                while(!establish_secure_connection(115200,WIFI_SSID[connection_index],WIFI_PASSWORD[connection_index]))
                { 
                if(connection_index<2)
                {
                connection_index =  connection_index + 1; 
                }
                else
                {
                 connection_index = 0;
                }
                }
                
                sendToApi();
               
           }

           last_read_tag_ID=Rfid_tag_ID;

           UID_JSON.clear();
           UID_JSON["api_token"] = "40kbno9qesgzah1k5reiznwtr9yco2vlfgzw9nu5";
           }
           else
           {
             digitalWrite(Invalid_card,HIGH);
           }

           }
           
           Rfid_tag_ID="";

           delay(500);
           digitalWrite(Rfid_status,LOW);
           digitalWrite(Invalid_card,LOW);
           digitalWrite(Attendance_status,LOW);
     
      }
      else
      {
         Serial.println("Unable to Read card UID! ");
      }

   } 
   else
   {
    Serial.println("Scan card... ");
    delay(500);
   }


   }
   else
   {  
        Serial.println("WiFi Disconnected !");
        digitalWrite(Internet_status,LOW);
        Serial.println();
        Serial.println("Internet status = NOT_CONNECTED"); // Debug statement

        Serial.println();
        Serial.println("Connection lost trying to reconnect...");
                 
        while(!establish_secure_connection(115200,WIFI_SSID[connection_index],WIFI_PASSWORD[connection_index]))
        { 
            if(connection_index<2)
            {
              connection_index =  connection_index + 1; 
            }
            else
            {
              connection_index = 0;
            }
        }
             
  }
  
  
}
