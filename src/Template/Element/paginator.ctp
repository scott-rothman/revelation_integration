<section class="paginator">
<?php
    $totalPages = 9;
    $endDots = $start + 90;
    $end = $end - ($end % 10);
    $startPage = floor($start / 10);
    if ($start == 0 || $start == '') {
        echo '<div class="page active">
                <div class="bar"></div>
                <span class="label">
                    <a href="/news">01</a>
                </span>
            </div>';
        $pagesLeft = 6;
        $startPage = 2;
    } elseif ($start == 10) {
        echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/news">01</a>
                </span>
            </div>';
        echo '<div class="page active">
                <div class="bar"></div>
                <span class="label">
                    <a href="/news?start=10">02</a>
                </span>
            </div>';
        $pagesLeft = 5;
        $startPage = 3;
    } elseif ($start == 20) {
        $pagesLeft = 5;
        echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/news">01</a>
                </span>
            </div>';
        echo '<div class="page active">
                <div class="bar"></div>
                <span class="label">
                    <a href="/news?start=10">02</a>
                </span>
            </div>';
        $pagesLeft = 5;
        $startPage = 3;
    } else {
        $pagesLeft = 5;
        $dotStart = $start - 50;
        if ($dotStart < 0) {
            $dotStart = 10;
        }
        echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/news">First</a>
                </span>
            </div>';
        echo '<div class="page">
                <div class="bar"></div>
                <span class="label">
                    <a href="/news?start='.$dotStart.'">...</a>
                </span>
            </div>';
    }

    while ($pagesLeft > 0) {
        $pagesLeft--;
        $startNumber = $startPage * 10;
        $startNumberUrl = $startNumber - 10;
        if ($startPage < 10) {
            $startPage = '0'.$startPage;
        }
        if ($start / 10 == $startPage) {
            $extraClass = ' active';
        } else {
            $extraClass = '';
        }
        echo '<div class="page'.$extraClass.'">
                <div class="bar"></div>
                <span class="label">
                    <a href="/news?start='.$startNumberUrl.'">'.$startPage.'</a>
                </span>
            </div>';
        $startPage++;
    }
?>
<div class="page">
    <div class="bar"></div>
    <span class="label">
        <a href="/news?start=<?php echo $endDots; ?>">...</a>
    </span>
  </div>
  <div class="page">
    <div class="bar"></div>
    <span class="label">
        <a href="/news?start=<?php echo $end; ?>">Last</a>
    </span>
  </div>
</section>