  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-header">
      <header>
        <h1><?php the_author(); ?></h1>
        <h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bonestheme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></h2>
      </header>
      <?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'bonestheme_status_avatar', '48' ) ); ?>
    </div><!-- .entry-header -->

    <div class="entry-content">
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bonestheme' ) ); ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
      <?php if ( comments_open() ) : ?>
      <div class="comments-link">
        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'bonestheme' ) . '</span>', __( '1 Reply', 'bonestheme' ), __( '% Replies', 'bonestheme' ) ); ?>
      </div><!-- .comments-link -->
      <?php endif; // comments_open() ?>
      <?php edit_post_link( __( 'Edit', 'bonestheme' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
  </article><!-- #post -->