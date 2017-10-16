<?php $curPage = $this->viewVars['page']; ?>

<header>
<a href="index.html">
      <img class="sticky_logo" src="img/mobile_logo.png" alt="">
    </a>
  <div class="container">
    
    <div class="logo">
      <a href="index.html">
        <img class="default_logo" src="img/logo.png" alt="">
      </a>
    </div>
    <nav class="main_nav">
    
      <a class="<?php if ($curPage == 'home') { echo 'active'; } ?>" href="/">HOME</a>
      
      <a class="<?php if ($curPage == 'news') { echo 'active'; } ?>" href="/news">NEWS</a>
      
      <a class="<?php if ($curPage == 'artists') { echo 'active'; } ?>" href="/artists">ARTISTS</a>
      
      <a class="<?php if ($curPage == 'shows') { echo 'active'; } ?>" href="/shows">SHOWS</a>
      
      <a class="<?php if ($curPage == 'releases') { echo 'active'; } ?>" href="/releases">RELEASES</a>
      
      <a class="<?php if ($curPage == 'vinyl') { echo 'active'; } ?>" href="/vinyl">VINYL</a>
      
      <a class="<?php if ($curPage == 'contact') { echo 'active'; } ?>" href="/contact">CONTACT</a>
      
    </nav>
    <div class="hamburger">
      <div class="bar"></div>
      <div class="bar"></div>
      <div class="bar"></div>
    </div>
  </div>
  <a href="#" class="store_link">Store</a>
  <div class="close_sticky"><img src="img/x.png"></div>
  <div class="hamburger show_sticky">
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
  </div>
</header>