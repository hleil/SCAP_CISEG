<?php

require $_SERVER['DOCUMENT_ROOT'] . "/SCAP/conexion/PHPMailer/class.phpmailer.php";
require $_SERVER['DOCUMENT_ROOT'] . "/SCAP/conexion/PHPMailer/class.smtp.php";

class Mail {

    function sendCorreoAlta($nombre,$correo) {

        $mail = new PHPMailer();
        $body = '
        <p>Estimado '.$nombre.':</p>
        <p>Le hacemos llegar sus datos de acceso para el sistema SCAP - CISEG:</p>
        <table  border="0">

          <tr>
                <td><strong>Usuario:</strong></td>
                <td>' . $correo . '</td>
          </tr>
          <tr>
                <td><strong>Contraseña de primer acceso:</strong></td>
                <td>Scap;2018</td>
          </tr>   
          <tr>
                <td><strong>URL del sistema:</strong></td>
                <td>http://148.204.64.228/SCAP/</td>
          </tr>               
          <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
          </tr>  
        </table>
        <p>Saludos</p>';
        $body .= "";
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP(); 


        $mail->Host = "mail.miguelhdz.com";
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls'; 
        $mail->SMTPDebug = 1; 


        $mail->From     = "scap@miguelhdz.com";
        $mail->FromName = "SCAP - CISEG";
        $mail->Subject  = "Alta en el Sistema SCAP - CISEG";
        $mail->AltBody  = "Leer"; 
        $mail->MsgHTML($body);


        $mail->AddAddress($correo);   
        $mail->SMTPAuth = true;


        $mail->Username = "scap@miguelhdz.com";
        $mail->Password = "Octubre;93"; 

        if($mail->Send()) {
                return true;
                die();
        }else {
                return false;
                die();
        }
    }
    
    
    function sendCorreoRecuperarContrasena($correo,$contrasena) {
        
        $mail = new PHPMailer();
        $body = '
        <p>Estimado usuario:</p>
        <p>Le hacemos llegar su contraseña para reestablecer su acceso al sistema SCAP - CISEG:</p>
        <table  border="0">
          <tr>
                <td><strong>Contraseña de primer acceso:</strong></td>
                <td>'.$contrasena.'</td>
          </tr>   
          <tr>
                <td><strong>URL del sistema:</strong></td>
                <td>http://148.204.64.228/SCAP/</td>
          </tr>               
          <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
          </tr>  
        </table>
        <p>Saludos</p>';
        $body .= "";
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP(); 


        $mail->Host = "mail.miguelhdz.com";
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls'; 
        $mail->SMTPDebug = 1; 


        $mail->From     = "scap@miguelhdz.com";
        $mail->FromName = "SCAP - CISEG";
        $mail->Subject  = "Recuperar contraseña Sistema SCAP - CISEG";
        $mail->AltBody  = "Leer"; 
        $mail->MsgHTML($body);


        $mail->AddAddress($correo);   
        $mail->SMTPAuth = true;


        $mail->Username = "scap@miguelhdz.com";
        $mail->Password = "Octubre;93"; 

        if($mail->Send()) {
                return true;
                die();
        }else {
                return false;
                die();
        }
        
    }

}

?>
