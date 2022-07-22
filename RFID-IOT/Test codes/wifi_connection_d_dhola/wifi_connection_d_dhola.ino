#include <ESP8266WiFi.h> // esp connection library
#include <ESP8266WiFi.h>

#define WIFI_SSID "winter_stark" //College Active Wifi Connection Name
#define WIFI_PASSWORD "12345678#" //wifi password of college networks


#define Internet_status 10
#define Attendance_status 11
#define System_status 12


//static unsigned int System_reset_counter = 64400 ; // 1 day hault time

void setup() {
  
  Serial.begin(115200); // Network Baud Rate set
  Serial.println(); 

  //start connection
  
  Serial.print("Connecting to AP(Access Point)");
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD); // send wifi connect request
   
  while(WiFi.status() != WL_CONNECTED){ // waiting for Access point to response
    Serial.print(".");
    delay(200);
  }

  // Other Network Information
  
  Serial.println("");
  Serial.println("WiFi connected.");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.println();


  //Lights configuration

  pinMode(Internet_status,OUTPUT);
  pinMode(Attendance_status,OUTPUT);
  pinMode(System_status,OUTPUT);

  digitalWrite(Internet_status,LOW);
  digitalWrite(Attendance_status,LOW);
  digitalWrite(System_status,LOW);
}

void loop() {
  
   Serial.println("Hello world !");
   /*if(WiFi.status()==WL_CONNECTED)
   {
     Serial.println("Internet Service Active!");
     digitalWrite(Internet_status,LOW);
     delay(1000);
    //rest of application working code
   }
   else
   {
    Serial.println("Internet Service Down !");
    digitalWrite(Internet_status,HIGH);
    delay(1000);
   }

   
   System_reset_counter = System_reset_counter - 1; 
   if(System_reset_counter>0)
   {
    delay(1000);
   }
   else
   {
    set system hault for 60 seconds  or any seconds you want
    delay(60000);
   }

   */
   
   
}
