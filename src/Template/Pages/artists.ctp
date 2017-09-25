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
    $results = $connection->execute('SELECT * FROM artists ORDER BY name')->fetchAll('assoc');
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
        <?php echo $this->element('/paginator'); ?>
    
        <div class="row">
            <?php 
                $output = '';

                foreach ($results as $result) {
                    $id = $result['id'];
                    $name = $result['name'];
                    echo "<div class='col-md-4 col-xs-12'>
                        <a href='/artist/$id'>
                            <div class='card'>
                                <img src='img/image.png' alt=''>
                                <span class='label'>$name</span>    
                            </div>
                        </a>
                    </div>";
                }

            ?>
        </div>
        <?php echo $this->element('/paginator'); ?> 
    </div>
</div>


<?php 
    echo $this->element('/footer');
    echo $this->element('/footerIncludes');
?>
</body>
</html>
