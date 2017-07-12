<?php include('templates/start.php'); ?>
<div class="content">
    <?php include('forms/newQuote.php'); ?>
    <ul><?php foreach ($data as $quote): ?>
        <?php include('templates/quote.php'); ?>
    <?php endforeach; ?>
    </ul>
</div>
<?php include('templates/end.php'); ?>