#include <SoftwareSerial.h> //SERIAL COMMUNICATION WITH ARDUINO UNO R3
#include <ESP8266WiFi.h> // CONNECTING WITH WIFI 
#include <WiFiClientSecure.h> // COMMUNICATION WITH INTERNET API'S

SoftwareSerial Esp8266_SoftSerial (0,2); //RX, TX 

#define buzzerPin 16  // buzzer
#define Internet_status 4 // Internet_connection Active/Inactive
//#define Response_status 12

// except: [0 2 4 12] all GPIO [16] is free 

/*Global variable for data storage in serial communication */


/*Internet Communication  */

String url = "/api/add/40kbno9qesgzah1k5reiznwtr9yco2vlfgzw9nu5";
const char* host = "killing-winters.000webhostapp.com";
const int httpsPort = 443;


/* Wifi Communication */

char WIFI_SSID[3][30]={"winter","Jeshvi","winter_stark"};
char WIFI_PASSWORD[3][30]={"password","Winterisgreat97","12345678#"};
char connection_req_ssid[30];
int connection_index = 0;

WiFiClientSecure client; // Use WiFiClientSecure class to create TLS connection


void setup() {

  
pinMode(buzzerPin,OUTPUT);
digitalWrite(buzzerPin,LOW);

//pinMode(Response_status,OUTPUT);
//digitalWrite(Response_status,LOW);

/*Open Serial communication (NodeMcu-Arduino) */
Esp8266_SoftSerial.begin(9600);

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


bool establish_secure_connection(unsigned long int baud_rate,String Ssid,String Password)
{
   
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
     
     client.setInsecure(); //making connection Insecure to send data on api

     /* making connection to API */
     
     Serial.print("Connecting to Api : ");
     Serial.print(host);
     Serial.println(url);
 
     if(client.connect(host, httpsPort))
     {
     Serial.println("Connection Succeeded to Api !");

     /* System start Indication */

     Serial.println(" ");
     Serial.println("Esp8266 is ready to receive data and sending that to API for verification."); // we can change to LED/LCD Print
     Serial.println(" ");
     
     }
     else
     {

      /* System failed Indication */

      Serial.println(" ");
      Serial.println("Connection Failed to Api !");
      Serial.println("Something went wrong !");
      Serial.println(" ");
      
     }
     
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



bool receiveTagId(String &str)
{ 
  
}

void forwardResponse(String Res)
{
  /* Forwarding Reponse given by API to Arduino */
   Esp8266_SoftSerial.print(String(Res+"\n"));

   Serial.println(String("I have forwarded the Response : "+Res));

}
String Rfid_tag_ID="";
String Api_Response="";

void loop() {
  

   while(WiFi.status()==WL_CONNECTED)
   {    
        Serial.println();
     
        digitalWrite(Internet_status,LOW);
        Serial.println();
        Serial.println("Internet status = CONNECTED"); // Debug statement
        Serial.println("before:"+Rfid_tag_ID);

        /* RFID RECEIVE */
        
          char Reg_c='-';
          String bufferStorage;
         
          while(Esp8266_SoftSerial.available () >0)
          {
              Reg_c = Esp8266_SoftSerial.read();
              if(Reg_c =='\n'){break;}
              else{bufferStorage+=Reg_c ; }
          }

          if(Reg_c =='\n')
          {

             if(bufferStorage!="")
             Rfid_tag_ID = bufferStorage;
    
             Serial.println(String("Received Tag ID from Arduino : "+ Rfid_tag_ID));
          }
          
          //Reset the buffer storage area
          Reg_c=0;
          bufferStorage="";
        
        /***************/

        
        if(Rfid_tag_ID!="")  // function to receive tag ID coming from Arduino
        {
          
          Rfid_tag_ID.trim();
          Serial.println("after:"+Rfid_tag_ID);
          /* Send Received ID to API Server for validation */

         String postReq = String("POST "+ url + " HTTP/1.1\r\n" +"Host: " + host + "\r\n"+"Content-length: 147\r\n"+"Content-Type: application/json\r\n"+"{\"data\":\""+String(Rfid_tag_ID)+"\"}"); 
         Serial.println(postReq);
         delay(1000);
         client.print(postReq);
         
         Api_Response = client.readString();
         
         Serial.println("Server Response : " + Api_Response);  //HTTP/1.1 200 OK ..... { name : "firstname lastname"} All Response Given by API server in single String
        
         if(Api_Response.startsWith("HTTP/1.1 200 OK")) // validating  Response from Server with HTTP/1.1 200 OK
         {     
               Api_Response = Api_Response.substring(Api_Response.lastIndexOf(':')+2,Api_Response.lastIndexOf('"'));
               Serial.println(Api_Response);  // Debug statement: here name of user will come we need to print it in display

               /* forward response to arduino */
               forwardResponse(String(Rfid_tag_ID+"==OK"));
               
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
               Serial.println("else  block");
               
               forwardResponse(Api_Response);

               /* buzzer part */
               tone(buzzerPin,1000);  // invalid ID sound we need to set it different
               delay(2000);
               noTone(buzzerPin);
         }

        }
        else
        {
            Serial.println(" ");
            Serial.println("Waiting for Receiving Tag ID from Arduino UNO R3...");
            delay(1000);
        }
         Api_Response = "";
         Rfid_tag_ID = "";

         Serial.println("API :"+Api_Response+" "+"RFid_tag_ID :"+Rfid_tag_ID);
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
