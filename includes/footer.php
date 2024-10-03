<!-- End of Footer -->
</div>
<!-- /.container-fluid -->



<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto ">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; SmartPvc 2024</span>
    </div>
  </div>
</footer>
</div>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    // When a nav link is clicked
    $('.nav-link').on('click', function () {
      // Remove 'active' class from all nav items
      $('.nav-item').removeClass('active');
      // Add 'active' class to the clicked nav item
      $(this).closest('.nav-item').addClass('active');
    });
  });
</script>

</body>

</html>