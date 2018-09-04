<h2>Edit chapter</h2>

<form action="/back/edit_chapter/<?php echo str_replace(" ", "-", $Novels->getTitle()) . "/" . $Number . "/"?>" method="post">
    Title :<br>
    <input type="text" name="Title" value=<?php echo $ChapterTitle?>>
    <br>
    Chapter number :<br>
    <input type="text" name="Number" value=<?php echo $Number?>>
    <br>
    Chapter Content : <br>
    <TEXTAREA name="Body" rows=20 cols=120 ><?php echo $Body?></TEXTAREA>
    <br>
    <input type="submit" value="Edit">
</form>
