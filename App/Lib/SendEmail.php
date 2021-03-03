<?php

namespace App\Lib;

require VENDORPARTH;


defined("APPPATH") OR die("Access denied");

require APPPATH .'/Lib/PHPMailer.php';
require APPPATH .'/Lib/PHPSmtp.php';

/**
 * 
 */
class SendEmail
{
	
	public static function RecoveryData($email, $id)
	{

		$config = parse_ini_file(APPPATH . '/Config/config.ini');

		$mail = new \PHPMailer(true);

		try {
		    $mail->isSMTP();
		    $mail->Host 		= 	$config['hostEmail'];
		    $mail->Port 		= 	$config['portEmail'];
		    $mail->Username 	=	$config['userEmail'];
		    $mail->Password 	=	$config['passEmail'];
		    $mail->SMTPAuth 	=	$config['smtpAutEmail'];
		    $mail->SMTPSecure 	=	$config['smtpSecEmail'];
		    $mail->SMTPDebug 	=	$config['smtpDebEmail'];


		    $mail->setFrom($config['addEmail'], $config['titleEmail']);
		    
		    $mail->addAddress($email);  

            // $retVal = ($cuerpo['status'] == "act") ? '<p><strong><h3> Actualizacion de Hoja de Servicio </h3></strong><br></p>' : '' ;   

		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Recovery Data';
		    $mail->Body    = ' 
		    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		        <html xmlns="http://www.w3.org/1999/xhtml">
		            <head>
		                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		                <title>Influencers</title>
		                <link rel="stylesheet" href="https://unpkg.com/bootstrap@3.3.7/dist/css/bootstrap.css">
		                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
						<style>
						.button {
						    background-color: #4CAF50;
						    border: none;
						    color: white;
						    padding: 15px 32px;
						    text-align: center;
						    text-decoration: none;
						    display: inline-block;
						    font-size: 16px;
						    margin: 4px 2px;
						    cursor: pointer;
						}
						</style>
		            </head>
		            <body style="margin: 0; padding: 0;">
		                <table align="center" border="0" cellpadding="0" cellspacing="0" width="800">
		                    <tr>
		                        <td align="center" bgcolor="#F2F0F0" style="padding: 40px 0 30px 0;">
		                            <strong style="font-size: 19px;">Influencers</strong>
		                        </td>
		                    </tr>
		                    <tr>
                                <td bgcolor="#ffffff" style="text-align: center;">
                                    <p><strong style="font-size: 15px;"><h1>Hello!</h1</strong></p>
                                    <p><strong>You are receiving this email because we received a password reset request for your account.</strong></p>
                                    <p><a href="192.203.0.13/index.php?url=login/recovery/'.$id.'" class="button">Reset Password</a></p>
                                    <p><strong>If you did not request a password reset, no further action is required.</strong></p>
                                </td>
                            </tr>
		                    
		                    <td bgcolor="#002260" style="padding: 30px 30px 30px 30px; color: #fff;">
		                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
		                            <tr>
		                                <td>
		                                    
		                                    © Influencers All Right Reserved '.date("Y").'
		                                    
		                                </td>
		                            </tr>
		                        </table>
		                    </td>
		                </table>
		                <script src="https://unpkg.com/bootstrap@3.3.7/dist/js/bootstrap.js"></script>
		            </body>
		        </html>
		    ';

		    $mail->IsHTML(true);

		    // $mail->addAttachment($direct);

		    $mail->send();

			return array(
				'error' 		=>  false, 
				'Message'		=>  "Solicitud enviada satisfactoriamente."   
			);

		} catch (Exception $e) {

			return array(
				'error' 		=>  true, 
				'Message'		=>  "Error al enviar solicitud intente nuevamente, si el error persiste contacte a su programador web."   
			);

		}

		return array(
			'error' 		=>  false, 
			'Message'		=>  "Solicitud enviada satisfactoriamente."   
		);

	}
	
}