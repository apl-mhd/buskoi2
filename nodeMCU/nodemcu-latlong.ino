/*
 * Testing 
 */

// Libraries 
#include <ESP8266HTTPClient.h>
#include<ESP8266WiFi.h>

void setup()
{
  Serial.begin(9600);
  WiFi.begin("orko","12345678");  // add ssid and password here

  while(WiFi.status() !=WL_CONNECTED)
  {
    delay(500);
    
    Serial.println("Waiting for connection");
  }
  
  Serial.println("Connected...");
  delay(1000);
  if (WiFi.status() ==WL_CONNECTED)
  {
    Serial.println("Wi-Fi Connected!");
  }
  
  delay(2000);
  Serial.println("Sending message to server espcomm");
  delay(5000);
  int res=sendmessage("Hi,Server");
  delay(1000);
  if (res==1)
  {
    
    Serial.println("Send Successfully");
  }
  else
  {
    
    Serial.println("Error on Server side or client side.");
  }
  
}

void loop()
{

  delay(5000);
  sendmessage("aa");
  
}




int sendmessage(String d)
{
  int sres;
  int net;
  if (WiFi.status()==WL_CONNECTED)
  {
    HTTPClient http;
    http://localhost:8080/buskoi/insert-lat-long.php?logical_id=2&lat=1&long=1

    String logical = "1";
    String lat = "2";
    String longi = "3";
    
    //String url="http://xyz.000webhostapp.com/writefile.php?data="+d;
  // String url="http://localhost:8080/buskoi/insert-lat-long.php?logical_id="+logical+"&"+"lat="+lat+"&"+"long="+longi;
 //  String url="http://localhost:8080/buskoi/insert-lat-long.php?logical_id="+logical;


 http.begin("http://localhost:8080/buskoi/insert-lat-long.php");
     http.begin("http://ce9a72ce.ngrok.io/buskoi/insert-lat-long.php");      //Specify request destination
   http.addHeader("Content-Type", "application/x-www-form-urlencoded");  //Specify content-type header
 
   int httpCode = http.POST("logical_id=a&submit=enter");   //Send the request
   String payload = http.getString();                  //Get the response payload
 
   Serial.println(httpCode);   //Print HTTP return code
   Serial.println(payload);    //Print request response payload
 
   http.end();  //Close connection
  }

  return 0;
}