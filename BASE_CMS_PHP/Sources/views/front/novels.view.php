<main class="clearfix">
    <article>
        <header>
            <h1>List Of Novels</h1>
        </header>
        <main>
            <table>
                <?php foreach ($novels as $novel):?>
                    <tr>
                        <td>
                            <div>
                                <a href="/chapters/<?php echo str_replace(" ", "-",$novel->getTitle())."/";?>">
                                    <img src="<?php echo DS.$novel->getPicture();?>" width="176" height="253" alt="<?php echo $novel->getTitle();?>" title="<?php echo $novel->getTitle();?>">
                                </a>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div></div>
                                <a href="/chapters/<?php echo str_replace(" ", "-",$novel->getTitle())."/";?>">
                                    <h4><?php echo $novel->getTitle();?></h4>
                                </a>
                            </div>
                        </td>
                        <td>
                            <p><?php echo $novel->getSynopsis();?></p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
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