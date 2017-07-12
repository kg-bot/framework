<div class="update-quote">
    <form action="/" method="post">
        <input type="hidden" name="c" value="Database">
        <input type="hidden" name="m" value="update">
        <input type="hidden" name="id" value="<?php echo $data->id; ?>">

        <input type="text" name="username" placeholder="Your username" value="<?php echo $data->username; ?>">
        <input type="text" name="quote" placeholder="Quote" value="<?php echo $data->quote; ?>">

        <br>
        <input type='submit' value="Update Quote">
    </form>
</div>