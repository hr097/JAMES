#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>


//const char* fingerprint = "f31bb747295939c1917db461da4dec0d8ce1e7c1";  

bool temp=true;

//String cardID = "59 8D 64 D5";
String cardID = "73 7E 8E 02";
String url = "/api/add/40kbno9qesgzah1k5reiznwtr9yco2vlfgzw9nu5";
const char* host = "killing-winters.000webhostapp.com";
const int httpsPort = 443;

WiFiClientSecure client; // Use WiFiClientSecure class to create TLS connection


char WIFI_SSID[3][30]={"Jeshvi","SkyBit","winter_stark"};
char WIFI_PASSWORD[3][30]={"Winterisgreat97","Mahakal@103","12345678#"};
char connection_req_ssid[30];
int connection_index = 0;

#define Rfid_status 4 // indicates whether RFID reader read the tag
#define Internet_status 12 // indicates intertnet connection  online/offline status
#define Attendance_status 16 // indicates Attedance taken status
#define buzzerPin 0 // indicates Buzzer pin

// 0 2 4 12 16 GPIO free pins 

bool establish_secure_connection(unsigned long int baud_rate,String Ssid,String Password)
{
   //System Lights configuration

   pinMode(Internet_status,OUTPUT);
   pinMode(Attendance_status,OUTPUT);
   pinMode(Rfid_status,OUTPUT);
   pinMode(buzzerPin,OUTPUT);
     
  int counter = 1,i=0;
  bool connection_flag=true;
  char connection_req_ssid[30];
  
  Serial.begin(baud_rate);
  WiFi.begin(Ssid,Password);

  
  delay(1000);

  digitalWrite(Internet_status,HIGH);
  Serial.println();
  Serial.println("Internet Status HIGH");
  
  Serial.println();
  Serial.printf("Connecting to %s ",WIFI_SSID[connection_index]);
  
  while(WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
    counter = counter + 1;
    if(counter>30)
    {
      connection_flag=false;
      break;
    }
    connection_flag=true;
  }

  if(connection_flag==true)
  {  
     delay(200);
     Serial.println();
     Serial.printf("Connected to %s with IP address : ",WIFI_SSID[connection_index]);
     Serial.print(WiFi.localIP());

     digitalWrite(Internet_status,HIGH);
     digitalWrite(Attendance_status,HIGH);
     digitalWrite(Rfid_status,HIGH);
     digitalWrite(buzzerPin,HIGH);
     
     Serial.println();
     Serial.println("Sysetm lights HIGH");

     delay(1500);
     
     client.setInsecure(); //making connection Insecure to send data on api
     
     Serial.print("Connecting to Api : ");
     Serial.print(host);
     Serial.println(url);
 
     if(client.connect(host, httpsPort))
     {
     Serial.println("Connection Succeeded to Api !");
     }
     else
     {
      Serial.println("Connection Failed to Api !");
     }
     

     digitalWrite(Internet_status,LOW);
     digitalWrite(Attendance_status,LOW);
     digitalWrite(Rfid_status,LOW);
     digitalWrite(buzzerPin,LOW);
     Serial.println("Sysetm lights LOW");

     
  }
  else
  {   
      delay(200);
      Serial.println();
      Serial.printf("Failed to connect : %s",WIFI_SSID[connection_index]);
      delay(200);
      digitalWrite(Internet_status,HIGH);
      Serial.println("Internet statucs HIGH");
      
      tone(buzzerPin,1000); // here we need to set different sound because it is tring to reconnect
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

void setup()
{
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
   
void loop()
{   

   while(WiFi.status()==WL_CONNECTED)
   {    
     Serial.println();
     Serial.println("Internet Service Active !");
     Serial.println("Internet statucs LOW");
     delay(2000); // need to remove
      /* TEAM D code : parth + harshil */

     if(temp==true)
     {
 
      String line = "";
      
     //if(client.verify(fingerprint,host))
     //{   
         //Serial.println();
         //Serial.println("API Authentication Status : Successful");
         
         client.print(String("POST ") + url + " HTTP/1.1\r\n" +
         "Host: " + host + "\r\n" +
         "User-Agent: JAMES 4.0\r\n" +
         "Content-length: 22\r\n"
         "Content-Type: application/json\r\n" +
         "Connection: close\r\n\r\n" +
         "{\"data\":\""+cardID+"\"}"
         );
           

        line = client.readString();
        //Serial.println("Server Response : " + line);  //HTTP/1.1 200 OK ..... { name : "firstname lastname"}
        
        
//         while(client.connected())
//         {
//            // we can remove extra information (it is just HTTP 1.0 . 200 OK Reponse) we are doing deletion of that
//            line = client.readStringUntil('\n');
//            if(line=="\r")
//            {
//            Serial.print("headers received : ");  //NEED TO REMOVE
//            Serial.println("Data in header : " + line); 
//            break;
//            }
//          }

         if(line.startsWith("HTTP/1.1 200 OK"))
         {     
               line = line.substring(line.lastIndexOf(':')+2,line.lastIndexOf('"'));
               Serial.println(line);  // here name of user will come we need to print it in display
               digitalWrite(Rfid_status,LOW);
               Serial.println("Rfid status LOW");
               digitalWrite(Attendance_status,HIGH);
               Serial.println("Attedance status HIGH");

               tone(buzzerPin,1000);  // attedance fill up sound
               delay(2000);
               noTone(buzzerPin);
         }
         else
         {
               Serial.println("Invalid ID !");  // here name of user will come we need to print it in display

               tone(buzzerPin,1000);  // invalid ID sound
               delay(2000);
               noTone(buzzerPin);
         }
         
          delay(1500);
          digitalWrite(Attendance_status,LOW);
          Serial.println("Attedance status LOW");

        temp=false; // need to remove
     // } 
     //else
     //{
     //Serial.println();
     // Serial.println("API Authentication Status : Failed");
     // }

   
    }

     /* code application here TEAM A */
     
   }
   
    delay(500);
    digitalWrite(Internet_status,HIGH);
    Serial.println();
    Serial.println("Internet status HIGH");
    Serial.println("Internet Service Down !");
    tone(buzzerPin,1000); // here we need to set different sound because in between service down  
    delay(3000);
    noTone(buzzerPin);
    
    delay(200);
    Serial.println();
    Serial.println("Connection lost trying to reconnect...");
    
    delay(200);
 
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
