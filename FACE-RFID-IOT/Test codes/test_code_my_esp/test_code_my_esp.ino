#include <SoftwareSerial.h>

String data= "";

void receive_Data()
{
  
if(Serial.available())
{
 data = Serial.read() ;
 
 while(data=="")
 {
  data = Serial.read() ;
 }

 if(data!=""&&data=="UID TAG : 1008")
 {
  Serial.println("Esp8266 : tag id received !");
  Serial.println(data);
 }
}

}


void resend_Data()
{
  Serial1.println(data);
  Serial.println("Esp8266 : Response sent back to arduino.");
}

void handshake()
{
   Serial1.println("Esp8266 : Hey , Buddy I am Esp 8266.");
}

void setup()
{
Serial.begin(115200);
Serial1.begin(115200);
handshake();
Serial.println(" ");
Serial.println("Esp8266 : I am Ready to Receive !");
while (!Serial) {;}  // wait for serial port to connect. Needed for native USB port only
}



void loop()
{ 
  receive_Data();
  resend_Data();
}
