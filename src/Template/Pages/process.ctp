<?php
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @since         0.10.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Core\Plugin;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;

    $this->layout = false;

    $connection = ConnectionManager::get('default');

    if(!isset($_COOKIE['logged_in'])) {
        header('Location: /');
        exit();
    }

    $target_dir = "/img/";

    //print_r($_POST);

    if ($_POST['id'] == 'NEW') {
        $query = "INSERT INTO ".$_POST['table'];
        $columns = '(';
        $values = "VALUES (";
        foreach ($_POST as $key => $value) {
            if ($key != 'id' && $key != 'table') {
                $columns .= "$key, ";
                $values .= "'$value', ";
            }
        }
        $columns = substr($columns, 0, -2).")";
        $values = substr($values, 0, -2).")";
        $query .= " $columns $values";
        $title = "Entry Created!";

    } else {
        $query = "UPDATE ".$_POST['table']." SET";
        foreach ($_POST as $key => $value) {
            if ($key != 'id' && $key != 'table') {
                $query .= " $key = '$value', ";    
            }
        }
        $id_string = " WHERE id = ".$_POST['id'];
        $query = substr($query, 0, -2);
        $query .= $id_string;
        $title = "Entry Updated!";
    }
    
    if ($connection->execute($query)) {
        
        foreach ($_FILES as $file) {
            print_r($file);
        }
        // $target_file = $target_dir . basename($_FILES["front_cover"]["name"]);        
        // if (move_uploaded_file($_FILES["front_cover"]["tmp_name"], $target_file)) {

        

        
    } else {
        $title = 'ERROR';
    }


?>

<!DOCTYPE html>
    <html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->element('/headerIncludes'); ?>
    </head>
    <body id="cms">
        <div class="container">
            <h1><?php echo $title ?></h1>
            <a href="/admin"><< Back to Admin</a>
        </div>
    </div>
    </body>
</html>
