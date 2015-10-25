<?php



/*

 * TB_Contactform

 *	http://labs.thinkbright.nl/tb_contactform/

 *

 * 	A semantic and usable contact form for Frog CMS

 *  by Marijn Scholtus (http://thinkbright.nl)

 *

 *  Please keep this comment block intact when redistributing this Frog CMS Plugin.

 */



 /**

 * @package frog

 * @subpackage plugin.tb_contactform

 * @author Marijn Scholtus (Thinkbright)

 * @version 1.0

 * @since Frog version 0.9.5

 * @license http://creativecommons.org/licenses/by-sa/3.0/nl/deed.en

 * @copyright Marijn Scholtus, 2009

 */



Plugin::setInfos(array(

    'id'          => 'tb_contactform',

    'title'       => 'TB_Contactform',

    'description' => 'A semantic and usable contact form with proper input validation.',

    'version'     => '1.0.2',

    'license'     => 'MIT',

    'author'      => 'Marijn Scholtus (Thinkbright)',

    'require_frog_version' => '0.9.5',

    'website'     => 'http://labs.thinkbright.nl/tb_contactform/',

    'update_url'  => 'http://labs.thinkbright.nl/frog-plugin-versions.xml'

));





/** Contact Form **/

function TB_ContactForm($emailTo, $emailCC = FALSE, $sentHeading='Your message was sent successfully.', $sentMessage='We will get back to you soon.') {



	if(isset($_POST['contact_submit']))

	{

		$error = "";

		$fullname 					= makeSafe($_POST['fullname']);

		$email						= makeSafe($_POST['email']);

		$phone 						= makeSafe($_POST['phone']);

		$message 					= makesafe($_POST['message']);

		$subject = "Enquiry from Hotel Yan";



		if(empty($fullname))

		{ $error['fullname'] = "Your name"; }

		if(empty($email) || !isValidEmail($email))

		{ $error['email'] = "Email Address"; }

		if(empty($message))

		{ $error['message'] = "General Enquiry"; }		



		if(!empty($_POST['antispam']))

		{

			echo '<p>We don&rsquo;t appreciate spam.</p>';

		}

		elseif(!empty($error))

		{	

			TB_DisplayForm($error);

		}

		else

		{

			

			$content =  __('Name').' : '.$fullname."\n\n".

						__('Email Address').' : '.$email . "\n\n" .

						__('Contact No.').' : '.$phone."\n\n".

						__('General Enquiry')." : \n\n".

						$message."\n\n";



			$headers = 'From: =?UTF-8?B?'.base64_encode($fullname).'?= <'.$email.'>'."\r\n";

			$emailBCC = '';

			if($emailCC)

			{

				$headers .= 'CC: '.$emailCC."\r\n";

			}



			if($emailBCC != ''){

				$headers .= 'BCC: '.$emailBCC."\r\n";

			}

			$headers .= 'Reply-To: ' . $email . "\r\n";

			$headers .= 'Content-type: text/plain; charset=UTF-8';



			if(mail($emailTo, $subject, $content, $headers))

			{

				echo '<a id="contact-status" name="status"></a>'."\n";

				echo '<p class="tbSuccess">'.__($sentHeading). ' '. __($sentMessage).'</p>'."\n";

			}else{

				$error['sendemail'] = "Email could not be sent.";

			}

			TB_DisplayForm($error);

		}

	}

	else

	{

		TB_DisplayForm();

	}

}



