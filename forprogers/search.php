<?php  
    require_once('DB.php');
    global $searched_users;

    if (!isset($_COOKIE['numb_p3'])) 
        $_COOKIE['numb_p3'] = 0;
    $_COOKIE['numb_p3']++;
    setcookie('numb_p3', $_COOKIE['numb_p3']);

    $total_visits = $_COOKIE['numb_p1'] + $_COOKIE['numb_p2'] + $_COOKIE['numb_p3'];
    $curent_page_visits = $_COOKIE['numb_p3'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Тестовое задание Webcompany</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-3.7.0.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="js/jquery.lavalamp.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $("#1, #2, #3").lavaLamp({
                    fx: "backout",
                    speed: 700,
                    click: function (event, menuItem) {
                        return true;
                    }
                });
            });
        </script>
        <link href="lavalamp.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="wrap">
            <div id="topbg"> </div>
            <div id="wrap2">
                <div id="topbar">
                    <img style="float:left;margin:0 150px 0 20px;height:65px;" src="images/logo.svg" alt="logo"> 
                    <h1 id="sitename"><a href="#">Тестовое задание</a> <span class="description"></span></h1>
                </div>
                <div id="header">
                    <div id="headercontent"> </div>
                    <div id="topnav">
                        <ul class="lavaLampWithImage" id="1">
                            <li  ><a href="cities.php">Города</a></li>
                            <li  ><a href="users.php">Пользователи</a></li>
                            <li class='current' ><a href="#">Поиск</a></li>
                        </ul>
                    </div>
                </div>
                <div id="content">
                    <div id="left">   
                        <div class="post">
                            <div class="postheader"> </div>
                            <div class="postcontent"> 
                                <h2>Общее количество загрузок страницы = <b><?=$total_visits?></b></h2>
                            </div>
                            <div class="postbottom">
                                <h3 style=" margin-left: 25px; ">
                                    Вы посещали эту страницу 
                                    <b><?=$curent_page_visits?></b> раз
                                </h3>
                            </div>
                        </div>
                        
                        <!--форма для поиска по имени и фамилии-->
                        <form action="" method="post">
                            <div class='form'>
                                <h3>Поиск по имени и/или фамилии пользователя</h3>
                                <span>
                                    <input type="search" pattern="[A-Za-zА-Яа-яЁё]{3,16}" name="ins_sh_name" value='' required placeholder="Введите запрос">
                                </span>
                                <input type="submit" name="sub_sh_name" value="Поиск">
                            </div>
                        </form>

                        <?php foreach ($searched_users as $user){ ?>
                        <div class='users'>
                            <img width='100' src="<?=$user['profile_img']?>" class='image' alt="Фотография">
                            <div class='userdan'>
                                <h4><?=$user['name']?> <?=$user['last_name']?></h4>
                                <p>Город: <?=$user['city']?></p>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    
                    <div class="clear"></div>
                </div>


                <div id="footer"> 
                    <div class="credit">Webcompany 2023г</div>
                </div>
            </div>
            <div id="btmbg"> </div>
        </div>
    </body>
    <script type="text/javascript" src="js/script.js"></script>
</html>
