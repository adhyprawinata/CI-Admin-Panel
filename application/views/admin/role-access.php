<script type="text/javascript">
  $(document).ready(function() {
    $('.custom-control-input').on('click', function() {
      const menuId = $(this).data('menu');
      const roleId = $(this).data('role');

      $.ajax({
        url: "<?= base_url('admin/changeaccess'); ?>",
        type: 'post',
        data: {
          menuId: menuId,
          roleId: roleId
        },
        success: function() {
          document.location.href = "<?= base_url('admin/role_access/'); ?>" + roleId;
        }
      });

    });
  });
</script>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Role</h1>
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
          <div class="card">
            <div class="card-header">
              <h4>Role: <?= $role['role']; ?></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Menu</th>
                      <th scope="col">Access</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $m['menu']; ?></td>
                        <td>
                          <div class="form-check">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck<?= $i; ?>" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                              <label class="custom-control-label" for="customCheck<?= $i; ?>"></label>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach; ?>
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