<?php
/**
 * The search form.
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package _s
 * 
 */ ?>

<form role="search" method="get" class="searchform__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <label for="s">
        <span class="searchform__label"><?php echo esc_html__( 'Search', 'afs-2021' ) ?></span>
    </label>
    
    <input type="search" class="searchform__input" value="<?php echo get_search_query() ?>" name="s" required/>
    
    <button type="submit" class="searchform__button">
       <?php echo esc_attr( 'Search', 'afs-2021' ) ?>
    </button>
</form>