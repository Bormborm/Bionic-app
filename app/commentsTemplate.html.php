<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="posts-section">
    <?php foreach ($response as $commentsArray){
        foreach ($commentsArray as $text) {
            print_r("<div><p>" . $text . "</p></div>");
        }
    }?>
</div>

</body>
</html>