<?php foreach ($articles as $article) {

    $date = date('m-d-Y', strtotime($article['published_on']));
    $short_copy = substr($article['body'], 0, 200);
    $short_copy .= '...';
?>

<article>
    <h2 class="eyebrow"><?php echo $date; ?></h2>
    <h1><?php echo $article['title'] ?></h1>
    <p><?php echo $short_copy; ?></p>
    <? if (array_key_exists('image', $article)) { ?>
        <img src="<?php echo $article['image'] ?>" alt="">
    <? } ?>
    <a href="/news/<?php echo $article['id'] ?>" class="btn">Read full story ></a>
</article>

<?php } ?>