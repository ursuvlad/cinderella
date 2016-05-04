<!-- algolplus -->
	<div>
		<h1><?php _e('Urmatoarele rezervari','salon-booking-system');?></h1>
		<?php if($data['cancelled']): ?>
			<p><?php _e('Rezervare anulata', 'salon-booking-system'); ?></p>
		<?php endif ?>
		<?php if (!empty($data['upcoming'])):?>
			<table class="table table-bordered table-striped">
				<thead>
				<tr>
					<th><?php _e('Rezervare','salon-booking-system');?></th>
					<th><?php _e('Data','salon-booking-system');?></th>
					<th><?php _e('Servicii','salon-booking-system');?></th>
					<?php if($data['attendant_enabled']): ?>
						<th><?php _e('Asistent','salon-booking-system');?></th>
					<?php endif; ?>
					<?php if(!$data['hide_prices']): ?>
						<th><?php _e('Total','salon-booking-system');?></th>
					<?php endif; ?>
					<th><?php _e('Status','salon-booking-system');?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ( $data['upcoming'] as $item ): ?>
					<tr>
						<td data-th="<?php _e('Rezervare','salon-booking-system');?>"><?php echo $item['id'] ?></td>
						<td data-th="<?php _e('Data','salon-booking-system');?>"><strong><?php echo $item['date'] ?></strong></td>
						<td data-th="<?php _e('Servicii','salon-booking-system');?>"><?php echo $item['services']; ?></td>
						<?php if($data['attendant_enabled']): ?>
							<td data-th="<?php _e('Asistent','salon-booking-system');?>"><?php echo $item['assistant'] ?></td>
						<?php endif; ?>
						<?php if(!$data['hide_prices']): ?>
							<td data-th="<?php _e('Total','salon-booking-system');?>"><nobr><strong><?php echo $item['total'] ?></strong></nobr></td>
						<?php endif; ?>
						<td data-th="<?php _e('Status','salon-booking-system');?>">
							<div class="status <?php echo SLN_Enum_BookingStatus::getColor($item['status_code']); ?>">
								<nobr>
									<span class="glyphicon <?php echo SLN_Enum_BookingStatus::getIcon($item['status_code']); ?>" aria-hidden="true"></span>
									<span class="glyphicon-class"><?php echo $item['status']; ?></span>
								</nobr>
							</div>

							<div>
							<?php if ($item['status_code'] != SLN_Enum_BookingStatus::CANCELED
							    && $data['cancellation_enabled']): ?>
									<?php if ($item['timestamp']-current_time('timestamp') > $data['seconds_before_cancellation']): ?>
										<button class="btn btn-danger btn-confirm" onclick="slnMyAccount.cancelBooking(<?php echo $item['id']; ?>);">
											<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
											<?php _e('Anulare rezervare','salon-booking-system');?>
										</button>
									<?php else: ?>
									<button class="btn" data-toggle="tooltip" data-placement="top" style="cursor: not-allowed;"
									        title="<?php _e('Ne pare rău, nu puteți anula această rezervare on-line. Va rugam sa sunati ' . $data['gen_phone'], 'salon-booking-system'); ?>">
										<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> 
										<?php _e('Anulare rezervare','salon-booking-system');?>
									</button>
									<?php endif ?>
							<?php endif; ?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php else: ?>
			<p class="sln-my-account-message"><strong><?php _e('Nu exista rezervari in viitor', 'salon-booking-system'); ?></strong></p>
		<?php endif; ?>
	</div>

	<div>
		<h1><?php _e('Istoria rezervarilor','salon-booking-system');?></h1>
		<?php if (!empty($data['history'])):?>
			<table class="table table-bordered table-striped">
				<thead>
				<tr>
					<th><?php _e('Rezervare','salon-booking-system');?></th>
					<th><?php _e('Data','salon-booking-system');?></th>
					<th><?php _e('Servicii','salon-booking-system');?></th>
					<?php if($data['attendant_enabled']): ?>
						<th><?php _e('Asistent','salon-booking-system');?></th>
					<?php endif; ?>
					<?php if(!$data['hide_prices']): ?>
						<th><?php _e('Total','salon-booking-system');?></th>
					<?php endif; ?>
					<th><?php _e('Status','salon-booking-system');?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ( $data['history'] as $item ): ?>
					<tr>
						<td data-th="<?php _e('Rezervare','salon-booking-system');?>"><?php echo $item['id'] ?></td>
						<td data-th="<?php _e('Data','salon-booking-system');?>"><strong><?php echo $item['date'] ?></strong></td>
						<td data-th="<?php _e('Servicii','salon-booking-system');?>"><?php echo $item['services'] ?></td>
						<?php if($data['attendant_enabled']): ?>
							<td data-th="<?php _e('Asistent','salon-booking-system');?>"><?php echo $item['assistant'] ?></td>
						<?php endif; ?>
						<?php if(!$data['hide_prices']): ?>
							<td data-th="<?php _e('Total','salon-booking-system');?>"><nobr><strong><?php echo $item['total'] ?></strong></nobr></td>
						<?php endif; ?>
						<td data-th="<?php _e('Status','salon-booking-system');?>">
							<div class="status <?php echo SLN_Enum_BookingStatus::getColor($item['status_code']); ?>">
								<nobr>
									<span class="glyphicon <?php echo SLN_Enum_BookingStatus::getIcon($item['status_code']); ?>" aria-hidden="true"></span>
									<span class="glyphicon-class"><?php echo $item['status']; ?></span>
								</nobr>
							</div>

							<div>
								<?php if($item['status_code'] == SLN_Enum_BookingStatus::PAY_LATER OR $item['status_code'] == SLN_Enum_BookingStatus::PAID   OR $item['status_code'] == SLN_Enum_BookingStatus::CONFIRMED): ?>
										<?php if(empty($item['rating'])): ?>
										<button class="btn btn-default sln-rate-service" onclick="slnMyAccount.showRateForm(<?php echo $item['id']; ?>);">
											<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> 
											<?php _e('Acorda o nota serviciului','salon-booking-system');?>
										</button>
										<?php endif; ?>
