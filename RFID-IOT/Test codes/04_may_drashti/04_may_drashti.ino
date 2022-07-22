#include <SPI.h> // SERIAL PERIPHERAL INTERFACE
#include <MFRC522.h> //RFID LIBRARY
#include <SoftwareSerial.h> // ARDUINO WITH ESP COMMUNICATION

#define SS_PIN 10 // SDA pin of rfid reader
#define RST_PIN 9 // Reset pin of rfid reader

String Rfid_tag_id= "",Response="";


SoftwareSerial espSerial(7,8); // RX= 8 TX=7 // We use this pin for communication with esp8266 wifi module 
MFRC522 mfrc522(SS_PIN, RST_PIN); // Create MFRC522 instance




void setup()
{
Serial.begin(115200); // Initiate a serial communication with baud rate 115200
espSerial.begin(115200);  // Initiate a serial communication with baud rate 115200 with esp8266

SPI.begin(); // Initiate SPI bus
mfrc522.PCD_Init(); // Initiate MFRC522

Serial.println();
Serial.println("RFID Reader is ready to scan cards…"); // LCD/LCD Print
Serial.println(" ");

delay(200); //we can remove it
}


void loop()
{
  
// Look for new cards
if (!mfrc522.PICC_IsNewCardPresent()){return;}

// Select one of the cards
if(!mfrc522.PICC_ReadCardSerial()){return;}

//Show UID on serial monitor

Serial.print("UID tag :");

for(byte i = 0; i < mfrc522.uid.size; i++)
{
//Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
//Serial.print(mfrc522.uid.uidByte[i], HEX);
Rfid_tag_id.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
Rfid_tag_id.concat(String(mfrc522.uid.uidByte[i], HEX));
}

Rfid_tag_id.toUpperCase();
Serial.println(Rfid_tag_id);
espSerial.println(String(Rfid_tag_id));

Serial.write(" ");
Serial.write("waiting for reponse from esp8266");

while(Response=="")
{
  if(Serial.available()) {
    Response=Serial.read();
    Serial.write(Serial.read());
  }
  else
  {
     Serial.write(".");
     delay(500);
  }
}

}
