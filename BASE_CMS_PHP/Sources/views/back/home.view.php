<ul>
    <li>
        <h2>Add chapters</h2><br>
        <form action="/back/add_chapter/" method="get">
            <select name="NovelList1">
                <?php foreach ($Novels as $novel):?>
                    <option value="<?php echo $novel->getTitle();?>"><?php echo $novel->getTitle();?></option>
                <?php endforeach;?>
            </select><br>
            <input type="submit"  value="Add"/><br>
        </form>
    </li>
</ul>

<ul>
    <li>
        <h2>Edit chapters</h2><br>
        <form action="/back/select_chapter/" method="get">
            <select name="NovelList2">
                <?php foreach ($Novels as $novel):?>
                    <option value="<?php echo $novel->getTitle();?>"><?php echo $novel->getTitle();?></option>
                <?php endforeach;?>
            </select><br>
            <input type="submit"  value="Edit"/><br>
        </form>
    </li>
</ul>

<ul>
    <li>
        <h2>Add Novel</h2><br><br>
        <button type="button" onclick="document.location.href='/back/add_novels'">Add</button><br>
    </li>
</ul>

<ul>
    <li>
        <h2>Edit Novel</h2><br>
        <form action="/back/edit_novels/" method="get">
            <select name="NovelList3">
                <?php foreach ($Novels as $novel):?>
                    <option value="<?php echo $novel->getTitle();?>"><?php echo $novel->getTitle();?></option>
                <?php endforeach;?>
            </select><br>
            <input type="submit"  value="Edit"/><br>
        </form>
    </li>
</ul>

