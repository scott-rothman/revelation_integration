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

    $table = $this->request->query['type'];
    if (isset($this->request->query['id'])) {
        $id = $this->request->query['id'];
        $id_string = "WHERE id = $id";
    } else {
        $id = 'NEW';
        $id_string = '';
    }

    $values = $connection->execute("SELECT * FROM $table $id_string")->fetchAll('assoc');
    $fields = $connection->execute("DESC $table")->fetchAll('assoc');

    $artist_ids = $connection->execute("SELECT id, name FROM artists ORDER BY name")->fetchAll('assoc');


    $field_type['id'] = 'hidden';
    $field_type['name'] = 'text';
    $field_type['state'] = 'text';
    $field_type['type'] = 'checkbox';
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
        <form action="/form_process.php">
        <?php 
            foreach ($values as $entry) {
                foreach ($fields as $field) {
                    $type = $field['Field'];
                    if ($type == 'id') {
                        $value = $id;
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
                        if ($field_type[$type] == 'textarea') {
                            echo "<textarea id='$type'>$value</textarea><br>";
                        } elseif ($field_type[$type] == 'checkbox') {
                            if ($value == 'CURRENT') {
                                $checked = 'checked="checked"';
                            } else {
                                $checked = '';
                            }
                            echo "<input type='$field_type[$type]' id='$type' $checked><br>";
                        } elseif ($field_type[$type] =='date') {
                            $value = date('Y-m-d', strtotime($value));
                            echo "<input type='$field_type[$type]' id='$type' value='$value' ><br>";
                        } else {
                            if ($type == 'image' || $type == 'logo') {
                                echo "<img src='$value'>";    
                            }
                            echo "<input type='$field_type[$type]' id='$type' value='$value' ><br>";
                        }
                    }
                }
            }
            if ($table == 'band_members' ||
                $table == 'releases' ||
                $table == 'tourdates' ||
                $table == 'vinyl' ||
                $table == 'news_articles') {

                $artist_dropdown = "<select id='artist_id' name='artist_id'>";
                foreach ($artist_ids as $artist_id) {
                    if ($artist_id['id'] = $entry['artist_id']) {
                        $selected = "selected=selected";
                    } else {
                        $selected = "";
                    }
                    $artist_dropdown .= '<option value="'.$artist_id['id'].'" '.$selected.'>'.$artist_id["name"].'</option>';
                }
                $artist_dropdown .= "</select><br><br>";
            } else {
                $artist_dropdown = "";
            }
        ?>
            <?php echo $artist_dropdown; ?>
            <input type="submit" value="Save">
        </form>
    </div>
    </body>
</html>
