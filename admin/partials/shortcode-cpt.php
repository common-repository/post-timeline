<div class="row">
   <div class="col-lg-6 col-md-12">
      <div class="form-group">
         <label class="form-control-label" for="ptl-post-type"><?php echo esc_attr__('Select Post types','post-timeline'); ?></label>
         <div class="field-group-inner">
            <select class="custom-select custom-nice-select input" id="ptl-post-type" name="post-type">
               <?php
               foreach ($posttypes_array as $key => $posttypes) {
                  echo '<option value="'.$posttypes.'">'.$posttypes.'</option>';
               }
               ?>
            </select>
         </div>
         <div class="description">
          <?php echo esc_attr__('Choose what type of post to include in the timeline.','post-timeline'); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="form-control-label" for="ptl-category"><?php echo esc_attr__('Select Category','post-timeline'); ?></label>
         <select class="custom-select custom-nice-select input" id="ptl-category" name="category" multiple="multiple">
         </select>
         <div class="description">
          <?php echo esc_attr__('Choose the type of Category for the timeline.','post-timeline'); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="form-control-label" for="ptl-filter-ids"><?php echo esc_attr__('Filter By IDs','post-timeline'); ?></label>
         <input type="text" class="form-control input" placeholder="example: 10,13,2,4" name="filter-ids" id="ptl-filter-ids">
         <div class="description">
          <?php echo esc_attr__('Select which IDs to include','post-timeline'); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="form-control-label" for="ptl-pagination"><?php echo esc_attr__('Load more','p_timeline'); ?><span class="ptl-go-pro"><a href="https://posttimeline.com/" target="__blank">Go Pro</a></span></label>
         <div class="field-group-inner">
            <select class="custom-select custom-nice-select input" id="ptl-pagination" name="pagination">
               <option value="off"><?php echo esc_attr__('Disable','p_timeline'); ?></option>
               <option value="button"><?php echo esc_attr__('LoadMore Button','p_timeline'); ?></option>
               <option disabled value=""><?php echo esc_attr__('LoadMore on Scroll','p_timeline'); ?></option>
            </select>
         </div>
         <div class="description">
          <?php echo esc_attr__('Select how upcoming posts will be loaded','p_timeline'); ?>
         </div>
      </div>
   </div>
   <div class="col-lg-6 col-md-12">
      <div class="form-group">
        <?php
          $taxonomies = get_object_taxonomies(  'post', 'objects' );
        ?>
         <label class="form-control-label" for="ptl-taxonomy"><?php echo esc_attr__('Select Taxonomy','post-timeline'); ?></label>
         <div class="field-group-inner">
           <select class="custom-select custom-nice-select input" id="ptl-taxonomy" name="taxonomy">
              <option value=""><?php echo esc_attr__('Select Taxonomy','post-timeline'); ?></option>
              <?php
              foreach( $taxonomies as $taxonomy ){
                  if ($taxonomy->name == 'post_tag' || $taxonomy->name ==  'post_format') continue;

                  echo '<option value="'.$taxonomy->name.'">'.$taxonomy->name.'</option>';
              } 
              ?>
           </select>
         </div>
         <div class="description">
          <?php echo esc_attr__('Choose by which criteria the post content is classified or categorized.','post-timeline'); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="form-control-label" for="ptl-post-desc"><?php echo esc_attr__('Select Description Type','post-timeline'); ?></label>
         <div class="field-group-inner">
            <select class="custom-select custom-nice-select input" id="ptl-post-desc" name="post-desc">
               <option value="full"><?php echo esc_attr__('Full Content','post-timeline'); ?></option>
               <option value="excerpt"><?php echo esc_attr__('Excerpt','post-timeline'); ?></option>
            </select>
         </div>
         <div class="description">
          <?php echo esc_attr__('Choose what type of description will be in the timeline','post-timeline'); ?>
         </div>
      </div>
      <div class="form-group">
         <label class="form-control-label" for="ptl-exclude-ids"><?php echo esc_attr__('Exclude IDs','post-timeline'); ?></label>
         <input type="text" class="form-control input" placeholder="example: 11,12,5,7" name="exclude-ids" id="ptl-exclude-ids">
         <div class="description">
          <?php echo esc_attr__('Choose which IDs to exclude','post-timeline'); ?>
         </div>
      </div>
      <div class="form-group">
         <label for="ptl-post-per-page" class="form-control-label"><?php echo esc_attr__('Display per page','post-timeline'); ?></label>
         <input class="form-control" type="number" value="" placeholder="example: 10" id="ptl-post-per-page" name="post-per-page">
         <div class="description">
          <?php echo esc_attr__('Choose the number of displays per page','post-timeline'); ?>
         </div>
      </div>
   </div>
</div>
