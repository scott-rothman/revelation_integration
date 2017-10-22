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
    $end = $end - ($end % 12);
    if ($pagesLeft > 7) {
        $pagesLeft = 7;
    }
    if ($end < 108) {
        $ignorePreSteps = true;
    } else {
        $ignorePreSteps = false;
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
                    <a href="/'.$paginatorPage.'?start='.$urlPage.'">'.$displayPage.'</a>
                </span>
            </div>';        
        $pagesLeft--;
        $pageCounter++;
    }


    if ($start == $end) {
        $pageCounter = 1;
        $lastClass = 'active';
    } else {
        $lastClass = '';
    }

    while ($pageCounter < 8 && !$ignorePreSteps) {
        $curPreStep = 8 - $pageCounter;
        $urlPage = (($preStartPage) * 12);
        $displayPage = ($urlPage / 12);
        $preSteps = '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/'.$paginatorPage.'?start='.$urlPage.'">'.$displayPage.'</a>
                </span>
            </div>'.$preSteps;
        $preStartPage--;
        $pageCounter++;
    }

    echo $preSteps;
    echo $interiorSteps;

      echo '<div class="page '.$lastClass.'">
        <div class="bar"></div>
        <span class="label">
            <a href="/'.$paginatorPage.'?start='.$end.'">Last</a>
        </span>
      </div>
    </section>';

?>