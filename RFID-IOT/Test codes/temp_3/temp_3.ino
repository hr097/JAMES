#include <SoftwareSerial.h>


SoftwareSerial espSerial(7,8); //TX RX

String str="Hey This is Arduino UNO R3 Over N Out !";

void setup(){

espSerial.begin(115200);

}
void loop()
{
espSerial.println(str);
}
