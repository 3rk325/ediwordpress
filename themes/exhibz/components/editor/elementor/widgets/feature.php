<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Exhibz_Feature_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'exhibz-feature';
    }

    public function get_title() {
        return esc_html__( 'Feature', 'exhibz' );
    }

    public function get_icon() { 
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'exhibz-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Exhibz Featured Box', 'exhibz'),
            ]
		);
      $this->add_control(
			'feature_style',
			[
				'label' => esc_html__( 'Feature Style', 'exhibz' ),
				'type' => Custom_Controls_Manager::IMAGECHOOSE,
				'default' => 'square_feature',
				'options' => [
                    'square_feature' => [
					    'title' => esc_html__( 'Square feature', 'exhibz' ),
                        'imagelarge' => EXHIBZ_IMG. '/style/features/feature1.png',
                        'imagesmall' => EXHIBZ_IMG. '/style/features/feature1.png',
                        'width' => '30%',
					],
              		'circle_feature' => [
						'title' => esc_html__( 'Circle feature', 'exhibz' ),
                        'imagelarge' => EXHIBZ_IMG. '/style/features/feature2.png',
                        'imagesmall' => EXHIBZ_IMG. '/style/features/feature2.png',
                        'width' => '30%',
					],
					'info_feature' => [
						'title' => esc_html__( 'Info feature', 'exhibz' ),
                        'imagelarge' => EXHIBZ_IMG. '/style/features/feature3.png',
                        'imagesmall' => EXHIBZ_IMG. '/style/features/feature3.png',
                        'width' => '30%',
					],
			
				],
			]
        );
		$this->add_control(
			'sl_number', [
				'label'			=> esc_html__( 'Serial Number', 'exhibz' ),
				'type'			=> Controls_Manager::NUMBER,
				'label_block'	=> true,
             'default'	    => 1,
             'condition' => [
               'feature_style' => ['square_feature'],
           	]
           
			]
		);

        $this->add_control(
			'title', [
				'label'			=> esc_html__( 'Title', 'exhibz' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'Great Speakers', 'exhibz' ),
				'default'	    => esc_html__( 'Great Speakers', 'exhibz' ),
			]
		);

        $this->add_control(
			'desc', [
			'label'			=> esc_html__( 'Content', 'exhibz' ),
			'type'			=> Controls_Manager::TEXTAREA,
			'label_block'	=> true,
			'placeholder'	=> esc_html__( 'How you transform your business', 'exhibz' ),
            'default'       => esc_html__( 'How you transform your business as technology, consumer, habits industry dynamic', 'exhibz' ),
            'condition'     => [
			        'feature_style' => ['square_feature', 'info_feature'],
           	]
			]
		);
		
		$this->add_control(
			'icon',
			[
				'label' =>esc_html__( 'Icon', 'exhibz' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'icon icon-speaker',
			]
		);

		$this->add_control(
            'image',
            [
                'label'   => esc_html__( 'Image', 'exhibz' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'condition'	 => [
					'use' => 'image',
				],
            ]
        );
        
        $this->add_responsive_control('title_align', 
          [
				'label'			 => esc_html__( 'Alignment', 'exhibz' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 => esc_html__( 'Left', 'exhibz' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 => esc_html__( 'Center', 'exhibz' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 => esc_html__( 'Right', 'exhibz' ),
						'icon'	 => 'fa fa-align-right',
					],
					'justify'	 => [
						'title'	 => esc_html__( 'Justified', 'exhibz' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => 'left',
                'selectors' => [
                    '{{WRAPPER}} .single-intro-text' => 'text-align: {{VALUE}};',
				],
			]
        );//Responsive control end
        $this->end_controls_section();

      //Title Style Section
      $this->start_controls_section(
			'section_background_style', [
				'label'	 => esc_html__( 'Background Color', 'exhibz' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			]
        );
       
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'circle_background',
				'label' => esc_html__( 'Background', 'exhibz' ),
				'types' => [  'gradient' ],
				'selector' => '{{WRAPPER}} .ts-single-outcome',
			]
		);
      $this->end_controls_section();

		$this->start_controls_section(
			'section_sl_number_style', [
				'label'	 => esc_html__( '#SL Number', 'exhibz' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'sl_color', [
				'label'		 => esc_html__( 'Number color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text .count-number' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'sl_bg_color', [
				'label'		 => esc_html__( 'Number Background color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text .count-number' => 'background: {{VALUE}};',
				],
			]
        );
		$this->end_controls_section();
       
		$this->start_controls_section(
			'section_sub_title_style', [
				'label'	 => esc_html__( 'Title', 'exhibz' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'title_color', [
				'label'		 => esc_html__( 'Title color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text h3' => 'color: {{VALUE}};',
				],
			]
		);

        
        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .single-intro-text h3',
			]
		);

        $this->end_controls_section();
        
        //Content Style Section
      $this->start_controls_section('section_content_style',
         [
				'label'	 => esc_html__( 'Content', 'exhibz' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'feature_content_color', [
				'label'		 => esc_html__( 'Content color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text p' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			 'name'		 => 'feature_content_typography',
			 'selector'	 => '{{WRAPPER}} .single-intro-text p',
			]
		);

		$this->end_controls_section();

		//Icon Style Section
      $this->start_controls_section('section_icon_style',
         [
				'label'	 => esc_html__( 'Icon', 'exhibz' ),
				'tab'	   => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control('icon_color', 
          [
				'label'		 => esc_html__( 'Icon color', 'exhibz' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text i' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'icon_typography',
			'selector'	 => '{{WRAPPER}} .single-intro-text i',
			]
		);
		$this->end_controls_section();

		
    

    } //Register control end

    protected function render( ) { 
      $settings  = $this->get_settings();
      $style     = $settings["feature_style"];
     	$icon      = $settings["icon"];
		$title     = $settings["title"];
		$desc      = $settings["desc"];
		$sl_number = $settings["sl_number"];
    ?>
 
    <?php if($style=='square_feature'): ?>
		<div class="single-intro-text mb-70">
			<i class="<?php echo esc_attr($icon); ?>"></i>
			<h3 class="ts-title"><?php echo esc_html($title); ?></h3>
			<p>
		   	<?php echo exhibz_kses($desc); ?>
			</p>
			<span class="count-number"><?php echo esc_html($sl_number); ?></span>
		</div><!-- single intro text end-->
    <?php endif; ?>

    <?php if($style=='circle_feature'): ?>
		<div class="ts-single-outcome">
			<i class="<?php echo esc_attr($icon); ?>"></i>
			<h3 class="ts-title"><?php echo esc_html($title); ?></h3>
		</div>
    <?php endif; ?>

	<?php if($style=='info_feature'): ?>
		<div class="single-intro-text single-contact-feature">
			<h3 class="ts-title"><?php echo esc_html($title); ?></h3>
			<p>
				<?php echo exhibz_kses($desc); ?>
			</p>
			<span class="count-number <?php echo esc_attr($icon); ?>">
				
			</span>
		</div>
    <?php endif; ?>
    
    <?php  
    }
    protected function _content_template() { }
}