<!--										<span>--><?php //_e('Nota ta ','salon-booking-system');?><!--</span>-->
									<input type="hidden" name="sln-rating" value="<?php echo $item['rating']; ?>">
									<div class="rating" id="<?php echo $item['id']; ?>" style="display: none;"></div>
								<?php endif; ?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<div id="ratingModal" class="modal fade" role="dialog" tabindex="-1">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body">
							<div id="step1">
								<p><?php _e('Buna','salon-booking-system');?> <?php echo $data['user_name'] ?>!</p>
								<p><?php _e('De cit timp aveti experienta? (necesar)','salon-booking-system');?></p>
								<p><textarea id="" placeholder="<?php _e('rog, lasati citeva rinduri pentru a intelege daca experienta a fost in conformitate cu asteptarile','salon-booking-system');?>"></textarea></p>
								<p>
									<div class="rating" id="<?php echo $item['id']; ?>"></div>
									<span><?php _e('Acorda o nota (necesar)','salon-booking-system');?></span>
								</p>
								<p>
									<button type="button" class="btn btn-primary" onclick="slnMyAccount.sendRate();"><?php _e('Trimite comentariul tau','salon-booking-system');?></button>
									<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Sterge','salon-booking-system');?></button>
								</p>
							</div>
							<div id="step2">
								<p><?php _e('Va multumim pentru recenzii. Aceasta ne va ajuta la imbunatatirea serviciilor noastre.','salon-booking-system');?></p>
								<p><?php _e('Speram sa ne vedem din nou','salon-booking-system');?> <?php echo $data['gen_name']; ?></p>
							</div>
						</div>
						<div class="modal-footer">

						</div>
					</div>

				</div>
			</div>

		<?php else: ?>
			<p><?php _e('Nu sunt rezervari', 'salon-booking-system'); ?></p>
		<?php endif; ?>
	</div>
