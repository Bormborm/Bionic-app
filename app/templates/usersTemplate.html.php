<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="users-section">
    <?php echo '<pre>'; var_dump($response); echo '</pre>';
    foreach ($response as $userObjects){
        foreach ($userObjects as $userObject) {}
 echo "<br/>";
            //print_r("<div><p>" . $userObject->getName() . "</p></div>");

    }?>
</div>

</body>
</html>