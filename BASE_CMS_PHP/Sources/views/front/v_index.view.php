<!-- le main -->
<main>
    <section class="container">
        <p>
        <h1 class="font-size-h1-1">explorez nos évènements</h1> </p>
        <div class="row">
            <div class="col-12">
                <?php if ($events[0] != null && !empty($events[0])):?>
                    <a href="<?php echo $events[0]->getUrl(); ?>">
                        <div class="card-box-lg white-bg">
                            <h2 class="about-event-link">en savoir plus</h2>
                            <div class="first-plan">
                                <h2 class="font-size-h1-1"><?php echo $events[0]->getStartdate(); ?></h2>
                                <h2 class="font-size-h1-2"><?php echo $events[0]->getName(); ?></h2>
                            </div>
                        </div>
                        <img id="img-flyers" src="<?php echo DS."".$events[0]->getThumbnail(); ?>" class="img-cover img-flyers" alt="<?php echo $events[0]->getName(); ?>"/>
                    </a>
                <?php endif;?>
            </div>
        </div>
    </section>
    <?php if(sizeof($events) > 1) :?>
        <hr class="hr-separateur-li">
        <section class="container">
            <p><h1 class="font-size-h1-1">&eacute;vènements à venir</h1></p>
            <?php
                unset($events[0]);
                $events = array_values($events);
            ?>
            <div class="row">
                <?php foreach ($events as $event):?>
                    <div class="col-4">
                        <a href="<?php echo $event->getUrl(); ?>">
                            <div class="card-box-sm">
                                <h3 class="font-size-h2-1"><?php echo $event->getName(); ?></h3>
                            </div>
                            <img src="<?php echo DS . "" . $event->getThumbnail(); ?>" class="img-cover img-large" alt="<?php echo $event->getName(); ?>"
                                 alt="<?php echo $event->getName();?>"/>
                        </a>
                    </div>
                <?php endforeach;?>
            </div>
        </section>
    <?php endif; ?>

    <!-- fin du main -->
</main>
