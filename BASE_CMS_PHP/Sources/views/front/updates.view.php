<main class="clearfix">
    <article>
        <header>
            <h2>ALL ONGOING TRANSLATIONS - Most Recently Updated</h2>
        </header>
        <main>
            <table>
                <tr>
                    <th>Novel</th>
                    <th>Last Release</th>
                    <th>Time</th>
                </tr>
                <?php foreach ($listChapters as $lChapter):?>
                <tr>
                    <td>
                        <a href="/chapters/<?php echo str_replace(" ", "-", $lChapter->getNovelsName())."/".$lChapter->getChapterNumber()."/"; ?>">
                            <?php echo $lChapter->getNovelsName();?>
                        </a>
                    </td>
                    <td>
                        <a href="/chapters/<?php echo str_replace(" ", "-", $lChapter->getNovelsName())."/".$lChapter->getChapterNumber()."/"; ?>">
                            <?php echo "Chapter ".$lChapter->getChapterNumber().":".$lChapter->getChapterTitle();?>
                        </a>
                    </td>
                    <td>
                        <a href="/chapters/<?php echo str_replace(" ", "-", $lChapter->getNovelsName())."/".$lChapter->getChapterNumber()."/"; ?>">
                            <?php echo $lChapter->getCreateDate();?>
                        </a>
                    </td>
                </tr>
                <?php endforeach;?>

            </table>
        </main>
    </article>
</main>