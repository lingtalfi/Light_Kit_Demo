<?php


/**
 * @var $this LightKitPageRenderer
 */

use Ling\Light_Kit\PageRenderer\LightKitPageRenderer;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/plugins/Light_Kit_Demo/looplab/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <?php if (true === $this->copilot->hasTitle()): ?><title><?php echo $this->copilot->getTitle(); ?></title><?php endif; ?>

    <?php if (true === $this->copilot->hasDescription()): ?><meta name="description" content="<?php echo htmlspecialchars($this->copilot->getDescription()); ?>"><?php endif; ?>

</head>

<body data-spy="scroll" data-target="#main-nav" id="home">


<?php $this->printZone("main_zone"); ?>


<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>

<script>

    $(document).ready(function () {


        /**
         * Adds a top padding automatically to the first .container element, except if it's
         * the .container inside the top nav element.
         *
         * Note: depending on your layout, this might be a good/bad idea.
         * You might also want to first arrange your page, then when done, change the css manually (i.e. not
         * using a javascript solution like this).
         *
         */
        $('.container').not("nav .container").first().addClass('first-container');


        // Get the current year for the copyright
        $('#year').text(new Date().getFullYear());

        // Init Scrollspy
        $('body').scrollspy({target: '#main-nav'});


        // Smooth Scrolling
        $("#main-nav a").on('click', function (event) {
            if (this.hash !== "") {
                event.preventDefault();

                const hash = this.hash;

                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {

                    window.location.hash = hash;
                });
            }
        });
    });
</script>
</body>

</html>