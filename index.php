<!doctype html>
<?php
if(file_exists('./bot/.maintenance.txt')){
    header('location: /maintenance');
    die;
}
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="anonymous">
    <link rel="preload" as="style" onload="this.rel='stylesheet'" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap">

    <script src="https://www.googletagmanager.com/gtag/js?id=G-LNG0XGL9ZV" async></script>
    <script>window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-LNG0XGL9ZV');
</script>

    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no"
    />
    <title>Goat Game</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script type="module" crossorigin src="assets/index.js?v=21"></script>
    <link rel="stylesheet" crossorigin href="assets/index.css?v=21">
  </head>
  <style>
    html {
      height: 100%;
      overflow: hidden;
    }

    body {
      height: 100%;
      overflow: hidden;
      min-height: 100%;
      isolation: isolate;
    }
  </style>
  <body style="background-color: #202229">
    <script>
      Telegram.WebApp.expand();
      Telegram.WebApp.setHeaderColor('#2A2D36');
      Telegram.WebApp.setBackgroundColor('#202229');
    </script>


    <div id="root"></div>

  </body>
</html>