<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .comments-section {
            border: 1px solid black;
        }
        .comment {
            border: 1px dashed black;
            background: #cde0ff;
        }
        .comment p:nth-child(2) {
            font-size: larger;
        }
        .comment p:nth-child(3) {
            font-size: smaller;
        }
    </style>
</head>
<body>
<div class="comments-section">
    <?php foreach ($response as $commentsArray): ?>
        <div class="comment">
        <?php
            foreach ($commentsArray as $text) {
            print_r("<p>" . $text . "</p>");
        }?>
        </div>
<?php endforeach; ?>

</div>

</body>
</html>