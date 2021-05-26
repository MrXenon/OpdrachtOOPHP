<!-- GO TO TOP KNOP START -->
<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
<!-- GO TO TOP KNOP END -->

<!-- FORM CHECK START -->
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
<!-- FORM CHECK END -->


<!-- JS Global -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaQaMwK2SdUm3R5-6Llcq7nZBSVwcZrwo"></script>
<!--<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>-->

<!-- JS Plugins -->
<script src="assets/plugins/parallax/parallax.min.js"></script>
<script src="assets/plugins/isotope/lib/imagesloaded.pkgd.min.js"></script>
<script src="assets/plugins/isotope/isotope.pkgd.min.js"></script>
<script src="assets/plugins/flickity/flickity.pkgd.js"></script>
<script src="assets/plugins/lightbox/js/lightbox.min.js"></script>
<script src="assets/plugins/reservation/reservation.js"></script>
<script src="assets/plugins/alerts/alerts.js"></script>

<!-- JS Custom -->
<script src="assets/js/theme.min.js"></script>
<script src="assets/js/custom.js"></script>