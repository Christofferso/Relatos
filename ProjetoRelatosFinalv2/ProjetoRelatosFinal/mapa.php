<script type="text/javascript">
window.history.go(1);
</script>

<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Ocorrências</title>
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="./styles/style.css">

    <!-- BOOTSTRAP 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    -->

    <!-- SCRIPTS 
    <script src="./js/main.js"></script>
    -->
    <!--Icon-->
    <link rel="icon" href="assets/logo.png">
    
    <!-- CHARTJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  </head>
  <body style="background:#ffe3e3;">

  <?php require './leyouts/side_menu.php'; 
  ?>

      <div class="container">
        <?php require './leyouts/header.php'; ?>

          <div class="container-map">
            <div class="content-map">
              <div id="map"></div>
            </div>
            
              <div class="report-form">
                <h1>Relate seu problema aqui!</h1>
                <form method="POST" action="processa_cad.php">

                  <input type="text" name="name" class="form-control" placeholder="Descreva seu problema">

                  <input type="text" name="address" class="form-control" placeholder="Digite o número e o Logradouro do local de referência">
                              
                  <select name="select" class="form-control">
                    <option value="">Selecione o problema</option>
                    <option value="enchente">Enchente</option>
                    <option value="poluicao">Poluição</option>
                    <option value="iluminacao">Iluminação</option>
                    <option value="buraco">Buraco</option>
                    <option value="engarrafamento">Engarrafamento</option>
                  </select>
                  <input class="btn btn-danger" id="report-btn" name="save_marker" type="submit" value="Registrar"><br><br>
                </form>
              </div>
            </div>
            
      </div> 

      <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };  
      if(navigator.geolocation){
				navigator.geolocation.getCurrentPosition(function(position){
          var latitude = position.coords.latitude;
          var longitude = position.coords.longitude; 	 	 	
        
          document.cookie = "lat ="+ latitude; 
          document.cookie = "lng ="+ longitude; 
				})
			}
      
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-23.97458090873452, -46.42523037490869),
          zoom: 12,
          mapTypeId: 'hybrid'
      });
        var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP or XML file
        downloadUrl('resultado.php', function(data) {
          var xml = data.responseXML;
          var markers = xml.documentElement.getElementsByTagName('marker');
          Array.prototype.forEach.call(markers, function(markerElem) {
          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var point = new google.maps.LatLng(
              parseFloat(markerElem.getAttribute('lat')),
              parseFloat(markerElem.getAttribute('lng')));
          
          var latf = parseFloat(markerElem.getAttribute('lat'));
          var longf = parseFloat(markerElem.getAttribute('lng'));
        
          var infowincontent = document.createElement('div');
          
          var strong = document.createElement('strong');
          strong.textContent = name;
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var text = document.createElement('text');
          text.textContent = address
          infowincontent.appendChild(text);
          var icon = customLabel[name] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            label: icon.label
          });
          var contador = 1; 

          //Função para exibir e fechar o círculo vermelho
          //Resolva com o refresh
          
            marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
            if(contador == 1){
              // Add the circle for this city to the map.
              var cityCircle = new google.maps.Circle({
              strokeColor: '#e30b21',
              strokeOpacity: 0.9,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.1,
              map: map,
              center: {lat: latf, lng: longf},
              radius: (1 * 145)   
              });
              contador = contador + 1;
            }
            
            else{
              //circle.setMap(null); 
              contador = contador - contador;
              location.reload();
              
            }
          });
        });
      });
      var citymap = {
        sampa: {
          center: {lat: document.cookie['lat'], lng: document.cookie['lng']}
        }
      };
    }
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
      
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    } 

    function doNothing() {}
  </script>

  
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXWDDpDOXoNtsfBwrC87YDXtQU5UX8FTM&callback=initMap">
  </script>
    
</body>
</html>