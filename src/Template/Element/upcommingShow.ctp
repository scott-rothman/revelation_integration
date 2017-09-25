<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Core\Plugin;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;

    $this->layout = false;

    $connection = ConnectionManager::get('default');
    $results = $connection->execute('SELECT distinct artist_id FROM tourdates ORDER BY performs_on LIMIT 5')->fetchAll('assoc'); 
    
    
?>


<tr class="artist">
    <td colspan="3">Burn</td>
</tr>
<tr>
    <td width="15%">08.01.16</td>
    <td width="25%">Richmond, VA</td>
    <td width="60%">United Blood @ The Canal Clumb</td>
</tr>
<tr>
    <td>08.01.16</td>
    <td>Richmond, VA</td>
    <td>United Blood @ The Canal Clumb</td>
</tr>