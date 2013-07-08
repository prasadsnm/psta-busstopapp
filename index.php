<?php include('header.php'); ?> 
<body>
 <div data-role="page">
 <div data-theme="a" data-role="header">
                <h3>
                    Bus Stop
                </h3>
            </div>
            <!--end header-->
            <div data-role="content">
            <?php
				require("psta.class.php");
				$psta = new PSTA;
				$routes = json_decode($psta->index());
			?>
                <ul data-role="listview" data-divider-theme="b" data-inset="false">
                    <li data-role="list-divider" role="heading">
                        Select a route to view times
                    </li>
                   <?php if(is_array($routes->items)) { foreach($routes->items as $item) { ?>
                   		<li data-theme="c">
						<a href="get_direction.php?route=<?= $item->route_id ?>">
						<?= $item->name ?>
						</a>
					</li>
					<?php } } //end foreach loop & if?>	
                </ul>
            </div>
        </div>
    </body>
</html>