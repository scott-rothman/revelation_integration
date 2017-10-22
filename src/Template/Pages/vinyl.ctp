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

    if (array_key_exists('start', $this->request->query)) {
        $start = $this->request->query['start'];
    } else {
        $start = 0;
    }

    $connection = ConnectionManager::get('default');
    $results = $connection->execute('SELECT * FROM vinyl ORDER BY name LIMIT '.$start.', 12')->fetchAll('assoc');
    $final = $connection->execute("SELECT COUNT(id) FROM vinyl ORDER BY name")->fetch();
    $final = $final[0];
    $paginatorPage = 'vinyl';
?>

<!DOCTYPE html>
    <html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->element('/headerIncludes'); ?>
        <title>Revelation Records | Home</title>
    </head>
    <body>
    <?php echo $this->element('/header'); ?>
    <div class="container">
  <div class="row">
    <div class="single_col col-xs-12">
        <?php echo $this->element('/paginator', array('start' => $start, 'end' => $final, 'paginatorPage' => $paginatorPage)); ?>
    
        <div class="row">
            <?php 
                $output = '';

                foreach ($results as $result) {
                    $id = $result['id'];
                    $name = $result['name'];
                    echo "<div class='col-md-4 col-xs-12'>
                        <a href='/vinyl_release?id=$id'>
                            <div class='card'>";
                            if (isset($result['front_cover'])) {
                                echo "<img src='".$result['front_cover']."' alt=''>";
                            }
                                echo "<span class='label'>$name</span>    
                            </div>
                        </a>
                    </div>";
                }

            ?>
        </div>
        <?php echo $this->element('/paginator', array('start' => $start, 'end' => $final, 'paginatorPage' => $paginatorPage)); ?>
    </div>
</div>
</div>

<?php 
    echo $this->element('/footer');
    echo $this->element('/footerIncludes');
?>
</body>
</html>
