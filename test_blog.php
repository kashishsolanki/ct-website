<section class="blog-sec c-padding wow fadeIn">
  <div class="container">
    <div class="row">
      <div class="col-md-4 main-text">
        <h2 class="color-blue font-35 font-black wow fadeIn">Blogs</h2>
        <div class="border-y">
          <h4 class="color-grey font-25 font-bold wow fadeIn">Open Eyes. Read Twice it’s worthy!</h4>
        </div>
      </div>
      <div class="col-md-8">
        <?php define('WP_USE_THEMES', false); require 'blogs/wp-blog-header.php'; $number_of_posts = 3; $args = array('numberposts' => $number_of_posts, 'post_status' => 'publish'); $recent_posts = wp_get_recent_posts($args); $bdate = ""; $btitle = ""; $bimage = ""; $bcat = ""; $blink = ""; foreach ($recent_posts as $recent_post) { $bdate = $recent_post['post_date']; $btitle = $recent_post['post_title']; $blink = get_permalink($recent_post['ID']); if (has_post_thumbnail($recent_post["ID"])) { $bimage = get_the_post_thumbnail($recent_post["ID"],'full'); } $i = 0; $cats = get_the_category($recent_post["ID"]); $bcat = $cats[$i]->name; $i++; ?>
        <div class="blog-b">
          <div class="blog-img">
            <a href="<?php echo $blink; ?>">
              <div class="content-overlay"></div>
              <?php echo $bimage; ?>
              <div class="blog-details fadeIn-top">
                <h5 class="font-20 wow fadeIn">Read Blog</h5>
              </div>
            </a>
          </div>
          <div class="blog-det blog-line">
            <h5 class="pb-3"><a href="<?php echo $blink; ?>" class="font-bold font-25 color-black wow fadeIn"><?php echo $btitle; ?></a></h5>
            <div class="blog-cl">
              <h6 class="color-blue font-18 font-bold wow fadeIn"><?php echo $bcat; ?></h6>
              <p class="color-grey font-16 wow fadeIn"><?php echo get_the_date( 'd-M-Y', $recent_post["ID"] ); ?></p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>