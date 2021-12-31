<?php

$domains = ['techweber.com','yellowvideodirectory.com'];

foreach( $domains as $domain ) {  

      $response = json_decode( file_get_contents('http://api.whoapi.com/?apikey=20e73e275f5be97bb83f4361c67dccbf&r=whois&domain='.$domain.'&ip='), true);

      if ( !empty ( $response ) ) {
		$today = time();
		$target_date = date( strtotime($response['date_expires'] ) );	
		$datediff = $target_date - $today;
		$no_of_days_diff = round ( $datediff / ( 60 * 60 * 24 ) );

		echo 'Domain: ' . $domain . ' => ' . $no_of_days_diff . ' days <br/>';

		if ( $no_of_days_diff <= 5 ) {
			// the message
			$msg = "Domains expiring: \n";

			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);

			// send email
			mail("info@techweber.com","Domains expiring...",$msg);
		}
     }
}