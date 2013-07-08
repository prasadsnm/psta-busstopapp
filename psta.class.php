<?php

require 'simple_html_dom.php';

define("PSTA_INDEX", "http://97.76.252.57/bustime/wireless/html/home.jsp");
define("PSTA_DIRECTION", "http://97.76.252.57/bustime/wireless/html/selectdirection.jsp?route=");
define("PSTA_STOPS", "http://97.76.252.57/bustime/wireless/html/selectstop.jsp?route=__ROUTE__&direction=__DIRECTION__");
define("PSTA_ETA", "http://97.76.252.57/bustime/wireless/html/eta.jsp?route=__ROUTE__&direction=__DIRECTION__&stop=__STOP__&id=__ID__");
define("PSTA_MAP", "http://97.76.252.57/bustime/map/getBusesForRoute.jsp?route=");
define("PSTA_NO_SERVICE_STRING", "No service is scheduled");

class PSTA {
	
	function http_request_get ($address, $selector="ul li") {
		
		$output = file_get_html($address);
		if(isset($selector))
			$output = $output->find($selector);
		return $output;
		
	}
	
	function convert_object ($object) { 
		$return = NULL;
		if(is_array($object)) {
			if(count($object) == 1) {
				$return[$key][] = self::convert_object($value);
			} else {
				foreach($object as $key => $value) {
					$return[$key] = self::convert_object($value);
				}
			}
		} else {
			$var = get_object_vars($object);
			if($var) {
				foreach($var as $key => $value) {
					$return[$key] = self::convert_object($value);
				}
			} else {
				return strval($object);
			}
		}
		return $return; 
	}
	
	function index () {
		$els = @self::http_request_get(PSTA_INDEX);
		
		if(is_array($els)) {
			$routes = array();
			$routes["items"] = array();
			foreach($els as $el) {
				$url = parse_url($el->children(0)->href);
				//explode route to get # for use as route id
				$exploded_route = explode(" ", $el->plaintext);
		 		array_push($routes["items"], array("name" => trim($el->plaintext),
										"route_id" => $exploded_route[0]
										));
			}
			
		}
		
		return json_encode($routes);
		
	}//close index function

	
}//close class psta

?>