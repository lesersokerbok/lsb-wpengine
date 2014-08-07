<?php
/*
Template Name: Boksøk Frontpage Template
*/
?>

<?php while (have_posts()) : the_post(); ?>

  <?php if( have_rows('frontpage_list') ): ?>

        <?php while ( have_rows('frontpage_list') ) : the_row(); ?>

            <?php

            global $post;

            $taxQuery = array();

            if (has_sub_field('customization')) :
                _log('has_sub_field customization');
                array_push($taxQuery, array(
                    'taxonomy' => 'lsb_tax_customization',
                    'field' => 'id',
                    'terms' => get_sub_field('customization')
                ));
            endif;

            if (has_sub_field('author')) :
                _log('has_sub_field author');
                array_push($taxQuery, array(
                    'taxonomy' => 'lsb_tax_author',
                    'field' => 'id',
                    'terms' => get_sub_field('author')
                ));
            endif;

            if (has_sub_field('genre')) :
                _log('has_sub_field genre');
                array_push($taxQuery, array(
                    'taxonomy' => 'lsb_tax_genre',
                    'field' => 'id',
                    'terms' => get_sub_field('genre')
                ));
            endif;

            $args = array(
                'post_type' => 'lsb_book'
            );

            $custom_posts = get_posts($args);

            ?>

            <h2><?php the_sub_field('list-header'); ?></h2>

            <section class="loop">
            <?php foreach($custom_posts as $post) : ?>
                <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
            <?php endforeach; ?>
            </section>

        <?php endwhile; ?>

    <?php else: ?>

    <?php endif; ?>
<?php endwhile; ?>
