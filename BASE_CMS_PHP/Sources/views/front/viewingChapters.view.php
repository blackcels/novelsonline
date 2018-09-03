<main class="clearfix">
    <article>
        <header>
            <a href="/chapters/<?php echo str_replace(" ", "-", $chapter->getNovelsName())."/".($chapter->getChapterNumber() - 1) ."/"; ?>"> << Back </a>
            <h1><?php echo $novel->getTitle();?></h1>
            <a href="/chapters/<?php echo str_replace(" ", "-", $chapter->getNovelsName())."/".($chapter->getChapterNumber() + 1) ."/"; ?>"> Next >> </a>
        </header>
        <main>
            <p><?php echo "Chapter : ".$chapter->getChapterNumber()." - ". $chapter->getChapterTitle();?></p>
            <div>
                <?php echo $chapter->getChapterBody();?>
            </div>
        </main>
    </article>

    <aside>
        <header>
            <h1>Recent Chapters</h1>
        </header>
        <main>
            <ul>
                <?php foreach ($recentChapters as $rChapter): ?>
                    <li><a href="/chapters/<?php echo str_replace(" ", "-", $rChapter->getNovelsName())."/".$rChapter->getChapterNumber()."/"; ?>">
                            <?php echo $rChapter->getNovelsName() . " chapter " . $rChapter->getChapterNumber() . " : " . $rChapter->getChapterTitle(); ?></a></li>
                <?php endforeach;?>
            </ul>
        </main>
    </aside>

</main>

