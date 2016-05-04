<?php

if(!isset($forAdmin)) {
    $forAdmin = false;
}
?>
<tr>
    <td align="center" valign="top" bgcolor="#f2f2f2">
        <table width="502" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td height="25">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top"
                    style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#666666; font-weight:normal;">
                   
<?php /*
                    <?php _e('Dear', 'salon-booking-system') ?>

                    <?php if($forAdmin): ?>
                    <?php _e('Administrator','salon-booking-system') ?>
                <?php else: ?>
                    <?php echo esc_attr($booking->getFirstname()) . ' ' . esc_attr($booking->getLastname()); ?>,
                <?php endif; ?>
*/?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top"
                    style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#666666; font-weight:normal;">
                    
                    

                
<?php if ($plugin->getSettings()->get('confirmation') && $booking->hasStatus(SLN_Enum_BookingStatus::PENDING) ) : ?>

	<?php if($forAdmin): ?>

     <a  style="text-decoration:none;" href="<?php echo admin_url() ?>/post.php?post=<?php echo $booking->getId() ?>&action=edit">
         <?php echo __('Click here to approve ', 'salon-booking-system') ?>
         <?php echo esc_attr($booking->getFirstname()) . ' ' . esc_attr($booking->getLastname()); ?>
         <?php echo __('booking request.', 'salon-booking-system') ?>
     </a>

 	
                     
	<?php else: ?>

<?php echo __('Rezervarea dvs. este in asteptare, va rugam sa asteptati confirmarea.','salon-booking-system') ?></p>

	<?php endif ?>

<?php else: ?> 

	<?php if($forAdmin): ?>

	<?php echo __('Aceasta este o notificare noua pe e-mail a unei rezervari', 'salon-booking-system') ?>
	
	<?php else: ?>

	    <?php if(isset($remind) && $remind): ?>

	    <?php echo __('Amintesteti rezervarea la', 'salon-booking-system') ?>

        <b style="color:#666666;">
        <?php echo $plugin->getSettings()->get('gen_name') ?
                    $plugin->getSettings()->get('gen_name') : get_bloginfo('name') ?>.</b>
        <br>

	    <?php else: ?>

<?php echo __('Aceasta este o confirmare prin e-mail pentru rezervarea la', 'salon-booking-system') ?>

<b style="color:#666666;">
                        <?php echo $plugin->getSettings()->get('gen_name') ?
                            $plugin->getSettings()->get('gen_name') : get_bloginfo('name') ?>.</b><br></p>

<?php endif ?>
<?php endif ?>

<?php endif ?>




                    <p><?php _e('Va rugam sa luati nota de detalii pentru urmatoarele rezervari.', 'salon-booking-system') ?></p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" bgcolor="#ffffff">
                    <?php echo $plugin->loadView('mail/_summary_details',compact('booking')) ?>
                </td>
            </tr>
            <?php if($booking->hasStatus(SLN_Enum_BookingStatus::PENDING_PAYMENT)){ ?>
            <tr>
                <td align="left" valign="top" bgcolor="#ffffff">
                    <?php include('_summary_pendingpayment.php') ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td height="25" align="left" valign="top">&nbsp;</td>
            </tr>
      <tr>
        <td align="center" valign="top"><table width="460" border="0" align="center" cellpadding="0" cellspacing="0">
          <tbody><tr>
              <?php
              if($forAdmin) {
                  $title = __('Adresa clientului', 'salon-booking-system');
                  $text = $booking->getAddress();
              }
              else {
                  $title = __('Adresa noastra', 'salon-booking-system');
                  $text = $plugin->getSettings()->get('gen_address');
              }
              ?>
            <td width="242" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#cc3333; font-weight:normal;"><?php echo $title ?></td>
            <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#666666; font-weight:normal;"><?php echo $text ?></td>
          </tr>
        </tbody></table></td>
      </tr>

<tr>
    <td height="25" align="left" valign="top">&nbsp;</td>
</tr>

<tr>
        <td align="center" valign="top" bgcolor="#ffffff"><table width="460" border="0" align="center" cellpadding="0" cellspacing="0">
          <tbody><tr>
              <?php
              if($forAdmin) {
                  $title = __('Contactele clientului', 'salon-booking-system');
                  $text = $booking->getDisplayName();
                  $m = $booking->getEmail();
                  $phone = $booking->getPhone();
              }
              else {
                  $title = __('Contactele', 'salon-booking-system');
                  $text = '';
                  $m = $plugin->getSettings()->get('gen_email') ?
                      $plugin->getSettings()->get('gen_email') : get_bloginfo('admin_email');
                  $phone = $plugin->getSettings()->get('gen_phone');
              }
              ?>
            <td width="242" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#cc3333; font-weight:normal;"><?php echo $title ?></td>
            <td align="left" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td height="27">&nbsp;</td>
              </tr>
              <tr>
                  <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#666666; font-weight:normal;"><?php echo $text ?></td>
              </tr>
              <tr>
                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:normal;">
                                <a href="mailto:<?php echo $m ?>"
                                   style="color:#666666; text-decoration:none;"><?php echo $m ?></a></td>
              </tr>
              <tr>
                <td height="22">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#666666; font-weight:normal;"><?php echo $phone ?></td>
              </tr>
              <tr>
                <td height="35">&nbsp;</td>
              </tr>
            </tbody></table></td>
          </tr>
        </tbody></table>
    </td>
</tr>
<tr>
    <td height="40" align="left" valign="top">&nbsp;</td>
</tr>
<tr>
    <td align="center" valign="top">
        <table width="460" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td height="24" align="left" valign="top"
                    style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666666; font-weight:bold;">
                    <?php _e('Important notes', 'salon-booking-system') ?></td>
            </tr>
            <tr>
                <td align="left" valign="top"
                    style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666666; font-weight:normal;">
                    <?php echo $plugin->getSettings()->get('gen_timetable') ?>
                </td>
            </tr>
            <tr>
                <td height="40" align="left" valign="top">&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>
<?php if($forAdmin): ?>
<tr>
    <td align="center" valign="top">
        <table width="460" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td height="24" align="left" valign="top"
                    style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666666; font-weight:bold;">
 
<p><?php _e('Customer message:', 'salon-booking-system')?>: <?php echo esc_attr($booking->getNote())?></p>
<?php if ($plugin->getSettings()->get('confirmation') && $booking->hasStatus(SLN_Enum_BookingStatus::PENDING)) : ?>
    <p><strong><?php _e('Va rugam sa confirmati sau sa respingeti aceasta rezervare', 'salon-booking-system') ?></strong></p>
<?php endif ?>
<a href="<?php echo admin_url() ?>/post.php?post=<?php echo $booking->getId() ?>&action=edit">
    <?php _e('Vezi aceasta rezervare in administrare.','salon-booking-system') ?></a>
    <p>&nbsp;</p>
                </td>
            </tr>
        </table>
    </td>
</tr>
<?php endif ?>
</table>
</td></tr>
