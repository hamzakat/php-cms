<?php
$PAGE_TITLE = "Hamza's Guestbook";
$DESCRIPTION = "Salam 👋 You can put your post here anonymously!";
require_once "configs.php";
require_once "controllers/PostsController.php";
require "layout/head.php";

// array of Post objects 
$posts = $postsController->getAll($arg = false);;


?>




<section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 py-24 lg:w-2/ md:w-3/4 mx-auto">
        <button class="flex mb-5 mx-auto text-white bg-indigo-500 border-0 py-2 px-5 focus:outline-none hover:bg-indigo-600 rounded text-lg">
            <a href="/add-post.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                </svg> <span> Add Post</span> </a>

        </button>
        <div class="-my-8 divide-y-2 divide-gray-100">
            <!-- If there is no post -->
            <?php if (empty($posts)) { ?>
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <strong>No posts. You can add one!</strong>
                </div>
            <?php } else { ?>




                <!-- List all posts -->
                <?php foreach ($posts as $post) { ?>
                    <div class="py-8 flex flex-wrap md:flex-nowrap">
                        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                            <span class="font-semibold title-font text-gray-700"><?php echo $post->getContributorName() ?></span>
                            <span class="mt-1 text-gray-500 text-sm"><?php echo $post->getPublishDate() ?></span>
                        </div>
                        <div class="md:flex-grow">
                            <h2 class="text-2xl font-medium text-gray-900 title-font mb-2"><?php echo $post->getTitle() ?></h2>
                            <p class="leading-relaxed">
                                <?php
                                // display only first 230 characters
                                echo mb_strimwidth($post->getText(), 0, 230, "...");
                                ?>
                            </p>
                            <a href="post.php?id=<?php echo $post->getId() ?>" class="text-indigo-500 inline-flex items-center mt-4">Read More
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php } ?>

            <?php } ?>
        </div>
    </div>
</section>

<?php require "layout/footer.php" ?>