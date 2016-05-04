<div class="row sln-attendant">
    <div class="col-xs-2 col-sm-1 sln-radiobox sln-steps-check sln-attendant-check <?php echo $bb->hasAttendant(
        $attendant
    ) ? 'is-checked' : '' ?>">

        <?php SLN_Form::fieldRadioboxForGroup(
            'sln[attendants][]',
            'sln[attendant]',
            $attendant->getId(),
            $bb->hasAttendant($attendant),
            $settings
        ) ?>
        <!-- .sln-attendant-check // END -->
    </div>
    <div class="col-xs-4 col-sm-3 col-md-3 sln-steps-thumb sln-attendant-thumb">
        <?php
        if (has_post_thumbnail($attendant->getId())) {
            echo get_the_post_thumbnail($attendant->getId(), 'thumbnail');
        }
        ?>
    </div>
    <div class="col-xs-6 visible-xs-block">
        <label for="<?php echo SLN_Form::makeID('sln[attendant]['.$attendant->getId().']') ?>">
            <h3 class="sln-steps-name sln-attendant-name"><?php echo $attendant->getName(); ?></h3>
        </label>
        <!-- .sln-attendant-info // END -->
    </div>
    <div class="col-xs-12 col-sm-8 col-md-8">
        <div class="row sln-steps-info sln-attendant-info">
            <div class="col-md-12 hidden-xs">
                <label for="<?php echo SLN_Form::makeID('sln[attendant]['.$attendant->getId().']') ?>">
                    <h3 class="sln-steps-name sln-attendant-name"><?php echo $attendant->getName(); ?></h3>
                </label>
                <!-- .sln-attendant-info // END -->
            </div>
        </div>
        <div class="row sln-steps-description sln-attendant-description">
            <div class="col-md-12">
                <label for="<?php echo SLN_Form::makeID('sln[attendant]['.$attendant->getId().']') ?>">
                    <p><?php echo $attendant->getContent() ?></p>
                </label>
                <!-- .sln-attendant-info // END -->
            </div>
        </div>
    </div>
    <span class="errors-area">
    <?php if ($errors) : ?>
        <div class="col-md-12 alert alert-warning">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    </span>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <hr>
    </div>
</div>