<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Core\Plugin;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;

    $this->layout = false;

    $connection = ConnectionManager::get('default');
    
    $next_artist = '';    
?>

<? foreach ($shows as $show) { 

$artist_name = $connection->execute("SELECT name FROM artists WHERE id=$show[artist_id]")->fetchAll('assoc');
$artist_name = $artist_name[0]['name'];
$date = date('m.d.Y', strtotime($show['performs_on']));

if ($artist_name != $next_artist) {
    $next_artist = $artist_name;
    echo "<tr class=\"artist\">
        <td colspan=\"3\">$next_artist</td>
    </tr>";
}
    echo "<tr>
        <td width=\"15%\">".$date."</td>
        <td width=\"25%\">".$show['city'].", ".$show['state']."</td>
        <td width=\"60%\">".$show['venue']."</td>
    </tr>";


?>

<?php } ?>