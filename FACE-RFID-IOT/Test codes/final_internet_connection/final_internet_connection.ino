#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>


bool temp=true;

//const int httpsPort = 80;
//const char* host = "killing-winters.000webhostapp.com";
const char* serverName = "https://killing-winters.000webhostapp.com/api/add/{\"data\":\"rh234\"}";


char WIFI_SSID[3][30]={"Jeshvi","Hotspot","Harshil's iphone"};
char WIFI_PASSWORD[3][30]={"Winterisgreat97","12345678","hr141141"};

char connection_req_ssid[30];
  
int connection_index = 0;

#define Internet_status 0
#define Attendance_status 2

// 0 2 4 12 16 GPIO free pins 

bool establish_secure_connection(unsigned long int baud_rate,String Ssid,String Password)
{

  int counter = 1,i=0;
  bool connection_flag=true;
  char connection_req_ssid[30];
  
  Serial.begin(baud_rate);
  WiFi.begin(Ssid,Password);
 
  delay(1000);
  
  Serial.println();
  Serial.printf("Connecting to %s ",WIFI_SSID[connection_index]);
  
  while(WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
    counter = counter + 1;
    if(counter>30)
    {
      connection_flag=false;
      break;
    }
    connection_flag=true;
  }

  if(connection_flag==true)
  {  
     delay(200);
     Serial.println();
     Serial.printf("Connected to %s with IP address : ",WIFI_SSID[connection_index]);
     Serial.print(WiFi.localIP());

     //System Lights configuration

     pinMode(Internet_status,OUTPUT);
     pinMode(Attendance_status,OUTPUT);

     digitalWrite(Internet_status,LOW);
     digitalWrite(Attendance_status,LOW);
  }
  else
  {   
      delay(200);
      Serial.println();
      Serial.printf("Failed to connect : %s",WIFI_SSID[connection_index]);
      delay(200);
      
      if(connection_index<2)
      {   
        i=0;
        while(WIFI_SSID[connection_index+1][i]!='\0')
        {
          connection_req_ssid[i]=WIFI_SSID[connection_index+1][i];
          i++;
        }

         connection_req_ssid[i] ='\0';
      }
      else
      {
        i=0;
        while(WIFI_SSID[0][i]!='\0')
        {
          connection_req_ssid[i]=WIFI_SSID[0][i];
          i++;
        }

         connection_req_ssid[i] ='\0';
  
       }

     delay(500);
     Serial.println();
     Serial.printf("Trying to connect :%s",connection_req_ssid);
     delay(500); // necessary to write here otherwise not work because below return execute faster 
  }


 return (connection_flag);
}

void setup()
{
  while(!establish_secure_connection(115200,WIFI_SSID[connection_index],WIFI_PASSWORD[connection_index]))
  {    
     
     if(connection_index<2)
      {
      connection_index = connection_index + 1; 
      
      }
      else
      {
        connection_index = 0;
      }
  }
}
   
void loop()
{   

   while(WiFi.status()==WL_CONNECTED)
   {    
     Serial.println();
     Serial.println("Internet Service Active !");
     
       /* TEAM D code : parth + harshil */
     if(temp==true)
     {
      WiFiClient client;
      HTTPClient http;
      
      // Your Domain name with URL path or IP address with path
      http.begin(client,serverName);

      // Specify content-type header
      //http.addHeader("Content-Type", "application/x-www-form-urlencoded");
      // Data to send with HTTP POST


      http.addHeader("Content-Type", "application/json");
      String httpRequestData = "{\"data\":\"jsn1008\"}";           
      
      // Send HTTP POST request
      //int httpResponseCode = http.POST(httpRequestData);
      
      // If you need an HTTP request with a content type: application/json, use the following:
      
     
      int httpResponseCode = http.POST(httpRequestData);

      // If you need an HTTP request with a content type: text/plain
      //http.addHeader("Content-Type", "text/plain");
      //int httpResponseCode = http.POST("Hello, World!");
     
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
        
      // Free resources
      http.end();
    temp=false;
     }

      /* code application here TEAM A */
      
     digitalWrite(Internet_status,HIGH);
     delay(1500);
   }

   
   
    delay(500);
    digitalWrite(Internet_status,LOW);
    Serial.println();
    Serial.println("Internet Service Down !");
    
    delay(200);
    Serial.println();
    Serial.println("Connection lost trying to reconnect...");
    
    delay(200);
 
   if(WiFi.status()==WL_DISCONNECTED)
   {   
    
      while(!establish_secure_connection(115200,WIFI_SSID[connection_index],WIFI_PASSWORD[connection_index]))
      { 
        if(connection_index<2)
        {
        connection_index =  connection_index + 1; 
        }
        else
        {
        connection_index = 0;
        }
      }
   }
   
}
