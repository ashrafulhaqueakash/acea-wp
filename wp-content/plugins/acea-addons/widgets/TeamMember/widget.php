<?php
namespace Acea_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Acea_Team_Member extends Widget_Base {
	public function get_name() {
		return 'acea-team-member';
	}
	public function get_title() {
		return esc_html__( 'Team Member', 'acea-addons' );
	}
	public function get_icon() {
		return 'feather icon-user-plus';
	}
	public function get_categories() {
		return [ 'acea-addons' ];
	}
	public function get_keywords() {
        return [ 'acea', 'employee', 'staff', 'team', 'member' ];
    }
	protected function register_controls() {
		/**
		* Team Member Content Section
		*/
		$this->start_controls_section(
			'acea_team_content',
			[
				'label' => esc_html__( 'Content', 'acea-addons' )
			]
		);

		$this->add_control(
			'acea_team_member_image',
			[
				'label'   => __( 'Image', 'acea-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'team_member_image_size',
				'default'   => 'medium_large',
				'condition' => [
					'acea_team_member_image[url]!' => ''
				]
			]
		);

		$this->add_control(
			'acea_team_member_mask_shape_position',
			[
				'label'       => __( 'Position', 'acea-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'center',
				'label_block' => true,
				'options'     => [
					'top'     => __( 'Top', 'acea-addons' ),
					'center'  => __( 'Center', 'acea-addons' ),
					'left'    => __( 'Left', 'acea-addons' ),
					'right'   => __( 'Right', 'acea-addons' ),
					'bottom'  => __( 'Bottom', 'acea-addons' ),
					'custom'  => __( 'Custom', 'acea-addons' )
                ],
                'selectors'   => [
					'{{WRAPPER}} .acea-team-member-thumb img' => '-webkit-mask-position: {{VALUE}};'
				],
				'condition' 		   => [
					'acea_team_member_enable_image_mask' => 'yes'
				]
			]
		);

		$this->add_control(
			'acea_team_member_mask_shape_position_x_offset',
			[
				'label'       => __( 'X Offset', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-team-member-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'acea_team_member_enable_image_mask' => 'yes',
                    'acea_team_member_mask_shape_position' => 'custom'
				]
			]
		);

		$this->add_control(
			'acea_team_member_mask_shape_position_y_offset',
			[
				'label'       => __( 'Y Offset', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-team-member-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'acea_team_member_enable_image_mask' => 'yes',
                    'acea_team_member_mask_shape_position' => 'custom'
				]
			]
		);

        $this->add_control(
			'acea_team_member_mask_shape_size',
			[
				'label'       => __( 'Size', 'acea-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'auto',
				'label_block' => true,
				'options'     => [
					'auto'    => __( 'Auto', 'acea-addons' ),
					'contain' => __( 'Contain', 'acea-addons' ),
					'cover'   => __( 'Cover', 'acea-addons' ),
					'custom'  => __( 'Custom', 'acea-addons' )
                ],
                'selectors'   => [
					'{{WRAPPER}} .acea-team-member-thumb img' => '-webkit-mask-size: {{VALUE}};'
				],
				'condition' 		   => [
					'acea_team_member_enable_image_mask' => 'yes'
				]
			]
        );

        $this->add_control(
			'acea_team_member_mask_shape_custome_size',
			[
				'label'       => __( 'Mask Size', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 600
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-team-member-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'acea_team_member_enable_image_mask' => 'yes',
                    'acea_team_member_mask_shape_size' => 'custom'
				]
			]
		);

        $this->add_control(
			'acea_team_member_mask_shape_repeat',
			[
				'label'         => __( 'Repeat', 'acea-addons' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'no-repeat',
				'label_block'   => true,
				'options'       => [
					'no-repeat' => __( 'No repeat', 'acea-addons' ),
					'repeat'    => __( 'Repeat', 'acea-addons' )
                ],
                'selectors'     => [
					'{{WRAPPER}} .acea-team-member-thumb img' => '-webkit-mask-repeat: {{VALUE}};'
				],
				'condition' 	=> [
					'acea_team_member_enable_image_mask' => 'yes'
				]
			]
		);

		$this->add_control(
			'acea_team_member_name',
			[
				'label'       => esc_html__( 'Name', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'John Doe', 'acea-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'acea_team_member_designation',
			[
				'label'       => esc_html__( 'Designation', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Designation', 'acea-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'acea_section_team_members_cta_btn',
			[
				'label'        => __( 'Call To Action', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'acea-addons' ),
				'label_off'    => __( 'OFF', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'acea_team_members_cta_btn_text',
			[
				'label'       => esc_html__( 'Text', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Read More', 'acea-addons' ),
				'condition'   => [
					'acea_section_team_members_cta_btn' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'acea_team_members_cta_btn_link',
			[
				'label'       => esc_html__( 'Link', 'acea-addons' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
				'show_external' => true,
				'condition' => [
					'acea_section_team_members_cta_btn' => 'yes'
				]
			]
		);
		$this->add_control(
			'team_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);
		$this->end_controls_section();
		/*
		* Team member Social profiles section
		*/
		$this->start_controls_section(
			'acea_section_team_member_social_profiles',
			[
				'label' => esc_html__( 'Social Profiles', 'acea-addons' )
			]
		);
		$this->add_control(
			'social_before_text_enable',
			[
				'label'   => esc_html__( 'Display Before Text', 'acea-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'social_before_text',
			[
				'label' => esc_html__( 'Social Before Text', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Follow Me', 'acea-addons' ),
				'placeholder' => esc_html__( 'Type your text here', 'acea-addons' ),
			]
		);
		$this->add_control(
			'acea_team_member_enable_social_profiles',
			[
				'label'   => esc_html__( 'Display Social Profiles?', 'acea-addons' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'social_icon',
			[
				'label'            => __( 'Icon', 'acea-addons' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'default'          => [
					'value'        => 'fab fa-wordpress',
					'library'      => 'fa-brands'
				],
				'recommended'      => [
					'fa-brands'    => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'google-plus',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'stumbleupon',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px'
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss'
					]
				]
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', 'acea-addons' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => 'true'
				],
				'dynamic'     => [
					'active'  => true
				],
				'placeholder' => __( 'https://your-link.com', 'acea-addons' )
			]
		);

		$this->add_control(
			'acea_team_member_social_profile_links',
			[
				'label'       => __( 'Social Icons', 'acea-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'condition'   => [
					'acea_team_member_enable_social_profiles!' => ''
				],
				'default'     => [
					[
						'social_icon' => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'fa-brands'
						],
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-google-plus-g',
							'library' => 'fa-brands',
						]
					]
				],
				'title_field' => '{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, false, true, false, true ) }}}'
			]
		);
		$this->end_controls_section();
		/*
		* Team Members Styling Section
		*/

		/*
		* Team Members Container Style
		*/
		$this->start_controls_section(
			'acea_section_team_members_styles_preset',
			[
				'label' => esc_html__( 'Container', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'acea_team_members_bg_heading',
			[
				'label' => esc_html__( 'Wrap BG', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'acea_team_members_bg',
				'types'    => [ 'classic', 'gradient' ],
				'separator'  => 'after',
				'selector' => '{{WRAPPER}} .acea-team-member'
			]
		);

		$this->add_control(
			'acea_team_members_bg_hover_heading',
			[
				'label' => esc_html__( 'Wrap BG Hover', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'acea_team_members_bg_hover',
				'types'    => [ 'classic', 'gradient' ],
				'separator'  => 'after',
				'selector' => '{{WRAPPER}} .acea-team-member:hover'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'acea_team_members_border',
				'selector' => '{{WRAPPER}} .acea-team-member'
			]
		);

		$this->add_responsive_control(
			'acea_team_members_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_team_members_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_team_members_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'acea_team_members_box_shadow',
				'selector' => '{{WRAPPER}} .acea-team-member',
				'fields_options'         => [
		            'box_shadow_type'    => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'         => [
		                'default'        => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 49,
		                    'spread'     => 0,
		                    'color'      => 'rgba(24, 27, 33, 0.1)'
		                ]
		            ]
	            ]
			]
		);

		$this->end_controls_section();

		/**
		 * For Thumbnail style
		 */

		$this->start_controls_section(
			'acea_section_team_members_image_style',
			[
				'label' => esc_html__( 'Image', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'acea_team_membe_image_position',
            [
                'label'         => esc_html__( 'Image Position', 'acea-addons' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'       => 'acea-position-top',
                'options'       => [
                    'acea-position-left'  => [
                        'title' => esc_html__( 'Left', 'acea-addons' ),
                        'icon'  => 'eicon-arrow-left'
                    ],
                    'acea-position-top'   => [
                        'title' => esc_html__( 'Top', 'acea-addons' ),
                        'icon'  => 'eicon-arrow-up'
                    ],
                    'acea-position-right' => [
                        'title' => esc_html__( 'Right', 'acea-addons' ),
                        'icon'  => 'eicon-arrow-right'
                    ]
                ]
            ]
        );

		  $this->start_controls_tabs(
			'image_style_tabs'
		);
		
		$this->start_controls_tab(
			'image_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'plugin-name' ),
			]
		);

		$this->add_control(
			'acea_section_team_members_thumbnail_box',
			[
				'label'        => __( 'Image Box', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'acea-addons' ),
				'label_off'    => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
            'acea_section_team_members_thumbnail_box_height',
            [
                'label'      => __( 'Height', 'acea-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 100
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-team-member-thumb'=> 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'acea_section_team_members_thumbnail_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'acea_section_team_members_thumbnail_box_width',
            [
                'label'      => __( 'Width', 'acea-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 100
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-team-member-thumb'=> 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'acea_section_team_members_thumbnail_box' => 'yes'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'acea_section_team_members_thumbnail_box_border',
				'selector'  => '{{WRAPPER}} .acea-team-member-thumb',
				'condition' => [
					'acea_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'acea_section_team_members_thumbnail_box_radius',
			[
				'label'      => __( 'Border radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acea-team-member-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_section_team_members_thumbnail_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_section_team_members_thumbnail_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_section_team_members_thumbnail_box_margin_top',
			[
				'label'      => __( 'Top Spacing', 'acea-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'unit'   => 'px',
					'size'   => 0
				],
				'range'        => [
                    'px'       => [
                        'min'  => -300,
                        'max'  => 300,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => -50,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-thumb' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'acea_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'acea_section_team_members_thumbnail_box_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', 'acea-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'unit'   => 'px',
					'size'   => 0
				],
				'range'        => [
                    'px'       => [
                        'min'  => -300,
                        'max'  => 300,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => -50,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'acea_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'acea_section_team_members_thumbnail_box_shadow',
				'selector'  => '{{WRAPPER}} .acea-team-member-thumb',
				'condition' => [
					'acea_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'acea_section_team_members_thumbnail_css_filter',
				'selector' => '{{WRAPPER}} .acea-team-member-thumb img',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'image_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'plugin-name' ),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_hover_border',
				'selector'  => '{{WRAPPER}} .acea-team-member-thumb img:hover',
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/*
		* Team Members Content Style
		*/
		$this->start_controls_section(
			'acea_section_team_members_content_style',
			[
				'label' => esc_html__( 'Content', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .acea-position-left .acea-team-member-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'acea_team_member_content_alignment',
			[
				'label'   => __( 'Alignment', 'acea-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'acea-left'   => [
						'title'   => __( 'Left', 'acea-addons' ),
						'icon'    => 'eicon-text-align-left'
					],
					'acea-center' => [
						'title'   => __( 'Center', 'acea-addons' ),
						'icon'    => 'eicon-text-align-center'
					],
					'acea-right'  => [
						'title'   => __( 'Right', 'acea-addons' ),
						'icon'    => 'eicon-text-align-right'
					]
				],
				'default' => 'acea-center'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'acea_team_members_content_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .acea-team-member-content'
			]
		);

		$this->add_responsive_control(
			'acea_section_team_members_content_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_section_team_members_content_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_team_member_content_border_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'acea_section_team_members_content_box_shadow',
				'selector' => '{{WRAPPER}} .acea-team-member-content'
			]
		);

		$this->end_controls_section();

		/*
		* Name style
		*/
		$this->start_controls_section(
            'section_team_carousel_name',
            [
				'label' => __('Name', 'acea-addons'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'acea_team_name_color',
            [
				'label'     => __('Color', 'acea-addons'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
                    '{{WRAPPER}} .acea-team-member-name' => 'color: {{VALUE}};'
                ]
            ]
        );

		//new code
		$this->add_control(
			'acea_team_name_color_hover',
			[
				'label'     => esc_html__( 'Name Hover Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .acea-team-item:hover .acea-team-member-name' => 'color: {{VALUE}};'
				]
			]
		);
		//new code

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'acea_team_name_typography',
				'selector' => '{{WRAPPER}} .acea-team-member-name'
            ]
		);

		$this->add_responsive_control(
			'acea_team_members_name_margin',
			[
				'label'        => __( 'Margin', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Designation Style
		 */
        $this->start_controls_section(
            'section_team_member_designation',
            [
				'label' => __('Designation', 'acea-addons'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'acea_team_designation_color',
            [
				'label'     => __('Color', 'acea-addons'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
                    '{{WRAPPER}} .acea-team-member-designation' => 'color: {{VALUE}};'
                ]
            ]
        );
			//new code
			$this->add_control(
				'acea_team_designation_color_hover',
				[
					'label'     => esc_html__( 'Designation Hover Color', 'acea-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .acea-team-item:hover .acea-team-member-designation' => 'color: {{VALUE}};'
					]
				]
			);
			//new code

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'acea_team_designation_typography',
				'selector' => '{{WRAPPER}} .acea-team-member-designation'
            ]
		);

		$this->add_responsive_control(
			'acea_team_members_designation_margin',
			[
				'label'        => __( 'Margin', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_team_members_designation_padding',
			[
				'label'        => __( 'Padding', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '11',
					'right'    => '20',
					'bottom'   => '11',
					'left'     => '20',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-team-member-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);





		$this->add_responsive_control(
			'acea_team_members_designation_border_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-designation' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'acea_team_members_designation_border',
				'selector' => '{{WRAPPER}} .acea-team-member-designation',
			]
		);


		$this->end_controls_section();

		/**
		 * Call to action Style
		 */
        $this->start_controls_section(
            'acea_team_member_cta_btn_style',
            [
				'label'     => __('Call To Action', 'acea-addons'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'acea_section_team_members_cta_btn' => 'yes'
				]
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_team_member_cta_btn_typography',
				'selector' => '{{WRAPPER}} .acea-team-member-cta'
			]
		);

		$this->add_responsive_control(
			'acea_team_member_cta_btn_margin',
			[
				'label'        => __( 'Margin', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-team-member-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_team_member_cta_btn_padding',
			[
				'label'        => __( 'Padding', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-team-member-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_team_member_cta_btn_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'acea_team_member_cta_btn_tabs' );

			$this->start_controls_tab( 'acea_team_member_cta_btn_tab_normal', [ 'label' => esc_html__( 'Normal', 'acea-addons' ) ] );

				$this->add_control(
					'acea_team_member_cta_btn_text_color_normal',
					[
						'label'     => esc_html__( 'Text Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .acea-team-member-cta' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_team_member_cta_btn_background_normal',
					[
						'label'     => esc_html__( 'Background Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .acea-team-member-cta' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'acea_team_member_cta_btn_border_normal',
						'selector' => '{{WRAPPER}} .acea-team-member-cta'
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'acea_team_member_cta_btn_tab_hover', [ 'label' => esc_html__( 'Hover', 'acea-addons' ) ] );

				$this->add_control(
					'acea_team_member_cta_btn_text_color_hover',
					[
						'label'     => esc_html__( 'Text Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .acea-team-member-cta:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_team_member_cta_btn_background_hover',
					[
						'label'     => esc_html__( 'Background Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .acea-team-member-cta:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'acea_team_member_cta_btn_border_hover',
						'selector' => '{{WRAPPER}} .acea-team-member-cta:hover'
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_control(
			'team_icon_options',
			[
				'label' => esc_html__( 'Icon Options', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_gap',
			[
				'label' => esc_html__( 'Icon Gap', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} span.team_btn_iocn svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_svg_top_gap',
			[
				'label' => esc_html__( 'Svg Top Gap', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} span.team_btn_iocn svg' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * Social icons style
		 */
        $this->start_controls_section(
            'acea_team_member_social_section',
            [
				'label'     => __('Social Icons', 'acea-addons'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'acea_team_member_enable_social_profiles!' => ''
				]
            ]
		);


		$this->add_responsive_control(
			'acea_team_members_social_icon_size',
			[
				'label'        => __( 'Size', 'acea-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px' ],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 14
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-team-member-social li a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .acea-team-member-social li a svg' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'acea_team_member_social_border_wrap',
				'selector' => '{{WRAPPER}} .acea-team-member-social',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'acea_team_member_social_border',
				'selector' => '{{WRAPPER}} .acea-team-member-social li',
			]
		);

		$this->add_responsive_control(
			'acea_team_member_social_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-social li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_team_members_social_box_radius',
			[
				'label'      => __( 'Border radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-social li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_team_member_social_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .acea-team-member-social li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'acea_team_members_social_icons_style_tabs' );

			$this->start_controls_tab( 'acea_team_members_social_icon_tab', [ 'label' => esc_html__( 'Normal', 'acea-addons' ) ] );

				$this->add_control(
					'acea_team_carousel_social_icon_color_normal',
					[
						'label'     => esc_html__( 'Icon Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#a4a7aa',
						'selectors' => [
							'{{WRAPPER}} .acea-team-member-social li a i' => 'color: {{VALUE}};',
							'{{WRAPPER}} .acea-team-member-social li a svg path' => 'fill: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_team_carousel_social_bg_color_normal',
					[
						'label'     => esc_html__( 'Background Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .acea-team-member-social' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_team_carousel_social_bg_color_hover',
					[
						'label'     => esc_html__( 'Background Hover Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .acea-team-item:hover .acea-team-member-social' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'acea_team_carousel_social_border_normal',
						'selector' => '{{WRAPPER}} .acea-team-member-social li a'
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'acea_team_members_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'acea-addons' ) ] );

				$this->add_control(
					'acea_team_carousel_social_icon_color_hover',
					[
						'label'     => esc_html__( 'Icon Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#8a8d91',
						'selectors' => [
							'{{WRAPPER}} .acea-team-member-social li a:hover i' => 'color: {{VALUE}};',
							'{{WRAPPER}} .acea-team-member-social li a:hover svg path' => 'fill: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_team_carousel_social_bg_color_hover',
					[
						'label'     => esc_html__( 'Background Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .acea-team-member-social li a:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'acea_team_carousel_social_border_hover',
						'selector' => '{{WRAPPER}} .acea-team-member-social li a:hover'
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}
	private function team_member_cta() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'acea_team_members_cta_btn_text', 'class', 'acea-team-cta-button-text' );
		$this->add_inline_editing_attributes( 'acea_team_members_cta_btn_text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'acea_team_members_cta_btn_text' ); ?>>
			<?php echo esc_html( $settings['acea_team_members_cta_btn_text'] );?>
		</span>
		<?php
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$social_before_text_enable = $settings['social_before_text_enable'] ?? '';
		$social_before_text = $settings['social_before_text'] ?? '';
		$this->add_render_attribute( 'acea_team_member_name', 'class', 'acea-team-member-name' );
		$this->add_inline_editing_attributes( 'acea_team_member_name', 'basic' );
		$this->add_render_attribute( 'acea_team_member_designation', 'class', 'acea-team-member-designation' );
		$this->add_inline_editing_attributes( 'acea_team_member_designation', 'basic' );
		$this->add_render_attribute( 'acea_team_member_item', [
            'class' => [
                'acea-team-member',
                esc_attr( $settings['acea_team_member_content_alignment'] ),
                esc_attr( $settings['acea_team_membe_image_position'] )
            ]
        ]);
		$this->add_render_attribute( 'acea_team_members_cta_btn_link', 'class', 'acea-team-member-cta' );
		if( isset( $settings['acea_team_members_cta_btn_link']['url'] ) ) {
            $this->add_render_attribute( 'acea_team_members_cta_btn_link', 'href', esc_url( $settings['acea_team_members_cta_btn_link']['url'] ) );
	        if( $settings['acea_team_members_cta_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'acea_team_members_cta_btn_link', 'target', '_blank' );
	        }
	        if( $settings['acea_team_members_cta_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'acea_team_members_cta_btn_link', 'rel', 'nofollow' );
	        }
        }

		?>

		<div class="acea-team-item">
			<div <?php echo $this->get_render_attribute_string( 'acea_team_member_item' ); ?>>
				<?php do_action('acea_team_member_wrapper_before'); ?>
				<?php
					if ( $settings['acea_team_member_image']['url'] || $settings['acea_team_member_image']['id'] ) { ?>
						<div class="acea-team-member-thumb">
							<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'team_member_image_size', 'acea_team_member_image' ); ?>
						</div>
					<?php
					}
				?>

				<div class="acea-team-member-content">
					<?php do_action('acea_team_member_content_area_before'); ?>
					<?php if ( !empty( $settings['acea_team_member_name'] ) ) : ?>
						<h2 <?php echo $this->get_render_attribute_string( 'acea_team_member_name' ); ?>><?php echo wp_kses_post( $settings['acea_team_member_name'] ); ?></h2>
					<?php endif; ?>

					<?php if ( !empty( $settings['acea_team_member_designation'] ) ) : ?>
						<span <?php echo $this->get_render_attribute_string( 'acea_team_member_designation' ); ?>><?php echo wp_kses_post ( $settings['acea_team_member_designation'] ); ?></span>
					<?php endif; ?>

					<?php if ( 'yes' === $settings['acea_section_team_members_cta_btn'] && !empty( $settings['acea_team_members_cta_btn_text'] ) ) : ?>
						<a <?php echo $this->get_render_attribute_string( 'acea_team_members_cta_btn_link' ); ?>>
							<?php echo $this->team_member_cta(); ?>
							<span class="team_btn_iocn" >
							<?php \Elementor\Icons_Manager::render_icon( $settings['team_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						</a>
					<?php
					endif;

					do_action('acea_team_member_content_area_after'); ?>

				</div>
				<?php	if ( 'yes' === $settings['acea_team_member_enable_social_profiles'] ) : ?>
						<ul class="list-inline acea-team-member-social">
							<?php
								if (!empty($social_before_text) && 'yes' == $social_before_text_enable ){
									echo '<li class="before-text">' . $social_before_text . '</li>';
								}
							?>
							<?php
							foreach ( $settings['acea_team_member_social_profile_links'] as $index => $item ) :
								$social   = '';
								$link_key = 'link_' . $index;

								if ( 'svg' !== $item['social_icon']['library'] ) {
									$social = explode( ' ', $item['social_icon']['value'], 2 );
									if ( empty( $social[1] ) ) {
										$social = '';
									} else {
										$social = str_replace( 'fa-', '', $social[1] );
									}
								}
								if ( 'svg' === $item['social_icon']['library'] ) {
									$social = '';
								}

								if( $item['link']['url'] ) {
									$this->add_render_attribute( $link_key, 'href', esc_url( $item['link']['url'] ) );
									if( $item['link']['is_external'] ) {
										$this->add_render_attribute( $link_key, 'target', '_blank' );
									}
									if( $item['link']['nofollow'] ) {
										$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
									}
								}

								$this->add_render_attribute( $link_key, 'class', [
									'acea-social-icon',
									'elementor-repeater-item-' . $item['_id'],
								] );
								?>
								<li>
									<a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
										<?php Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php
					endif;
					?>
				<?php do_action('acea_team_member_wrapper_after'); ?>
			</div>
		</div>
		<?php
	}
}
$widgets_manager->register_widget_type( new \Acea_Addons\Widgets\Acea_Team_Member() );