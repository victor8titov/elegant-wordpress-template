<?php

/**
 * Add post types that are used in the theme 
 * 
 * more settings
 * https://wp-kama.ru/function/register_post_type#label-stroka
 * 
 * @return array
 */
function ele_get_post_types() {
    return array(
        // Шаблон
        /*
        'watermalon*' => array(
            'singular' => 'Арбуз',   // название для одной записи этого типа   
            'multiple' => 'Арбузы',  // основное название для типа записи         
            )
            'config' => array(
                // все параметры в сноске *
                'public' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'editor',
                    'thumbnail',
					'excerpt',
                    'comments',
                    'custom-field',
                ),
                'show_in_nav_menus'=> true,
            ),
        ),*/
        'work' => array(
            'singular' => 'Work',   // название для одной записи этого типа   
            'multiple' => 'Works',  // основное название для типа записи         
            
            'config' => array(
                // все параметры в сноске *
                'public' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'editor',
                    'thumbnail',
                    'custom-field',
                ),
                'show_in_nav_menus'=> true,
            ),
        ),
        'project' => array(
            'singular' => 'Project',   // название для одной записи этого типа   
            'multiple' => 'Projects',  // основное название для типа записи         
            
            'config' => array(
                // все параметры в сноске *
                'public' => true,
                'menu_position' => 20,
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'editor',
                    'thumbnail',
                    'custom-field',
                ),
                'show_in_nav_menus'=> true,
            ),
        ),
    );
}

/*
 *  Settning meta data
 * 
 */
add_filter( 'rwmb_meta_boxes', 'ele_meta_boxes' );
function ele_meta_boxes( $meta_boxes ) {
    $prefix = 'ele_';
    $meta_boxes[] = array(
        'id'         => 'info',
        'title'      => 'Additional date',
        'post_types' => 'project',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'id'               => 'images',
                'name'             => 'Image Advanced',
                'type'             => 'image_advanced',
            
                // Delete image from Media Library when remove it from post meta?
                // Note: it might affect other posts if you use same image for multiple posts
                'force_delete'     => false,
                        
                // Image size that displays in the edit page.
                //'image_size'       => 'thumbnail',
            ),
            
        )
    );

    // Add more meta boxes if you want
    // $meta_boxes[] = ...

    return $meta_boxes;
}
?>