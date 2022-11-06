<?php
        
        
    $head = '';
    $body = '';

    require_once 'components/helper_functions.php';
    require_once 'pages/home_page/index.php';

    // get_components([
    //     'loading',
    //     'short_header',
    //     'search_box',
    //     'dark_mode_toggler',
    //     'large_card_box',
    //     'footer',
    // ]);

    // loading();
    // short_header();
    // search_box();
    // large_card_box();
    // footer();
    // dark_mode_toggler();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxnovels</title>

    <link rel = 'stylesheet' href = 'styles/general.css'>
    <link rel = 'stylesheet' href = 'styles/index.css'>

    <script src = 'scripts/general.js' defer></script>

    <?php
        echo $head; 
    ?>

</head>
<body class = ''>

    <div class = 'wrapper'>
        <?php
            echo $body;
        ?>
    </div>
    
</body>
</html>