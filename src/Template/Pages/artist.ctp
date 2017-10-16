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

    $artist_id = $this->request->query['id'];

    $ar_artist = $connection->execute("SELECT * FROM artists WHERE id=$artist_id")->fetchAll('assoc');
    $ar_releases = $connection->execute("SELECT * FROM releases WHERE artist_id=$artist_id")->fetchAll('assoc');
    $ar_shows = $connection->execute("SELECT * FROM tourdates WHERE artist_id=$artist_id ORDER BY performs_on;")->fetchAll('assoc');
    $ar_artist = $ar_artist[0];
?>

<!DOCTYPE html>
    <html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo $this->element('/headerIncludes'); ?>
        <title>Revelation Records | <?php echo $ar_artist['name'] ?></title>
    </head>
    <body>
    <?php echo $this->element('/header'); ?>
    <div class="container">
  <div class="row">
    <div class="left_col col-md-8 col-xs-12">
      <section class="artist_profile">
    <h1 class="eyebrow"><?php echo $ar_artist['name'] ?></h1>
    <div class="image_slider">
        <img class="band_photo" src="img/image-wide.png" alt="">
        <div class="image_wrapper">
            
            <img src="img/image.png" alt="">
            <img src="img/image.png" alt="">
            <img src="img/image.png" alt="">
            <img src="img/image.png" alt="">
            <img src="img/image.png" alt="">
            <img src="img/image.png" alt="">
            <img src="img/image.png" alt="">
            <img src="img/image.png" alt="">
            
        </div>
        <div class="scroll_control scroll_left"> &lsaquo; </div>
        <div class="scroll_control scroll_right"> &rsaquo; </div>
    </div>
    <h2 class="eyebrow">bio</h2>
    <p>
    <?php echo $ar_artist['bio'] ?>
    </p>
    <h2 class="eyebrow">Releases</h2>
    <div class="artist_releases">
        <?php 
        foreach ($ar_releases as $release) {
                    $id = $release['id'];
                    $name = $release['name'];
                    $thumbnail = $release['thumbnail'];

        echo '<div class="artist_release">
            <a href="/release?id='.$id.'">
                <img src="'.$thumbnail.'" alt="'.$name.'">
            </a>
        </div>';
        }
        ?>
        
        
    </div>
</section>     </div>
    <div class="right_col col-md-4 col-xs-12">
      <section class="upcomming_shows_artist">
          <h1 class="eyebrow">Upcomming Shows</h1>
            <table>
                <?php 
                    if (sizeof($ar_shows < 1)) {
                        echo 'None upcomming at this time';
                    } else {
                        echo $this->element('/upcommingShow', array('shows' => $ar_shows));
                    }
                ?>
            </table>
        </section>      
<section class="past_shows">
    <h2 class="eyebrow">Past Shows</h2>
    <ul class="years">
        <li class="year">2016</li>
        <ul class="months">
            <li class="month">January</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">February</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">March</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">April</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">May</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">June</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">July</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">August</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">September</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">October</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">November</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">December</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
        </ul>
        <li class="year">2015</li>
        <ul class="months">
            <li class="month">January</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">February</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">March</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">April</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">May</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">June</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">July</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">August</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">September</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">October</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">November</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">December</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
        </ul>
        <li class="year">2014</li>
        <ul class="months">
            <li class="month">January</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">February</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">March</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">April</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">May</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">June</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">July</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">August</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">September</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">October</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">November</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">December</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
        </ul>
        <li class="year">2013</li>
        <ul class="months">
            <li class="month">January</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">February</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">March</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">April</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">May</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">June</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">July</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">August</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">September</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">October</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">November</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
            <li class="month">December</li>
            <ul class="shows">
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
                <li class="show">Lorem ipsum</li>
            </ul>
        </ul>
    </ul>
    
</section>    </div>
  </div>
</div>


<?php 
    echo $this->element('/footer');
    echo $this->element('/footerIncludes');
?>
</body>
</html>
