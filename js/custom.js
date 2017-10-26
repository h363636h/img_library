		function getOptByStyle(styleName){
	
		var opt = {
				
		};
		
		var isJustified = jQuery("#tiles_type_justified").length;
		
		switch(styleName){
			case "default":
			break;
			case "lightbox_compact_inside":
				opt.lightbox_type = "compact";			
				opt.lightbox_arrows_position = "inside";
			break;
			case "lightbox_compact":
				opt.lightbox_type = "compact";			
			break;
			case "bw":
				opt.tile_enable_image_effect = true;
				opt.tile_enable_overlay = false;
				opt.tile_enable_icons = false;
			break;
			case "as_link":
				opt.tile_as_link = true;				
			break;
			case "link_and_view":
				opt.tile_show_link_icon = true;
			break;
			case "no_icons":
				opt.tile_enable_icons = false;
			break;
			case "bw_over":
				opt.tile_enable_image_effect = true;
				opt.tile_image_effect_reverse = true;
			break;
			case "blur":
				opt.tile_enable_image_effect = true;
				opt.tile_image_effect_reverse = true;
				opt.tile_image_effect_type = "blur";				
			break;
			case "sepia":
				opt.tile_enable_image_effect = true;
				opt.tile_image_effect_type = "sepia";
				opt.tile_enable_overlay = false;
				opt.tile_enable_icons = false;
			break;
			case "border":
				opt.tile_enable_shadow = false;
				opt.tile_enable_border = true;
				opt.tile_enable_outline = false;
				opt.tiles_space_between_cols = 15;
				opt.tiles_justified_space_between = 15;
				opt.tile_border_color = "#949494";
				opt.tile_border_width = 3;
				opt.tiles_col_width = 235;
				opt.tile_border_radius = 5;
				if(isJustified)
					opt.theme_gallery_padding = 15;
			break;
			case "outline":
				opt.tile_enable_shadow = false;
				opt.tile_enable_border = true;
				opt.tiles_space_between_cols = 15;
				opt.tiles_justified_space_between = 15;
				opt.tiles_col_width = 235;
				opt.tile_border_color = "#ffffff";
				opt.tile_enable_outline = true;
				if(isJustified)
					opt.theme_gallery_padding = 15;
			break;
			case "shadow":
				opt.tiles_space_between_cols = 25;
				opt.tiles_justified_space_between = 25;
				opt.tiles_col_width = 220;
				opt.tile_enable_shadow = true;
				if(isJustified)
					opt.theme_gallery_padding = 25;
			break;
			case "text_panel":
				opt.tile_enable_textpanel = true;
				opt.tile_textpanel_title_text_align = "center";
			break;
			case "text_panel_color":
				opt.tile_enable_textpanel = true;
				opt.tile_textpanel_bg_color = "#3A85E0";
				opt.tile_textpanel_bg_opacity = 0.8;
				opt.tile_textpanel_title_color = "yellow";
				opt.tile_textpanel_title_text_align = "center";
			break;
			case "text_panel_always":
				opt.tile_enable_textpanel = true;
				opt.tile_textpanel_title_text_align = "center";
				opt.tile_textpanel_always_on = true;
			break;
			case "combination1":
				opt.tile_enable_image_effect = true;
				opt.tile_image_effect_type = "blur";
				opt.tile_overlay_color = "#509B39";
				opt.tile_overlay_opacity = 0.4;
				opt.tile_image_effect_reverse = true;
			break;
			case "justified_space":
				opt.tiles_justified_space_between = 0;
			break;
			case "justified_bigger_space":
				opt.tiles_justified_space_between = 10;
			break;
			case "tilesgrid_nospace":
				opt.grid_space_between_cols = 0;
				opt.grid_space_between_rows = 0;
				opt.tile_enable_border = false;
				opt.tile_enable_shadow = false;
				opt.grid_padding = 0;
				opt.tile_width = 250;
			break;
			case "tilesgrid_anothersize":
				opt.tile_width = 180;
				opt.tile_height = 230;
				opt.grid_num_rows = 2;
			break;
			case "thumbs_bw":
				opt.thumb_image_overlay_effect = true;
			break;
			case "thumbs_blur":
				opt.thumb_image_overlay_effect = true;
				opt.thumb_image_overlay_type = "blur";
			break;
			case "thumbs_sepia":
				opt.thumb_image_overlay_effect = true;
				opt.thumb_image_overlay_type = "sepia";
			break;
			case "thumbs_border":
				opt.thumb_border_width = 2;
				opt.thumb_over_border_width = 2;
				opt.thumb_selected_border_width = 4;
				
			break;
			case "thumbs_dynamic":
				opt.thumb_fixed_size = false;
			break;
			case "thumbs_color":
				opt.thumb_border_effect = false;
				opt.thumb_color_overlay_effect = true;
				opt.thumb_overlay_color = "#ffffff";
				opt.thumb_overlay_reverse = false;
				opt.thumb_overlay_opacity = 0.5;
			break;
			case "thumbs_play1":
				opt.slider_enable_arrows = false;
				opt.slider_enable_zoom_panel=false;
				opt.slider_textpanel_enable_title=true;
				opt.slider_textpanel_bg_opacity=0.5;
				opt.slider_textpanel_css_title={color:"yellow"};
				opt.slider_textpanel_css_description={color:"yellow"};
				opt.thumb_width=120;
				opt.thumb_height=60;
				opt.thumb_border_color="#aea703";
				opt.thumb_over_border_color="#ded84d";
				opt.thumb_selected_border_width=4;
				opt.thumb_selected_border_color="#ded84d";
				opt.thumb_round_corners_radius=2;
				opt.thumb_color_overlay_effect=false;
				opt.thumb_image_overlay_effect=true;
				opt.thumb_transition_duration=500;
				opt.thumb_transition_easing="linear";
				opt.strippanel_enable_buttons=false;
				opt.strippanel_enable_handle=false;
				opt.theme_enable_hidepanel_button=false;
			break;
			case "thumbs_size":
				opt.thumb_width = 120;
				opt.thumb_height = 70;
			break;
			case "thumbs_between":
				opt.strip_space_between_thumbs = 15;
				opt.thumb_border_width = 1;
				opt.thumb_over_border_width = 1;
			break;
			case "grid_scroll":
				opt.gridpanel_vertical_scroll = false;
				opt.gridpanel_grid_align = "top";
			break;
			case "grid_cols":
				opt.grid_num_cols = 3;
				opt.gridpanel_vertical_scroll = false;
				opt.gridpanel_grid_align = "top";
				opt.thumb_width = 70;
				opt.thumb_height = 50;				
			break;
			case "compact_noextras": 
			case "grid_no_extras":
				opt.slider_enable_arrows = false;
				opt.slider_enable_progress_indicator = false;
				opt.slider_enable_play_button = false;
				opt.slider_enable_fullscreen_button = false;
				opt.slider_enable_zoom_panel = false;
				opt.slider_enable_text_panel = false;
				opt.strippanel_enable_handle = false;
				opt.gridpanel_enable_handle = false;
			break;
			case "carousel_size":
				opt.tile_width = 120; 
				opt.tile_height = 120;			
				opt.carousel_space_between_tiles = 10;
			break;
			case "carousel_direction":
				opt.carousel_autoplay_direction = "left";
			break;
			case "compact_textpanel":
				opt.slider_enable_text_panel = true;
				opt.strippanel_enable_handle = false;
			break;
			case "compact_textpanel_options":
				opt.slider_enable_text_panel = true;
				opt.strippanel_enable_handle = false;
				
				opt.slider_textpanel_enable_title=false;
				opt.textpanel_enable_bg = false;
				
				opt.slider_textpanel_css_title={color:"yellow","font-size":"20px"};
				opt.slider_textpanel_css_description={color:"yellow","font-size":"20px","text-shadow": "2px 2px 8px #000000","text-align":"right"};
				opt.slider_textpanel_padding_bottom = 15;
			break;
			case "compact_buttons_positions":
				opt.slider_arrow_right_align_hor = "left";
				opt.slider_arrow_left_align_vert = "top";
				opt.slider_arrow_right_align_vert = "top";
				opt.slider_arrow_left_offset_hor = 11;
				opt.slider_arrow_right_offset_hor = 41;
				opt.slider_arrow_left_offset_vert = 10;
				opt.slider_arrow_right_offset_vert = 10;
				opt.slider_play_button_align_hor = "right";
				opt.slider_fullscreen_button_align_hor = "right";
				opt.slider_zoompanel_offset_vert = 45;
				opt.slider_zoompanel_offset_hor = 10;
				opt.slider_progress_indicator_align_hor = "right";
				opt.slider_progress_indicator_offset_hor = 60;
				opt.slider_progress_indicator_offset_vert = 5;
				
			break;
			default:
				trace(styleName);
				return(false);
			break;
		}
		
		//opt.lightbox_textpanel_enable_title = false;
		//opt.lightbox_textpanel_enable_description = true;
		
		if(isJustified){
			opt.tiles_type = "justified";
		}
		
		return(opt);
	}

	
	/**
	 * reload the gallery with selected opt
	 */
	function reloadGallery(styleName){
	
		var opt = getOptByStyle(styleName);
		
		if(opt === false)
			return(false);
		
		updateOptsText(opt);
		
		updateHash(styleName);
		
		if(ugapi1 == undefined)
			return(false);
			
		ugapi1.reloadGallery(opt);
		
	}
	
	
	/**
	 * update hash location
	 */
	function updateHash(styleName){
		
		location.hash = styleName;
		
	}
	
	/**
	 * get hash
	 */
	function getHash(){
		var hash = location.hash;
		if(hash == "" || hash == undefined)
			return("");
		
		hash = hash.replace("#", "");
		
		return(hash);
	}
	
	
	/**
	 * check hash on load, and load appropriete style
	 */
	function getOptByHash(){
		
		var hash = getHash();
		if(hash == "")
			return(false);
		
		var opt = getOptByStyle(hash);
		return(opt);
	}
	
	
	/**
	 * update options text
	 */
	function updateOptsText(opt){
		
		var text = "jQuery(\"#gallery\").unitegallery({\n";
		var tab = "	";
		for(key in opt){
			var value = opt[key];
			if(typeof value == "string")
				text += tab + key+": \""+value+"\",\n";
			else
				text += tab + key+":"+value+",\n";
		}
		
		text += "});";
		
		jQuery("#galleryopts").html(text);
	
	}
	
	/**
	 * main onload function
	 */
	function ugModify(){
		
		var buttonsWrapper = jQuery(".effects_buttons_wrapper");
		var objButtons = buttonsWrapper.children("input");
		
		objButtons.click(function(){
			objButtons.removeClass("selected");
			var button = jQuery(this);
			button.addClass("selected");
			var styleName = button.attr("name");
			reloadGallery(styleName);
		});
	}
	
	
	$(document).ready(function() {
		
		ugModify();
		

	});
	
	
