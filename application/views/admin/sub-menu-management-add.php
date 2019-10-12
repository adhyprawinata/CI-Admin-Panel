<script type="text/javascript">
  $(document).ready(function() {
    getMenuID();
  });

  function getMenuID() {
    $.ajax({
      url: '<?= base_url(); ?>admin/getMenuID',
      type: 'get',
      data: {},
      dataType: 'json',
      async: false,
      success: function(data) {
        var myObj = data;
        var myJSON = JSON.stringify(myObj);

        var myParse = JSON.parse(myJSON);

        console.log(JSON.parse(myJSON));

        var options = '<option value="">-- Select Menu --</option>';
        for (var i = 0, len = myParse.length; i < len; i++) {
          options += '<option value="' + myParse[i]['id'] + '">' + myParse[i]['menu'] + '</option>';
        }
        $('select[id="menu_id"]').html(options);
      }
    });
  }
</script>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Sub Menu Management</h1>
      <div class="section-header-breadcrumb">
        <?php
        $segments = $this->uri->segment_array();
        $last_segment = '';
        $index = 1;
        foreach ($segments as $segment) {
          if ($index == "1") {
            $last_segment .= $segment;
          } else {
            $last_segment .= '/' . $segment;
          }
          echo '<div class="breadcrumb-item"><a href="' . base_url() . $last_segment . '">' . ucfirst(str_replace(array('-', '_'), '', $segment)) . '</a></div>';
          $index++;
        }
        ?>

      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <form method="post" action="<?= base_url('admin/save_sub_menu_mng'); ?>" class="needs-validation" novalidate="">
              <div class="card-header">
                <h4>Add Sub Menu Management</h4>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" id="title" name="title" class="form-control" required="">
                    <div class="invalid-feedback">
                      Please fill in your title
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Menu</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="menu_id" name="menu_id" required="">
                    </select>
                    <div class="invalid-feedback">
                      Please fill in your menu
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Url</label>
                  <div class="col-sm-9">
                    <input type="text" id="url" name="url" class="form-control" required="">
                    <div class="invalid-feedback">
                      Please fill in your url
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Icon</label>
                  <div class="col-sm-9">
                    <input type="text" id="icon" name="icon" class="form-control" required="">
                    <div class="invalid-feedback">
                      Please fill in your icon
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                      <label class="custom-control-label" for="is_active"></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>