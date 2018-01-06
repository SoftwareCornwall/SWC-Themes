<?php
/*-----------------------------------------------------------------------------------*/
/*	Google Map
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'sd_google_map') ) {
	function sd_google_map( $atts ) {
		// default atts
		$atts = shortcode_atts( array(	
			'lat'   => '0', 
			'lon'    => '0',
			'id' => 'map',
			'zoom' => '15',
			'width' => '400px',
			'height' => '300px',
			'maptype' => 'ROADMAP',
			'address' => '',
			'marker' => '',
			'markerimage' => '',
			'traffic' => 'no',
			'bike' => 'no',
			'infowindow' => '',
			'infowindowdefault' => 'yes',
			'hidecontrols' => 'false',
			'scale' => 'false',
			'scrollwheel' => 'true'		
		), $atts);
		
		$returnme = '<div id="' .$atts['id'] . '" style="width:' . $atts['width'] . ';height:' . $atts['height'] . ';" class="google_map"></div>';
		
		$marker_image = ( !empty($atts['markerimage']) ? wp_get_attachment_image_src( $atts['markerimage'], 'full' ) : NULL );
		
		$atts['markerimage'] = ( !empty($atts['markerimage']) ? $marker_image[0] : NULL );

		$returnme .= '
	
	<script type="text/javascript">

		var latlng = new google.maps.LatLng(' . $atts['lat'] . ', ' . $atts['lon'] . ');
		var myOptions = {
			zoom: ' . $atts['zoom'] . ',
			center: latlng,
			scrollwheel: ' . $atts['scrollwheel'] .',
			scaleControl: ' . $atts['scale'] .',
			disableDefaultUI: ' . $atts['hidecontrols'] .',
			mapTypeId: google.maps.MapTypeId.' . $atts['maptype'] . ',
			styles: [{stylers:[{saturation:-100},{gamma:1}]},{elementType:"labels.text.stroke",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"water",stylers:[{visibility:"on"},{saturation:50},{gamma:0},{hue:"#50a5d1"}]},{featureType:"administrative.neighborhood",elementType:"labels.text.fill",stylers:[{color:"#333333"}]},{featureType:"road.local",elementType:"labels.text",stylers:[{weight:0.5},{color:"#333333"}]},{featureType:"transit.station",elementType:"labels.icon",stylers:[{gamma:1},{saturation:50}]}]
		};
		var ' . $atts['id'] . ' = new google.maps.Map(document.getElementById("' . $atts['id'] . '"),
		myOptions);
		
		google.maps.event.addDomListener(window, "resize", function() {
    var center = ' .$atts['id'] . '.getCenter();
    google.maps.event.trigger(' .$atts['id'] . ', "resize");
    ' .$atts['id'] . '.setCenter(center);
	});
	';
	
		//traffic
		if($atts['traffic'] == 'yes')
		{
			$returnme .= '
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(' . $atts['id'] . ');
			';
		}
	
		//bike
		if($atts['bike'] == 'yes')
		{
			$returnme .= '			
			var bikeLayer = new google.maps.BicyclingLayer();
			bikeLayer.setMap(' . $atts['id'] . ');
			';
		}
		//address
		if($atts['address'] != '')
		{
			$returnme .= '
		    var geocoder_' . $atts['id'] . ' = new google.maps.Geocoder();
			var address = \'' . $atts['address'] . '\';
			geocoder_' . $atts['id'] . '.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					' . $atts['id'] . '.setCenter(results[0].geometry.location);
					';
					
					if ($atts['marker'] !='no')
					{
						//add custom image
						if ($atts['markerimage'] !='')
						{
							$returnme .= 'var image = "'. $atts['markerimage'] .'";';
						}
						$returnme .= '
						var marker = new google.maps.Marker({
							map: ' . $atts['id'] . ', 
							';
							if ($atts['markerimage'] !='')
							{
								$returnme .= 'icon: image,';
							}
						$returnme .= '
							position: ' . $atts['id'] . '.getCenter()
						});
						';

						//infowindow
						if($atts['infowindow'] != '') 
						{
							//first convert and decode html chars
							$thiscontent = htmlspecialchars_decode($atts['infowindow']);
							$returnme .= '
							var contentString = \'' . $thiscontent . '\';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
										
							google.maps.event.addListener(marker, \'click\', function() {
							  infowindow.open(' . $atts['id'] . ',marker);
							});
							';

							//infowindow default
							if ($atts['infowindowdefault'] == 'yes')
							{
								$returnme .= '
									infowindow.open(' . $atts['id'] . ',marker);
								';
							}
						}
					}
			$returnme .= '
				} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
		';
		}

		//marker: show if address is not specified
		if ($atts['marker'] != '' && $atts['address'] == '')
		{
			//add custom image
			if ($atts['markerimage'] !='')
			{
				$returnme .= 'var image = "'. $atts['markerimage'] .'";';
			}

			$returnme .= '
				var marker = new google.maps.Marker({
				map: ' . $atts['id'] . ', 
				';
				if ($atts['markerimage'] !='')
				{
					$returnme .= 'icon: image,';
				}
			$returnme .= '
				position: ' . $atts['id'] . '.getCenter()
			});
			';

			//infowindow
			if($atts['infowindow'] != '') 
			{
				$returnme .= '
				var contentString = \'' . $atts['infowindow'] . '\';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
							
				google.maps.event.addListener(marker, \'click\', function() {
				  infowindow.open(' . $atts['id'] . ',marker);
				});
				';
				//infowindow default
				if ($atts['infowindowdefault'] == 'yes')
				{
					$returnme .= '
						infowindow.open(' . $atts['id'] . ',marker);
					';
				}				
			}
		}
		
		$returnme .= '</script>';
		
		
		return $returnme;
		
	}
	add_shortcode( 'sd_gmap', 'sd_google_map' );
}

// register shortcode to VC

add_action( 'init', 'sd_gmap_vcmap' );

if ( ! function_exists( 'sd_gmap_vcmap' ) ) {
	function sd_gmap_vcmap() {
		vc_map( array(
			'name'					=> 'Google Map',
			'description'			=> 'Insert a Google map',
			'base'					=> "sd_gmap",
			'class'					=> "sd_gmap",
			'category'				=> 'My University',
			'icon' 					=> "icon-wpb-sd-gmap",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'				=> array(
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Map ID',
					'param_name'	=> 'id',
					'value'			=> 'map',
					'description'	=> 'Insert a unique ID for the map (eg. map01).',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Address',
					'param_name'	=> 'address',
					'value'			=> '',
					'description'	=> 'Insert the address of the map.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Width',
					'param_name'	=> 'width',
					'value'			=> '400px',
					'description'	=> 'Insert the width of the map in pixels or percentage (eg. 400px, 100%).',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Height',
					'param_name'	=> 'height',
					'value'			=> '300px',
					'description'	=> 'Insert the height of the map in pixels or percentage (eg. 300px, 100%)',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Map Type',
					'param_name'	=> 'maptype',
					'value'			=> array( 'ROADMAP' => 'ROADMAP', 'TERRAIN' => 'TERRAIN', 'SATELLITE' => 'SATELLITE', 'HYBRID' => 'HYBRID' ),
					'description'	=> 'Insert the type of the map.',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Show Marker?',
					'param_name'	=> 'marker',
					'value'			=> array( 'yes', 'no' ),
					'description'	=> 'Show a marker at the address.',
					),
				array(
					'type'			=> 'attach_image',
					'class'			=> '',
					'heading'		=> 'Marker Image',
					'param_name'	=> 'markerimage',
					'value'			=> '',
					'description'	=> 'Upload a custom marker image.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Zoom',
					'param_name'	=> 'zoom',
					'value'			=> '15',
					'description'	=> 'Insert the amount of zoom into the map.',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Show Info Window?',
					'param_name'	=> 'infowindowdefault',
					'value'			=> array( 'yes', 'no' ),
					'description'	=> 'Show the info window.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Info Window Content',
					'param_name'	=> 'infowindow',
					'value'			=> '',
					'description'	=> 'Insert a short content of the infowindow (eg. Home Sweet Home)',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Hide Controls?',
					'param_name'	=> 'hidecontrols',
					'value'			=> array( 'no' => 'false', 'yes' => 'true' ),
					'description'	=> 'Select to show or hide the map controls.',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Allow Map Scaling?',
					'param_name'	=> 'scale',
					'value'			=> array( 'no' => 'false', 'yes' => 'true' ),
					'description'	=> 'Select if you allow scaling of the map.',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Allow Scrolling on the Map?',
					'param_name'	=> 'scrollwheel',
					'value'			=> array( 'yes' => 'true', 'no' => 'false' ),
					'description'	=> 'Select if you allow scrolling on the map.',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Show Traffic Info?',
					'param_name'	=> 'traffic',
					'value'			=> array( 'no', 'yes' ),
					'description'	=> 'Select if you want to show traffic info.',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Show Bike Route?',
					'param_name'	=> 'bike',
					'value'			=> array( 'no', 'yes' ),
					'description'	=> 'Select if you want to show bike route.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Latitude',
					'param_name'	=> 'lat',
					'value'			=> '0',
					'description'	=> 'Insert latitude coordinates (optional).',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Longitude',
					'param_name'	=> 'lon',
					'value'			=> '0',
					'description'	=> 'Insert longitude coordinates (optional).',
					)
				)
			));
	}
}