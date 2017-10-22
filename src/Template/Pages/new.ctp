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

    if(!isset($_COOKIE['logged_in'])) {
        header('Location: /');
        exit();
    }

    $connection = ConnectionManager::get('default');

    $table = $this->request->query['type'];

    $fields = $connection->execute("DESC $table")->fetchAll('assoc');
    $artist_ids = $connection->execute("SELECT id, name FROM artists ORDER BY name")->fetchAll('assoc');

    $field_type['id'] = 'hidden';
    $field_type['name'] = 'text';
    $field_type['state'] = 'text';
    $field_type['type'] = 'checkbox';
    $field_type['photo_of_the_day'] = 'checkbox';
    $field_type['logo'] = 'text';
    $field_type['image'] = 'text';
    $field_type['bio'] = 'textarea';
    $field_type['gear'] = 'textarea';
    $field_type['published_on'] = 'date';
    $field_type['title'] = 'text';
    $field_type['byline'] = 'text';
    $field_type['body'] = 'textarea';
    $field_type['download_url'] = 'text';
    $field_type['catalog_number'] = 'text';
    $field_type['buy_url'] = 'text';
    $field_type['itunes_url'] = 'text';
    $field_type['description'] = 'textarea';
    $field_type['reviews'] = 'textarea';
    $field_type['tracklist'] = 'textarea';
    $field_type['price'] = 'text';
    $field_type['thumbnail'] = 'text';
    $field_type['released_on'] = 'date';
    $field_type['front_cover'] = 'text';
    $field_type['back_cover'] = 'text';
    $field_type['front_record'] = 'text';
    $field_type['back_record'] = 'text';
    $field_type['photo'] = 'text';
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
        <h1><?php echo $table; ?></h1>
        <form action="/process" method="post">
        <?php 
            
                foreach ($fields as $field) {
                    $type = $field['Field'];
                    if ($type == 'id') {
                        $value = 'NEW';
                    } else {
                        if (isset ($entry[$field['Field']])) {
                            $value = $entry[$field['Field']];    
                        } else {
                            $value = '';
                        }
                    }
                    if (isset($field_type[$type])) {
                        if ($type != 'id') {
                            if ($type == 'type') {
                                echo "<label for='$type'>current</label><br>";
                            } else {
                                echo "<label for='$type'>$type</label><br>";    
                            }
                        }
                        if ($field_type[$type] == 'hidden') {
                            echo "<input type='$field_type[$type]' id='$type' name='$type' value='$value' >";
                        } elseif ($field_type[$type] == 'textarea') {
                            echo "<textarea id='$type' name='$type'>$value</textarea><br>";
                        } elseif ($field_type[$type] == 'checkbox') {
                            if ($value == 'CURRENT') {
                                $checked = 'checked="checked"';
                            } else {
                                $checked = '';
                            }
                            echo "<input type='$field_type[$type]' id='$type' name='$type' $checked><br>";
                        } elseif ($field_type[$type] =='date') {
                            $value = date('Y-m-d', strtotime($value));
                            echo "<input type='$field_type[$type]' id='$type' name='$type'><br>";
                        } else {
                            if ($type == 'image' || 
                                $type == 'logo' || 
                                $type == 'front_record' ||
                                $type == 'back_record' ||
                                $type == 'front_vinyl' ||
                                $type == 'back_vinyl') {
                                echo "<img src='$value'>";    
                            }
                            echo "<input type='$field_type[$type]' id='$type' name='$type'><br>";
                        }

                    }
                }
            
            if ($table == 'band_members' ||
                $table == 'releases' ||
                $table == 'tourdates' ||
                $table == 'vinyl' ||
                $table == 'news_articles' ||
                $table == 'photos') {

                $artist_dropdown = "<select id='artist_id' name='artist_id'>";
                foreach ($artist_ids as $artist_id) {
                    $artist_dropdown .= '<option value="'.$artist_id['id'].'">'.$artist_id["name"].'</option>';
                }
                $artist_dropdown .= "</select><br><br>";
            } else {
                $artist_dropdown = "";
            }
        ?>
            <?php echo $artist_dropdown; ?>
            <input type="hidden" name="table" value="<?php echo $table; ?>" >
            <input type="submit" value="Save">
        </form>
    </div>
    </body>
</html>
