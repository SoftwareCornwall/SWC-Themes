<?php
/*-----------------------------------------------------------------------------------*/
/*	SD Visual Composer Layouts
/*-----------------------------------------------------------------------------------*/
//landing page layout template

add_filter( 'vc_load_default_templates', 'sd_landing_page_layout' );

if ( !function_exists( 'sd_landing_page_layout' ) ) {
	function sd_landing_page_layout( $data ) {
    	$template               = array();
	    $template['name']       = __( 'Landing Page', 'sd-framework' );
	    $template['image_path'] = vc_asset_url( 'vc/templates/landing_page.png' );
	    $template['custom_class'] = '';
    	$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row]
CONTENT;

	    array_unshift( $data, $template );
    	return $data;
	}
}

//call to action page layout template

add_filter( 'vc_load_default_templates', 'sd_call_to_action_layout' );

if ( !function_exists( 'sd_call_to_action_layout' ) ) {
	function sd_call_to_action_layout( $data ) {
    	$template               = array();
	    $template['name']       = __( 'Call to Action Page', 'sd-framework' );
    	$template['image_path'] = vc_asset_url( 'vc/templates/call_to_action_page.png' );
	    $template['custom_class'] = '';
    	$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row]
CONTENT;

	    array_unshift( $data, $template );
    	return $data;
	}
}

//feature list page layout template

add_filter( 'vc_load_default_templates', 'sd_feature_list_layout' );

if ( !function_exists( 'sd_feature_list_layout' ) ) {
	function sd_feature_list_layout( $data ) {
    	$template               = array();
	    $template['name']       = __( 'Feature List Page', 'sd-framework' );
    	$template['image_path'] = vc_asset_url( 'vc/templates/feature_list.png' );
	    $template['custom_class'] = '';
    	$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][vc_column width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][vc_column width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][/vc_row]
CONTENT;

	    array_unshift( $data, $template );
    	return $data;
	}
}

//description page layout template

add_filter( 'vc_load_default_templates', 'sd_description_layout' );

if ( !function_exists( 'sd_description_layout' ) ) {
	function sd_description_layout( $data ) {
    	$template               = array();
	    $template['name']       = __( 'Description Page', 'sd-framework' );
    	$template['image_path'] = vc_asset_url( 'vc/templates/description_page.png' );
	    $template['custom_class'] = '';
    	$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_separator color="grey"][vc_single_image border_color="grey" img_link_target="_self"][vc_separator color="grey" margintop="0" marginbottom="0"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_empty_space height="10px"][vc_button title="Text on the button" style="rounded" color="#0191c6" size="large" href="#" target="_self" icon="none" textcolor="#ffffff" type="background"][/vc_column][vc_column width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_empty_space height="10px"][vc_button title="Text on the button" style="rounded" color="#0191c6" size="large" href="#" target="_self" icon="none" textcolor="#ffffff" type="background"][/vc_column][/vc_row]
CONTENT;

	    array_unshift( $data, $template );
    	return $data;
	}
}

//service list page layout template

add_filter( 'vc_load_default_templates', 'sd_service_list_layout' );

if ( !function_exists( 'sd_service_list_layout' ) ) {
	function sd_service_list_layout( $data ) {
    	$template               = array();
	    $template['name']       = __( 'Service List Page', 'sd-framework' );
    	$template['image_path'] = vc_asset_url( 'vc/templates/service_list.png' );
	    $template['custom_class'] = '';
    	$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row]
CONTENT;

	    array_unshift( $data, $template );
    	return $data;
	}
}

//product page layout template

add_filter( 'vc_load_default_templates', 'sd_product_layout' );

if ( !function_exists( 'sd_product_layout' ) ) {
	function sd_product_layout( $data ) {
    	$template               = array();
	    $template['name']       = __( 'Product Page', 'sd-framework' );
    	$template['image_path'] = vc_asset_url( 'vc/templates/product_page.png' );
	    $template['custom_class'] = '';
    	$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_separator color="grey"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][vc_column width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_empty_space height="10px"][vc_button title="Text on the button" style="rounded" color="#0191c6" size="large" href="#" target="_self" icon="none" textcolor="#ffffff" type="background"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][vc_column width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_empty_space height="10px"][vc_button title="Text on the button" style="rounded" color="#0191c6" size="large" href="#" target="_self" icon="none" textcolor="#ffffff" type="background"][/vc_column][/vc_row]
CONTENT;

	    array_unshift( $data, $template );
    	return $data;
	}
}

?>