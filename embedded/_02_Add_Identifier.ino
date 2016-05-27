/* Version 0.02
   Code for server connection
   and basic device-service communucation.
   Added switch-based trigger for sending data.
   June 25, 2015
*/

#include <Dhcp.h>
#include <Dns.h>
#include <Ethernet.h>
#include <EthernetClient.h>
#include <EthernetServer.h>

#include <SPI.h>

//Set Service Variables Here
String serial = "$2y$10$qAAtouhi42roeokMePopzuGxgsr.cm3gukFcxCo5qVDjtMdzhIFRW"; //Assigned in in your account
String pin = "$2y$10$DSimsSLNPd26rKcSzStWquZjsm2iAeveQQV49OXLWX04nn7xgoTW2"; //Assigned in your account

//Set Local Device Variables Here

//Set up internet capabilities
byte mac_addr[] = {0xFE, 0xDD, 0xBE, 0xEF, 0xFE, 0xE1};
/*byte ip_addr[] = {192, 168, 5, 9};*/
char server_addr[] = "riot.cloudapp.net"; //Service URL. Not the same as web URL.{191,236,50,144}

EthernetClient client;

void setup() {
Serial.begin(9600);

//Set Input & Output Locations Here
pinMode(7, INPUT);
pinMode(3, OUTPUT);

  Ethernet.begin(mac_addr);
  delay(1000);
  
  IPAddress thisIP = Ethernet.localIP();
  Serial.print("IP address: ");
  Serial.println(thisIP);
  Serial.println("Waiting to connect to server...");

}

void loop() {
int on = digitalRead(7);

String bite = "11"; //This is the data you want to be sent. Can be any data type.

String add = "HEAD /?id=";
add += serial;
add += "&pin=";
add += pin;
add += "&bit=";
add += bite;
add += " HTTP/1.0";

if (on == HIGH){
  Serial.println("Connecting to server...");
  int conn = client.connect(server_addr, 80);  
  client.println(add);
  client.println();
  
  if(conn == 1){
  Serial.println("Connection to server established");
  }
  else {
        Serial.print("Request to server failed. Error code: ");
        Serial.println(conn);
        //while(true);
      }
  digitalWrite(3, HIGH);
  Serial.println(add);
  }

else {
  digitalWrite(3, LOW);
}

/*if(client.available()) {;     //Recommended you do not include this in your code.    
  char letter = client.read();  //Only include this if you want to 
  Serial.print(letter);       //see what the HEAD request returns. You cannot send another request while this is happening.
}*/

if(!client.connected()) {
  Serial.println("Client not available");
  //Serial.println("Complete. Disconnecting from server.");
}
client.stop();

delay(1000); //This controls how often data is sent to the server. Recommended at least one second (1000ms) to prevent client request overlaps.
}



