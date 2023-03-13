<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($PAGE_TITLE) ? $PAGE_TITLE : "Title" ?></title>
    <link href="/css/main.css" rel="stylesheet">

</head>

<body>

    <section class="text-gray-600 body-font mt-5">

        <?php
        if ($PAGE_TITLE != "Articles") { ?>
            <div class="container lg:w-2/ md:w-3/4 px-5 mb-10 mx-auto">
                <a href="index.php" class="text-indigo-500 inline-flex items-center mt-4">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Back to homepage
                </a>
            </div>
        <?php } ?>

        <div class="flex flex-col text-center w-full mb-1">

            <h1 class="sm:text-3xl text-2xl font-medium title-font my-4 text-gray-900"> <?php echo isset($PAGE_TITLE) ? $PAGE_TITLE : "Title" ?> </h1>
            <?php
            if (isset($DESCRIPTION)) {
                echo "<p class=\"lg:w-2/3 mx-auto leading-relaxed text-base\">" . $DESCRIPTION . "</p>";
            }
            ?>

        </div>
        </div>
    </section>