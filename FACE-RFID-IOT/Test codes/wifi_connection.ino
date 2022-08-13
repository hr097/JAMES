#include <ESP8266WiFi.h>

#define WIFI_SSID "Dhaval" //your wifi name
#define WIFI_PASSWORD "Dhaval2015" //wifi password
  
void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  Serial.println();
  Serial.print("Connecting to AP");
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  while (WiFi.status() != WL_CONNECTED){
    Serial.print(".");
    delay(200);
  }
  Serial.println("");
  Serial.println("WiFi connected.");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.println();

}

void loop() {
  // put your main code here, to run repeatedly:

}
