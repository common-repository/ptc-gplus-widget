<?php
/*
Plugin Name: PTC GPLUS Widget
Plugin URI: https://wordpress.org/plugins/ptc-gplus-widget/
Description: PTC GPLUS Widget - is the common way to display your google plus profile or business on your website. With our PTC GPLUS Widget you can do more.
Author: vivan jakes 
Version: 1.0
Author URI: https://wordpress.org/support/profile/personaltrainercertification
*/
class ptcgpluswgt_RealGooglebadgeSlider{
    
    public $options;
    
    public function __construct() {
        //you can run delete_option method to reset all data
        //delete_option('ptcgpluswgt_real_google_plugin_options');
        $this->options = get_option('ptcgpluswgt_real_google_plugin_options');
        $this->ptcgpluswgt_real_google_register_settings_and_fields();
    }
    
    public function ptcgpluswgt_add_real_fb_tools_options_page(){
        add_options_page('PTC GPLUS Widget', 'PTC GPLUS Widget', 'administrator', __FILE__, array('ptcgpluswgt_RealGooglebadgeSlider','ptcgpluswgt_real_google_tools_options'));
    }
    
    public function ptcgpluswgt_real_google_tools_options(){
?>
<div class="wrap">
    <h2>PTC GPLUS Widget</h2>
    <form method="post" action="options.php" enctype="multipart/form-data">
        <?php settings_fields('ptcgpluswgt_real_google_plugin_options'); ?>
        <?php do_settings_sections(__FILE__); ?>
        <p class="submit">
            <input name="submit" type="submit" class="button-primary" value="Save Changes"/>
        </p>
    </form>
</div>
<?php
    }
    public function ptcgpluswgt_real_google_register_settings_and_fields(){
        register_setting('ptcgpluswgt_real_google_plugin_options', 'ptcgpluswgt_real_google_plugin_options',array($this,'ptcgpluswgt_real_google_validate_settings'));
        add_settings_section('ptcgpluswgt_real_google_main_section', 'Settings', array($this,'ptcgpluswgt_real_google_main_section_cb'), __FILE__);
        //Start Creating Fields and Options
        //marginTop
        add_settings_field('marginTop', 'Margin Top', array($this,'ptcgpluswgt_marginTop_settings'), __FILE__,'ptcgpluswgt_real_google_main_section');
        //pageURL
        add_settings_field('pageURL', 'Google Pofile ID', array($this,'ptcgpluswgt_pageURL_settings'), __FILE__,'ptcgpluswgt_real_google_main_section');
        //width
        add_settings_field('width', 'Width', array($this,'ptcgpluswgt_width_settings'), __FILE__,'ptcgpluswgt_real_google_main_section');
        //height
        add_settings_field('height', 'Height', array($this,'ptcgpluswgt_height_settings'), __FILE__,'ptcgpluswgt_real_google_main_section');
        //streams options
        add_settings_field('layout', 'Layout', array($this,'ptcgpluswgt_streams_settings'),__FILE__,'ptcgpluswgt_real_google_main_section');
        //color_scheme options
        add_settings_field('color_scheme', 'Cover Theme', array($this,'ptcgpluswgt_color_scheme_settings'),__FILE__,'ptcgpluswgt_real_google_main_section');
        //show_faces options
        add_settings_field('showcover', 'Cover Photo', array($this,'ptcgpluswgt_show_faces_settings'),__FILE__,'ptcgpluswgt_real_google_main_section');
         
        //alignment option
         add_settings_field('alignment', 'Alignment Position', array($this,'ptcgpluswgt_position_settings'),__FILE__,'ptcgpluswgt_real_google_main_section');
        //jQuery options
        
    }
    public function ptcgpluswgt_real_google_validate_settings($plugin_options){
        return($plugin_options);
    }
    public function ptcgpluswgt_real_google_main_section_cb(){
        //optional
    }

