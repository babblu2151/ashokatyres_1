<?php
/*
Template Name: Mobhil Car Dealer HTML Template

Variable
	$recaptchaSecret : Recaptcha Secret Key
 
	$dlabName : Contact Person Name
	$dlabEmail : Contact Person Email
	$dlabMessage : Contact Person Message
	$dlabRes : response holder
	$dlabOtherField : Form other additional fields
	
	
	$dlabMailSubject : Mail Subject.
	$dlabMailMessage : Mail Body
	$dlabMailHeader : Mail Header
	$dlabEmailReceiver : Contact receiver email address
	$dlabEmailFrom : Mail Form title
	$dlabEmailHeader : Mail headers
*/
/* require ReCaptcha class */
require('recaptcha-master/src/autoload.php');

/* ReCaptch Secret */
$recaptchaSecret = '6LefsVUUAAAAABy0gWJlqIPO3YpVkxgcjy9XJ5kQ';

$dlabEmailTo 		= "test@dexignlab.com";   /* Receiver Email Address */
$dlabEmailFrom    = "Mobhil Contact";


function pr($value)
{
	echo "<pre>";
	print_r($value);
	echo "</pre>";
}

try {
    if (!empty($_POST)) {
	
		$reCaptchaEnable = isset($_POST['reCaptchaEnable']) ? $_POST['reCaptchaEnable'] : 1;
		
		
		if($reCaptchaEnable)
		{
		
			/* validate the ReCaptcha, if something is wrong, we throw an Exception,
				i.e. code stops executing and goes to catch() block */
			
			if (!isset($_POST['g-recaptcha-response'])) {
				$dlabRes['status'] = 0;
				$dlabRes['msg'] = 'ReCaptcha is not set.';
				echo json_encode($dlabRes);
				exit;
			}

			/* do not forget to enter your secret key from https://www.google.com/recaptcha/admin */
			
			$recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());
			
			/* we validate the ReCaptcha field together with the user's IP address */
			
			$response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

			if (!$response->isSuccess()) {
				$dlabRes['status'] = 0;
				$dlabRes['msg'] = 'ReCaptcha was not validated.';
				echo json_encode($dlabRes);
				exit;
			}
        }
		
		#### Contact Form Script ####
		if($_POST['dlabToDo'] == 'Contact')
		{
			$dlabName = trim(strip_tags($_POST['dlabName']));
			$dlabEmail = trim(strip_tags($_POST['dlabEmail']));
			$dlabMessage = strip_tags($_POST['dlabMessage']);	
			$dlabRes = array();
			if (!filter_var($dlabEmail, FILTER_VALIDATE_EMAIL)) 
			{
				$dlabRes['status'] = 0;
				$dlabRes['msg'] = 'Wrong Email Format.';
			}
			$dlabMailSubject = 'Mobhil|Contact Form: A Person want to contact';
			$dlabMailMessage	= 	"
								A person want to contact you: <br><br>
								Name: $dlabName<br/>
								Email: $dlabEmail<br/>
								Message: $dlabMessage<br/>
								";
								
			$dlabOtherField = "";
			if(!empty($_POST['dlabOther']))
			{
				$dlabOther = $_POST['dlabOther'];
				$message = "";
				foreach($dlabOther as $key => $value)
				{
					$fieldName = ucfirst(str_replace('_',' ',$key));
					$fieldValue = ucfirst(str_replace('_',' ',$value));
					$dlabOtherField .= $fieldName." : ".$fieldValue."<br>";
				}
			}
			$dlabMailMessage .= $dlabOtherField; 
								
			$dlabEmailHeader  	= "MIME-Version: 1.0\r\n";
			$dlabEmailHeader 		.= "Content-type: text/html; charset=iso-8859-1\r\n";
			$dlabEmailHeader 		.= "From:$dlabEmailFrom <$dlabEmail>";
			$dlabEmailHeader 		.= "Reply-To: $dlabEmail\r\n"."X-Mailer: PHP/".phpversion();
			if(mail($dlabEmailTo, $dlabMailSubject, $dlabMailMessage, $dlabEmailHeader))
			{
				$dlabRes['status'] = 1;
				$dlabRes['msg'] = 'We have received your message successfully. Thanks for Contact.';
			}
			else
			{
				$dlabRes['status'] = 0;
				$dlabRes['msg'] = 'Some problem in sending mail, please try again later.';
			}
			echo json_encode($dlabRes);
			exit;
		}
		#### Contact Form Script End ####
		
		#### Appointment Form Script ####
		if($_POST['dlabToDo'] == 'Appointment')
		{
			$dlabMessage = isset($_POST['dlabMessage'] ) ? $_POST['dlabMessage'] : '';
			
			$dlabName = trim(strip_tags($_POST['dlabName']));
			$dlabEmail = trim(strip_tags($_POST['dlabEmail']));
			$dlabMessage = strip_tags($dlabMessage);	
			$dlabRes = array();
			if(!filter_var($dlabEmail, FILTER_VALIDATE_EMAIL)) 
			{
				$dlabRes['status'] = 0;
				$dlabRes['msg'] = 'Wrong Email Format.';
				echo json_encode($dlabRes);
				exit;
			}
			
				
			
			$dlabMailSubject = 'Mobhil|Appointment Form: A Person want to contact';
			$dlabMailMessage	= 	"
								A person want to contact you: <br><br>
								Name: $dlabName<br/>
								Email: $dlabEmail<br/>
								Message: $dlabMessage<br/>
								";
			$dlabOtherField = "";
			if(!empty($_POST['dlabOther']))
			{
				$dlabOther = $_POST['dlabOther'];
				$message = "";
				foreach($dlabOther as $key => $value)
				{
					$fieldName = ucfirst(str_replace('_',' ',$key));
					$fieldValue = ucfirst(str_replace('_',' ',$value));
					$dlabOtherField .= $fieldName." : ".$fieldValue."<br>";
				}
			}
			$dlabMailMessage .= $dlabOtherField; 
			
			$dlabEmailHeader  	= "MIME-Version: 1.0\r\n";
			$dlabEmailHeader 		.= "Content-type: text/html; charset=iso-8859-1\r\n";
			$dlabEmailHeader 		.= "From:$dlabEmailFrom <$dlabEmail>";
			$dlabEmailHeader 		.= "Reply-To: $dlabEmail\r\n"."X-Mailer: PHP/".phpversion();
			if(mail($dlabEmailTo, $dlabMailSubject, $dlabMailMessage, $dlabEmailHeader))
			{
				$dlabRes['status'] = 1;
				$dlabRes['msg'] = 'We have received your message successfully. Thanks for Contact.';
			}
			else
			{
				$dlabRes['status'] = 0;
				$dlabRes['msg'] = 'Some problem in sending mail, please try again later.';
			}
			echo json_encode($dlabRes);
			exit;
		}	
		#### Appointment Form Script End ####
		
	}
} catch (\Exception $e) {
    $dlabRes['status'] = 0;
	$dlabRes['msg'] = $e->getMessage().'Some problem in sending mail, please try again later.';
	echo json_encode($dlabRes);
	exit;
}

?>