<div class="wrap sln-bootstrap" id="sln-salon--admin">
	<h1>
		<?php /** @var SLN_Wrapper_Customer $customer */ ?>
		<?php _e($customer->isEmpty() ? 'Client nou' : 'Editeaza client', 'salon-booking-system') ?>
		<?php /** @var string $new_link */ ?>
		<a href="<?php echo $new_link; ?>" class="page-title-action"><?php echo esc_html_x('Adauga un client', 'salon-booking-system'); ?></a>
	</h1>
	<br>

	<form method="post">
		<input type="hidden" name="id" id="id" value="<?php echo $customer->getId(); ?>">
		<div class="row">
			<div class="col-xs-10 col-md-10 col-lg-10 col-sm-10 postbox">
				<h3><?php _e('Detalii despre client', 'salon-booking-system') ?></h3>
				<div class="row inside">
					<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
						<div class="form-group sln_meta_field">
							<label for="_sln_customer_first_name"><?php _e('Prenume', 'salon-booking-system') ?></label>
							<input type="text" name="sln_customer[first_name]" id="_sln_customer_first_name" value="<?php echo $customer->get('first_name'); ?>" class="form-control">
						</div>
					</div>
					<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
						<div class="form-group sln_meta_field">
							<label for="_sln_customer_last_name"><?php _e('Nume', 'salon-booking-system') ?></label>
							<input type="text" name="sln_customer[last_name]" id="_sln_customer_last_name" value="<?php echo $customer->get('last_name'); ?>" class="form-control">
						</div>
					</div>
					<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
						<div class="form-group sln_meta_field">
							<label for="_sln_customer_email"><?php _e('E-mail', 'salon-booking-system') ?></label>
							<input type="text" name="sln_customer[user_email]" id="_sln_customer_email" value="<?php echo $customer->get('user_email'); ?>" class="form-control" required>
						</div>
					</div>
					<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
						<div class="form-group sln_meta_field">
							<label for="_sln_customer_sln_phone"><?php _e('telefon mobil', 'salon-booking-system') ?></label>
							<input type="text" name="sln_customer_meta[_sln_phone]" id="_sln_customer_sln_phone" value="<?php echo $customer->get('_sln_phone'); ?>" class="form-control">
						</div>
					</div>
				</div>

				<div class="row inside">
					<div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">
						<div class="form-group sln_meta_field">
							<label for="_sln_customer_sln_address"><?php _e('Adresa', 'salon-booking-system') ?></label>
							<textarea type="text" name="sln_customer_meta[_sln_address]" id="_sln_customer_sln_address" class="form-control"><?php echo $customer->get('_sln_address'); ?></textarea>
						</div>
					</div>
				</div>

				<div class="row inside">
					<div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">
						<div class="form-group sln_meta_field">
							<label for="_sln_customer_sln_personal_note"><?php _e('Nota personala', 'salon-booking-system') ?></label>
							<textarea type="text" name="sln_customer_meta[_sln_personal_note]" id="_sln_customer_sln_personal_note" class="form-control"><?php echo $customer->get('_sln_personal_note'); ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 col-md-offset-1">
				<div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
						<div class="form-group sln_meta_field">
							<input type="submit" name="save" value="<?php _e($customer->isEmpty() ? 'Publica' : 'Actualizeaza', 'salon-booking-system'); ?>" class="button button-primary" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-10 col-md-10 col-lg-10 col-sm-10 postbox">
				<h3><?php _e('Istoria rezervarilor', 'salon-booking-system') ?></h3>
				<div class="row inside">
					<div class="col-xs-2 col-md-2 col-lg-2 col-sm-2">
						<h4><?php _e('Total rezervari', 'salon-booking-system') ?></h4>
					<span>
						<?php
						$count = $customer->getCountOfReservations();
						echo $count;
						?>
					</span>
					</div>
					<div class="col-xs-2 col-md-2 col-lg-2 col-sm-2">
						<h4><?php _e('Valoarea de client', 'salon-booking-system') ?></h4>
						<span><?php echo SLN_Plugin::getInstance()->getSettings()->getCurrencySymbol() . ' ' . $customer->getCustomerValue(); ?></span>
					</div>
				</div>
			</div>
		</div>

		<?php if ($count): ?>
			<div class="row">
				<div class="col-xs-10 col-md-10 col-lg-10 col-sm-10 postbox">
				<?php

				$_GET['post_type'] = SLN_Plugin::POST_TYPE_BOOKING;
				$_GET['author'] = $customer->getId();
				get_current_screen()->add_option('post_type', SLN_Plugin::POST_TYPE_BOOKING);
				get_current_screen()->id = 'edit-sln_booking';
				get_current_screen()->post_type = SLN_Plugin::POST_TYPE_BOOKING;

				/** @var SLN_Admin_Customers_BookingsList $wp_list_table */
				$wp_list_table = new SLN_Admin_Customers_BookingsList();

				$wp_list_table->prepare_items();

				$wp_list_table->display();
				?>
				</div>
			</div>
		<?php endif; ?>
	</form>

</div>