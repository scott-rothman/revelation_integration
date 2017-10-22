<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Core\Plugin;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;

    $this->layout = false;

    $connection = ConnectionManager::get('default');
    
    $cur_year = '';
    $cur_month = '';
    $cur_day = '';   

    $ar_shows = $connection->execute('SELECT * FROM tourdates WHERE artist_id='.$artist_id.' ORDER BY performs_on DESC;')->fetchAll('assoc');

    $months['01'] = 'January';
    $months['02'] = 'February';
    $months['03'] = 'March';
    $months['04'] = 'April';
    $months['05'] = 'May';
    $months['06'] = 'June';
    $months['07'] = 'July';
    $months['08'] = 'August';
    $months['09'] = 'September';
    $months['10'] = 'October';
    $months['11'] = 'November';
    $months['12'] = 'December';

    $entry_count = sizeof($ar_shows);
    $first_year_string = "";
    $first_month_string = "";
?>

<ul class="years">


    


<? 

if ($entry_count > 0) {

    foreach ($ar_shows as $show) { 

    $artist_name = $connection->execute("SELECT name FROM artists WHERE id=".$artist_id)->fetchAll('assoc');
    $artist_name = $artist_name[0]['name'];
    $date = date('m.d.Y', strtotime($show['performs_on']));
    list($month, $day, $year) = explode('.', $date);

    if ($year != $cur_year) {
        $cur_year = $year;
        echo "$first_year_string
            <li class=\"year\">$cur_year</li>
            <ul class=\"months\">";
            $first_year_string = "</ul></ul>";
    }
    if ($month != $cur_month) {
        $cur_month = $month;
        echo "$first_month_string
            <li class=\"month\">$months[$cur_month]</li>
            <ul class=\"shows\">";
    }
    echo "<li class=\"show\">".$show['bands']." - $date</li>";

}

} else {
    echo 'None listed';
}



?>

</ul>
    