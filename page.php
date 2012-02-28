<?php get_header(); ?>

<div id="main">

	<div class="row">
    <div class="eightcol">  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article class="post" id="post-<?php the_ID(); ?>">
    <header>
      <h2><?php the_title(); ?></h2>
    </header>
        </div>
        <div class="fourcol last"></div>    
    </div>
  
  
  	<div class="row post-content">
  	<div class="eightcol">
    <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
  
  </article>
  <?php endwhile; endif; ?>
  <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

</div>

<div class="fourcol last">
<?php get_sidebar(); ?>
</div>
</div>
</div>
<?php get_footer(); ?>
