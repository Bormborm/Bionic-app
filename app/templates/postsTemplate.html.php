<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .posts-section {
            border: 1px solid black;
        }
        .post {
            border: 1px dashed black;
            background: #cde0ff;
        }
        .post p:nth-child(1) {
            font-size: larger;
        }
        .post p:nth-child(2) {
            font-size: smaller;
        }
    </style>
</head>
<body>
<div class="posts-section">
    <?php foreach ($response as $postsArray): ?>
        <div class="post">
            <?php
            foreach ($postsArray as $text) {
                print_r("<p>" . $text . "</p>");
            }?>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>