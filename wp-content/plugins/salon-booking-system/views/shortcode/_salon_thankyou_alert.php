<?php
/**
 * @var $confirmation bool
 * @var $plugin SLN_Plugin
 */
$genPhone = $plugin->getSettings()->get('gen_phone');
$genMail = $plugin->getSettings()->get('gen_email');
if (!$genMail) {
    $genMail = get_option('admin_email');
}
?>
<div class="sln-alert sln-alert--warning <?php if ($confirmation) : ?> sln-alert--topicon<?php endif ?>">
    <?php if ($confirmation) : ?>
        <p><strong><?php _e(
                    'Veți primi o confirmare a rezervării prin e-mail.',
                    'salon-booking-system'
                ) ?></strong></p>
        <p><?php echo sprintf(
                __(
                    'Dacă nu primiți nici o veste de la noi sau de care aveți nevoie pentru a schimba o rezervare va rugam sa sunati %s sau trimite un e-mail la %s',
                    'salon-booking-system'
                ),
                $genPhone,
                $genMail
            ); ?></p>
    <?php else : ?>
        <p><?php echo sprintf(
                __(
                    'În cazul în care aveți nevoie pentru a schimba o rezervare vă rugăm să sunați <strong>%s</strong> sau trimite un e-mail la <strong>%s</strong>',
                    'salon-booking-system'
                ),
                $genPhone,
                $genMail
            ); ?>
        </p>
        <!-- form actions -->
    <?php endif ?>
</div>
