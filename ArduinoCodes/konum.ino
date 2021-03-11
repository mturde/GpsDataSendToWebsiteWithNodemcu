#include <ESP8266WiFi.h>
#include <TinyGPS++.h>
#include <SoftwareSerial.h>
static const int RXPin = 4, TXPin = 5;
static float x,y,spid;
int sat;
TinyGPSPlus gps;
SoftwareSerial ss(RXPin, TXPin);
 
const char* ssid     = "nodemcu";
const char* password = "12345678";
const char* host = "muhammedturde.xyz";

void setup() {
  Serial.begin(115200);
  delay(100);
  Serial.println();
  Serial.println();
  Serial.print("İnternete Bağlanılıyor");
  
  
  WiFi.begin(ssid, password); 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  Serial.println("");
  Serial.println("WiFi bağlantısı gerçekleştirildi");  
}
 
void loop() {
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }

   while(ss.available()>0)
   {
    gps.encode(ss.read());
    if(gps.location.isUpdated())
    {
      x=gps.location.lat();
      y=gps.location.lng();
	    spid=gps.speed.kmph();
	    sat=gps.satellites.value();
      delay(3000);
      Serial.print("Enlem= ");      
      Serial.print(x,6);
      Serial.print(" ,Boylam= "); 
      Serial.println(y,6);
	    Serial.print("Cihazın kullandığı uydu sayısı= ");
	    Serial.println(gps.satellites.value());
	    Serial.print("Cihazın hızı= ");
	    Serial.println(spid,2);
	  String url = "/konum_servisi/insert.php?enlem=" + String(x,6) + "&boylam="+ String(y,6) +"&hiz=" + String(spid,3) + "&uydu_sayisi=" + String(sat); 
  Serial.print("Requesting URL: ");
  Serial.println(url);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  delay(500);
  while(client.available()){
    String line = client.readStringUntil('\r');
    //Serial.print(line);
  }  
  Serial.println();
  Serial.println("closing connection");
  delay(3000);
    }
   } 
}
