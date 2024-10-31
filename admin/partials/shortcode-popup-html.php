<!-- Modal -->
<div class="modal fade ptl-cont ptl-main-shortcode-popup" id="insert-ptl-shortcode" tabindex="-1" role="dialog" aria-labelledby="insert-ptl-shortcodeLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="insert-ptl-shortcodeLabel"><?php echo esc_attr__('Generate Post-Timeline Shortcode','post-timeline'); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="shortcode-popup">
               <div class="card">
                  <!-- Card body -->
                  <div class="card-body set_ptl_post_type">
                     <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">

                           <li class="nav-item">
                              <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-settings" data-toggle="tab" href="#tabs-settings-text" role="tab" aria-controls="tabs-settings-text" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i><?php echo esc_attr__('Settings','post-timeline'); ?></a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link mb-sm-3 mb-md-0" id="tabs-post-ui" data-toggle="tab" href="#tabs-post-ui-text" role="tab" aria-controls="tabs-tabs-post-ui-text" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i><?php echo esc_attr__('Post UI','post-timeline'); ?></a>
                           </li>
                        </ul>
                     </div>
                     <div class="card">
                        <div class="card-body popup-inner-body">
                           <div class="tab-content" id="myTabContent">
                              <div class="tab-pane" id="tabs-post-ui-text" role="tabpanel" aria-labelledby="tabs-post-ui">
                                 <div class="ptl-inner-settings ptl-inner-tab">
                                    <div class="row">
                                       <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                           <label class="form-control-label"  for="ptl-layout"><?php echo esc_attr__('Select Timeline Orientation','p_timeline'); ?><span class="ptl-go-pro"><a href="https://posttimeline.com/" target="__blank">Go Pro</a></span></label>
                                           <div class="field-group-inner">
                                              <select class="custom-select custom-nice-select input" id="ptl-layout" name="layout">
                                                 <option value="vertical"><?php echo esc_attr__('Vertical','p_timeline'); ?></option>
                                                 <option value="one-side"><?php echo esc_attr__('One Side','p_timeline'); ?></option>
                                                 <option disabled="disabled" value=""><?php echo esc_attr__('Horizontal','p_timeline'); ?></option>
                                              </select>
                                           </div>
                                           <div class="description">
                                              <?php echo esc_attr__(' Choose the orientation of your timeline.','p_timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="form-control-label" for="ptl-template"><?php echo esc_attr__('Select Timeline Model','p_timeline'); ?><span class="ptl-go-pro"><a href="https://posttimeline.com/" target="__blank">Go Pro</a></span></label>
                                           <div class="field-group-inner">
                                              <select class="custom-select custom-nice-select input" id="ptl-template" name="template">
                                                 <?php
                                                 foreach ($ptl_templates as $key => $ptl_template) {
                                                    echo '<option src="'.$ptl_template['image'].'" value="'.$ptl_template['id'].'">'.$ptl_template['template_name'].'</option>';
                                                 }
                                                 ?>
                                              </select>
                                           </div>
                                           <div class="ptl-lock-box">
                                             <img src="<?php echo $ptl_templates[0]['image'] ?>" class="temp-img">
                                             <div class="ptl-lock-inner">
                                               <svg width="60" height="90" viewBox="0 0 90 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path d="M82.5 52.5H75V30C75 13.5 61.5 0 45 0C28.5 0 15 13.5 15 30V52.5H7.5C3.75 52.5 0 56.25 0 60V112.5C0 116.25 3.75 120 7.5 120H82.5C86.25 120 90 116.25 90 112.5V60C90 56.25 86.25 52.5 82.5 52.5ZM52.5 105H37.5L40.5 88.5C36.75 87 33.75 82.5 33.75 78.75C33.75 72.75 39 67.5 45 67.5C51 67.5 56.25 72.75 56.25 78.75C56.25 83.25 54 87 49.5 88.5L52.5 105ZM60 52.5H30V30C30 21.75 36.75 15 45 15C53.25 15 60 21.75 60 30V52.5Z" fill="white"/></svg>
                                             </div>
                                           </div>
                                           <div class="ptl-tmpl-btns"></div>
                                           <div class="description">
                                              <?php echo esc_attr__('Select a timeline template.','p_timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label for="nav-max" class="form-control-label"><?php echo esc_attr__('Navigation Limit','post-timeline'); ?></label>
                                           <input class="form-control" type="number" value="5" placeholder="example: 3" id="nav-max" name="nav-max">
                                           <div class="description">
                                              <?php echo esc_attr__('Set your tag-based Navigation Limit','post-timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="form-control-label" for="ptl-anim-type"><?php echo esc_attr__('Select Animation','post-timeline'); ?></label>
                                           <div class="field-group-inner">
                                              <select name="anim-type" class="custom-select custom-nice-select input" id="ptl-anim-type">
                                                <?php
                                                  $animations = array(
                                                    'backIn_left-right'     => esc_attr__('BackIn Left/Right','post-timeline'),
                                                    'bounceIn'              => esc_attr__('BounceIn','post-timeline'),
                                                    'bounceInUp'            => esc_attr__('BounceInUp','post-timeline'),
                                                    'fadeIn'                => esc_attr__('FadeIn','post-timeline'),
                                                    'fadeUpLeft-Right'      => esc_attr__('FadeUp Left/Right','post-timeline'),
                                                    'fadeInDown'            => esc_attr__('FadeInDown','post-timeline'),
                                                    'fadeDownLeft-Right'    => esc_attr__('FadeDown Left/Right','post-timeline'),
                                                    'fadeIn_left-right'     => esc_attr__('FadeIn Left/Right','post-timeline'),
                                                    'flipInY'               => esc_attr__('Flip Y','post-timeline'),
                                                    'flipInX'               => esc_attr__('Flip X','post-timeline'),
                                                    'flip-left-right'       => esc_attr__('Flip Left/Right','post-timeline'),
                                                    'lightSpeed_left-right' => esc_attr__('lightSpeed Left/Right','post-timeline'),
                                                    'rotateIn'              => esc_attr__('RotateIn','post-timeline'),
                                                    'fadeInUp'              => esc_attr__('Slide Up','post-timeline'),
                                                    'zoomInUp'              => esc_attr__('ZoomInUp','post-timeline'),
                                                    'zoomInDown'            => esc_attr__('ZoomInDown','post-timeline'),
                                                    'zoomInLeft-Right'      => esc_attr__('ZoomIn Left/Right','post-timeline'),
                                                    'zoomOutLeft-Right'     => esc_attr__('ZoomOut Left/Right','post-timeline')
                                                     );

                                                  foreach ($animations as $animKey => $animVal) {

                                                    echo '<option value="'.$animKey.'">'.$animVal.'</option>';

                                                  }
                                                ?>
                                              </select>
                                           </div>
                                           <div class="description">
                                              <?php echo esc_attr__('Pick an animation type for timeline transitions.','post-timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="form-control-label" for="ptl-type"><?php echo esc_attr__('Select Tag Type','post-timeline'); ?></label>
                                           <div class="field-group-inner">
                                              <select name="type" class="custom-select custom-nice-select input" id="ptl-type">
                                                <option value="date" ><?php echo esc_attr__('Date Based','post-timeline') ?></option>
                                                <option value="tag"><?php echo esc_attr__('Tag Based','post-timeline') ?></option>
                                              </select>
                                           </div>
                                           <div class="description">
                                              <?php echo esc_attr__('Choose Your Tag Type From Date and Tag.','post-timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label for="ptl-letter-spacing" class="form-control-label"><?php echo esc_attr__('Letter Spacing','post-timeline'); ?></label>
                                           <input class="form-control" type="number" step="0.1" min="0" max="2" value="" placeholder="example: 0.8" id="ptl-letter-spacing" name="letter-spacing">
                                           <div class="description">
                                              <?php echo esc_attr__('Set your tag-based Navigation Limit','post-timeline'); ?>
                                           </div>
                                        </div>
                                          <div class="form-group">
                                             <div class="input-group input-group-merge">
                                                <div class="field-set">
                                                   <div class="field-title">
                                                      <?php echo esc_attr__('Post Background Color','post-timeline'); ?>
                                                   </div>
                                                   <div class="field-content ptl-colorpicker-box post_field">
                                                    <div style="position: relative;">
                                                         <input type="text" class="colorpicker_value" id="ptl-bg-color-text" value="#F5F5F5">
                                                         <input type="color" class="colorpicker" id="ptl-post-color" name="bg-color" value="#F5F5F5">
                                                    </div>
                                                    <div class="description"><?php echo esc_attr__('Choose a color for the background.','post-timeline'); ?></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="input-group input-group-merge">
                                               <div class="field-set">
                                                   <div class="field-title">
                                                      <?php echo esc_attr__('Link open in new tab','post-timeline') ?>
                                                   </div>
                                                   <div class="field-content">
                                                      <div class="row align-items-center">
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                                          <label class="custom-toggle" for="ptl-targe-blank"><input type="checkbox" name="targe-blank" id="ptl-targe-blank"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span></label>
                                                        </div>
                                                      </div>
                                                      <div class="description">
                                                         <?php echo esc_attr__('Enable this to open links in a different tab.','post-timeline'); ?>
                                                      </div>
                                                   </div>
                                               </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                           <label class="form-control-label" for="ptl-skin-type"><?php echo esc_attr__('Select Skin Type','post-timeline'); ?></label>
                                           <div class="field-group-inner">
                                              <select id="ptl-skin-type" name="skin-type" class="custom-select custom-nice-select">
                                                 <option <?php echo ($def_skin == 'light') ? 'selected' : '' ?> value="light"><?php echo esc_attr__('Light','post-timeline'); ?></option>
                                                 <option <?php echo ($def_skin == 'dark') ? 'selected' : '' ?> value="dark"><?php echo esc_attr__('Dark','post-timeline'); ?></option>
                                              </select>
                                           </div>
                                           <div class="description">
                                              <?php echo esc_attr__('Choose a skin tone for your timeline.','post-timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="form-control-label" for="ptl-nav-type"><?php echo esc_attr__('Select Navigation Type','p_timeline'); ?><span class="ptl-go-pro"><a href="https://posttimeline.com/" target="__blank">Go Pro</a></span></label>
                                           <div class="field-group-inner">
                                              <select disabled="disabled" class="custom-select custom-nice-select input" id="ptl-nav-type" name="nav-type">
                                                 <?php
                                                 foreach ($ptl_navs as $key => $ptl_nav) {
                                                    echo '<option src="'.$ptl_nav['image'].'" value="'.$ptl_nav['id'].'">'.$ptl_nav['navigation_name'].'</option>';
                                                 }
                                                 ?>
                                              </select>
                                           </div>
                                           <div class="ptl-lock-box">
                                             <img src="<?php echo $ptl_navs[0]['image'] ?>" class="nav-img">
                                             <div class="ptl-lock-inner">
                                               <svg width="60" height="90" viewBox="0 0 90 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                               <path d="M82.5 52.5H75V30C75 13.5 61.5 0 45 0C28.5 0 15 13.5 15 30V52.5H7.5C3.75 52.5 0 56.25 0 60V112.5C0 116.25 3.75 120 7.5 120H82.5C86.25 120 90 116.25 90 112.5V60C90 56.25 86.25 52.5 82.5 52.5ZM52.5 105H37.5L40.5 88.5C36.75 87 33.75 82.5 33.75 78.75C33.75 72.75 39 67.5 45 67.5C51 67.5 56.25 72.75 56.25 78.75C56.25 83.25 54 87 49.5 88.5L52.5 105ZM60 52.5H30V30C30 21.75 36.75 15 45 15C53.25 15 60 21.75 60 30V52.5Z" fill="white"/></svg>
                                             </div>
                                           </div>
                                           <div class="description">
                                              <?php echo esc_attr__('Choose a navigation direction for your timeline.','p_timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label for="nav-offset" class="form-control-label"><?php echo esc_attr__('Navigation Offset','post-timeline'); ?></label>
                                           <input class="form-control" type="number" value="100" placeholder="example: 70" id="nav-offset" name="nav-offset">
                                           <div class="description">
                                              <?php echo esc_attr__('Increase or decrease the Navigation distance to the timeline tag.','post-timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="form-control-label" for="ptl-sort"><?php echo esc_attr__('Sorting Order','post-timeline'); ?></label>
                                           <div class="field-group-inner">
                                              <select name="sort" class="custom-select custom-nice-select input" id="ptl-sort">
                                                 <option value="ASC"><?php echo esc_attr__('Ascending','post-timeline') ?></option>
                                                 <option value="DESC"><?php echo esc_attr__('Descending','post-timeline') ?></option>
                                              </select>
                                           </div>
                                           <div class="description">
                                              <?php echo esc_attr__('Arrange your timeline based on sorting sequence.','post-timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="form-control-label" for="ptl-line-style"><?php echo esc_attr__('Select Line Style','post-timeline'); ?></label>
                                           <div class="field-group-inner">
                                              <select name="line-style" class="custom-select custom-nice-select input" id="ptl-line-style">
                                                <option value="solid" ><?php echo esc_attr__('Solid','post-timeline') ?></option>
                                                <option value="dotted"><?php echo esc_attr__('Dotted','post-timeline') ?></option>
                                                <option value="dashed"><?php echo esc_attr__('Dashed','post-timeline') ?></option>
                                              </select>
                                           </div>
                                           <div class="description">
                                              <?php echo esc_attr__('Pick line styles among solid, dotted, and dashed','post-timeline'); ?>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <div class="input-group input-group-merge">
                                              <div class="field-set">
                                                 <div class="field-title">
                                                    <?php echo esc_attr__('Line Color','post-timeline'); ?>
                                                 </div>
                                                 <div class="field-content ptl-colorpicker-box post_field">
                                                  <div style="position: relative;">
                                                     <input type="text" class="colorpicker_value" id="ptl-tagline-color-text" value="#4285F4">
                                                     <input type="color" class="colorpicker" id="ptl-post-color" name="tagline-color" value="#E11619">
                                                  </div>
                                                  <div class="description"><?php echo esc_attr__('Select a color for Tagline through the timeline.','post-timeline'); ?></div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                          <div class="form-group">
                                             <div class="input-group input-group-merge">
                                                <div class="field-set">
                                                   <div class="field-title">
                                                      <?php echo esc_attr__('Post Navigation Color','post-timeline'); ?>
                                                   </div>
                                                   <div class="field-content ptl-colorpicker-box post_field">
                                                    <div style="position: relative;">
                                                       <input type="text" class="colorpicker_value" id="ptl-nav-color-text" value="#4285F4">
                                                       <input type="color" class="colorpicker" id="ptl-post-color" name="nav-color" value="#4285F4">
                                                    </div>
                                                    <div class="description"><?php echo esc_attr__('Select a color for navigating through the timeline.','post-timeline'); ?></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="input-group input-group-merge">
                                               <div class="field-set">
                                                   <div class="field-title">
                                                      <?php echo esc_attr__('Include HTML','post-timeline') ?>
                                                   </div>
                                                   <div class="field-content">
                                                      <div class="row align-items-center">
                                                        <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                                          <label class="custom-toggle" for="ptl-html"><input type="checkbox" value="1" name="html" id="ptl-html"><span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span></label>
                                                        </div>
                                                      </div>
                                                      <div class="description">
                                                         <?php echo esc_attr__('Enable this include option to add custom HTML on the timeline.','post-timeline'); ?>
                                                      </div>
                                                   </div>
                                               </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane show active" id="tabs-settings-text" role="tabpanel" aria-labelledby="tabs-settings">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="form-control-label" for="ptl_select_posttype"><?php echo esc_attr__('Select Source','post-timeline'); ?></label>
                                          <div class="field-group-inner">
                                             <select class="custom-select custom-nice-select" id="ptl_select_posttype" name="ptl_select_posttype">
                                                <option value="ptl"><?php echo esc_attr__('Post-Timeline','post-timeline'); ?></option>
                                                <option value="cpt"><?php echo esc_attr__('Custom Post Type','post-timeline'); ?></option>
                                             </select>
                                          </div>
                                          <div class="description">
                                            <?php echo esc_attr__('Choose a source from where the post will be added to the timeline.','post-timeline'); ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="ptl-inner-settings ptl-inner-tab">
                                    <?php 
                                    $terms = get_terms([
                                        'taxonomy' => 'ptl_categories',
                                        'hide_empty' => false,
                                    ]); 
                                    include POST_TIMELINE_PLUGIN_PATH.'admin/partials/shortcode-ptl.php'; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo esc_attr__('Close','post-timeline'); ?></button>
            <button type="button" id="ptl-add-shortcode" class="btn btn-primary"><?php echo esc_attr__('Insert Shortcode','post-timeline'); ?></button>
         </div>
      </div>
   </div>
</div>