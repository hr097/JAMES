#include <SoftwareSerial.h>


String data = "";

void setup()
{
  
Serial.begin(115200); // Open serial communications and wait for port to open:
Serial1.begin(115200); // Open serial communications and wait for port to open:
while (!Serial) {; }// wait for serial port to connect. Needed for native USB port only

}

void loop()
{ 
  
if(Serial.available())
{
data=Serial.read();
Serial.write(Serial.read());
Serial1.println(data);
}

}
