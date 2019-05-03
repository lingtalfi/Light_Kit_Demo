Light_Kit_Demo
===========
2019-04-25


WORK IN PROGRESS, COME BACK IN A FEW MONTHS...



Some demonstration of how to use Light_Kit with concrete websites.


This is part of the [universe framework](https://github.com/karayabin/universe-snapshot).


Install
==========
Using the [uni](https://github.com/lingtalfi/universe-naive-importer) command.
```bash
uni import Ling/Light_Kit_Demo
```

Or just download it and place it where you want otherwise.






Summary
===========
- [Light_Kit_Demo api](https://github.com/lingtalfi/Light_Kit_Demo/blob/master/doc/api/Ling/Light_Kit_Demo.md) (generated with [DocTools](https://github.com/lingtalfi/DocTools))
- [The demos](#the-demos)
- [What is this?](#what-is-this)
- [The prototype organization](#the-prototype-organization)
- [The real website organization](#the-real-website-organization)
    - [index.php](#indexphp)
    - [The Light_Kit configuration](#the-light_kit-configuration)
    - [The looplab_home page](#the-looplab_home-page)
    - [The layout page](#the-layout-page)
- [History Log](#history-log)


The demos
===========

Checkout the [5 Light Kit demos](http://lingtalfi.com/Light_Kit_Demo).

All the demos are themes created by Brad Traversy in this course [Bootstrap 4 From Scratch With 5 Projects ](https://www.udemy.com/bootstrap-4-from-scratch-with-5-projects/).

The 5 websites use Bootstrap 4 and are responsive.

Their names are:

- LoopLab
- Mizuxe
- Glozzom
- Blogen
- PortfolioGrid




What is this?
============


The goal of this [planet](https://github.com/karayabin/universe-snapshot) is to help anybody creating website with [Light_Kit](https://github.com/lingtalfi/Light_Kit).

It does so by providing 5 examples of websites (in this case all created with boostrap 4), along with the source code.


The methodology I've used for those demos is the following:

- create a prototype website first (optional)
- then create the real website 


The prototype website is using only prototype widgets.
A prototype widget is just a static html widget, it's not administrable with php, so you can't change its variables.

The real website is the version with working widgets (php driven widgets).


The benefit for me to create a prototype version, is that I can show you the demos right now, without you
having to wait for me to create all php widgets (which might take quite some time).



The prototype organization
==============

In this section, I'll discuss the general organization of a prototype website in a [Light](https://github.com/lingtalfi/Light) application,
using [Light_Kit].

Basically, all **Light_Kit** does is providing us with a **kit** service to use in our **Light** application.
 
The kit service by default uses a [BabyYaml](https://github.com/lingtalfi/BabyYaml) configuration storage which allows us to store all of our configuration in 
the **config/kit/pages** directory of our app.



Actually, in the [map directory of this repository](https://github.com/lingtalfi/Light_Kit_Demo/tree/master/assets/map), you'll find all the files used for the demos.


Those files are copy/pasted in the application as is.


If we take the LoopLab demo for instance, the structure looks like this:


- [config/kit/pages/Light_Kit_Demo/looplab/prototype/looplab_home.byml](https://github.com/lingtalfi/Light_Kit_Demo/blob/master/assets/map/config/kit/pages/Light_Kit_Demo/looplab/prototype/looplab_home.byml)
- [templates/Light_Kit_Demo/layouts/prototype/looplab_main_layout.php](https://github.com/lingtalfi/Light_Kit_Demo/blob/master/assets/map/templates/Light_Kit_Demo/layouts/looplab/prototype/looplab_main_layout.php)
- [templates/Light_Kit_Demo/widgets/prototype/looplab/](https://github.com/lingtalfi/Light_Kit_Demo/tree/master/assets/map/templates/Light_Kit_Demo/widgets/prototype/looplab)
- [templates/Light_Kit_Demo/widgets/prototype/looplab/looplab_footer_with_contact_us_button.php](https://github.com/lingtalfi/Light_Kit_Demo/blob/master/assets/map/templates/Light_Kit_Demo/widgets/prototype/looplab/looplab_footer_with_contact_us_button.php)
- [www/plugins/Light_Kit_Demo/looplab](https://github.com/lingtalfi/Light_Kit_Demo/tree/master/assets/map/www/plugins/Light_Kit_Demo/looplab)




Notice that this structure respects the [recommended Light app structure](https://github.com/lingtalfi/Light/blob/master/doc/pages/light-application-recommended-structure.md).

  


The page configuration file (looplab_home.byml) is a regular [kit page configuration array](https://github.com/lingtalfi/Kit#the-kit-configuration-array).

Then the layout (looplab_main_layout.php) is the skeleton of the page. We can see that it contains a printZone statement, which
is one of the most useful method to use in a layout, allowing us to print a zone (group of widgets).


Then the **templates/Light_Kit_Demo/widgets/prototype/looplab** directory contains all the prototype widgets used for the LoopLab theme.
 
And last but not least the **www/plugins/Light_Kit_Demo/looplab** directory contains all the assets used for the LoopLab theme.


On the server side, I just use regular Light code, here is my code for the looplab demo:


```php
<?php


use Ling\Light\Core\Light;
use Ling\Light\Helper\ServiceContainerHelper;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;


require_once __DIR__ . "/../../../universe/bigbang.php"; // activate universe






$appDir = __DIR__ . "/../../..";
$container = ServiceContainerHelper::getInstance($appDir, [
    'type' => 'red',
]);

$light = new Light();
$light->setDebug(true);
$light->setContainer($container);


$light->registerRoute("/Light_Kit_Demo", function (LightServiceContainerInterface $service) {
    return $service->get("kit")->renderPage('Light_Kit_Demo/looplab/prototype/looplab_home');
});
$light->run();

```


Note that since I was using a server of mine and I wanted to use only one url namespace for all demos,
I used $_GET variables to navigate around the demos (site and page variables to be more precise),
but that's just specific to my server, you can create one url per page if you want, or whatever.





The real website organization
==============

Let's create the [LoopLab theme](http://lingtalfi/Light_Kit_Demo?site=looplab) using real widgets.




index.php
-----------------

Let's start with the entry point of the web application, **index.php** in my case:

```php
<?php


use Ling\Light\Core\Light;
use Ling\Light\Helper\ServiceContainerHelper;
use Ling\Light\ServiceContainer\LightServiceContainerInterface;


require_once __DIR__ . "/../../../universe/bigbang.php"; // activate universe





// we're using a service container
$appDir = __DIR__ . "/../../..";
$container = ServiceContainerHelper::getInstance($appDir, [
    'type' => 'red',
]);


// instantiate the light 
$light = new Light();
$light->setDebug(true); // set that to false in production
$light->setContainer($container);


$light->registerRoute("/Light_Kit_Demo", function (LightServiceContainerInterface $service) {
    return $service->get("kit")->renderPage('Light_Kit_Demo/looplab/looplab_home');
});
$light->run();

```



The Light_Kit configuration
-------------

Here is the kit configuration I'm using.

Reminder: the kit service is injected automatically in your app when you import the [Light_Kit planet](https://github.com/lingtalfi/Light_Kit).

```yaml
kit:
    instance: Ling\Light_Kit\PageRenderer\LightKitPageRenderer
    methods:
        configure:
            settings:
                application_dir: ${app_dir}
        setConfStorage:
            -
                instance: Ling\Kit\ConfStorage\BabyYamlConfStorage
                methods:
                    setRootDir:
                        rootDir: ${app_dir}/config/kit/pages
        setContainer:
            container: @container()

    methods_collection:
        -
            method: registerWidgetHandler
            args:
                - picasso
                -
                    instance: Ling\Kit_PicassoWidget\WidgetHandler\PicassoWidgetHandler
                    constructor_args:
                        options:
                            showCssNuggetHeaders: true
                            showJsNuggetHeaders: true
                    methods:
                        setWidgetBaseDir:
                            dir: ${app_dir}
        -
            method: registerWidgetHandler
            args:
                - prototype
                -
                    instance: Ling\Kit_PrototypeWidget\WidgetHandler\PrototypeWidgetHandler
                    methods:
                        setRootDir:
                            appDir: ${app_dir}


kit_css_file_generator:
    instance: Ling\Light_Kit\CssFileGenerator\LightKitCssFileGenerator
    constructor_args:
        rootDir: ${app_dir}/www
        format: css/tmp/$identifier-compiled-widgets.css
```


I pasted it here so that you can notice that I'm using a BabyYamlConfStorage, which rootDir is **${app_dir}/config/kit/pages**.

That's important, because that's where the page files will be found.


The looplab_home page
-----------

From the **index.php**, we call the **Light_Kit_Demo/looplab/looplab_home** page.

Now because of the kit service configuration we are using, this path resolves to **${app_dir}/config/kit/pages/Light_Kit_Demo/looplab/looplab_home.byml**.


What follows is the content of that file:


```yaml
label: LoopLab main page
layout: templates/Light_Kit_Demo/layouts/looplab/looplab_main_layout.php
layout_vars: []

title: LoopLab one page theme
description: <
    This is the LoopLab one page theme, created by Brad Traversy, and implemented with the Light_Kit plugin from the Light framework.
>

zones:
    main_zone:
        -
            name: main_nav
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\MainNavWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/MainNavWidget
            template: default.php
            skin: looplab-nav
            vars:
                attr:
                    id: main-nav
                    class: bg-dark navbar-dark looplab-nav
                title: LoopLAB
                fixed_top: true
                use_scrollspy: true
                use_smooth_scrolling: true
                title_url: /
                expand_size: sm
                links:
                    -
                        text: Home
                        url: "#home"
#                        icon: fas fa-user
                    -
                        text: Explore
                        url: "#explore-head-section"

                    -
                        text: Create
                        url: "#create-head-section"
                    -
                        text: Share
                        url: "#share-head-section"
                links_align_right: true
        -
            name: looplab_two_columns_signup_form
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\LoopLabTwoColumnsSignupFormWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/LoopLabTwoColumnsSignupFormWidget
            template: default.php
            vars:
                attr:
                    id: home
                showTeaser: true
                form_align_right: false
                teaser_visible_size: lg
                teaser_title: Build <strong>social profiles</strong> and gain revenue <strong>profits</strong>
                teaser_items:
                    -
                        icon: fas fa-check fa-2x
                        text:  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed, tempore iusto in minima facere dolorem!
                    -
                        icon: fas fa-check fa-2x
                        text:  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed, tempore iusto in minima facere dolorem!
                    -
                        icon: fas fa-check fa-2x
                        text:  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed, tempore iusto in minima facere dolorem!
                form_title: Sign up Today
                form_subtitle: Please fill out this form to register
                form_fields:
                    -
                        name: username
                        placeholder: Username
                        type: text
                    -
                        name: email
                        placeholder: Email
                        type: text
                    -
                        name: password
                        placeholder: Password
                        type: password
                    -
                        name: confirm_password
                        placeholder: Confirm Password
                        type: password
                form_submit_value: Submit
                form_submit_class: btn btn-outline-light btn-block
                background_style: url('/plugins/Light_Kit_Demo/looplab/img/home.jpg')

        -
            name: looplab_monochrome_header
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\LoopLabMonoChromeHeaderWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/LoopLabMonoChromeHeaderWidget
            template: default.php
            skin: looplab-dark
            vars:
                attr:
                    class: looplab-dark
                    id: explore-head-section
                title: Explore
                text: Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente doloribus ut iure itaque quibusdam rem accusantium deserunt reprehenderit sunt minus.
                button_url: '#'
                button_class: btn btn-outline-secondary
                button_text: Find Out More


        -
            name: looplab_two_columns_teaser
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\LoopLabTwoColumnsTeaserWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/LoopLabTwoColumnsTeaserWidget
            template: default.php
            vars:
                attr:
                    class: bg-light text-muted py-5
                img_on_left: true
                img_rounded: true
                img_src: img/explore-section1.jpg
                img_alt: Explore & Connect
                teaser_title: Explore & Connect
                teaser_text: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore reiciendis, voluptate at alias laborum odit aliquidtempore perspiciatis repudiandae hic?
                teaser_items:
                    -
                        icon: fas fa-check fa-2x
                        text: Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi distinctio iusto, perspiciatis mollitia natus harum?
                    -
                        icon: fas fa-check fa-2x
                        text: Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi distinctio iusto, perspiciatis mollitia natus harum?
        -
            name: looplab_monochrome_header
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\LoopLabMonoChromeHeaderWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/LoopLabMonoChromeHeaderWidget
            template: default.php
            vars:
                attr:
                    class: text-white bg-primary
                    id: create-head-section
                title: Create
                text: Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente doloribus ut iure itaque quibusdam rem accusantium deserunt reprehenderit sunt minus.
                button_url: '#'
                button_class: btn btn-outline-light
                button_text: Find Out More
        -
            name: looplab_two_columns_teaser
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\LoopLabTwoColumnsTeaserWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/LoopLabTwoColumnsTeaserWidget
            template: default.php
            skin: looplab-dark
            vars:
                attr:
                    class: looplab-dark py-5
                img_on_left: false
                img_rounded: true
                img_src: img/create-section1.jpg
                img_alt: Create Your Passion
                teaser_title: Create Your Passion
                teaser_text: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore reiciendis, voluptate at alias laborum odit aliquidtempore perspiciatis repudiandae hic?
                teaser_items:
                    -
                        icon: fas fa-check fa-2x
                        text: Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi distinctio iusto, perspiciatis mollitia natus harum?
                    -
                        icon: fas fa-check fa-2x
                        text: Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi distinctio iusto, perspiciatis mollitia natus harum?
        -
            name: looplab_monochrome_header
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\LoopLabMonoChromeHeaderWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/LoopLabMonoChromeHeaderWidget
            template: default.php
            vars:
                attr:
                    class: text-white bg-primary
                    id: share-head-section
                title: Share
                text: Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente doloribus ut iure itaque quibusdam rem accusantium deserunt reprehenderit sunt minus.
                button_url: '#'
                button_class: btn btn-outline-light
                button_text: Find Out More

        -
            name: looplab_two_columns_teaser
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\LoopLabTwoColumnsTeaserWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/LoopLabTwoColumnsTeaserWidget
            template: default.php
            vars:
                attr:
                    class: bg-light text-muted py-5
                img_on_left: true
                img_rounded: true
                img_src: img/share-section1.jpg
                img_alt: Share What You Create
                teaser_title: Share What You Create
                teaser_text: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore reiciendis, voluptate at alias laborum odit aliquidtempore perspiciatis repudiandae hic?
                teaser_items:
                    -
                        icon: fas fa-check fa-2x
                        text: Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi distinctio iusto, perspiciatis mollitia natus harum?
                    -
                        icon: fas fa-check fa-2x
                        text: Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi distinctio iusto, perspiciatis mollitia natus harum?
        -
            name: looplab_footer_with_contact_us_button
            type: picasso
            className: Ling\Light_Kit_BootstrapWidgetLibrary\Widget\Picasso\LoopLabFooterWithContactUseButtonWidget
            widgetDir: templates/Light_Kit_BootstrapWidgetLibrary/widgets/picasso/LoopLabFooterWithContactUseButtonWidget
            template: default.php
            vars:
                attr:
                    class: bg-dark
                footer_title: LoopLab
                footer_text: Copyright &copy; $year
                footer_button_class: btn btn-primary
                footer_button_text: Contact Us
                modal_title: Contact Us
                modal_form_action: ""
                modal_form_method: post
                modal_fields:
                    -
                        label: Name
                        name: name
                        type: text
                    -
                        label: Email
                        name: email
                        type: email
                    -
                        label: Message
                        name: message
                        type: textarea

                modal_btn_text: Submit
                modal_btn_class: btn btn-primary btn-block





```


A couple of things:

- all widgets are picasso widgets from the [light kit bootstrap widget library](https://github.com/lingtalfi/Light_Kit_BootstrapWidgetLibrary). Read [the widgets documentation](https://github.com/lingtalfi/Light_Kit_BootstrapWidgetLibrary/blob/master/doc/pages/widget-variables-description.md) for more info about the widgets.
- this is just the example page for the LoopLab theme, but it works the same for all other themes
- you can find the page configuration files for all the themes in the [pages directory of this repository](https://github.com/lingtalfi/Light_Kit_Demo/tree/master/assets/map/config/kit/pages/Light_Kit_Demo)
- more generally, you can find all source code for the demos in [the map directory of this repository](https://github.com/lingtalfi/Light_Kit_Demo/tree/master/assets/map)

 
And that's it for the real website demo.
With the page configuration above, we get the LoopLab theme.

Now it's the same principle for all themes.


  
Note: this planet is still a work in progress, and I'm currently working on the real websites versions for other demos.



The layout page
------------------

The layout used by the LoopLab home page has the following content.

- you can find the layouts for all the themes in the [layout directory of this repository](https://github.com/lingtalfi/Light_Kit_Demo/tree/master/assets/map/templates/Light_Kit_Demo/layouts)

```php
<?php


/**
 * @var $this LightKitPageRenderer
 */


use Ling\Bat\StringTool;
use Ling\Light_Kit\PageRenderer\LightKitPageRenderer;


$container = $this->getContainer();


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


    <link rel="stylesheet"
          href="<?php echo $container->get('kit_css_file_generator')->generate($this->copilot, $this->pageName); ?>">


    <link rel="stylesheet" href="css/style.css">

    <?php if (true === $this->copilot->hasTitle()): ?>
        <title><?php echo $this->copilot->getTitle(); ?></title><?php endif; ?>

    <?php if (true === $this->copilot->hasDescription()): ?>
        <meta name="description"
              content="<?php echo htmlspecialchars($this->copilot->getDescription()); ?>"><?php endif; ?>

</head>

<body <?php echo StringTool::htmlAttributes($this->copilot->getBodyTagAttributes()); ?>>


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


    });
</script>

<?php if (true === $this->copilot->hasJsCodeBlocks()): ?>

    <script>

        <?php $blocks = $this->copilot->getJsCodeBlocks(); ?>
        <?php foreach($blocks as $block): ?>
        <?php echo $block; ?>
        <?php endforeach; ?>

    </script>

<?php endif; ?>
</body>

</html>
```




History Log
=============

- 0.6.4 -- 2019-05-03

    - update README.md  
    
- 0.6.3 -- 2019-05-03

    - update README.md looplab configuration page, now reflects the website more accurately (especially the nav)  
    
- 0.6.2 -- 2019-05-03

    - update README.md add looplab layout content  
    
- 0.6.1 -- 2019-05-03

    - fix README.md looplab page example missing ids  
    
- 0.6.0 -- 2019-05-03

    - update the README.md with real website example for looplab  
    
- 0.5.0 -- 2019-05-01

    - update the README.md with online demos  
    
- 0.4.0 -- 2019-04-29

    - adjust active navigation item  
    
- 0.3.0 -- 2019-04-29

    - adjust paths for multi-pages prototypes  
    
- 0.2.0 -- 2019-04-29

    - add prototypes for 5 projects 
    
- 0.1.0 -- 2019-04-26

    - add assets for looplab prototype version 

- 0.0.0 -- 2019-04-25

    - initial commit