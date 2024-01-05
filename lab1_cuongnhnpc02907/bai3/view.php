<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if ($user !== null): ?>
        <?= $user['firstname'] . " " . $user['lastname']; ?>
    <?php else: ?>
        User not found.
    <?php endif; ?>
    <form action="" method="post">
        <input type="email" name="email" id="">
        <input type="submit" value="submit">
    </form>
</body>
</html>