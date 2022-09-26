#include<ESP8266WiFi.h> // we need to include library file for inbuilt function use of wifi

const char* ssid = "MSCIT-5"; // here you give name to your esp module station name which will be available on your phone just like your wifi name
const char* password = "root@123"; // for security we set password who can connect to your system and who don't

WiFiServer server(80);// port 80 is default for wifi in devices for we need to communicate to server using port 80

int ROLLNUMBERS[10]={1,2,3,4,5,6,7,8,9,10};
char ATTENDANCE[10]={'A','A','A','A','A','A','A','A','A','A'};
int i=0;
// actual webpages to be created

char HTML[] PROGMEM = R"=====(
 // archit webpage code goes here
)=====";

void resetAttendance()
{
  i=0;
  for(i=0;i<10;i++)
  {
    ROLLNUMBERS[i]=(i+1);
    ATTENDANCE[i]='A';
  }
}
void fillUpAttendance(int Rollno)
{ 
    ATTENDANCE[Rollno-1]='P';
}

void newWebPageTimer()
{
  delay(60000);
}



void setup() 
{
  resetAttendance();
  delay(1000);
  WiFi.softAP(ssid, password); // start interacting & create wifi signal for Devices which need to be connected 
  server.begin(); // esp server(at port 80) stated with station(192.168.4.1)for communication with client in Your case it might be different
}


void loop()
 {
  
  WiFiClient client = server.available(); // if server is available on device then module will create 1 client of that server
  if (!client) // if client not found then exit this loop and search again for client
  {
    return;
  }

  while(!client.available()) // if available then wait for 1 microSeconds
  {
    delay(1);
  }
  
  String req = client.readStringUntil('\r'); // accepting data packets fsent by the server which is sent by 192.168.4.1 (e.g. LED_1/on)
  client.flush(); //now close the client connection until server sent another request

  int indexOfLastSlash =  req.lastIndexOf("/");
  if(indexOfLastSlash!=-1)
  {
    String rollNo = req.substring(req.lastIndexOf("/")+1);
    
    if(rollNo=="submit/adminhr")
    {
      // new attendance data webpage & reset function
        String HTML2 = "";
        client.print(HTML2); // make webpage means it will print all HTML code to 192.168.4.1 station which is default for ESP 8266
        newWebPageTimer();
        resetAttendance();
    }
    else
    {
      int rno = rollNo.toInt();
      // mark as present
      fillUpAttendance(rno);
    }
      
  }
  else 
  {
    client.stop(); // here client req. will stop and it will return control back to new loop
    return;
  }
   
  client.flush(); 
  client.print(HTML); // make webpage means it will print all HTML code to 192.168.4.1 station which is default for ESP 8266
  delay(10); // for smoother response
}
