<?php 

require_once('ENV.php');

class DB{

	public $db;

	function __construct(){
        global $conn;
        $this->db = $conn;
    }
	
// ======================== work with cities table =========================== //

    function getCities($id = null){
        if($id == null){
            $sql = "SELECT * FROM cities";
            $query = $this->db->query($sql);
            return $query->fetch_all(MYSQLI_ASSOC);
        }else{
            $sql = "SELECT * FROM cities where id = {$id}";
            $query = $this->db->query($sql);
            $result = $query->fetch_all(MYSQLI_ASSOC);
            if ($result) {
                $data = '';
                foreach ($result as $row) {
                    $data = $row['id'] .'|'.$row['name'] .'|'.$row['sort_index'];
                }
                echo $data;
            }else{
                echo 'Empty data';
            }
        }
    }

    function getOrderedCities($field = null, $direction = null){
        global $cities;
        if($field != null and $direction != null){
            $sql = "SELECT * FROM cities ORDER BY {$field} {$direction}";
            $query = $this->db->query($sql);
            $cities = $query->fetch_all(MYSQLI_ASSOC);
            return $cities;
        }else{
            
            echo 'Empty sort';
        }
    }


    function addCity($city_name, $city_sort_index){
        if($city_name and $city_sort_index){
            $data = "(`name`, `sort_index`) VALUES ('{$city_name}', {$city_sort_index})";
            $sql = "INSERT INTO cities {$data}";
            $this->db->query($sql);
        }else{
            return 0;
        }
    }

    function editCity($id, $city_name, $city_sort_index, $old_city_name){
        if($id and $city_name and $city_sort_index){
            try {
                $this->db->query("UPDATE cities set `name` = '{$city_name}', `sort_index` = {$city_sort_index} where `id` = {$id}");
                $this->db->query("UPDATE users set `city` = '{$city_name}' where `city` = '{$old_city_name}'");
            } catch (Throwable $e) {
                var_dump($e);
            }
        }else{
            return 0;
        }
    }

    function deleteCity($id = null){
        if($id != null){
            try {
                $this->db->query("DELETE FROM cities where `id` = {$id}");
            } catch (Throwable $e) {
                return $e;
            }
        }else{
            return 0;
        }
    }

// ======================== (END) work with cities table =========================== //


// ======================== work with users table =========================== //

    function getUsers($id = null){
        if($id == null){
            $sql = "SELECT * FROM users";
            $query = $this->db->query($sql);
            return $query->fetch_all(MYSQLI_ASSOC);
        }else{
            $sql = "SELECT * FROM users where id = {$id}";
            $query = $this->db->query($sql);
            $result = $query->fetch_all(MYSQLI_ASSOC);
            if ($result) {
                $data = '';
                foreach ($result as $row) {
                    $data = $row['id'] .'|'.$row['name'] .'|'.$row['last_name'] .'|'.$row['city'] .'|'.$row['profile_img'];
                }
                echo $data;
            }else{
                echo 'Empty data';
            }
        }
    }

    function addUser($name, $last_name, $city){
        global $profile_images_path;
        $uploadfile = $profile_images_path . basename($_FILES['uploadfile']['name']);

        move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile);

        if($name and $last_name and $city){
            $data = "(`name`, `last_name`, `city`, `profile_img`) VALUES ('{$name}', '{$last_name}', '{$city}', '{$uploadfile}')";
            $sql = "INSERT INTO users {$data}";
            $this->db->query($sql);
        }else{
            return 0;
        }
    }

    function deleteUser($id = null){
        if($id != null){
            try {
                $this->db->query("DELETE FROM users where `id` = {$id}");
            } catch (Throwable $e) {
                return $e;
            }
        }else{
            return 0;
        }
    }

    function editUser($id, $name, $last_name, $city, $photo){
        global $profile_images_path;
        if($id and $name and $last_name and $city and $photo){
            if($_FILES['uploadfile']['error'] != null){
                $this->db->query("UPDATE users set `name` = '{$name}', `last_name` = '{$last_name}', 
                                                   `city` = '{$city}', `profile_img` = '{$photo}' where `id` = {$id}");
            }else{
                $uploadfile = $profile_images_path . basename($_FILES['uploadfile']['name']);

                move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile);        
                $this->db->query("UPDATE users set `name` = '{$name}', `last_name` = '{$last_name}', 
                                                `city` = '{$city}', `profile_img` = '{$uploadfile}' where `id` = {$id}");
            }
        }else{
            echo "string";
        }
    }

    function getOrderedUsers($field = null, $direction = null){
        global $users;
        if($field != null and $direction != null){
            $sql = "SELECT * FROM users ORDER BY {$field} {$direction}";
            $query = $this->db->query($sql);
            $users = $query->fetch_all(MYSQLI_ASSOC);
            return $users;
        }else{
            
            echo 'Empty sort';
        }
    }
    
    function getFilteredUsers($city = null){
        global $users;
        if($city != null){
            if($city != 'all')
                $sql = "SELECT * FROM users where city = '{$city}'";
            else
                $sql = "SELECT * FROM users";
            $query = $this->db->query($sql);
            $users = $query->fetch_all(MYSQLI_ASSOC);
            return $users;
        }else{
            
            echo 'Empty sort';
        }
    }

    function getSearchedUsers($search = null){
        global $searched_users;
        if($search != null){
            try{
                $sql = "SELECT * FROM users where name like '%{$search}%' OR last_name like '%{$search}%'";
            }catch(Throwable $e){
                var_dump($e);
            }
            $query = $this->db->query($sql);
            $searched_users = $query->fetch_all(MYSQLI_ASSOC);
            return $searched_users;
        }else{
            
            return 'Empty sort';
        }
    }

// ======================== (END) work with users table =========================== //

    function __destruct(){
        $this->db->close();
    }
}

$db = new DB();

// ======================== work with cities POST requests =========================== //

if(isset($_POST['del_fors_city']))
    $db->deleteCity($_POST['id']);

if(isset($_POST['add_city']))
    $db->addCity($_POST['city_name'], $_POST['city_sort_index']);

if(isset($_POST['getCityById']))
    $db->getCities($_POST['id']);

if(isset($_POST['submit_edit_city']))
    $db->editCity($_POST['id'], $_POST['edit_text_city'], $_POST['edit_text_rangir'], $_POST['edit_text_city_old']);

$cities = $db->getCities();

if(isset($_POST['submit_sort_city']))
    $db->getOrderedCities($_POST['sort_city'], $_POST['sort_order_by']);


// ======================== (END) work with cities POST requests =========================== //

// ======================== work with users POST requests =========================== //


if(isset($_POST['subm_ins_names']) and isset($_FILES))
    $db->addUser($_POST['name'], $_POST['last_name'], $_POST['city']);

if(isset($_POST['del_fors_names']))
    $db->deleteUser($_POST['id']);

if(isset($_POST['getUserById']))
    $db->getUsers($_POST['id']);

if(isset($_POST['subm_edit_names']))
    $db->editUser($_POST['id_red'], $_POST['name'], $_POST['last_name'], $_POST['city'], $_POST['photo']);

$users = $db->getUsers();

if(isset($_POST['submit_sort_names']))
    $db->getOrderedUsers($_POST['sort_name'], $_POST['sort_order_by_2']);

if(isset($_POST['sort_fc']))
    $db->getFilteredUsers($_POST['selcity_2']);

$searched_users = null;
if(isset($_POST['sub_sh_name']))
    $db->getSearchedUsers($_POST['ins_sh_name']);

// ======================== (END) work with users POST requests =========================== //
?>