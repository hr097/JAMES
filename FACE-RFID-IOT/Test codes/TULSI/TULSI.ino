#include <ESP8266WiFi.h> // CONNECTING WITH WIFI 
#include <WiFiClientSecure.h> // COMMUNICATION WITH INTERNET API'S
#include <SPI.h>
#include <MFRC522.h>

/* RFID treader communication */

#define SS_PIN 4  //D2
#define RST_PIN 5 //D1


#define buzzerPin 16  // buzzer
#define Internet_status 0 // Internet_connection Active/Inactive
#define Rfid_read_status 2 
#define Response_status 15 // Server Reponse

// except: [0 2 4 12] all GPIO [16] is free 

/*Global variable for data storage in serial communication */

String Rfid_tag_ID="";
String Api_Response="";

/*Internet Communication  */
String url = "/api/add/40kbno9qesgzah1k5reiznwtr9yco2vlfgzw9nu5";
const char* host = "killing-winters.000webhostapp.com";
const int httpsPort = 443;


/* Wifi Communication */

char WIFI_SSID[3][30]={"Savaliya","Jeshvi","winter_stark"};
char WIFI_PASSWORD[3][30]={"12355321","Winterisgreat97","12345678#"};
char connection_req_ssid[30];
int connection_index = 0;

WiFiClientSecure client; // Use WiFiClientSecure class to create TLS connection


/* RFID */
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance/object.


/* wifi setup */

bool establish_secure_connection(unsigned long int baud_rate,String Ssid,String Password)
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

  digitalWrite(Internet_status,LOW); // Intial wifi connection status low
  Serial.println();
  Serial.println("Internet status = NOT_CONNECTED"); // Debug statement
  
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

     /* System start Configuration Indication */
     pinMode(buzzerPin,OUTPUT);
     digitalWrite(buzzerPin,LOW);

     pinMode(Response_status,OUTPUT);
     digitalWrite(Response_status,LOW);

     pinMode(Internet_status,OUTPUT);
     digitalWrite(Internet_status,HIGH);
     
     pinMode(Rfid_read_status,OUTPUT);
     digitalWrite(Rfid_read_status,LOW);
     
     Serial.println(" ");
     Serial.println("Esp8266 is ready to receive data and sending that to API for verification."); // we can change to LED/LCD Print
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


      /* Buzzer Part */
      
      tone(buzzerPin,1000); // here we need to set different sound because it is tring to reconnect same network
      delay(3000);
      noTone(buzzerPin);
      
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

/*******************************/


void setup() {
  
/*Connection with Wifi and Internet */

 while(!establish_secure_connection(9600,WIFI_SSID[connection_index],WIFI_PASSWORD[connection_index]))
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

bool readTagID()
{
         
   //Serial.println("read tag id is running...");
  
 
}
  
void loop() {
  
  while(WiFi.status()==WL_CONNECTED)
   {    
      //  Serial.println();
     
//        digitalWrite(Internet_status,LOW);
//        Serial.println();
//        Serial.println("Internet status = CONNECTED"); // Debug statement
//        Serial.println("before:"+Rfid_tag_ID);

         /* Connection to API */
           
     client.setInsecure(); //making connection Insecure to send data on api
     Serial.println(" ");
     digitalWrite(Response_status,LOW);       
     /* making connection to API */
     
     Serial.print("Connecting to Api : ");
     Serial.print(host);
     Serial.println(url);
 
     if(client.connect(host,httpsPort))
     {
     Serial.println("Connection Succeeded to Api !");
     }
     else
     {
      Serial.println("Connection Failed to Api !");
     }

     if(!mfrc522.PICC_IsNewCardPresent())
     {
       // Look for new cards
       return;
     }
  
     if(!mfrc522.PICC_ReadCardSerial())
     {
        // Select one of the cards
        return;
     }   

     Serial.print("Read UID tag :"); // Show UID on serial monitor===Debug statement
  
     for(byte i = 0; i < mfrc522.uid.size; i++)
     {
        Rfid_tag_ID.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
        Rfid_tag_ID.concat(String(mfrc522.uid.uidByte[i], HEX));
     }
  
     Rfid_tag_ID.toUpperCase(); //Read ID Convert to upperCase 
      
     Serial.println(Rfid_tag_ID); //Debug statement

 
     if(Rfid_tag_ID!="")  // function to receive tag ID coming from Arduino
     {    
          digitalWrite(Rfid_read_status,HIGH);
          tone(buzzerPin,1000);  // attedance fill up sound we need to set different
          delay(1000);
          noTone(buzzerPin);
          Rfid_tag_ID.trim();
          Serial.println("after:"+Rfid_tag_ID);
          
      /********************/
          
          /* Send Received ID to API Server for validation */
          
         String postReq = String("POST "+ url + " HTTP/1.1\r\n" +"Host: " + host + "\r\n" +"User-Agent: JAMES 4.0\r\n" +"Content-length: 31\r\n"+"Content-Type: application/json\r\n" +"Connection: close\r\n\r\n" +"{\"data\":\""+String(Rfid_tag_ID)+"\"}"); 
         //Serial.println(postReq);
         client.print(postReq);
         
         Api_Response = client.readString();
         
         Serial.println("Server Response : " + Api_Response);  //HTTP/1.1 200 OK ..... { name : "firstname lastname"} All Response Given by API server in single String
        
         if(Api_Response.startsWith("HTTP/1.1 200 OK")) // validating  Response from Server with HTTP/1.1 200 OK
         {     
               Api_Response = Api_Response.substring(Api_Response.lastIndexOf(':')+2,Api_Response.lastIndexOf('"'));
               Serial.println(Api_Response);  // Debug statement: here name of user will come we need to print it in display
               digitalWrite(Rfid_read_status,LOW);
               digitalWrite(Response_status,HIGH);
//               /* forward response to arduino */
//               forwardResponse(String(Rfid_tag_ID+"==OK"));
               
              /* buzzer part */
               tone(buzzerPin,1000);  // attedance fill up sound we need to set different
               delay(2000);
               noTone(buzzerPin);
         }
         else
         {     


               Api_Response = Api_Response.substring(Api_Response.lastIndexOf(':')+2,Api_Response.lastIndexOf('"'));
               Serial.println(Api_Response);  // Debug statement: here name of user will come we need to print it in display

               /* forward response to arduino */
               //Serial.println("else  block");
               
//               forwardResponse(Api_Response);

               /* buzzer part */
               tone(buzzerPin,1000);  // invalid ID sound we need to set it different
               delay(2000);
               noTone(buzzerPin);
         }

        }
        else
        {
            Serial.println(" ");
            Serial.println("Scan New Card...");
            delay(1000);
        }
        
        Api_Response = "";
        Rfid_tag_ID = "";

//        Serial.println("API :"+Api_Response+" "+"RFid_tag_ID :"+Rfid_tag_ID);
    }
   
    digitalWrite(Internet_status,LOW);
    Serial.println();
    Serial.println("Internet status = NOT_CONNECTED"); // Debug statement

    /* buzzer part */
    
    tone(buzzerPin,1000); // here we need to set different sound because in between service down  
    delay(3000);
    noTone(buzzerPin);
    
    Serial.println();
    Serial.println("Connection lost trying to reconnect...");
    
 
   if(WiFi.status()== WL_DISCONNECTED)
   {   
    
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