    //marginTop_settings
    public function ptcgpluswgt_marginTop_settings() {
        if(empty($this->options['marginTop'])) $this->options['marginTop'] = "100";
        echo "<input name='ptcgpluswgt_real_google_plugin_options[marginTop]' type='text' value='{$this->options['marginTop']}' />";
    }
    //pageURL_settings
    public function ptcgpluswgt_pageURL_settings() {
        if(empty($this->options['pageURL'])) $this->options['pageURL'] = "";
        echo "<input name='ptcgpluswgt_real_google_plugin_options[pageURL]' type='text' value='{$this->options['pageURL']}' />";
    }
   
    //width_settings
    public function ptcgpluswgt_width_settings() {
        if(empty($this->options['width'])) $this->options['width'] = "300";
        echo "<input name='ptcgpluswgt_real_google_plugin_options[width]' type='text' value='{$this->options['width']}' />";
    }
    //height_settings
    public function ptcgpluswgt_height_settings() {
        if(empty($this->options['height'])) $this->options['height'] = "345";
        echo "<input name='ptcgpluswgt_real_google_plugin_options[height]' type='text' value='{$this->options['height']}' />";
    }
    //layout_settings
    public function ptcgpluswgt_streams_settings(){
        if(empty($this->options['layout'])) $this->options['layout'] = "portrait";
        $items = array('portrait','landscape');
        echo "<select name='ptcgpluswgt_real_google_plugin_options[layout]'>";
        foreach($items as $item){
            $selected = ($this->options['layout'] === $item) ? 'selected = "selected"' : '';
            echo "<option value='$item' $selected>$item</option>";
        }
        echo "</select>";
    }
    //color_scheme_settings
    public function ptcgpluswgt_color_scheme_settings(){
        if(empty($this->options['color_scheme'])) $this->options['color_scheme'] = "light";
        $items = array('light','dark');
        echo "<select name='ptcgpluswgt_real_google_plugin_options[color_scheme]'>";
        foreach($items as $item){
            $selected = ($this->options['color_scheme'] === $item) ? 'selected = "selected"' : '';
            echo "<option value='$item' $selected>$item</option>";
        }
        echo "</select>";
    }
    //showcover_settings
    public function ptcgpluswgt_show_faces_settings(){
        if(empty($this->options['showcover'])) $this->options['showcover'] = "true";
        $items = array('true','false');
        echo "<select name='ptcgpluswgt_real_google_plugin_options[showcover]'>";
        foreach($items as $item){
            $selected = ($this->options['showcover'] === $item) ? 'selected = "selected"' : '';
            echo "<option value='$item' $selected>$item</option>";
        }
        echo "</select>";
    }
    
      //alignment_settings
    public function ptcgpluswgt_position_settings(){
        if(empty($this->options['alignment'])) $this->options['alignment'] = "left";
        $items = array('left','right');
        echo "<select name='ptcgpluswgt_real_google_plugin_options[alignment]'>";
        foreach($items as $item){
            $selected = ($this->options['alignment'] === $item) ? 'selected = "selected"' : '';
            echo "<option value='$item' $selected>$item</option>";
        }
        echo "</select>";
    }
    // put jQuery settings before here
}
add_action('admin_menu', 'ptcgpluswgt_real_google_trigger_options_function');

function ptcgpluswgt_real_google_trigger_options_function(){
    ptcgpluswgt_RealGooglebadgeSlider::ptcgpluswgt_add_real_fb_tools_options_page();
}

