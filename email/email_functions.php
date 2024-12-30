<?php 


function sendEmail($header, $msg, $users, $copy = false) {
    foreach ($users as $user) {
            $para  = $user; 

            // título
            $titulo = $header;

            // mensaje
            $mensaje = `
            <html>
            <head>
              <h1>${header}</h1>
            </head>
            <body>
              <p>${msg}</p>
            </body>
            </html>
            `;

            // Para enviar un correo HTML, debe establecerse la cabecera Content-type
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Cabeceras adicionales
            $cabeceras .= 'From: support@stepbro.site' . "\r\n";
            if ($copy) {
                $cabeceras .= 'Cc: support@stepbro.site' . "\r\n"; // Añadir copia al mismo correo
            }

            // Enviar el correo
            if (!mail($para, $titulo, $mensaje, $cabeceras)) {
                return false;
            }
    }
    return true;
}

function sendEmailToAllUser($header, $msg, $size = 10,$admin){
    $offset = 0;
    $emailAll = [];


    do {
        // Obtener los correos de los usuarios
        $emails = $admin->getAllUsersEmails($size, $offset);
        $emailAll = array_merge($emailAll,$emails);
        // Si hay correos, enviarlos
        /*
        if (count($emails) > 0) {
            // Enviar correo a este lote de usuarios
            if (!sendEmail($header, $msg, $emails, false)) {
                echo "Error al enviar correos a este lote.";
                return false;
            }
            */
        
        

        // Aumentar el offset 
        $offset += $size;
    } while (count($emails) == $size); // Seguir hasta que no haya mss usuarios
    return $emailAll;
    return true;

}


?>



