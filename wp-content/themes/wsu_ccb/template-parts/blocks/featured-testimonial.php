<?php 
    $featured_testimonial = get_field('featured_testimonial');
    if( $featured_testimonial ):
    $image = $featured_testimonial['image'];
    $copy = $featured_testimonial['copy'];
    $name = $featured_testimonial['name'];
    
        $url = $image['url'];
        $alt = $image['alt'];
?>

<div class="testimonial-section">
    <div class="image">
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
    </div>

    <div class="copy">
        <div class="quote-wrap">
        <div class="quote">“</div>
        <div class="top-border"></div>
        </div>
       
        <?= $copy; ?>
        <div class="name-wrap row">
            <div class="bottom-border col-12 col-md order-2 order-md-1"></div>
            <span class="name col-12 col-md-3 order-1 order-md-2">
                <?= $name; ?>
            </span>
        </div>
        
    </div>

</div>

<?php else: 
$testimonial = $args['featured_testimonial']; 
  if( $testimonial ):
?>
<div class="testimonial-section__full-width">

<div class="container">
<div class="row testimonial-section__full-width__inner">
    <div class="image col-4 col-md-2">
    <img src="<?php echo $testimonial['image']['url']; ?>" alt="<?php echo $testimonial['image']['alt']; ?>" />
    </div>

    <div class="copy col">
        <div class="quote-wrap">
        <div class="quote">“</div>
        <div class="top-border"></div>
        </div>
       
        <?= $testimonial['copy']; ?>
        <div class="name-wrap row">
            <div class="bottom-border col-12 col-md order-2 order-md-1"></div>
            <span class="name col-12 col-md-3 order-1 order-md-2">
                <?= $testimonial['name']; ?>
            </span>
        </div>
        
    </div>
    </div>
</div>
</div>
<?php endif;
endif;
?>
