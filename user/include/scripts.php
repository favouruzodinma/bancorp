<script>
function create(id){
    id.innerHTML = "submitting request...";
    $("#div").fadeOut(1000);
    setTimeout(function(){
    $('#div').show();
    id.innerHTML = "Submit";
    }, 3000);
    }
</script>
<script>
function create(event, id){
    event.preventDefault(); // Prevents the default behavior (e.g., form submission or page reload)
    
    id.innerHTML = "Validating...";
    $("#otp").fadeOut(1000);
    
    setTimeout(function(){
        $('#otp').show();
        id.innerHTML = "Validate";
    }, 3000);
}
</script>

<script>
    $(document).ready(function () {
        $('#update_profile').on('submit', function (e) {
            e.preventDefault();

            // Clear previous error messages
            $(".toast-body").html('');
            $("#ErrorToast").toast("hide");

            var full_name = $('#full_name').val();
            var city = $('#city').val();
            var gender = $('#gender').val();
            var dob = $('#dob').val();
            var age = $('#age').val();
            var marital_status = $('#maritalStatus').val();
            var address = $('#address').val();
            var country = $('#country').val();
            var state = $('#state').val();
            var profile_img = $('#profile_img')[0].files[0];

            // Validate form fields
            if (full_name == "" || address == "" || country == "" || city == "" || state == "" || gender == "" || age == "" || dob == "" || !profile_img || marital_status == "") {
                $(".toast-body").html('Enter all fields');
                $("#ErrorToast").toast("show");
                return false;
            }

            var formData = new FormData(this);
            formData.append('profile_img', profile_img);

            $.ajax({
                type: "POST",
                url: "include/process/edit-profile.php",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status === 'success') {
                        // Profile updated successfully
                        $(".toast-body").html(data.message);
                        $("#successToast").toast("show");

                        // Optionally, you can redirect the user to another page or perform additional actions
                    } else {
                        // Profile update failed
                        $(".toast-body").html(data.content);
                        $("#ErrorToast").toast("show");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    Swal.fire('The Internet?', 'Check network connection!', 'question');
                }
            });
        });
    });
</script>

<script src="js/jquery.min.js"></script>
 <!-- validation init -->
 <script src="../app\assets\js\pages\validation.init.js"></script>
<!-- App js -->
<!-- <script src="../app/assets/js/app.js"></script> -->

<script src="js/popper.min.js"></script>      
<script src="js/bootstrap.min.js"></script>
<!-- Appear JavaScript -->
<script src="js/jquery.appear.js"></script>
<!-- Countdown JavaScript -->
<script src="js/countdown.min.js"></script>
<!-- Counterup JavaScript -->
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<!-- Wow JavaScript -->
<script src="js/wow.min.js"></script>
<!-- Apexcharts JavaScript -->
<script src="js/apexcharts.js"></script>
<!-- Slick JavaScript -->
<script src="js/slick.min.js"></script>
<!-- Select2 JavaScript -->
<script src="js/select2.min.js"></script>
<!-- Owl Carousel JavaScript -->
<script src="js/owl.carousel.min.js"></script>
<!-- Magnific Popup JavaScript -->
<script src="js/jquery.magnific-popup.min.js"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="js/smooth-scrollbar.js"></script>
<!-- lottie JavaScript -->
<script src="js/lottie.js"></script>
<!-- Chart Custom JavaScript -->
<script src="js/chart-custom.js"></script>
<!-- Custom JavaScript -->
<script src="js/custom.js"></script>

<script>
  // Alert Redirect to logoout page
  $(document).on('click', '#logout', function(e) {
        swal({
        title: "Are you sure?", 
        text: "You will be redirected to bancorp.app", 
        type: "warning",
        confirmButtonText: "Yes!",
        showCancelButton: true
        })
          .then((result) => {
          if (result.value) {
              window.location = 'logout.php';
          } else if (result.dismiss === 'cancel') {
              swal(
                'Cancelled',
                'Your stay here ',
                'error'
              )
          }
        })  
    });
</script>


<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Include your JavaScript code -->
<script>
    $(document).ready(function () {
        // Parse the query string to get the status and message parameters
        var urlParams = new URLSearchParams(window.location.search);
        var status = urlParams.get('status');
        var message = urlParams.get('message');

        // Check if status and message parameters are present
        if (status && message) {
            // Show SweetAlert based on the status
            if (status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: message,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: message,
                });
            }
        }
    });
</script>

