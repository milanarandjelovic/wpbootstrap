<!-- search-form -->
<div class="row">
    <div class="col-md-6">
        <form method="get" class="search-form clearfix" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="input-group">
                <input id="s" type="text" name="s" class="form-control" value=""
                       placeholder="<?php esc_attr_e( 'Search Something', 'wp_bootstrap' ); ?>"
                >
                <div class="input-group-btn">
                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div> <!-- /.input-group -->
            </div>
        </form>
    </div> <!-- /.col-md-6 -->
</div> <!-- /.row -->
<!-- /search-form -->
