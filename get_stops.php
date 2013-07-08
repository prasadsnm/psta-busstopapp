<?php 
include('header.php');
$route = $_GET["route"];
$direction = $_GET["direction"];
$xml = simplexml_load_file("http://97.76.252.57/bustime/eta/routeDirectionStopAsXML.jsp?route=$route&direction=$direction");
?>
<body>
 <div data-role="page">
 <div data-theme="a" data-role="header">
                 <a data-role="button" data-direction="reverse" data-rel="back" data-transition="fade" href="get_direction.php?route=<?php echo $route; ?>" data-icon="back" data-iconpos="left">
                    Back
                </a>
                <h3>
                    Bus Stop
                </h3>
            </div>
            <!--end header-->
            <div data-role="content">
			 <ul data-role="listview" data-divider-theme="b" data-inset="false">
                    <li data-role="list-divider" role="heading">
                        Choose a stop
                    </li>
                    <?php foreach ($xml->stop as $stop) { ?>
                    <li data-theme="c">
<a href="get_eta.php?route=<?php echo $route; ?>&direction=<?php echo $direction; ?>&stop=<?php echo $stop['id']; ?> ">
<?php echo $stop['name']; ?>
                        </a>
                    </li>
					<?php } //close foreach ?> 
			</ul>
		</div>
     </div>
</body>
</html>