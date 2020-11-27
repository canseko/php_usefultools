<?php
/* Para que este código funcione es necesario poner los datos de 
 * $sitekey y $secret especificos para el dominio donde se estárá
 * implementando el captcha 
 * 
 * En php es necesario tener instalada la libreria curl*/

$sitekey = "6Lf3su4ZAAAAAOS5pclaG98J8CRYD2yFOxNs1fXA";

if(!empty($_POST)){
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $g_recaptcha_response = $_POST["g-recaptcha-response"];
  $secret = "6Lf3su4ZAAAAAFbhiIRT7A8PzgYCJNU4rNByvwz_";

  $url = "https://www.google.com/recaptcha/api/siteverify";
  $data = [
    'response'  => $g_recaptcha_response,
    'secret'    => $secret
  ];

  /* PASO 4: Se verifica que la información del captcha ingresado sea correcta */
  $response = json_decode(httpPost($url, $data));

  //Verificación de captcha Correcta
  if($response->success){
    echo "Se verifico el captcha correctamente";
  }else{
    //No se verificó correctamente el captcha
  }

}

function httpPost($url, $data){
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($curl);
  curl_close($curl);
  return $response;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>reCAPTCHA demo: Explicit render after an onload callback</title>
    <!-- PASO 2: Se declara la variable que es llamada desde la api y determina la función que
    ejecutará cuando al cambiar el estado del captcha -->
    <script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '<?php echo $sitekey;?>',
          'callback' : correctCaptcha
        });
      };

      /* PASO 3: Se determinan las acciones que se realizan al cambiar el status del captcha */
      var correctCaptcha = function(response) {
        console.log("datos");
        alert(response);
      };
    </script>
  </head>
  <body>
    <form action="?" method="POST">
      <div id="html_element"></div>
      <br>
      <input type="submit" value="Submit">
    </form>
    <!-- PASO 1: Se importa el api de recaptca y se configura cual será la funcion que se va a ejecutar -->
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
  </body>
</html>