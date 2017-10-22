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

    $end = $start + 10;

    $paginatorPage = 'news';

    $connection = ConnectionManager::get('default');
    $ar_articles = $connection->execute("SELECT * FROM news_articles ORDER BY published_on LIMIT $start, 10")->fetchAll('assoc');
    $final = $connection->execute("SELECT COUNT(id) FROM news_articles ORDER BY published_on")->fetch();
    $final = $final[0];
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
                <section class="home_articles">
                    <?php echo $this->element('/articles', array('articles' => $ar_articles)); ?>
                </section>
                <?php echo $this->element('/paginator', array('start' => $start, 'end' => $final, 'page' => $paginatorPage)); ?>
            </div>
            <div class="right_col col-md-4 col-xs-12">
                <section class="new_releases">
                    <h2 class="eyebrow">New Releases</h2>
                    <?php echo $this->element('/release'); ?>
                    <a class="btn" href="releases.html">More ></a>
                </section>
            </div>
        </div>
    </div>
<?php 
    echo $this->element('/footer');
    echo $this->element('/footerIncludes');
?>
</body>
</html>
