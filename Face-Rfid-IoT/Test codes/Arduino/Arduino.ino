
// Arduino code



#include <SoftwareSerial.h> // ARDUINO WITH ESP COMMUNICATION

SoftwareSerial espSerial(7,8); // RX=8 TX=7 // We use this pin for communication with esp8266 wifi module 

void setup() {
  // put your setup code here, to run once:
Serial.begin(115200); // Initiate a serial communication with baud rate 115200
espSerial.begin(115200);  // Initiate a serial communication with baud 

Serial.println();
Serial.println(""); 
Serial.println("Arduino is ready to send data...");
pinMode(10,OUTPUT);
pinMode(11,OUTPUT);
digitalWrite(10,HIGH);
digitalWrite(11,HIGH);

Serial.println();
espSerial.println(" ");
espSerial.println("Arduino : Hey,ESP8266 should i start sending data packets ? ");
}

void loop() {
  // put your main code here, to run repeatedly:

  Serial.println("Rfid Card readed !");
  Serial.println("Now i will send this card id to esp8266");
  espSerial.println(String("34 54 54 10"));
  digitalWrite(10,LOW);
  delay(2000);
  digitalWrite(10,HIGH);
  Serial.println("Now i will wait for response of esp8266");

  //delay(3000);

  if(espSerial.available())
  {
    Serial.println(espSerial.read());

    if(espSerial.read()=="34 54 54 10")
    {
      digitalWrite(11,LOW);
      delay(2000);
      digitalWrite(11,HIGH);
    }
  }
}
