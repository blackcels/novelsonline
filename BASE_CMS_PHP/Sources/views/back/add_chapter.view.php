<h2>Edit chapter</h2>

<form action="/back/add_chapter/<?php echo $Novelsname . "/"?>" method="post">
    Title :<br>
    <input type="text" name="Title" value=>
    <br>
    Chapter number :<br>
    <input type="text" name="Number" value=>
    <br>
    Chapter Content : <br>
    <TEXTAREA name="Body" rows=20 cols=120 ></TEXTAREA>
    <br>
    <input type="submit" value="Add">
</form>
