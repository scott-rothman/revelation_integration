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

    $release_id = $this->request->query['id'];

    $ar_release = $connection->execute("SELECT * FROM vinyl WHERE id=$release_id")->fetchAll('assoc');
    $ar_release = $ar_release[0];

    $artist_id = $ar_release['artist_id'];

    $ar_artist = $connection->execute("SELECT * FROM artists WHERE id=$artist_id;")->fetchAll('assoc');
    $ar_artist = $ar_artist[0];


    $ar_vinyl = $connection->execute("SELECT * FROM vinyl WHERE artist_id=$artist_id")->fetchAll('assoc');
    $ar_shows = $connection->execute("SELECT * FROM tourdates WHERE artist_id=$artist_id ORDER BY performs_on;")->fetchAll('assoc');

    $displayString = '';

    if (isset($ar_vinyl[0]['catalog_number'])) {
        $displayString .= $ar_vinyl[0]['catalog_number']." : ";
    }

    if (isset($ar_artist['name'])) {
        $displayString .= $ar_artist['name']." - ";
    }

    if (isset($ar_vinyl[0]['name'])) {
        $displayString .= $ar_vinyl[0]['catalog_number'];
    }

    
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
            <div class="left_col col-md-8 col-xs-12">
                <section>
                    <h1 class="eyebrow"><?php echo $displayString; ?></h1>
                    <div class="vinyl_release">
                        <img src="<?php echo $ar_vinyl[0]['front_cover']; ?>" alt="">
                        <img src="<?php echo $ar_vinyl[0]['back_cover']; ?>" alt="">
                        <img src="<?php echo $ar_vinyl[0]['front_record']; ?>" alt="">
                        <img src="<?php echo $ar_vinyl[0]['back_record']; ?>" alt="">
                    </div>
                </section>
            </div>
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
          <h1 class="eyebrow">Past Shows</h1>
            <?php 
                echo $this->element('/pastShows', array('artist_id' => $artist_id));
            ?>
        </section>      
    </div>
        </div>
        
  </div>
    </div>


<?php 
    echo $this->element('/footer');
    echo $this->element('/footerIncludes');
?>
</body>
</html>
