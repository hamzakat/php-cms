<?php
$PAGE_TITLE = "Add Post";
require_once "configs.php";
require_once "controllers/PostsController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    $inputName = trim($_POST["name"]);
    if (empty($inputName)) {
        $nameErr = "Please enter your name.";
    } else {
        $name = $inputName;
    }

    // Validate title
    $inputTitle = trim($_POST["title"]);
    if (empty($inputTitle)) {
        $titleErr = "Please enter the post title.";
    } else {
        $title = $inputTitle;
    }

    // Validate text
    $inputText = nl2br($_POST["text"]);
    if (empty($inputText)) {
        $textErr = "Please enter the post content.";
    } else {
        $text = $inputText;
    }

    // Check if there is invalid input  before adding post
    if (empty($nameErr) && empty($titleErr) && empty($textErr)) {
        $newPost = Post::makePost($name, $title, $text);
        $result = $postsController->add($newPost);
        if ($result) {
            // created successfully, therefore, refresh the page
            header("location: index.php");
            exit();
        } else {
            die("Something went wrong. Please try again later.");
        }
    }
}
require "layout/head.php";
?>


<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-15 mx-auto">
        <div class="lg:w-1/2 md:w-2/3 mx-auto">

            <!-- Print errors if there are any -->
            <?php
            if (isset($nameErr, $titleErr, $textErr)) { ?>
                <p class="text-red-700">
                    <?php echo $nameErr . "<br />" . $titleErr . "<br />" . $textErr . "<br />" ?>
                </p>
            <?php } ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">Author Name</label>
                            <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="title" class="leading-7 text-sm text-gray-600">Title</label>
                            <input type="text" id="title" name="title" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="message" class="leading-7 text-sm text-gray-600">Content</label>
                            <textarea id="text" name="text" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                            <input type="submit" value="Post">
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require "layout/footer.php" ?>