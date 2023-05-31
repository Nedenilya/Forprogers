<?php  
    require_once('DB.php');
    global $db;
    global $cities;
    global $users;

    if (!isset($_COOKIE['numb_p2'])) 
        $_COOKIE['numb_p2'] = 0;
    $_COOKIE['numb_p2']++;
    setcookie('numb_p2', $_COOKIE['numb_p2']);

    $total_visits = $_COOKIE['numb_p1'] + $_COOKIE['numb_p2'] + $_COOKIE['numb_p3'];
    $curent_page_visits = $_COOKIE['numb_p2'];

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
                            <li class='current' ><a href="#">Пользователи</a></li>
                            <li  ><a href="search.php">Поиск</a></li>
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
                                <h3 style=" margin-left: 25px; ">Вы посещали эту страницу <b>
                                        <?=$curent_page_visits?></b> раз</h3>
                            </div>
                        </div>
                        <div class="post">
                            <div class="postheader"> </div>
                            <div class="postcontent"> 
                                <h2>Список Пользователей</h2> 
                                <p><a name="top"></a></p>
                                        <!--Сортирвка-->
                                <h3><a href="#down">Вниз</a></h3>
                                <div style="display:inline-block">
                                    <form action="" method="post" >
                                        <input type="button" class="add_user_form_open" name="ins2" value="Добавить" >
                                        <input type="button" class="user_sort" name="sort2" value="Сортировать" >
                                    </form>	
                                </div>
                <!--Создадим выпадающий список "Города"-->
                                <div class="filter">
                                    <form action="" method="post">
                                        <h3>Фильтр по Городам</h3>
                                        <select size="1" name="selcity_2">
                                            <option disabled>Выберите город</option>
                                            <option value="all">Показать все</option>
                                            <?php foreach ($cities as $city) { ?>
                                            <option value="<?=$city['name']?>"><?=$city['name']?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="submit" name="sort_fc" onclick="hhh()" value="Показать">
                                    </form>
                                </div>

                                <form class="add_user_form" action="" method="post" enctype="multipart/form-data">
                                    <div class="form">
                                        <h3>Форма Добовления Пользователя</h3>
                                        <input type="text" name="name" required="" placeholder="Имя">
                                        <input type="text" name="last_name" required="" placeholder="Фамилия">
                                        <span>город: 
                                            <select size="1" name="city">                                                
                                                <option disabled="">Выберите город</option>
                                                <?php foreach ($cities as $city) { ?>
                                                <option value="<?=$city['name']?>"><?=$city['name']?></option>
                                                <?php } ?>
                                            </select>
                                        </span>
                                        <p>Выберите файл изображения</p>
                                        <input type="file" name="uploadfile">

                                        <input type="submit" name="subm_ins_names" value="Добавить">
                                        <a class="close_add_user">Отмена</a> 
                                    </div>
                                </form>

                                <form class="user_edit_form" action="" method="post" enctype="multipart/form-data">
                                    <div class="form">
                                        <h3>Форма Редактирования Пользователя</h3>
                                        <span>Имя 
                                            <input type="text" class="edit_text_name" name="name" required="" value=""> 
                                        </span>
                                        <span>Фамилия 
                                            <input type="text" class="edit_text_surname" name="last_name" required="" value=""> 
                                        </span>
                                        <span>Город 
                                            <select size="1" class="edit_selcity" name="city">
                                                <option disabled="">Выберите город</option>
                                                <?php foreach ($cities as $city) { ?>
                                                <option value="<?=$city['name']?>"><?=$city['name']?></option>
                                                <?php } ?>
                                            </select>
                                        </span>
                                        <img src="" class="prof_image" alt="Фотография" width="100">
                                        <input type="file" name="uploadfile">
                                        <input type="hidden" name="photo" class="hid_img" value="">
                                        <input type="hidden" class="id_red" name="id_red" value="">
                                        <input type="submit" name="subm_edit_names" value="Подтвердить редактирование"> 
                                        <a class="close_user_edit">Отмена</a>
                                    </div>
                                </form>

                                <form class="user_sort_form" action="" method="post">
                                    <div class="sortform">
                                        <div class="pole">
                                            <h3>Поле сортировки</h3>
                                            <span>
                                                <input type="radio" name="sort_name" value="id" checked="">
                                                <b>id</b>
                                            </span>
                                            <span>
                                                <input type="radio" name="sort_name" value="name" checked="">
                                                <b>Имя</b>
                                            </span>
                                            <span>
                                                <input type="radio" name="sort_name" value="last_name" checked="">
                                                <b>Фамилия</b>
                                            </span>
                                            <span>
                                                <input type="radio" name="sort_name" value="city" checked="">
                                                <b>Городу</b>
                                            </span>
                                        </div>
                                        <div class="napr">
                                            <h3>Направление сортировки</h3>
                                            <span>
                                                <input type="radio" name="sort_order_by_2" value="ASC" checked="">
                                                <b>Возрастание</b>
                                            </span>
                                            <span>
                                                <input type="radio" name="sort_order_by_2" value="DESC">
                                                <b>Убывание</b>
                                            </span> 
                                        </div>
                                        <input type="submit" class="submit_sort_names" name="submit_sort_names" value="Сортировать">
                                        <a class="close_user_sort">Отмена</a>
                                    </div>
                                </form>

                                <?php foreach ($users as $user){ ?>

                                <div class='users'>
                                        <img width='100' src="<?=$user['profile_img']?>" class='image' alt="Фотография">
                                        <div class='userdan'>
                                            <h4><?=$user['name']?> <?=$user['last_name']?></h4>
                                            <p>Город: <?=$user['city']?></p>


                                            <form action="" method="post" >
                                                <input type="hidden" name="id" value="<?=$user['id']?>" >
                                                <input type="submit" name="del_fors_names" value="Удалить" onclick="return confirm('Вы действительно хотите удалить пользователя?')">
                                            </form>	

                                            <form action="" method="post" >
                                                <input type="button" class="edit_fors_names" id="<?=$user['id']?>" value="Редактировать" >
                                            </form>
                                        </div>
                                </div>
                                <?php } ?>
                    
                                <a name="down"></a>
                                <h3><a href="#top">Наверх</a></h3>    
                            </div>
                            <div class="postbottom"></div>
                        </div>                    
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
