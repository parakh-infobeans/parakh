</div>
	</section>
	<footer class="footer">&copy; Copyright 2015  Infobeans, All Rights Reserved.</footer>
</div>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<!--<script type="text/javascript" src="js/jquery.fancybox-1.3.1.js"></script>-->
<script>
                (function($){
                        $(window).load(function(){
				
                                $("#content-1").mCustomScrollbar({
                theme: "minimal"
            });
            $("#content-2").mCustomScrollbar({
                theme: "minimal"
            });
            $("#content-3").mCustomScrollbar({
                theme: "minimal"
            });

        });
    })(jQuery);
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.logo-rht-txt').mouseover(function () {
            $('ul.dropdown').show();
        });
        $('.logo-rht-txt').mouseout(function () {
            $('ul.dropdown').hide();
        });
        // Rating request page js function
        $('.accordian-arrow-2').click(function () {
            $(this).parent().find('.img-acc').slideToggle(600);
            $(this).parent().find('.accordian-arrow-2').toggleClass('accordian-arrow-down-2');
        });
    });
</script>
<script type="text/javascript">

    // Only run everything once the page has completely loaded
    $(window).load(function () {

        // Fancybox specific
        $(".gallery__link").fancybox({
            'titleShow': false,
            'transitionIn': 'elastic',
            'transitionOut': 'elastic'
        });

        // Set general variables
        // ====================================================================
        var totalWidth = 0;

        // Total width is calculated by looping through each gallery item and
        // adding up each width and storing that in `totalWidth`
        $(".gallery__item").each(function () {
            totalWidth = totalWidth + $(this).outerWidth(true);
        });

        // The maxScrollPosition is the furthest point the items should
        // ever scroll to. We always want the viewport to be full of images.
        var maxScrollPosition = totalWidth - $(".gallery-wrap").outerWidth();
        var maxScrollPosition = totalWidth - $(".gallery-wrap1").outerWidth();
        var maxScrollPosition = totalWidth - $(".gallery-wrap2").outerWidth();

        // This is the core function that animates to the target item
        // ====================================================================
        function toGalleryItem($targetItem) {
            // Make sure the target item exists, otherwise do nothing
            if ($targetItem.length) {

                // The new position is just to the left of the targetItem
                var newPosition = $targetItem.position().left;

                // If the new position isn't greater than the maximum width
                if (newPosition <= maxScrollPosition) {

                    // Add active class to the target item
                    $targetItem.addClass("gallery__item--active");

                    // Remove the Active class from all other items
                    $targetItem.siblings().removeClass("gallery__item--active");

                    // Animate .gallery element to the correct left position.
                    $(".gallery").animate({
                        left: -newPosition
                    });
                } else {
                    // Animate .gallery element to the correct left position.
                    $(".gallery").animate({
                        left: -maxScrollPosition
                    });
                }
                ;
            }
            ;
        }
        ;

        // Basic HTML manipulation
        // ====================================================================
        // Set the gallery width to the totalWidth. This allows all items to
        // be on one line.
        $(".gallery").width(totalWidth);

        // Add active class to the first gallery item
        $(".gallery__item:first").addClass("gallery__item--active");

        // When the prev button is clicked
        // ====================================================================
        $(".gallery__controls-prev").click(function () {
            // Set target item to the item before the active item
            var $targetItem = $(".gallery__item--active").prev();
            toGalleryItem($targetItem);
        });

        // When the next button is clicked
        // ====================================================================
        $(".gallery__controls-next").click(function () {
            // Set target item to the item after the active item
            var $targetItem = $(".gallery__item--active").next();
            toGalleryItem($targetItem);
        });
    });
</script>
</body>
</html>
