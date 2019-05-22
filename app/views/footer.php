<script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function($) {
        $('.sort select').on('change', function(event) {
            event.preventDefault();

            sort = jQuery('.sort select[name="sort"]').val();
            order = jQuery('.sort select[name="order"]').val();
            page = jQuery('.navigation a').html();

            sorting(sort, order, page);
        });
        $('.navigation a').on('click', function(event) {
            event.preventDefault();

            sort = jQuery('.sort select[name="sort"]').val();
            order = jQuery('.sort select[name="order"]').val();
            page = jQuery(this).html();

            sorting(sort, order, page);
        });
    });

    function sorting(sort, order, page) {
        jQuery(location).attr('href', '/?page='+page+'&sort='+sort+'&order='+order);
    }
</script>

    </div>
</body>
</html>