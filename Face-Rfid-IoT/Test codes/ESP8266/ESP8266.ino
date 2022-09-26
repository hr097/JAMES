
//ESP8266

#include <SoftwareSerial.h>

void setup() {
  // put your setup code here, to run once:
  
Serial.begin(115200);
Serial1.begin(115200);

Serial.println(" ");
Serial.println("Esp8266 is ready for receiving data...");
Serial1.println("Esp8266 : will you please start sending data ?");

while (!Serial) {
 // wait for serial port to connect. Needed for native USB port only
 Serial.print(".");
}
}
String str = "";

void loop() {
  // put your main code here, to run repeatedly:
 if(Serial.available()) {
 str =  Serial.read();
 Serial.write(Serial.read());
 Serial1.println(str);
 Serial1.println("Esp8266:resending data you sent me.");
 }

}
