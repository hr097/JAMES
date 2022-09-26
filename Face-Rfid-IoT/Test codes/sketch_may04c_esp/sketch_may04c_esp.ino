void setup() {
// Open serial communications and wait for port to open:
Serial.begin(115200); // for for getting tag id
Serial1.begin(115200); // for sedning reponse
 Serial.write("connectionwith arduino uno ");
while (!Serial) {
 // wait for serial port to connect. Needed for native USB port only
 Serial.write(".");
}

}

int count = 0;
void loop() { // run over and over
if (Serial.available()) {
Serial.write(Serial.read());
}

if(count==2)
Serial1.println("Response with ok");

count++;
}
