# GpsDataSendToWebsiteWithNodemcu

# Introduction
Merhaba, bu projede nodeMCU(ESP8266) kullanarak GPS verilerini web server'a gönderdim. 
<br>Yani sensörden aldığım verileri internet aracılığıyla veritabanına kaydettim. Şimdi sizlere bunu nasıl yaptığımı açıklamak istiyorum.

* #### Öncelikle nodeMCU ' ya nem ve sıcaklık sensörünü bağlamamız gerekli. Kablo uçlarını resimdeki çıkışlara bağlayalım

* #### Daha sonra Arduino IDE programını açıp, nodeMCU dosyasını programlamamız lazım.
(Not: Eğer Windows kullanıcısıysanız 'Microsoft Store' ye giriş yaparak Arduino yazısını aratırsanız, Microsoft Store' den programı kurabilirsiniz, bu şekilde kurmak daha pratik.)
![5](https://user-images.githubusercontent.com/50117470/77775186-42033f80-705d-11ea-8c36-3d14e5ffaa0c.PNG)

# Codes
* #### Bu kısımda öncelikle kütüphaneleri include ettik. Daha sonra nodeMCU çıkış pinlerini belirledik, ve nodeMCU' nun kullanacağı internetin wifi ismini ve şifresini girdik. host değişkeninede verileri göndereceğimiz web sitesini yazıyoruz.
![1](https://user-images.githubusercontent.com/50117470/88455325-20845a00-ce7d-11ea-9848-b94678856f81.png)

* #### setup() :coffee:
* #### Bu kısımda nodeMCU, sensör verilerini almaya başlıyor, daha sonrasında WiFi bağlantısını gerçekleştiriyor. WiFi adı ve şifresinde yanlışlık olursa bu kısımda hata verir ve bağlantı gerçekleşmez. Eğer bilgiler doğruysa 'WiFi bağlantısı gerçekleştirildi' yazısı Seri Port ekranına gelir.
![1](https://user-images.githubusercontent.com/50117470/88455382-85d84b00-ce7d-11ea-8088-4055a4a18c06.png)

* #### Loop() :coffee:
* #### İlk başta nodeMCU 'nun port testini yaptık. 80 portuna bağlanıp bağlanmadığını test ettik.
* #### Daha sonra While döngüsü oluşturduk. While döngüsü oluşturmamızda ki amacımız; GPS uyduya bağlanıpta, GPS konum verilerini her güncellediğinde bunları değişkenler de saklamak. `x`, `y`, `spid`, `sat` adında tanımladığımız değişkenlere, GPS 'ten gelen verileri `boylam` `enlem` `hız` `uydu bağlantı sayısı` olarak sırasıyla tuttuk. Sonrasında ise bu değerleri Seri Port ekranına yazdırdık.
![1](https://user-images.githubusercontent.com/50117470/88455519-88877000-ce7e-11ea-8759-4bcc42bc2f47.png)

* #### Son kısımda ise oluşturduğumuz `insert.php` ' ye parametre gönderiyoruz. `x`, `y`, `spid`, `sat` değişkeninde tuttuğumuz verileri veritabanına gönderiyoruz. Daha sonra veri yazma işi başarıyla gerçekleştikten sonra bağlantıyı kapatıyoruz. 
![1](https://user-images.githubusercontent.com/50117470/88455850-a5717280-ce81-11ea-8866-f1f7578124c0.png)

# nodeMCU Breadboard Şeması
![devre](https://user-images.githubusercontent.com/50117470/88455989-c8e8ed00-ce82-11ea-8d42-92d7a6c560c7.png)


