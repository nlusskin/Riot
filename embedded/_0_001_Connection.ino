/* Version 0.01
   Code for server connection
   and basic device-service communucation
   June 25, 2015
*/


#include <Dhcp.h>
#include <Dns.h>
#include <Ethernet.h>
#include <EthernetClient.h>
#include <EthernetServer.h>
#include <EthernetUdp.h>

#include <SPI.h>

//Set Service Variables Here
String serial = "D0987654321"; //Assigned in developer account
String key = "0001";
String bite = "11";


byte mac_addr[] = {0xFE, 0xDD, 0xBE, 0xEF, 0xFE, 0xE1};
/*byte ip_addr[] = {192, 168, 5, 9};*/
char server_addr[] = "riot.cloudapp.net"; //Service URL. Not the same as web URL.

EthernetClient client;

void setup() {
  
  Serial.begin(9600);
  Ethernet.begin(mac_addr);
  delay(1000);
  
  IPAddress thisIP = Ethernet.localIP();
  Serial.print("IP address: ");
  Serial.print(thisIP);
  Serial.println();
  
  Serial.println("Connecting to server...");
  
    int conn = client.connect(server_addr, 80);
    if (conn == 1){
    Serial.println("Connection to server established");
    String cmd = "HEAD /?id=";
    cmd += serial;
    cmd += "&pin="; //Change package identifier to 'key'
    cmd += key;
    cmd += "&bit=";
    cmd += bite;
    //String cmd = "HEAD /";
    cmd += " HTTP/1.0";
    client.println(cmd);
    Serial.println(cmd);
    client.println();
  }
  else{
      Serial.print("Request to server failed. Error code: ");
      Serial.println(conn);
      while(true);
    }
}

void loop() {

if(client.available()) {

  char letter = client.read();
  Serial.print(letter);
}

if(!client.connected()) {
  Serial.println("Complete. Disconnecting from server.");
  client.stop();
  for(;;);
}
//delay(10000);
}



