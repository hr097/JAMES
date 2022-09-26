
#include <SoftwareSerial.h>

// this code for arduino

SoftwareSerial espSerial(7,8); // RX= 8 TX=7 

String str;

void setup(){
Serial.begin(115200);
espSerial.begin(115200);  
delay(2000);
}
void loop()
{
str =String("coming from arduino: okay ");
espSerial.println(str);
delay(1000);
}
