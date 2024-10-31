
<div class="ptl-cont ptl-new-event-cont">
    <!-- HTML5 inputs -->
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0"><?php echo esc_attr__('Event Details','post-timeline'); ?></h3>
        </div>
        <!-- Card body -->
        <div class="card-body event-details pb-0">
            <div class="form-group  mb-4">
                <?php 
                // dd(date('m/d/Y', strtotime($ptl_post_date)));
                ?>
                <label for="ptl-post-date" class="form-control-label"><?php echo esc_attr__('Post Date','post-timeline'); ?></label>
                <div class='input-group post_field date ptl-date-picker' id='ptl-date-picker'>
                    <input type='text' class="form-control" placeholder="08/11/2022" name="ptl-post-date" id="ptl-post-date" value="<?php echo (!empty($ptl_post_date) ? esc_attr(date('m/d/Y', strtotime($ptl_post_date))) : '' ) ; ?>" />
                    <span class="input-group-addon input-group-append">
                      <button class="btn btn-outline-primary" type="button" id="button-addon2"> <span class="fa fa-calendar"></span></button>
                    </span>
                </div>
                <div class="description"><?php echo esc_attr__('Select the Month/Date/Year of Timeline','post-timeline'); ?></div>
            </div>
            <div class="form-group mb-4">
                <label for="ptl-post-link" class="form-control-label"><?php echo esc_attr__('Page URL','post-timeline'); ?></label>
                <div class="post_field">
                    <input type="text" class="form-control" placeholder="<?php echo esc_attr__('https://example.com/my-story','post-timeline'); ?>" name="ptl-post-link" id="ptl-post-link" value="<?php echo esc_attr($ptl_post_link); ?>">
                    <a href="javascript:void(0);" class="ptl-page-url" id="add-page-url"><?php echo esc_attr__('Add URL','post-timeline'); ?></a>
                    <div class="description"><?php echo esc_attr__('For Separate Page URL(Optional).','post-timeline'); ?></div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="ptl-post-order" class="form-control-label"><?php echo esc_attr__('Post Order (Number Only)','post-timeline'); ?></label>
                <div class="post_field">
                    <input name="ptl-post-order" class="form-control" placeholder="0" id="ptl-post-order" type="number" value="<?php echo esc_attr($ptl_post_order); ?>">
                    <div class="description"><?php echo esc_attr__('Custom Ordering of Posts, default "1".','post-timeline'); ?></div>
                </div>
            </div>
        </div>
    </div> 
    <!-- HTML5 inputs -->
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0"><?php echo esc_attr__('Event Media','post-timeline'); ?></h3>
        </div>
        <!-- Card body -->
        <div class="card-body event-media pb-0">
            <div class="form-group">
                <label for="ptl-fav-icon" class="form-control-label"><?php echo esc_attr__('Media Type','post-timeline'); ?></label>
                <div class="radio-event-m">
                    <div class="row">
                        <div class="col-lg-10 col-md-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-6 col-12">
                                    <div class="custom-control custom-radio media-default mb-3">
                                      <input name="ptl-media-type" <?php echo (empty($ptl_media_type)) ? 'checked' : '' ?> <?php echo ($ptl_media_type == 'image') ? 'checked' : '' ?> class="custom-control-input" id="default" value="image" type="radio">
                                      <label class="custom-control-label" for="default"><?php echo esc_attr__('Default Post image','post-timeline'); ?></label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-6 col-12">
                                    <div class="custom-control custom-radio media-url mb-3">
                                      <input name="ptl-media-type" <?php echo ($ptl_media_type == 'video') ? 'checked' : '' ?> class="custom-control-input" id="p-vid-url" value="video" type="radio">
                                      <label class="custom-control-label" for="p-vid-url"><?php echo esc_attr__('Video URL','post-timeline'); ?></label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-6 col-12">
                                    <div class="custom-control custom-radio media-gallery mb-3">
                                      <input name="ptl-media-type" <?php echo ($ptl_media_type == 'gallery') ? 'checked' : '' ?> class="custom-control-input" value="gallery" id="p-gallery" type="radio">
                                      <label class="custom-control-label" for="p-gallery"><?php echo esc_attr__('Gallery images','post-timeline'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-vid-url <?php echo ($ptl_media_type != 'video') ? 'hide' : '' ?>">
                    <div class="post_field">
                        <input type="text" class="form-control" placeholder="https://www.youtube.com/watch?v=xxxxxxxxx" name="ptl-video-url" id="ptl-video-url" value="<?php echo esc_attr($ptl_video_url); ?>">
                        <div class="description"><?php echo esc_attr__('Provide the video link for the Iframe.','post-timeline'); ?></div>
                    </div>
                </div>
                <div class="p-gallery <?php echo ($ptl_media_type != 'gallery') ? 'hide' : '' ?>">
                    <?php 
                    $gallery_meta = 'ptl_gallery';
                    echo $this->ptl_gallery_field( $gallery_meta, get_post_meta($post->ID, $gallery_meta, true) ); ?>
                </div>
            </div>    
            <div class="form-group mb-0">
                <label for="ptl-fav-icon" class="col-form-label form-control-label"><?php echo esc_attr__('Post Icon','post-timeline'); ?></label>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="custom-control custom-radio sel-icon-type mb-3">
                          <input name="ptl-icon-type" <?php echo (empty($ptl_icon_type)) ? 'checked' : '' ?> <?php echo ($ptl_icon_type == 'font-awesome') ? 'checked' : '' ?> class="custom-control-input" id="plt-fontaweome" type="radio" value="font-awesome">
                          <label class="custom-control-label" for="plt-fontaweome"><?php echo esc_attr__('Font Awesome','post-timeline'); ?></label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="custom-control custom-radio sel-icon-type mb-3">
                          <input name="ptl-icon-type" <?php echo ($ptl_icon_type == 'upload-icon') ? 'checked' : '' ?> class="custom-control-input" id="ptl-upload-icon" value="upload-icon" type="radio">
                          <label class="custom-control-label" for="ptl-upload-icon"><?php echo esc_attr__('Upload Icon','post-timeline'); ?></label>
                        </div>
                    </div>
                </div>  
                <div class="post_field ptl-fav-icon <?php echo ($ptl_icon_type != 'font-awesome' && !empty($ptl_icon_type)) ? 'hide' : '' ?>">
                    <span class="input-group-addon iconpicker-icon"><i class="fa-solid fa-font-awesome"></i></span>
                    <input type="text"  class="form-control" name="ptl-fav-icon" id="ptl-fav-icon" value="<?php echo $ptl_fav_icon ?>">
                    <button class="ptl-icon-clear" <?php echo (empty($options['ptl-fav-icon'])) ? 'style="display: none"' : 'style="display: block"' ?> type="button"><svg width="10" height="10" viewBox="0 0 12 12" xmlns="https://www.w3.org/2000/svg"><path d="M.566 1.698L0 1.13 1.132 0l.565.566L6 4.868 10.302.566 10.868 0 12 1.132l-.566.565L7.132 6l4.302 4.3.566.568L10.868 12l-.565-.566L6 7.132l-4.3 4.302L1.13 12 0 10.868l.566-.565L4.868 6 .566 1.698z"></path></svg></button>
                    <div class="description"><?php echo esc_attr__('Select Font Awesome Icon','post-timeline'); ?></div>
                </div>                
                <div class="post_field ptl-custom-icon <?php echo ($ptl_icon_type != 'upload-icon') ? 'hide' : '' ?>">
                  <div class="p-icon d-flex">
                      <!-- <label for="ptl-custom-icon" class="col-form-label form-control-label">Upload Custom Icon</label> -->
                      <?php 
                      $icon_meta = 'ptl-custom-icon';
                      echo $this->ptl_upload_icon( $icon_meta, get_post_meta($post->ID, $icon_meta, true) ); ?>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HTML5 inputs -->
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0"><?php echo esc_attr__('Post UI','post-timeline'); ?></h3>
        </div>
        <!-- Card body -->
        <div class="card-body post-ui pb-0">
            <div class="form-group mb-0">
                <label for="ptl-post-color" class="form-control-label"><?php echo esc_attr__('Post Background Color','post-timeline'); ?></label>
                <div class="post_field">
                    <div style="position: relative;">
                        <input type="text" class="form-control hexcolor colorpicker_value" id="ptl-post-color-text" name="ptl-post-color-text" value="<?php echo (empty($ptl_post_color)) ? '#1100ff' : esc_attr($ptl_post_color); ?>">
                        <input type="color" class="form-control colorpicker" id="ptl-post-color" name="ptl-post-color" value="<?php echo (empty($ptl_post_color)) ? '#1100ff' : esc_attr($ptl_post_color); ?>">
                    </div>
                    <div class="description"><?php echo esc_attr__('Color of Post (Default Color will be used if not selected).','post-timeline'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ptl-container -->
