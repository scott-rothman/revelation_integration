<section class="paginator">
<?php
    $totalPages = 7;
    $resultsLeft = ($end - $start);
    $pagesLeft = floor($resultsLeft / 12);
    $startPage = $start / 12;
    $preStartPage = $start / 12;
    $pageCounter = 1;
    $interiorSteps = '';
    $preSteps = '';
    if ($pagesLeft > 7) {
        $pagesLeft = 7;
    }

    echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/releases">First</a>
                </span>
            </div>';

    while ($pagesLeft > 0) {
        $urlPage = (($pageCounter - 1) * 12) + $start;
        $displayPage = ($urlPage / 12) + 1;
        if ($urlPage == $start) {
            $extraClass = 'active';
        } else {
            $extraClass = '';
        }
        $interiorSteps .= '<div class="page '.$extraClass.'">
                <div class="bar"></div>
                <span class="label">
                    <a href="/releases?start='.$urlPage.'">'.$displayPage.'</a>
                </span>
            </div>';        
        $pagesLeft--;
        $pageCounter++;
    }

    while ($pageCounter < 8 && $start < $end) {
        $curPreStep = 8 - $pageCounter;
        $urlPage = (($preStartPage - 2) * 12) + $start;
        $displayPage = ($urlPage / 12);
        $preSteps = '<div class="page '.$extraClass.'">
                <div class="bar"></div>
                <span class="label">
                    <a href="/releases?start='.$urlPage.'">'.$displayPage.'</a>
                </span>
            </div>'.$preSteps;
        $preStartPage--;
        $pageCounter++;
    }

    echo $preSteps;
    echo $interiorSteps;

      echo '<div class="page">
        <div class="bar"></div>
        <span class="label">
            <a href="/releases?start='.$end.'">Last</a>
        </span>
      </div>
    </section>';

?>