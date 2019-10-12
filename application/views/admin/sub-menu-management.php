<script type="text/javascript">
  $(document).ready(function() {
    var table_menu = $("#table_menu").DataTable({
      'filter': false,
      "ajax": {
        "url": "<?= base_url(); ?>admin/getlistsubmenu",
        "type": "POST",
        "data": function(d) {

        }
      },
      "columns": [{
          "data": "no"
        },
        {
          "data": "title"
        },
        {
          "data": "menu"
        },
        {
          "data": "url"
        },
        {
          "data": "icon"
        },
        {
          "data": "is_active"
        },
        {
          "data": "action"
        }
      ]
    });
  });
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
      <h2 class="section-title">DataTables</h2>
      <p class="section-lead">
        We use 'DataTables' made by @SpryMedia. You can check the full documentation <a href="https://datatables.net/">here</a>.
      </p>

      <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
          <?php
          if ($this->session->flashdata('message')) {
            ?>
            <div class="alert alert-success alert-dismissible show fade">
              <div class=" alert-body">
                <button class="close" data-dismiss="alert">
                  <span>×</span>
                </button>
                <?= $this->session->flashdata('message'); ?>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="col-12">
          <div class="card">
            <!--<div class="card-header">
                              <h4>Basic DataTables</h4>
                            </div>-->
            <div class="card-footer text-left">
              <a href="sub_menu_mng_add" class="btn btn-primary">Add</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table_menu">
                  <thead>
                    <th>No</th>
                    <th>Title</th>
                    <th>Menu</th>
                    <th>Url</th>
                    <th>Icon</th>
                    <th>Active</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>