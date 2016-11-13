<?php
//I may not use this...
?>

<div id="" class="wordpressplagiarismtracking-quick-insert-widget">
<form method="post" action="" id="wordpressplagiarismtracking_quick_insert_form">
      <div class="case-link piklist-theme-field-container">
        <div class="piklist-theme-label">
          <label for="_post[post_title]" class="piklist-field-part piklist-label piklist-label-position-before ">Link<span class="piklist-required">*</span>
          </label>
        </div>
        <div class="piklist-theme-field">
          <input type="text" id="_post_post_title_0" name="_post[post_title]" value="
          " placeholder="Paste link here..." class="_post_post_title piklist-field-element">
        </div>
      </div>
      <?php
      $parents = get_terms(array(
      'taxonomy' => 'case_category'
      ,'hide_empty' => false
      ,'parent' => 0
      ));
      foreach ($parents as $parent => $value) {
        ?>
        <div class=" piklist-theme-field-container">
          <div class="piklist-theme-label">
            <label for="_taxonomy[case_category][]" class="piklist-field-part piklist-label piklist-label-position-before "><?php echo $value->name ?><span class="piklist-required">*</span>
            </label>
          </div>
          <div class="piklist-theme-field">
            <ul class="piklist-field-list">
            <?php
            $children = get_terms('case_category', array(
              'hide_empty' => false
              ,'child_of' =>$value->term_id
            ));
            foreach($children as $child => $child_val){
              ?>
              <li>
                <label class="piklist-field-list-item">
                  <input type="checkbox" id="_taxonomy_case_category_0" name="_taxonomy[case_category][]" value="164" class="form-control _taxonomy_case_category piklist-field-element">
                  <input type="hidden" id="_taxonomy_case_category_0" name="_taxonomy[case_category][]" value="">
                  <span class="piklist-list-item-label">
                    Books that resemble MLP's works</span>
                  </label>
                </li>
              <?php
            }
      }
       ?>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_1" name="_taxonomy[case_category][]" value="165" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          Courses that resemble Belsebuub's work        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_2" name="_taxonomy[case_category][]" value="166" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          Other copying that resembles MLP's works        </span>

      </label>

    </li>



  </ul></div></div><div class=" piklist-theme-field-container"><div class="piklist-theme-label"><label for="_taxonomy[case_category][]" class="piklist-field-part piklist-label piklist-label-position-before ">Copied Articles and Parts of Books<span class="piklist-required">*</span></label></div><div class="piklist-theme-field"><ul class="piklist-field-list">




    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_0" name="_taxonomy[case_category][]" value="171" class="form-control _taxonomy_case_category piklist-field-element">


          <input type="hidden" id="_taxonomy_case_category_0" name="_taxonomy[case_category][]" value="">


        <span class="piklist-list-item-label">
          1 to 3 Paragraphs copied        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_1" name="_taxonomy[case_category][]" value="173" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          4 + Paragraphs copied        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_2" name="_taxonomy[case_category][]" value="178" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          4+ Paragraphs copied        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_3" name="_taxonomy[case_category][]" value="176" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          Articles on Waking Times reposted – attribution not ideal        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_4" name="_taxonomy[case_category][]" value="172" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          Contacted Nothing Happened        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_5" name="_taxonomy[case_category][]" value="174" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          Resolved – 1 to 3 Paragraphs        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_6" name="_taxonomy[case_category][]" value="175" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          Resolved – 4 + paragraphs        </span>

      </label>

    </li>



  </ul></div></div><div class=" piklist-theme-field-container"><div class="piklist-theme-label"><label for="_taxonomy[case_category][]" class="piklist-field-part piklist-label piklist-label-position-before ">Posted MLP works<span class="piklist-required">*</span></label></div><div class="piklist-theme-field"><ul class="piklist-field-list">




    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_0" name="_taxonomy[case_category][]" value="170" class="form-control _taxonomy_case_category piklist-field-element">


          <input type="hidden" id="_taxonomy_case_category_0" name="_taxonomy[case_category][]" value="">


        <span class="piklist-list-item-label">
          Audio and Video        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_1" name="_taxonomy[case_category][]" value="167" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          eBook(s) posted        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_2" name="_taxonomy[case_category][]" value="168" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          Not readily available eBook pdfs posted        </span>

      </label>

    </li>

    <li>
      <label class="piklist-field-list-item">

        <input type="checkbox" id="_taxonomy_case_category_3" name="_taxonomy[case_category][]" value="169" class="form-control _taxonomy_case_category piklist-field-element">


        <span class="piklist-list-item-label">
          Old Course PDFs posted        </span>

      </label>

    </li>



  </ul></div></div><div class="case-link piklist-theme-field-container"><div class="piklist-theme-label"><label for="_post[post_content]" class="piklist-field-part piklist-label piklist-label-position-before ">Notes</label></div><div class="piklist-theme-field"><textarea id="_post_post_content_0" name="_post[post_content]" placeholder="Write notes about the link here" class="_post_post_content piklist-field-element"></textarea></div></div><div class=" piklist-theme-field-container"><div class="piklist-theme-label"></div><div class="piklist-theme-field"><input type="submit" id="submit_0" name="submit" value="Submit" class="submit piklist-field-element"></div></div><input type="hidden" id="_form_id_0" name="_[form_id]" value="wordpressplagiarismtracking_quick_insert_form" class="_form_id piklist-field-element" data-piklist-field-addmore-clear="0"><input type="hidden" id="_nonce_0" name="_[nonce]" value="336e99d2f5" class="_nonce piklist-field-element" data-piklist-field-addmore-clear="0"><input type="hidden" id="_fields_0" name="_[fields]" value="1609e2d0b5dcab8fe07020627effd0e8" data-piklist-fields="{&quot;post&quot;:{&quot;post_type&quot;:{&quot;add_more&quot;:false,&quot;attributes&quot;:{&quot;class&quot;:[&quot;_post_post_type&quot;,&quot;piklist-field-element&quot;],&quot;data-piklist-field-addmore-clear&quot;:false},&quot;capability&quot;:null,&quot;child_add_more&quot;:false,&quot;child_field&quot;:false,&quot;choices&quot;:null,&quot;columns&quot;:null,&quot;conditions&quot;:[],&quot;description&quot;:null,&quot;display&quot;:false,&quot;embed&quot;:false,&quot;errors&quot;:false,&quot;field&quot;:&quot;post_type&quot;,&quot;group_field&quot;:false,&quot;help&quot;:null,&quot;id&quot;:&quot;_post_post_type_0&quot;,&quot;index&quot;:0,&quot;index_force&quot;:false,&quot;label&quot;:null,&quot;label_position&quot;:&quot;before&quot;,&quot;label_tag&quot;:true,&quot;list&quot;:true,&quot;list_item_type&quot;:null,&quot;list_type&quot;:null,&quot;logged_in&quot;:false,&quot;meta_query&quot;:[],&quot;multiple&quot;:false,&quot;name&quot;:&quot;_post[post_type]&quot;,&quot;object_id&quot;:null,&quot;on_post_status&quot;:[],&quot;options&quot;:[],&quot;position&quot;:null,&quot;prefix&quot;:true,&quot;query&quot;:[],&quot;redirect&quot;:null,&quot;relate&quot;:false,&quot;relate_to&quot;:null,&quot;request_value&quot;:null,&quot;required&quot;:false,&quot;role&quot;:null,&quot;sanitize&quot;:[],&quot;save_as&quot;:null,&quot;scope&quot;:&quot;post&quot;,&quot;sortable&quot;:false,&quot;tax_query&quot;:[],&quot;template&quot;:&quot;field&quot;,&quot;type&quot;:&quot;hidden&quot;,&quot;valid&quot;:true,&quot;validate&quot;:[],&quot;value&quot;:&quot;plagiarism_case&quot;,&quot;wrapper&quot;:&quot;[field]&quot;},&quot;post_status&quot;:{&quot;add_more&quot;:false,&quot;attributes&quot;:{&quot;class&quot;:[&quot;_post_post_status&quot;,&quot;piklist-field-element&quot;]},&quot;capability&quot;:null,&quot;child_add_more&quot;:false,&quot;child_field&quot;:false,&quot;choices&quot;:{&quot;open&quot;:&quot;Open&quot;,&quot;draft&quot;:&quot;Draft&quot;,&quot;in_progress&quot;:&quot;In Progress&quot;,&quot;contacted&quot;:&quot;Contacted nothing happened&quot;,&quot;resolved&quot;:&quot;Resolved&quot;,&quot;resolved-comment&quot;:&quot;Resolved - attributed via comment&quot;},&quot;columns&quot;:null,&quot;conditions&quot;:[],&quot;description&quot;:null,&quot;display&quot;:false,&quot;embed&quot;:false,&quot;errors&quot;:false,&quot;field&quot;:&quot;post_status&quot;,&quot;group_field&quot;:false,&quot;help&quot;:null,&quot;id&quot;:&quot;_post_post_status_0&quot;,&quot;index&quot;:0,&quot;index_force&quot;:false,&quot;label&quot;:&quot;Status&quot;,&quot;label_position&quot;:&quot;before&quot;,&quot;label_tag&quot;:true,&quot;list&quot;:true,&quot;list_item_type&quot;:null,&quot;list_type&quot;:null,&quot;logged_in&quot;:false,&quot;meta_query&quot;:[],&quot;multiple&quot;:false,&quot;name&quot;:&quot;_post[post_status]&quot;,&quot;object_id&quot;:null,&quot;on_post_status&quot;:[],&quot;options&quot;:[],&quot;position&quot;:null,&quot;prefix&quot;:true,&quot;query&quot;:[],&quot;redirect&quot;:null,&quot;relate&quot;:false,&quot;relate_to&quot;:null,&quot;request_value&quot;:null,&quot;required&quot;:false,&quot;role&quot;:null,&quot;sanitize&quot;:[],&quot;save_as&quot;:null,&quot;scope&quot;:&quot;post&quot;,&quot;sortable&quot;:false,&quot;tax_query&quot;:[],&quot;template&quot;:&quot;theme&quot;,&quot;type&quot;:&quot;select&quot;,&quot;valid&quot;:true,&quot;validate&quot;:[],&quot;value&quot;:&quot;open&quot;,&quot;wrapper&quot;:&quot;[field_wrapper]\u003Cdiv class=\u0022 piklist-theme-field-container\u0022\u003E\u003Cdiv class=\u0022piklist-theme-label\u0022\u003E[field_label]\u003C\/div\u003E\u003Cdiv class=\u0022piklist-theme-field\u0022\u003E[field][field_description_wrapper]\u003Cp class=\u0022piklist-theme-field-description\u0022\u003E[field_description]\u003C\/p\u003E[\/field_description_wrapper]\u003C\/div\u003E\u003C\/div\u003E[\/field_wrapper]&quot;},&quot;post_title&quot;:{&quot;add_more&quot;:false,&quot;attributes&quot;:{&quot;wrapper_class&quot;:&quot;case-link&quot;,&quot;placeholder&quot;:&quot;Paste link here...&quot;,&quot;class&quot;:[&quot;_post_post_title&quot;,&quot;piklist-field-element&quot;]},&quot;capability&quot;:null,&quot;child_add_more&quot;:false,&quot;child_field&quot;:false,&quot;choices&quot;:null,&quot;columns&quot;:null,&quot;conditions&quot;:[],&quot;description&quot;:null,&quot;display&quot;:false,&quot;embed&quot;:false,&quot;errors&quot;:false,&quot;field&quot;:&quot;post_title&quot;,&quot;group_field&quot;:false,&quot;help&quot;:null,&quot;id&quot;:&quot;_post_post_title_0&quot;,&quot;index&quot;:0,&quot;index_force&quot;:false,&quot;label&quot;:&quot;Link&quot;,&quot;label_position&quot;:&quot;before&quot;,&quot;label_tag&quot;:true,&quot;list&quot;:true,&quot;list_item_type&quot;:null,&quot;list_type&quot;:null,&quot;logged_in&quot;:false,&quot;meta_query&quot;:[],&quot;multiple&quot;:false,&quot;name&quot;:&quot;_post[post_title]&quot;,&quot;object_id&quot;:null,&quot;on_post_status&quot;:[],&quot;options&quot;:[],&quot;position&quot;:null,&quot;prefix&quot;:true,&quot;query&quot;:[],&quot;redirect&quot;:null,&quot;relate&quot;:false,&quot;relate_to&quot;:null,&quot;request_value&quot;:null,&quot;required&quot;:true,&quot;role&quot;:null,&quot;sanitize&quot;:[],&quot;save_as&quot;:null,&quot;scope&quot;:&quot;post&quot;,&quot;sortable&quot;:false,&quot;tax_query&quot;:[],&quot;template&quot;:&quot;theme&quot;,&quot;type&quot;:&quot;text&quot;,&quot;valid&quot;:true,&quot;validate&quot;:[],&quot;value&quot;:null,&quot;wrapper&quot;:&quot;[field_wrapper]\u003Cdiv class=\u0022case-link piklist-theme-field-container\u0022\u003E\u003Cdiv class=\u0022piklist-theme-label\u0022\u003E[field_label]\u003C\/div\u003E\u003Cdiv class=\u0022piklist-theme-field\u0022\u003E[field][field_description_wrapper]\u003Cp class=\u0022piklist-theme-field-description\u0022\u003E[field_description]\u003C\/p\u003E[\/field_description_wrapper]\u003C\/div\u003E\u003C\/div\u003E[\/field_wrapper]&quot;},&quot;post_content&quot;:{&quot;add_more&quot;:false,&quot;attributes&quot;:{&quot;wrapper_class&quot;:&quot;case-link&quot;,&quot;placeholder&quot;:&quot;Write notes about the link here&quot;,&quot;class&quot;:[&quot;_post_post_content&quot;,&quot;piklist-field-element&quot;]},&quot;capability&quot;:null,&quot;child_add_more&quot;:false,&quot;child_field&quot;:false,&quot;choices&quot;:null,&quot;columns&quot;:null,&quot;conditions&quot;:[],&quot;description&quot;:null,&quot;display&quot;:false,&quot;embed&quot;:false,&quot;errors&quot;:false,&quot;field&quot;:&quot;post_content&quot;,&quot;group_field&quot;:false,&quot;help&quot;:null,&quot;id&quot;:&quot;_post_post_content_0&quot;,&quot;index&quot;:0,&quot;index_force&quot;:false,&quot;label&quot;:&quot;Notes&quot;,&quot;label_position&quot;:&quot;before&quot;,&quot;label_tag&quot;:true,&quot;list&quot;:true,&quot;list_item_type&quot;:null,&quot;list_type&quot;:null,&quot;logged_in&quot;:false,&quot;meta_query&quot;:[],&quot;multiple&quot;:false,&quot;name&quot;:&quot;_post[post_content]&quot;,&quot;object_id&quot;:null,&quot;on_post_status&quot;:[],&quot;options&quot;:[],&quot;position&quot;:null,&quot;prefix&quot;:true,&quot;query&quot;:[],&quot;redirect&quot;:null,&quot;relate&quot;:false,&quot;relate_to&quot;:null,&quot;request_value&quot;:null,&quot;required&quot;:false,&quot;role&quot;:null,&quot;sanitize&quot;:[],&quot;save_as&quot;:null,&quot;scope&quot;:&quot;post&quot;,&quot;sortable&quot;:false,&quot;tax_query&quot;:[],&quot;template&quot;:&quot;theme&quot;,&quot;type&quot;:&quot;textarea&quot;,&quot;valid&quot;:true,&quot;validate&quot;:[],&quot;value&quot;:null,&quot;wrapper&quot;:&quot;[field_wrapper]\u003Cdiv class=\u0022case-link piklist-theme-field-container\u0022\u003E\u003Cdiv class=\u0022piklist-theme-label\u0022\u003E[field_label]\u003C\/div\u003E\u003Cdiv class=\u0022piklist-theme-field\u0022\u003E[field][field_description_wrapper]\u003Cp class=\u0022piklist-theme-field-description\u0022\u003E[field_description]\u003C\/p\u003E[\/field_description_wrapper]\u003C\/div\u003E\u003C\/div\u003E[\/field_wrapper]&quot;}},&quot;taxonomy&quot;:{&quot;case_category&quot;:{&quot;add_more&quot;:false,&quot;attributes&quot;:{&quot;class&quot;:[&quot;form-control&quot;,&quot;_taxonomy_case_category&quot;,&quot;piklist-field-element&quot;]},&quot;capability&quot;:null,&quot;child_add_more&quot;:false,&quot;child_field&quot;:false,&quot;choices&quot;:{&quot;170&quot;:&quot;Audio and Video&quot;,&quot;167&quot;:&quot;eBook(s) posted&quot;,&quot;168&quot;:&quot;Not readily available eBook pdfs posted&quot;,&quot;169&quot;:&quot;Old Course PDFs posted&quot;},&quot;columns&quot;:null,&quot;conditions&quot;:[],&quot;description&quot;:null,&quot;display&quot;:false,&quot;embed&quot;:false,&quot;errors&quot;:false,&quot;field&quot;:&quot;case_category&quot;,&quot;group_field&quot;:false,&quot;help&quot;:null,&quot;id&quot;:&quot;_taxonomy_case_category_3&quot;,&quot;index&quot;:0,&quot;index_force&quot;:false,&quot;label&quot;:&quot;Posted MLP works&quot;,&quot;label_position&quot;:&quot;before&quot;,&quot;label_tag&quot;:true,&quot;list&quot;:true,&quot;list_item_type&quot;:null,&quot;list_type&quot;:null,&quot;logged_in&quot;:false,&quot;meta_query&quot;:[],&quot;multiple&quot;:true,&quot;name&quot;:&quot;_taxonomy[case_category][]&quot;,&quot;object_id&quot;:null,&quot;on_post_status&quot;:[],&quot;options&quot;:[],&quot;position&quot;:null,&quot;prefix&quot;:true,&quot;query&quot;:[],&quot;redirect&quot;:null,&quot;relate&quot;:false,&quot;relate_to&quot;:null,&quot;request_value&quot;:null,&quot;required&quot;:true,&quot;role&quot;:null,&quot;sanitize&quot;:[],&quot;save_as&quot;:null,&quot;scope&quot;:&quot;taxonomy&quot;,&quot;sortable&quot;:false,&quot;tax_query&quot;:[],&quot;template&quot;:&quot;theme&quot;,&quot;type&quot;:&quot;checkbox&quot;,&quot;valid&quot;:true,&quot;validate&quot;:[],&quot;value&quot;:null,&quot;wrapper&quot;:&quot;[field_wrapper]\u003Cdiv class=\u0022 piklist-theme-field-container\u0022\u003E\u003Cdiv class=\u0022piklist-theme-label\u0022\u003E[field_label]\u003C\/div\u003E\u003Cdiv class=\u0022piklist-theme-field\u0022\u003E[field][field_description_wrapper]\u003Cp class=\u0022piklist-theme-field-description\u0022\u003E[field_description]\u003C\/p\u003E[\/field_description_wrapper]\u003C\/div\u003E\u003C\/div\u003E[\/field_wrapper]&quot;}},&quot;&quot;:{&quot;submit&quot;:{&quot;add_more&quot;:false,&quot;attributes&quot;:{&quot;class&quot;:[&quot;submit&quot;,&quot;piklist-field-element&quot;]},&quot;capability&quot;:null,&quot;child_add_more&quot;:false,&quot;child_field&quot;:false,&quot;choices&quot;:null,&quot;columns&quot;:null,&quot;conditions&quot;:[],&quot;description&quot;:null,&quot;display&quot;:false,&quot;embed&quot;:false,&quot;errors&quot;:false,&quot;field&quot;:&quot;submit&quot;,&quot;group_field&quot;:false,&quot;help&quot;:null,&quot;id&quot;:&quot;submit_0&quot;,&quot;index&quot;:0,&quot;index_force&quot;:false,&quot;label&quot;:null,&quot;label_position&quot;:&quot;before&quot;,&quot;label_tag&quot;:true,&quot;list&quot;:true,&quot;list_item_type&quot;:null,&quot;list_type&quot;:null,&quot;logged_in&quot;:false,&quot;meta_query&quot;:[],&quot;multiple&quot;:false,&quot;name&quot;:&quot;submit&quot;,&quot;object_id&quot;:null,&quot;on_post_status&quot;:[],&quot;options&quot;:[],&quot;position&quot;:null,&quot;prefix&quot;:true,&quot;query&quot;:[],&quot;redirect&quot;:null,&quot;relate&quot;:false,&quot;relate_to&quot;:null,&quot;request_value&quot;:null,&quot;required&quot;:false,&quot;role&quot;:null,&quot;sanitize&quot;:[],&quot;save_as&quot;:null,&quot;scope&quot;:null,&quot;sortable&quot;:false,&quot;tax_query&quot;:[],&quot;template&quot;:&quot;theme&quot;,&quot;type&quot;:&quot;submit&quot;,&quot;valid&quot;:true,&quot;validate&quot;:[],&quot;value&quot;:&quot;Submit&quot;,&quot;wrapper&quot;:&quot;[field_wrapper]\u003Cdiv class=\u0022 piklist-theme-field-container\u0022\u003E\u003Cdiv class=\u0022piklist-theme-label\u0022\u003E[field_label]\u003C\/div\u003E\u003Cdiv class=\u0022piklist-theme-field\u0022\u003E[field][field_description_wrapper]\u003Cp class=\u0022piklist-theme-field-description\u0022\u003E[field_description]\u003C\/p\u003E[\/field_description_wrapper]\u003C\/div\u003E\u003C\/div\u003E[\/field_wrapper]&quot;}},&quot;_&quot;:{&quot;form_id&quot;:{&quot;add_more&quot;:false,&quot;attributes&quot;:{&quot;class&quot;:[&quot;_form_id&quot;,&quot;piklist-field-element&quot;],&quot;data-piklist-field-addmore-clear&quot;:false},&quot;capability&quot;:null,&quot;child_add_more&quot;:false,&quot;child_field&quot;:false,&quot;choices&quot;:null,&quot;columns&quot;:null,&quot;conditions&quot;:[],&quot;description&quot;:null,&quot;display&quot;:false,&quot;embed&quot;:false,&quot;errors&quot;:false,&quot;field&quot;:&quot;form_id&quot;,&quot;group_field&quot;:false,&quot;help&quot;:null,&quot;id&quot;:&quot;_form_id_0&quot;,&quot;index&quot;:0,&quot;index_force&quot;:false,&quot;label&quot;:null,&quot;label_position&quot;:&quot;before&quot;,&quot;label_tag&quot;:true,&quot;list&quot;:true,&quot;list_item_type&quot;:null,&quot;list_type&quot;:null,&quot;logged_in&quot;:false,&quot;meta_query&quot;:[],&quot;multiple&quot;:false,&quot;name&quot;:&quot;_[form_id]&quot;,&quot;object_id&quot;:null,&quot;on_post_status&quot;:[],&quot;options&quot;:[],&quot;position&quot;:null,&quot;prefix&quot;:true,&quot;query&quot;:[],&quot;redirect&quot;:null,&quot;relate&quot;:false,&quot;relate_to&quot;:null,&quot;request_value&quot;:null,&quot;required&quot;:false,&quot;role&quot;:null,&quot;sanitize&quot;:[],&quot;save_as&quot;:null,&quot;scope&quot;:&quot;_&quot;,&quot;sortable&quot;:false,&quot;tax_query&quot;:[],&quot;template&quot;:&quot;field&quot;,&quot;type&quot;:&quot;hidden&quot;,&quot;valid&quot;:true,&quot;validate&quot;:[],&quot;value&quot;:&quot;wordpressplagiarismtracking_quick_insert_form&quot;,&quot;wrapper&quot;:&quot;[field]&quot;},&quot;nonce&quot;:{&quot;add_more&quot;:false,&quot;attributes&quot;:{&quot;class&quot;:[&quot;_nonce&quot;,&quot;piklist-field-element&quot;],&quot;data-piklist-field-addmore-clear&quot;:false},&quot;capability&quot;:null,&quot;child_add_more&quot;:false,&quot;child_field&quot;:false,&quot;choices&quot;:null,&quot;columns&quot;:null,&quot;conditions&quot;:[],&quot;description&quot;:null,&quot;display&quot;:false,&quot;embed&quot;:false,&quot;errors&quot;:false,&quot;field&quot;:&quot;nonce&quot;,&quot;group_field&quot;:false,&quot;help&quot;:null,&quot;id&quot;:&quot;_nonce_0&quot;,&quot;index&quot;:0,&quot;index_force&quot;:false,&quot;label&quot;:null,&quot;label_position&quot;:&quot;before&quot;,&quot;label_tag&quot;:true,&quot;list&quot;:true,&quot;list_item_type&quot;:null,&quot;list_type&quot;:null,&quot;logged_in&quot;:false,&quot;meta_query&quot;:[],&quot;multiple&quot;:false,&quot;name&quot;:&quot;_[nonce]&quot;,&quot;object_id&quot;:null,&quot;on_post_status&quot;:[],&quot;options&quot;:[],&quot;position&quot;:null,&quot;prefix&quot;:true,&quot;query&quot;:[],&quot;redirect&quot;:null,&quot;relate&quot;:false,&quot;relate_to&quot;:null,&quot;request_value&quot;:null,&quot;required&quot;:false,&quot;role&quot;:null,&quot;sanitize&quot;:[],&quot;save_as&quot;:null,&quot;scope&quot;:&quot;_&quot;,&quot;sortable&quot;:false,&quot;tax_query&quot;:[],&quot;template&quot;:&quot;field&quot;,&quot;type&quot;:&quot;hidden&quot;,&quot;valid&quot;:true,&quot;validate&quot;:[],&quot;value&quot;:&quot;336e99d2f5&quot;,&quot;wrapper&quot;:&quot;[field]&quot;}}}" class="_fields piklist-field-element" data-piklist-field-addmore-clear="0">
</form></div>
