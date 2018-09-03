<main class="clearfix">
    <article>
        <header>
            <h1>Description</h1>
        </header>
        <main>
            <?php echo $Description;?>
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