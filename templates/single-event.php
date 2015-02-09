<?php

get_header(); ?>

 <div class="content-wrap">

	<div class="container">

		<div class="page-header">
			<?php the_title('<h1>', '</h1>'); ?>	
		</div>

		<?php 

			if(is_user_logged_in()) {

				function searchForId($id, $array, $part) {
				   foreach ($array as $key => $val) {
				       if ($val[$part] === $id) {
				           return true;
				       }
				   }
				   return null;
				}

				$player_list_get = str_replace("'",'"', get_post_meta(get_the_ID(), 'player_list', true) );

				$player_list = json_decode('['.$player_list_get.']');	

				if(!empty($_POST["reserve"])) {

					if ( ! isset( $_POST['reservation_nonce'] ) || ! wp_verify_nonce( $_POST['reservation_nonce'], 'reservation_submit' ) ) {
					   print 'Sorry, your nonce did not verify.';
					   exit;
					} else {

						$client_name = $_POST['client_name'];
						$player_chair = $_POST['player_chair'];
						$prev_reserved = $_POST['prev_reserved'];

						if ( searchForId($client_name, $player_list, 0) == 1 ) {

							echo '<div class="alert alert-info">You have reserved for this Game Already</div>';

						} else {
						
							update_post_meta(get_the_ID(), 'player_list', $prev_reserved . ",['" . $client_name . "', '" . $player_chair ."']" );

							//////////////////////// EMAILER

							// $to = $_POST['email'];

							// $subject = 'A Reservation was Made';

							// $message = '
							// <h1>Thank you for your reservation</h1> 
							// Your reservation has been booked.  
							// ';

							// $headers = 'From: Reservation <noreply@faussettelaw.com>';
							// function set_html_content_type() {
							// 	return 'text/html';
							// }
							// add_filter( 'wp_mail_content_type', 'set_html_content_type' );
							// wp_mail( $to, $subject, $message, $headers );
							// remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

							echo '<div class="alert alert-success">You have succesfully reserved for this game.</div>';

						 }
					}

				} else { ?>


					<b>Date of Game:</b> 
					<?php echo get_post_meta(get_the_ID(), 'play_date', true); ?> <br>

					<b>Time of Game:</b> 
					<?php echo get_post_meta(get_the_ID(), 'play_time', true); ?> <br>

					<?php 

					function current_page_url() {

						$pageURL = 'http';

						if( isset($_SERVER["HTTPS"]) ) {

							if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

						}

						$pageURL .= "://";

						if ($_SERVER["SERVER_PORT"] != "80") {

							$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

						} else {

							$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

						}

						return $pageURL;

					 }
					?>

					<hr>
					
					<form  role="form" action="<?php echo current_page_url();  ?>" method="post" enctype="multipart/form-data">
						
						<?php wp_nonce_field('reservation_submit','reservation_nonce'); ?>
						
						
						
						

						<h3>Choose your Seat <button type="submit" class="btn btn-primary pull-right">Reserve</button></h3>

						<hr>


						<?php

						//$field = $args['field'];

						if ( get_option('setting_a') == '' || get_option('setting_b') == '') {
							echo '<div class="alert alert-warning">Missing Settings</div>';
							exit;
						} 
						$table = get_option('setting_a');
						$chair = get_option('setting_b');

						for ($i = 1; $i <= $table; $i++) { ?>

						
						<div class="col-sm-2">
						<h4>Table <?php echo $i; ?></h4>	
						

						<?php
						    for ($j = 1; $j <= $chair; $j++) { ?>
								
								<?php $table_chair = $i . '_' . $j; ?>

								<div  class="radio

								<?php $id = searchForId($table_chair, $player_list, 1);
								        	if ($id == 1) echo 'text-muted';
								?>

								">
								<label>
									
									<input 
										type="radio" 
										name="player_chair" 
										id="player_<?php echo $i . '_' . $j; ?>" 
										value="<?php echo $i . '_' . $j; ?>"
										<?php $id = searchForId($table_chair, $player_list, 1);
								        	if ($id == 1) echo 'disabled';
								        ?> > 
								        <?php
								        echo 'Table: '.$i . ' Chair: ' . $j; ?>
								</label>
								</div>
						<?php
						    }
						?>
						</div>
						<?php
						}
						?>

						<input type="hidden" id="client_name" name="client_name" value="<?php echo wp_get_current_user()->display_name; ?>">

						<input type="hidden" id="prev_reserved" name="prev_reserved" value=" <?php echo get_post_meta(get_the_ID(), 'player_list', true) ?>">

						<input type="hidden" id="reserve" name="reserve" value="true">
						
						<div class="clearfix">&nbsp;</div>
						<hr>
						

					</form> 

				<?php
				}

			} 
			else { ?>
				<div class="alert alert-warning">
					<p>You need to Login to see this section</p>
				</div>
			<?php
			}
			?>
	</div>

</div>
<div class="clearfix">&nbsp;</div>

<?php
get_footer(); ?>