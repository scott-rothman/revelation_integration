<section class="paginator">
<?php
    $totalPages = 9;
    $endDots = $start + 90;
    $end = $end - ($end % 12);
    $startPage = floor($start / 108);
    if ($start == 0 || $start == '') {
        echo '<div class="page active">
                <div class="bar"></div>
                <span class="label">
                    <a href="/artists">01</a>
                </span>
            </div>';
        $pagesLeft = 6;
        $startPage = 2;
    } elseif ($start == 12) {
        echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/artists">01</a>
                </span>
            </div>';
        echo '<div class="page active">
                <div class="bar"></div>
                <span class="label">
                    <a href="/artists?start=12">02</a>
                </span>
            </div>';
        $pagesLeft = 5;
        $startPage = 3;
    } elseif ($start == 24) {
        $pagesLeft = 5;
        echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/artists">01</a>
                </span>
            </div>';
        echo '<div class="page active">
                <div class="bar"></div>
                <span class="label">
                    <a href="/artists?start=12">02</a>
                </span>
            </div>';
        $pagesLeft = 5;
        $startPage = 3;
    } else {
        $pagesLeft = 5;
        $dotStart = $start - 50;
        if ($dotStart < 0) {
            $dotStart = 12;
        }
        echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/artists">First</a>
                </span>
            </div>';
        echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/artists?start='.$dotStart.'">...</a>
                </span>
            </div>';
    }

    while ($pagesLeft > 0) {
        $pagesLeft--;
        $startNumber = $startPage * 12;
        $startNumberUrl = $startNumber - 12;
        if ($startPage < 12) {
            $startPage = '0'.$startPage;
        }
        if ($start / 12 == $startPage) {
            $extraClass = ' active';
        } else {
            $extraClass = '';
        }
        echo '<div class="page'.$extraClass.'">
                <div class="bar"></div>
                <span class="label">
                    <a href="/artists?start='.$startNumberUrl.'">'.$startPage.'</a>
                </span>
            </div>';
        $startPage++;
    }
?>
<div class="page">
    <div class="bar"></div>
    <span class="label">
        <a href="/artists?start=<?php echo $endDots; ?>">...</a>
    </span>
  </div>
  <div class="page">
    <div class="bar"></div>
    <span class="label">
        <a href="/artists?start=<?php echo $end; ?>">Last</a>
    </span>
  </div>
</section>