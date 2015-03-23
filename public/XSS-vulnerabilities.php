<!-- Try to submit <script>alert('attacked');</script> into the form to see what each
user handler function does to protect your site -->
<!-- View the page source to see how they translate the script characters -->

<?php
    $items = array('Item One', 'Item Two', 'Item Three');
    $allItems = array_merge($items, $_POST);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alternative Syntax</title>
</head>
<body>
    <h1>List of Items</h1>
    <ul>
    <?php foreach ($allItems as $item): ?>
        <li><?php echo htmlspecialchars($item); ?></li>
        <li><?php echo htmlentities($item); ?></li>
        <li><?php echo strip_tags($item); ?></li>
        <li><?php echo htmlspecialchars(strip_tags($item)); ?></li>
    <?php endforeach; ?>
    </ul>

    <form method="POST">
        <input type="text" id="newitem" name="newitem" placeholder="Add new todo item">
        <input type="submit" value="add">
    </form>
</body>
</html>