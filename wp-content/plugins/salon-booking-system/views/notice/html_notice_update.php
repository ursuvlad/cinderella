<div id="sln-setting-success" class="updated settings-success success">
	<p>
		<strong><?php _e('Actualizarea datelor pentru Salon','salon-booking-system') ?></strong> -
		<?php echo __('O actualizare a bazei de date este necesara pentru toata versiunea. Va rugam sa faceti o copie de rezerva a bazei de date inainte de a continua.','salon-booking-system') ?>
	</p>

	<p>
		<a href="<?php echo esc_url( add_query_arg( 'do_update_sln', 'true', admin_url( 'admin.php?page=salon-settings' ) ) ); ?>"
		   class="button button-default"><?php _e( 'Porneste actualizarea', 'salon-booking-system' ); ?></a>
	</p>
</div>
