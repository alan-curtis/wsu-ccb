<?php
$terms = get_terms(
  array(
    'taxonomy' => 'department',
    'hide_empty' => false,
  )
);
$departments = [];
$inc = 0;
foreach ($terms as $term) {
  $departments[$inc]['name'] = $term->name;
  $departments[$inc]['link'] = get_term_link($term->term_id);
  $inc++;
}
?>
<div class="container-parent ">
  <div class="container">
    <div class="search_main_section">
      <div class="row">
        <div class="col-md-8">
          <div class="search-title">
            <h2>
              <?= $args['title']; ?>
            </h2>
          </div>
          <div class="d-flex flex-column department_search_section">
            <label for="department-search">
              <?= $args['search_field_label']; ?>
            </label>
            <div class="d-flex align-items-center input-container">
              <input id="department-search" class="form-control" type="text" />
              <a class="search-result-link" href="#/"><i class="fa fa-search"></i></a>
              <div id="suggestion" class="row text-center"></div>

            </div>
            <!-- <div class="search-icon">

                        </div> -->
            <div class="departments-list">
              <ul class="d-flex list-unstyled m-0">
                <?php foreach ($departments as $department) { ?>
                  <li><a href="<?php echo $department['link']; ?>"><?php echo $department['name']; ?></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
            <!-- <div class="img-section"></div> -->
          </div>

        </div>
        <div class="col-md-4 img-section d-view-img">
          <img src="/wp-content/themes/wsu_ccb/assets/images/d-view.png" alt="">
        </div>
        <div class="col-md-4 img-section m-view-img">
          <img src="/wp-content/themes/wsu_ccb/assets/images/friends-participating-study-session-library.png" alt="">
        </div>
      </div>
    </div>
  </div>
</div>



<script>
  var items = [
    <?php foreach ($departments as $department) { ?>
      { data: '<?php echo $department['link']; ?>', value: '<?php echo $department['name']; ?>' },
    <?php } ?>
    //{data: '/vicente' , value: 'Vicente'},
  ]
  jQuery(function () {
    jQuery('#department-search').autocomplete(
      {
        lookup: items,
        onSelect: function (r) {
          //jQuery('#suggestion').text('Data: ' + r.data + ' Value: ' + r.value);
          jQuery('.search-result-link').attr('href', r.data)
        }
      });
  });
</script>