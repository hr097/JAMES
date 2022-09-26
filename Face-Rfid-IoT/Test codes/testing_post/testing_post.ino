#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

const char* ssid = "Jeshvi";
const char* password = "Winterisgreat97";

//Your Domain name with URL path or IP address with path
const char* serverName = "killing-winters.000webhostapp.com/api/add";



void setup() {
  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

}

void loop() {
  
  //Send an HTTP POST request every 10 minutes

    if(WiFi.status()== WL_CONNECTED){
      WiFiClient client;
      HTTPClient http;
      
      // Your Domain name with URL path or IP address with path
      http.begin(client, serverName);

      // Specify content-type header
      http.addHeader("Content-Type", "application/json");
      
      // Data to send with HTTP POST

      delay(5000);
      Serial.println("\n{\n\"api_token\":\"40kbno9qesgzah1k5reiznwtr9yco2vlfgzw9nu5\",\n\"Total_UID\": 3,\n\"data\":[\"05 8F SB AB AB\",\"05 8F SB AB AB\",\"05 8F SB AB AB\"]\n}");
      int httpResponseCode = http.POST("{\"api_token\":\"40kbno9qesgzah1k5reiznwtr9yco2vlfgzw9nu5\",\"Total_UID\":\"3\",\"data\":\"[\"05 8F SB AB AB\",\"05 8F SB AB AB\",\"05 8F SB AB AB\"]\"}");          
      
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
        
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
}