function TB_DisplayForm($error = false) {

	echo '<form id="tbContactform" name="thisform" method="post" action="">'."\n";

	echo '  <table class="tbContactform" border=1 cellpadding=1 cellspacing=1>'."\n";

	echo '	<input type=hidden name="contact_submit" value="">'."\n";

	if($error)

	{

	    echo '<a id="contact-status" name="status"></a>'."\n";

		echo '	<tr><td class="tbErrors" colspan=2><div class="tbErrors" style="display:inline; display: inline-block; ">'."\n";

		$errfield = '';

		foreach($error as $key => $val) {

			if ($key != 'terms') { $errfield .= __($val).', '; }

		}

		if ($errfield != ''){

		    $errfield = 'Enquiry cannot be sent. Please try again.';

		    // $errfield = $errfield;

		}

		echo '<div class="comment-captcha-error">'.$errfield.'</div>'."\n";

		echo '	</div></td></tr>'."\n";

	}

	

	echo '	<tr><td width=100px><div class="label-entry '.(isset($error['fullname']) ? 'error' : '').'"><label for="tbname">'.__(' Name').'</label></div></td><td width=15px><div class="semicol">:</div></td>'."\n";

	echo '		<td valign=top><div class="field-entry"><input type="text" class="text" id="fullname" name="fullname"';

	if(count($error) > 0 && !empty($_POST['fullname'])) { echo ' value="'.$_POST['fullname'].'"'; }

	echo '/></div>'."\n";

	echo '	</td></tr>'."\n";

	



	



	echo '	<tr><td><div class="label-entry"><label for="tbname">'.__('Contact No.').'</label></div></td><td ><div class="semicol">:</div></td>'."\n";

	echo '		<td valign=top><div class="field-entry"><input type="text" class="text" id="phone" name="phone" '.(count($error) > 0 && !empty($_POST['phone'])?' value="'.$_POST['phone'].'"':'').'/></div>'."\n";

	echo '	</td></tr>'."\n";



	echo '	<tr><td><div class="label-entry '.(isset($error['email']) ? 'error' : '').'"><label for="tbemail">'.__('Email').'</label></div></td><td ><div class="semicol">:</div></td>'."\n";

	echo '		<td><div class="field-entry"><input type="text" class="text" id="email" name="email"';

	if(count($error) > 0 && !empty($_POST['email'])) { echo ' value="'.$_POST['email'].'"'; }

	echo '/></div>'."\n";

	echo '	</td></tr>'."\n";

	echo '	<tr><td valign=top><div class="label-entry '.(isset($error['message']) ? 'error' : '').'" style="vertical-align: top;"><label for="tbmessage">'.__('Message').'</label></div></td><td ><div class="semicol">:</div></td>'."\n";

	echo '		<td valign=top><div class="field-entry">

					<textarea id="message" name="message">'.((count($error) > 0 && !empty($_POST['message']))?$_POST['message']:'').'</textarea></div>'."\n";

	echo '	</td></tr>'."\n";





	echo '	<tr style="display:none;"><td valign=top><div class="label-entry" style="vertical-align: top;"></div></td>'."\n";

	echo '		<td valign=top><div class="field-entry term">

					<div style="float:left;display:none; width:4%;margin-left:4%;margin-right:2%"><input type=checkbox id="term" name="term" checked></div><div style="float:left;display:none;width:90%;">I have read and agreed with the <a href="'.URL_PUBLIC.'private-policy" target="_blank">Private Policy</a> and <a href="'.URL_PUBLIC.'personal-data-policy" target="_blank">Personal Data Policy</a></div></div>'."\n";

	echo '	</td></tr>'."\n";



	// echo '	<tr class="antispam"><td>'."\n";

	// echo '		<div class="label-entry"><label for="tbantispam">Please don&rsquo;t fill in the following text-field, it&rsquo;s used as an anti-spam measure.</label></div>'."\n";

	// echo '		<div class="field-entry"><input type="text" id="tbantispam" name="antispam" /></div>'."\n";

	// echo '	</td></tr>'."\n";

	

	

	echo '	<tr><td></td><td></td><td><div class="field-entry">'."\n";

	echo '		<button type=submit class="button02 submit" name="commit-comment" onclick="return false;">SUBMIT</button></div>'."\n";

	echo '	</td></tr>'."\n";

	echo '	</table>'."\n";

	echo '</form>'."\n";



	echo '

		<script type="text/javascript">



			$("button[name=commit-comment]").bind("click",function(){

				if(!$("#term").is(":checked")){

					alert("Please check to agree that you had read our policies.");

					return false;

				}

				document.thisform.submit();

			})



			if ($("#contact-status").length){

				$("html,body").animate({

					scrollTop: $("#contact-status").offset().top},

				"slow");

			}

		</script>';

}





function isValidEmail($email){

	return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email);

}



function makeSafe($data)

{

	return trim(addslashes(htmlspecialchars(strip_tags($data),ENT_QUOTES,"UTF-8")));

}



?>