<?php 
get_header();

$curauth    = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$authorId   = $curauth->data->ID;
$nickname   = $curauth->nickname;
$user_register = $curauth->user_registered;
/*echo "<pre>";
print_r($curauth);
echo "</pre>";*/
$pro_pic = get_field('user_profile_pic','user_'.$curauth->data->ID);

if( empty($pro_pic) )
    $pro_pic = get_stylesheet_directory_uri()."/assets/images/avatar_standart_light.png";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center"><?php echo $nickname; ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo $pro_pic ?>" class="img-responsive">
        </div>
        <div class="col-md-9">
            <dl>
                <dt>Joined</dt>
                <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $user_register; ?></a></dd>
                <dt>Last Seen</dt>
                <dd>June 5, 2017</dd>
                <dt>Location</dt>
                <dd>Naples, Florida</dd>
            </dl>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="?tab=reviews"><?php echo $nickname ?>'s Review</a>
        </div>
        <div class="col-md-6">
            <a href="?tab=comments"><?php echo $nickname ?>'s Comments</a>
        </div>
    </div>
    
    <?php if( ($_GET['tab'] == 'reviews') || !isset($_GET['tab']) ): ?>
        <!-- Row for Reviews -->
        <div class="row">
            <h1><?php echo $nickname ?>'s Review</h1>
            <?php 
                $args = array(  'posts_per_page' => -1,
                                'post_type' => 'review',
                                'orderby'   => 'date',
                                'order'     => 'DESC',
                                'author' => $authorId
                            );
                $array      = array();
                $the_query  = new WP_Query( $args );
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post(); 
                        $pid = get_the_ID();
                        ?>
                        <div class="col-md-12 review-<?php echo $pid ?>">
                            <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                            <ul class="review-fields">            
                                <?php 
                                $company_id = get_post_meta( $pid, 'REVIEW_COMPANYID', true );
                                if( !empty($company_id) ){
                                    $company_name   = get_the_title( $company_id );
                                    $company_url    = get_the_permalink( $company_id );
                                    echo '<li class="normal-size">
                                            <i class="fa fa-building-o" aria-hidden="true"></i>
                                            <a href="'.$company_url.'"><span itemprop="name">'.$company_name.'</span></a>
                                        </li>';
                                }
                                ?>          
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i><span class="fs12"><?php echo get_the_date() ?></span></li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i><span class="fs12"><?php echo comments_number(0,1,'%') ?></span></li>
                                <li><i class="fa fa-user" aria-hidden="true"></i><span class="fs12">by </span><span class="fs12"><?php echo get_the_author() ?></span></li>          
                            </ul>
                            <div><?php echo get_the_excerpt(); ?></div>
                            <div><a href="<?php echo get_the_permalink(); ?>">Read More</a></div>
                        </div>                        
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo "<div class='col-md-12'>No reviews</div>";
                endif;
            ?>
        </div>
        <!-- End -->
    <?php else: ?>
        <!-- Row for comments -->
        <div class="row">
            <h1><?php echo $nickname ?>'s Comments</h1>
            <?php 
            $args = array( 'author__in' => array($authorId),
                           'orderby' => 'date',
                           'order' => 'DESC');
            $comments   = get_comments($args);
            if( !empty($comments) ):
                foreach($comments as $comment) : ?>
                    <div class="col-md-12">                    
                        <h2>TO:<a href="<?php echo get_the_permalink( $comment->comment_post_ID ); ?>"><?php echo get_the_title($comment->comment_post_ID) ?></a></h2>
                        <h6>
                            <?php echo "Date: ".$comment->comment_date ?>
                            <?php echo "Location: ".$comment->comment_author_IP ?>
                        </h6>
                        <div class="pull-left"><img width="200" src="<?php echo $pro_pic ?>" class="img-responsive"></div>                   
                        <div class="pull-right text-left"><?php echo $comment->comment_content ?></div>
                    </div>
                <?php 
                endforeach;            
            else:
                echo "<div class='col-md-12'>No comments</div>";
            endif;
            ?>
        </div>
        <!-- End -->
    <?php endif; ?>

</div>

<?php get_footer(); ?>