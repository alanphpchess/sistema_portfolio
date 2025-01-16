$(document).ready(function(){
    $("#galeria").unitegallery({
         gallery_theme: "tiles",
         tiles_max_columns: 3,	
         gallery_width:"100%",
         tile_enable_image_effect:true,
         tile_image_effect_type: "blur",
         tile_overlay_color: "#D4C26A",
         tile_overlay_opacity:0.4,
         tile_image_effect_reverse:true,
         tiles_space_between_cols:10,
         tiles_justified_space_between:25,
         tiles_col_width:220,
         tile_enable_shadow:false,
     });
 });