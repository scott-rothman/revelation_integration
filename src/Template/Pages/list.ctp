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

    if(!isset($_COOKIE['logged_in'])) {
        header('Location: /');
        exit();
    }

    if ($table == 'news_articles') {
        $query = "SELECT id, title, published_on FROM news_articles ORDER BY published_on";
    } elseif ($table == 'tourdates') {
        $query = "SELECT id, bands, performs_on FROM tourdates ORDER BY performs_on";
    } elseif ($table == 'releases') {
        $query = "SELECT releases.id, releases.name, artists.name AS artist_name FROM releases INNER JOIN artists ON releases.artist_id = artists.id ORDER BY releases.name";
    } elseif ($table == 'vinyl') {
        $query = "SELECT vinyl.id, vinyl.name, artists.name AS artist_name FROM vinyl INNER JOIN artists ON vinyl.artist_id = artists.id ORDER BY vinyl.name";
    } elseif ($table == 'artists') {
        $query = "SELECT id, name FROM artists ORDER BY name";
    } elseif ($table == 'photos') {
        $query = "SELECT * FROM photos ORDER BY artist_id";
    }


    $values = $connection->execute($query)->fetchAll('assoc');

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
        <ul>
        <?php 
            $link = "<li><a href='/new?type=".$table."&id=NEW'>ADD NEW</a></li>";
            echo $link;
            foreach ($values as $entry) {
                if ($table == 'news_articles') {
                    $value = date('Y-m-d', strtotime($entry['published_on']));
                    $display = $entry['title']." - ".$value;
                } elseif ($table == 'tourdates') {
                    $value = date('Y-m-d', strtotime($entry['performs_on']));
                    $display = $entry['bands']." - ".$value;
                } elseif ($table == 'releases') {
                    $display = $entry['name']." - ".$entry['artist_name'];
                } elseif ($table == 'vinyl') {
                    $display = $entry['name']." - ".$entry['artist_name'];
                } elseif ($table == 'artists') {
                    $display = $entry['name'];
                }
                $link = "<li><a href='/edit?type=".$table."&id=".$entry['id']."'>".$display."</a></li>";
                echo $link;
            }
        ?>
        </ul>
    </div>
    </body>
</html>
