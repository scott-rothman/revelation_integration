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

    if (isset($_POST['logging_in']) == 'true') {
        $users = $connection->execute("SELECT * FROM users")->fetchAll('assoc');
        if (sha1($_POST['password']) == $users[0]['password']) {
            setcookie('logged_in', 'true', time() + (86400 * 30), "/");
            header('Location: /admin');
            exit();
        }
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
            <h1>Admin</h1>
            <form action="/login" method="post">
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
                <input type="hidden" name="logging_in" value="true">
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
</html>
