<html>
<head>

<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/js/gmap.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
</head>

<div id='map' style='width:100%;height:100%'></div>
<script type='text/javascript'>
$(function() {

    gmap = new gmap({
        'lat': <?php echo $gmap->getLat();?>,
        'lng': <?php echo $gmap->getLng();?>,
        'zoom': <?php echo $gmap->getZoom();?>
    })
})

</script>
</html>
