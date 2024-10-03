<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>
  <div class="row">
    <!-- Content Rowwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww -->
    <?php
    // Read the count from the first text file
    $countFileOnePVC = 'download_count_onepvc.txt';
    $totalDownloadsOnePVC = file_exists($countFileOnePVC) ? (int) file_get_contents($countFileOnePVC) : 0;

    // Read the count from the second text file
    $countFileTwoPVC = 'download_count_twopvc.txt';
    $totalDownloadsTwoPVC = file_exists($countFileTwoPVC) ? (int) file_get_contents($countFileTwoPVC) : 0;

    // Calculate the total count
    $totalDownloads = $totalDownloadsOnePVC + $totalDownloadsTwoPVC;
    ?>

    <!-- Card for Total PVC -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total pvc</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalEntries"><?php echo $totalDownloads; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card for Total OnePVC -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total onepvc</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalEntries"><?php echo $totalDownloadsOnePVC; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card for Total TwoPVC -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total Twopvc</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalEntries"><?php echo $totalDownloadsTwoPVC; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>