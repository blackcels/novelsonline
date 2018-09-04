<h2>Edit novel</h2>

<form action="/back/edit_novels/<?php echo str_replace(" ", "-", $Novels->getTitle());?>" method="post">
    Title :<br>
    <input type="text" name="Title" value="<?php echo $Novels->getTitle()?>">
    <br>
    Language :<br>
    <input type="text" name="Language" value="<?php echo $Novels->getLanguage()?>">
    <br>
    Status :<br>
    <input type="text" name="Status" value="<?php echo $Novels->getStatus()?>">
    <br>
    Synopsis : <br>
    <TEXTAREA name="Synopsis" rows=20 cols=120 ><?php echo $Novels->getSynopsis()?></TEXTAREA>
    <br>
    Picture :<br>
    <input type="file" name="image_uploads" value=>
    <br><br><br>
    <input type="submit" value="Edit">

</form>