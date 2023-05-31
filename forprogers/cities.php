<?php  
    
    require_once('DB.php');
    global $db;
    global $cities;
    if (!isset($_COOKIE['numb_p1'])) 
        $_COOKIE['numb_p1'] = 0;
    $_COOKIE['numb_p1']++;
    setcookie('numb_p1', $_COOKIE['numb_p1']);

    $total_visits = $_COOKIE['numb_p1'] + $_COOKIE['numb_p2'] + $_COOKIE['numb_p3'];
    $curent_page_visits = $_COOKIE['numb_p1'];

    // $cities = $db->getCities();
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
                            <li class='current' ><a href="#">Города</a></li>
                            <li  ><a href="users.php">Пользователи</a></li>
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
                            <div class="postheader"></div>
                            <div class="postcontent"> 
                                <h2>Список городов</h2>               
                                
                                <!--вывод таблицы Города-->

                                <form action="" method="post" class="dopsity">
                                    <h3>Форма добовления города</h3>
                                    <input type="text" name="city_name" required="" placeholder="Название города">
                                    <input type="text" name="city_sort_index" required="" placeholder="Индекс Сортировки">
                                    <br>
                                    <input type="submit" name="add_city" value="Добавить">
                                    <input type="button" class="sort_city" name="sort_city" value="Сортировать" >
                                </form>


                                <form class="edit_city_form" action="" method="post">
                                    <div class="form">
                                        <h3>Форма редактирования города</h3>
                                        <span>
                                            Название:
                                            <input type="text" class="edit_text_city" name="edit_text_city" required="" value="">
                                            <input hidden type="text" class="edit_text_city_old" name="edit_text_city_old" value="">
                                        </span>
                                        <span>
                                            Индекс Сортировки:
                                            <input type="text" class="edit_text_rangir" name="edit_text_rangir" required="" value="">
                                        </span>
                                        <input type="hidden" class="edit_id" name="id" value="">
                                        <input type="submit" name="submit_edit_city" value="Подтвердить редактирование">
                                        <a class="edit_close">Отмена</a>
                                    </div>  
                                </form>
                                
                                <form class="sort_city_form" action="" method="post">
                                    <div class="sortform">
                                        <div class="pole">
                                            <h3>Поле сортировки</h3>
                                            <span>
                                                <input type="radio" name="sort_city" value="id" checked="">
                                                <b>id</b>
                                            </span>
                                            <span>
                                                <input type="radio" name="sort_city" value="name">
                                                <b>Название Города</b>
                                            </span>
                                            <span>
                                                <input type="radio" name="sort_city" value="sort_index">
                                                <b>Индекс Сортировки</b>
                                            </span>
                                        </div>
                                        <div class="napr">
                                            <h3>Направление сортировки</h3>
                                            <span>
                                                <input type="radio" name="sort_order_by" value="ASC" checked="">
                                                <b>Возрастание</b>
                                            </span>
                                            <span>
                                                <input type="radio" name="sort_order_by" value="DESC">
                                                <b>Убывание</b>
                                            </span> 
                                        </div>
                                        <input type="submit" name="submit_sort_city" value="Сортировать">
                                        <a class="close_city_form">Отмена</a>
                                    </div>

                                </form>


                                <?php foreach ($cities as $city){ ?>

                                <div class='cpsity'>
                                    <h3><?=$city['name']?></h3>
                                    <span>
                                        <form action="" method="post" >
                                            <input type="hidden" name="id" value="<?=$city['id']?>" >
                                            <input type="submit" name="del_fors_city" onclick="return confirm('Вы действительно хотите удалить город?')" value="Удалить" >
                                        </form>	
                                    </span>
                                    <span>
                                        <form>
                                            <input type="button" class="edit_fors_city" id="<?=$city['id']?>" value="Редактировать" >
                                        </form>
                                    </span>
                                </div>
                                <?php } ?>            


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
