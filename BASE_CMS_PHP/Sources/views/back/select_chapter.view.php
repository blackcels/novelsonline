<main class="clearfix">
    <article>
        <main>
            <h2><?php echo $Novels->getTitle() ;?></h2>
            <?php foreach ($Chapters as $chapter):?>
                <a href="/back/edit_chapter/<?php echo str_replace(" ", "-", $Novels->getTitle()) . "/" . $chapter->getChapterNumber() . "/";?>">
                    <?php echo $Novels->getTitle() . " chapter " . $chapter->getChapterNumber() . " " . $chapter->getChapterTitle();?></a>
            <?php endforeach;?>
        </main>
    </article>
</main>