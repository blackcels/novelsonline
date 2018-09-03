<main class="clearfix">
    <article>
        <header>
            <img src="<?php echo DS.$novel->getPicture();?>">
            <h1><?php echo $novel->getTitle();?></h1>
            <span><?php echo $novel->getStatus();?></span> <span><?php echo $novel->getLanguage();?></span>
        </header>
        <main>
            <div>
                <h2>Synopsis :</h2>
                <p><?php echo $novel->getSynopsis();?></p>
            </div>
            <div>
                <ul>
                    <?php foreach ($chapters as $chapter): ?>
                        <li><a href="/chapters/<?php echo str_replace(" ", "-", $chapter->getNovelsName())."/".$chapter->getChapterNumber()."/"; ?>">
                                <?php echo $chapter->getNovelsName() . " chapter " . $chapter->getChapterNumber() . " : " . $chapter->getChapterTitle(); ?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </main>
    </article>

    <aside>
        <header>
            <h1>Recent Chapters</h1>
        </header>
        <main>
            <ul>
                <?php foreach ($recentChapters as $chapter): ?>
                    <li><a href="/chapters/<?php echo str_replace(" ", "-", $chapter->getNovelsName())."/".$chapter->getChapterNumber()."/"; ?>">
                            <?php echo $chapter->getNovelsName() . " chapter " . $chapter->getChapterNumber() . " : " . $chapter->getChapterTitle(); ?></a></li>
                <?php endforeach;?>
            </ul>
        </main>
    </aside>

</main>
