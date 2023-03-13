<?php

require_once "configs.php";
require_once "controllers/ArticlesController.php";
require_once "controllers/CommentsController.php";

// Article objects 
$article = $articlesController->getArticleById($_GET['id']);

if (empty($article)) {
    http_response_code(404);
    include('404.php');
    die();
}
$PAGE_TITLE = $article->getTitle();

// array of comments
$comments = $commentsController->getAll($arg = $article->getId());

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    $inputName = trim($_POST["name"]);
    if (empty($inputName)) {
        $nameErr = "Please enter your name.";
    } else {
        $name = $inputName;
    }

    // Validate email
    $inputEmail = trim($_POST["email"]);
    if (empty($inputEmail)) {
        $emailErr = "Please enter the article title.";
    } else {
        $email = $inputEmail;
    }

    // Validate text
    $inputText = nl2br($_POST["text"]);
    if (empty($inputText)) {
        $textErr = "Please enter the article content.";
    } else {
        $text = $inputText;
    }

    // Check if there is invalid input  before adding post
    if (empty($nameErr) && empty($emailErr) && empty($textErr)) {
        $newComment = Comment::makeComment($article->getId(), $name, $email, $text);
        $result = $commentsController->add($newComment);
        if ($result) {
            // created successfully, therefore, refresh the page
            header("location: " . $_SERVER["REQUEST_URI"]);
            exit();
        } else {
            die("Something went wrong. Please try again later.");
        }
    }
}

require "layout/head.php";

?>

<!-- Article -->
<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-15 lg:w-2/ md:w-3/4 mx-auto">
        <div class="flex justify-between mb-6">
            <span>By <strong><?php echo $article->getContributorName() ?></strong></span>
            <span class="text-xs text-gray-400"><?php echo $article->getPublishDate() ?></span>
        </div>

        <p class="">
            <?php
            echo $article->getText();
            ?>
        </p>

    </div>
</section>

<!-- Comments -->
<div class="antialiased sm:mx-auto mx-10 max-w-screen-sm mt-20 border-t-4 border-indigo-500">
    <h3 class="mb-4 text-xl font-semibold text-gray-900">Comments</h3>

    <div class="divide-y-2 divide-gray-100">
        <!-- If there is no article -->
        <?php if (empty($comments)) { ?>
            <div class="py-8 flex flex-wrap md:flex-nowrap">
                <i>No comments.</i>
            </div>
        <?php } else { ?>
            <?php foreach ($comments as $comment) { ?>
                <div class="flex space-y-4 ">

                    <div class="flex-1 px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                        <div class="flex justify-between">
                            <span><strong><?php echo $comment->getContributorName() ?> </strong><span class="text-xs text-gray-400"><?php echo $comment->getContributorEmail() ?></span></span>
                            <span class="text-xs text-gray-400"><?php echo $comment->getPublishDate() ?></span>

                        </div>
                        <p class="text-sm">
                            <?php echo $comment->getText() ?>
                        </p>
                    </div>

                </div>
            <?php } ?>
        <?php } ?>


    </div>

    <!-- comment form -->
    <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method="post">
        <div class="flex flex-wrap mt-10">
            <?php
            if (isset($nameErr, $emailErr, $textErr)) { ?>
                <p class="text-red-700">
                    <?php echo $nameErr . "<br />" . $emailErr . "<br />" . $textErr . "<br />" ?>
                </p>
            <?php } ?>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                    <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                    <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>

            <div class="p-2 w-full">
                <div class="relative">
                    <label for="text" class="leading-7 text-sm text-gray-600">Content</label>
                    <textarea id="text" name="text" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                </div>
            </div>
            <div class="p-2 w-full">
                <button class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"><input type="submit" value="Add Comment"></button>
            </div>


        </div>
    </form>
</div>



<?php require("layout/footer.php") ?>