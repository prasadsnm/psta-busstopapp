<?php include('header.php');
$route = $_GET["route"];
$direction = $_GET["direction"];
$stop= $_GET["stop"];
$xml = simplexml_load_file("http://97.76.252.57/bustime/map/getStopPredictions.jsp?stop=$stop&route=$route");
?>
<body>
 <div data-role="page">
 <div data-theme="a" data-role="header">
                 <a data-role="button" data-direction="reverse" data-rel="back" data-transition="fade" href="get_stops.php?route=<?php echo $route; ?>&direction=<?php echo $direction['name']; ?>" data-icon="back" data-iconpos="left">
                    Back
                </a>
                <h3>
                    Bus Stop
                </h3>
            </div>
            <!--end header-->
            <div data-role="content">
			  <ul id="eta-times" data-role="listview" data-divider-theme="b" data-inset="true">
                    <li data-role="list-divider" role="heading">
                        <?php echo $xml->nm ?>
<?php if($xml->pre->pt !="") { ?>
<?php foreach ($xml->pre as $pre) { ?>
<li data-theme="c">
<?php echo $pre->pt;?>
</li>
<?php }} else { ?>
<li data-theme=c>
No arrival times are available at this time. Check back soon.
</li>
<?php } ?>
			</ul>
        		<button data-transition="slideup" data-theme="c" data-icon="refresh" data-iconpos="left"onclick="location.reload(true)">reload page</button>
		</div>
     </div>
</body>
</html>