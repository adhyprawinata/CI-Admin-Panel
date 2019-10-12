<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Profile</h1>
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
    </div>
  </section>
</div>