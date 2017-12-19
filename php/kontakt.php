<?php
$mailConfig = array(
    'foodmengroup'
   ,'julianmilicevic1@gmail.com'
);

$Output = '';

if( formSubmission() && ( $formFields = validateFormSubmission( $errors )) ){
    if( !$errors ){
        if( sendEmail( $mailConfig,$formFields ) ){
            $Output = successMessage();
        }else{
            $Output = failureMessage();
        }
    }else{
        $Output = errorMessage( $errors );
    }
}
?>
<?php include 'dependencies.php' ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title></title>
		<?php
			echo $head_dependencies;
		?>
	</head>

	<body>
	<!-- https://webdesign.tutsplus.com/tutorials/how-to-integrate-no-captcha-recaptcha-in-your-website--cms-23024 -->
		<?php include 'header.php' ?>
		<div class="container">
		<form action="" method="post">
		  <div class="form-group">
			<label for="name">Dein Name:</label>
			<input type="name" class="form-control" id="name" placeholder="Horst? Max? Eva? Wie heißt du denn nun?!">
    </div>
    <div class="form-group">
			<label for="email">Deine Email Adresse:</label>
			<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="deinname@deinedomain.de">
			<small id="emailHelp" class="form-text text-muted">Wir werden deine Email NIEMALS veröffentlichen oder teilen</small>
		  </div>
		  <div class="form-group">
			<label for="betreff">Betreff:</label>
			<input type="text" class="form-control" id="betreff" placeholder="Was willsch?">
		  </div>
		  <div class="form-group">
			<label for="nachricht">Nachricht:</label>
			<textarea class="form-control" id="nachricht" rows="3" placeholder="Erzähle uns mehr von deinem Bedürfniss"></textarea>
		  </div>
		  <button type="submit" name="senden" class="btn btn-primary">Nachricht senden</button>
		</form>
		</div>
		<?php include 'footer.php' ?>
	</body>
</html>
<!-- DIe logik zur kontrolle und senden der Mail  -->
<?php
function formSubmission(){
    if( isset( $_POST['senden'] ) ){
        if( get_magic_quotes_gpc() ){ stripslashes_deep( $_POST ); }
        return true;
    }
    return false;
}
function stripslashes_deep( $value ){
    $value = is_array( $value ) ?
        array_map('stripslashes_deep', $value):
        stripslashes($value);
    return $value;
}
function validateFormSubmission( &$errors=array() ){
    $formData = array( '','','' );

    if( empty( $_POST['nachricht'] ) ){
        $errors['nachricht'] = "Bitte schreibe eine Nachricht.";
    }else{
        $formData[0] = $_POST['nachricht'];
    }

    if( empty( $_POST['name'] ) ){
        $errors['name'] = "Bitte nenne uns deinen Namen.";
    }else{
        $formData[1] = $_POST['name'];
    }

    if( empty( $_POST['email'] ) ){
        $errors['email'] = "Bitte trag deine e-mail adresse ein.";
    }elseif( !filter_var( $_POST['email'],FILTER_VALIDATE_EMAIL ) || !preg_match( '#\w\.\w{2,}$#',$_POST['email'] ) ){
        $errors['email'] = "Bitte gebe deine E-Mail Adresse erneut ein.";
    }else{
        $formData[2] = $_POST['email'];
    }

    return $formData;
}

function sendEmail( $mailConfig,$formFields ){
    list( $myname,$myemail ) = $mailConfig;

    list( $name,$email,$nachricht ) = $formFields;

    $headers = "From: $myemail
";
    $headers .= "Reply-to: $email
";
    $headers .= "X-Mailer: PHP Contact Form Example";

    $t = new DateTime( '@'.time() );
    $datetime = $t->format( 'r' );

    $subject = "Contact Form Submission";
    $message = "
$subject
=======================

$name <$email> hat ihnen eine Nachricht über das mensa Kontaktformular gesendet:
----------------------------------------------------------------------
$nachricht

----------------------------------------------------------------------
Gesendet am $datetime";
    $message = wordwrap( $message,70 );

    if( mail( $myemail,$subject,$message,$headers ) ){
        return true;
    }else{
        return false;
    }
}

function successMessage(){
    $message = "Deine Nachricht wurde erfolgreich versendet!";
    return "<div class='alert alert-success alert-dismissable'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>$message</div>";
}

function failureMessage(){
    $message = "We're sorry, we were unable to send your message.  Please try again.";
    return "<div class='alert alert-danger alert-dismissable'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>$message</div>";
}

function errorMessage( $errors=array() ){
    if( empty( $errors ) ){ return; }
    $message = implode( "<br>",$errors );
    return "<div class='alert alert-danger alert-dismissable'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>$message</div>";
}
