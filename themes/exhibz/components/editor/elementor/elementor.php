<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if(defined('ELEMENTOR_VERSION')):

include_once EXHIBZ_EDITOR . '/elementor/manager/controls.php';

class EXHIBZ_Shortcode{

	/**
     * Holds the class object.
     *
     * @since 1.0
     *
     */
    public static $_instance;
    

    /**
     * Localize data array
     *
     * @var array
     */
    public $localize_data = array();

	/**
     * Load Construct
     * 
     * @since 1.0
     */

	public function __construct(){

		add_action('elementor/init', array($this, 'EXHIBZ_elementor_init'));
        add_action('elementor/controls/controls_registered', array( $this, 'exhibz_icon_pack' ), 11 );
        add_action('elementor/controls/controls_registered', array( $this, 'control_image_choose' ), 13 );
        add_action('elementor/controls/controls_registered', array( $this, 'EXHIBZ_ajax_select2' ), 13 );
        add_action('elementor/widgets/widgets_registered', array($this, 'EXHIBZ_shortcode_elements'));
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_enqueue_styles' ) );
        add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_enqueue_scripts' ) );
        
	}


    /**
     * Enqueue Scripts
     *
     * @return void  
     */ 
    
     public function enqueue_scripts() {
         wp_enqueue_script( 'exhibz-main-elementor', EXHIBZ_JS  . '/elementor.js',array( 'jquery', 'elementor-frontend' ), EXHIBZ_VERSION, true );
    }

    /**
     * Enqueue editor styles
     *
     * @return void
     */

    public function editor_enqueue_styles() {
        wp_enqueue_style( 'exhibz-panel', EXHIBZ_CSS.'/panel.css',null, EXHIBZ_VERSION );
        wp_enqueue_style( 'exhibz-icon-elementor', EXHIBZ_CSS.'/icofonts.css',null, EXHIBZ_VERSION );

    }

    /**
     * Preview Enqueue Scripts
     *
     * @return void
     */

    public function preview_enqueue_scripts() {}
	/**
     * Elementor Initialization
     *
     * @since 1.0
     *
     */

    public function EXHIBZ_elementor_init(){
    
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'exhibz-elements',
            [
                'title' =>esc_html__( 'EXHIBZ', 'exhibz' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
    }

    /**
     * Extend Icon pack core controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */ 

    public function EXHIBZ_icon_pack( $controls_manager ) {

        require_once EXHIBZ_EDITOR_ELEMENTOR. '/controls/icon.php';

        $controls = array(
            $controls_manager::ICON => 'EXHIBZ_Icon_Controler',
        );

        foreach ( $controls as $control_id => $class_name ) {
            $controls_manager->unregister_control( $control_id );
            $controls_manager->register_control( $control_id, new $class_name() );
        }

    }
    // registering ajax select 2 control
    public function EXHIBZ_ajax_select2( $controls_manager ) {
        require_once EXHIBZ_EDITOR_ELEMENTOR. '/controls/select2.php';
        $controls_manager->register_control( 'ajaxselect2', new \Control_Ajax_Select2() );
    }
    
    // registering image choose
    public function control_image_choose( $controls_manager ) {
        require_once EXHIBZ_EDITOR_ELEMENTOR. '/controls/choose.php';
        $controls_manager->register_control( 'imagechoose', new \Control_Image_Choose() );
    }

    public function EXHIBZ_shortcode_elements($widgets_manager){

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/call-to-action.php';
        $widgets_manager->register_widget_type(new Elementor\EXHIBZ_Call_To_Action_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/title.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Title_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/feature.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Feature_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/speaker.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Speaker_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/schedule.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Schedule_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/countdown.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Countdown_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/pricing.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Pricing_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/latestnew.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_Latestnews_Widget());

        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/owlslider.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_OwlSlider_Widget());
        require_once EXHIBZ_EDITOR_ELEMENTOR.'/widgets/date.php';
        $widgets_manager->register_widget_type(new Elementor\Exhibz_date_Widget());
        
    
    }
    
	public static function EXHIBZ_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new EXHIBZ_Shortcode();
        }
        return self::$_instance;
    }

}
$EXHIBZ_Shortcode = EXHIBZ_Shortcode::EXHIBZ_get_instance();

endif;