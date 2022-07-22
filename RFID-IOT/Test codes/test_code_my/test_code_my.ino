#include <SoftwareSerial.h>

SoftwareSerial espSerial(7,8); //TX RX

String data = "UID TAG : 1008";

void handshake()
{
    espSerial.println("Esp8266 : Hey , Buddy I am Arduino UNO R3.");
}

void setup()
{
Serial.begin(115200);
espSerial.begin(115200);
handshake();
Serial.println(" ");
Serial.println("Arduino : I am ready to send.");
while (!Serial) {;}  // wait for serial port to connect. Needed for native USB port only

}

void send_Data()
{
  espSerial.println(data);
}

void loop()
{ 
  send_Data();
  Serial.println("Arduino : Tag id has been sent !");
  delay(5000);
}