add_action('admin_init','ptcgpluswgt_real_google_trigger_create_object');
function ptcgpluswgt_real_google_trigger_create_object(){
    new ptcgpluswgt_RealGooglebadgeSlider();
}
add_action('wp_footer','ptcgpluswgt_real_google_add_content_in_footer');
function ptcgpluswgt_real_google_add_content_in_footer(){
    
    $o = get_option('ptcgpluswgt_real_google_plugin_options');
    extract($o);
$print_google = '';
if($pageURL == ''){
$print_google.='<div class="error_kudos">Please Fill Out The PTC GPLUS Widget Configuration First</div>';	
} else {
$print_google .= '<div class="g-person" data-href="//plus.google.com/u/0/'.$pageURL.'" 
data-theme="'.$color_scheme.'" data-showcoverphoto="'.$showcover.'" data-layout="'.$streams.'"  data-rel="author"></div>';}
$sidebarImgURL = plugins_url( 'assets/google-icon2.png', __FILE__ );
 ?>
<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('#gbox1').click(function(){
	 jQuery(this).parent().toggleClass('gbox_p');
});
});
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<?php if($alignment=='left'){?>
<style>
#gbox1{
transition: all 0.5s ease-in-out 0s;
left: -<?php echo trim($width+10);?>px; top: <?php echo $marginTop;?>px; z-index: 10000; height:<?php echo trim($height+30);?>px;
}
#gbox2{
 text-align: left;width:<?php echo trim($width);?>px;height:<?php echo trim($height);?>;	
}
#gbox2 img{
	top: 0px;right:-50px;
}
.gbox_p #gbox1{
	left:0px;
}
</style>
<div id="real_google_display">
    <div id="gbox1">
        <div id="gbox2">
            <a class="open" id="fblink" href="#"></a><img src="<?php echo $sidebarImgURL;?>" alt="">
            <?php echo $print_google; ?>
        </div>
        <div style="font-size: 9px; color: #808080; font-weight: normal; font-family: tahoma,verdana,arial,sans-serif; line-height: 1.28; text-align: left; direction: ltr;padding:3px 0px 0px; position:absolute;bottom:0px;left:0px;"><a href="https://www.nationalcprassociation.com/faqs/" target="_blank" style="color: #808080;">FAQs</a></div>
    </div>
</div>
<?php } else { ?>
<style>
#gbox1{
transition: all 0.5s ease-in-out 0s;
right: -<?php echo trim($width+10);?>px;
top: <?php echo $marginTop;?>px; 
z-index: 10000;
height:<?php echo trim($height+30);?>px;	
}
#gbox2{
	text-align: left;width:<?php echo trim($width);?>px;height:<?php echo trim($height);?>;
}
#gbox2 img{
	top: 0px;left:-50px;
}
.gbox_p #gbox1{
	right:0px;
}
</style>
<div id="real_google_display">
    <div id="gbox1">
        <div id="gbox2">
            <a class="open" id="fblink" href="#"></a>
            <img src="<?php echo $sidebarImgURL;?>" alt="">
            <?php echo $print_google; ?>
        </div>
        <div style="font-size: 9px; color: #808080; font-weight: normal; font-family: tahoma,verdana,arial,sans-serif; line-height: 1.28; text-align: right; direction: ltr;padding:3px 0px 0px; position:absolute;bottom:0px;right:0px;"><a href="https://www.nationalcprassociation.com/faqs/" target="_blank" style="color: #808080;">FAQs</a></div>
    </div>
</div>

<?php } ?>
<?php
}
add_action( 'wp_enqueue_scripts', 'ptcgpluswgt_register_real_google_badge_slider_styles' );
 function ptcgpluswgt_register_real_google_badge_slider_styles() {
    wp_register_style( 'ptcgpluswgt_real_google_badge_slider_style', plugins_url( 'assets/ptcgplus.css' , __FILE__ ) );
    wp_enqueue_style( 'ptcgpluswgt_real_google_badge_slider_style' );
    wp_enqueue_script('jquery');
 }
$ptcgpluswgt_real_google_default_values = array(
  
     'marginTop' => 100,
     'GoogleID' => '',
     'width' => '292',
     'height' => '345',
     'layout' => 'portrait',
     'cover_theme' => 'light',
	 'cover_photo' => 'true',
     'alignment' => 'left'
  
 );
add_option('ptcgpluswgt_real_google_plugin_options', $ptcgpluswgt_real_google_default_values);