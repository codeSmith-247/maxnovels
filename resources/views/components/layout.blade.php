
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name='CSRF_TOKEN' content='{{ csrf_token() }}'>
    
    <meta property="og:title" content="Maxnovels">
    <meta property="og:site_name" content="Maxnovels">
    <meta property="og:url" content="www.maxnovels.com">
    <meta property="og:description" content="Maxnovels is your online library dedicated to 
    bringing you the best books and stories from all genre. Explore, get inspired, inspire a generation" >
    <meta property="og:type" content="Books">
    <meta property="og:image" content="https://maxnovels.com/images/logo.png">
    <link rel="icon" type="image/x-icon" href="https://maxnovels.com/images/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" ></script>
    <meta property=fb:app_id content=824163028811849>
    
    
    <meta property="twitter:card" content="https://maxnovels.com/images/logo.png">
    <meta property="twitter:url" content="www.maxnovels.com">
    <meta property="twitter:title" content="Maxnovels">
    <meta property="twitter:description" content="Maxnovels is your online library dedicated to 
    bringing you the best books and stories from all genre. Explore, get inspired, inspire a generation">
    <meta property="twitter:image" content="https://maxnovels.com/images/logo.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" ></script>

    <script src = '/scripts/general.js' defer></script>
    <link rel='stylesheet' href='/styles/general.css'>
    <link rel='stylesheet' href='/styles/layout.css'>
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    
    <script>
        tailwind.config = {
          theme: {
            extend: {
              fontFamily: {
                sans: ['Poppins', 'sans-serif'],
              },
            }
          }
        }
      </script>

    @stack('header_links')
    
</head>
<body class = ''>

    <div class = 'loader p-fix top-left full-vhw z-10 flex-col flex-center'>
        <div class = 'ball-box flex-center flex-col'>
            <div class = 'ball p-rel z-2'></div>
            <div class = 'base-ball p-rel z-1'></div>
        </div>
        <div class = 'text-center' onclick = ''>Loading...</div>
    </div>

    
    <div class = 'wrapper'>
        {{ $slot }}


        <div class = 'mode-toggler flex-center round p-fix ' onclick = 'mode();'>
            <i class = 'bi bi-sun-fill'></i>
            <i class = 'bi bi-moon-fill'></i>
        </div>


        <footer>
            <div class = 'left flex-center'>
                <x-nav.logo />
            </div>
            <div class = 'right flex-col flex-center'>

                <div class = 'socials flex-row'>
                    <div class = 'icon flex-center round ov-hidden'>
                        <i class = 'bi bi-twitter'></i>
                    </div>

                    <div class = 'icon flex-center round ov-hidden'>
                        <i class = 'bi bi-facebook'></i>
                    </div>

                    <div class = 'icon flex-center round ov-hidden'>
                        <i class = 'bi bi-instagram'></i>
                    </div>

                    <div class = 'icon flex-center round ov-hidden'>
                        <i class = 'bi bi-whatsapp'></i>
                    </div>
                </div>

                <div class = 'info flex-center flex-wrap'>
                    <x-nav.nav_item name="Terms and Condition" icon='' link="/terms-and-conditions"/>
                    <x-nav.nav_item name="Privacy Policy" icon='' link="/privacy-policy"/>
                </div>
    
                <div class = 'info flex-center text-grey'>
                    © {{ date('Y') }} Copyright: Maxnovels 
                </div>

            </div>

            
        </footer>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
</html>