<div class="right_aninamtion polygonizr"></div>
<script type="text/javascript" src="<?php echo get_theme_file_uri( '/assets/plugins/polygonizr/polygonizr.min.js')?>"></script>
<script>
jQuery(document).ready(function($){
    let $sitelading = $('.polygonizr');
    $sitelading.polygonizr({
            canvasWidth: '250',
            canvasHeight: $('.polygonizr').height(),
            // duration: 10,
            // nodeMovementDistance: 10,
            // numberOfNodes: 1,
            // numberOfUnconnectedNode: 25,
            nodeDotColor:"10, 10, 10",
            nodeLineColor:"5, 5, 5",
            nodeFillColor:"5, 5, 5",
    });

});
</script>