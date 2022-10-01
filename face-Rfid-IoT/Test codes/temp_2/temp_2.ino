
#include <SoftwareSerial.h>


String str="Hey This is Esp8266 Over N out !";


void setup(){
Serial1.begin(115200);
}


void loop()
{
Serial1.println(str);
}
