<!-- COMMENT LIST-->
<ul class="list-unstyled wp_bootstrap_comment">
    <?php
    // Get comments for post
    $comments = get_comments( array(
        'post_id' => get_the_ID(),
        'status'  => 'approve', // Get only approve comments
    ) );

    // Show list of comments
    wp_list_comments( array(
        'avatar_size'       => 64,
        'type'              => 'all',
        'reverse_top_level' => null,
        'reverse_children'  => '',
        'callback'          => null,
        'end-callback'      => null,
        'page'              => '',
        'per_page'          => '',
        'max_depth'         => '',
        'format'            => 'html5',
        'short_ping'        => false,
        'echo'              => true,
        'walker'            => new WP_Bootstrap_Comment_Walker(),
    ), $comments );
    ?>
</ul>
<!-- /COMMENT LIST-->
