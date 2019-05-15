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
        'people' => array(
            'singular' => 'People',   // название для одной записи этого типа   
            'multiple' => 'Peoples',  // основное название для типа записи         
            
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
    /*      PROJECT      */
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
    /*      WORKS        */
    $meta_boxes[] = array(
        'id'         => 'info',
        'title'      => 'Additional date',
        'post_types' => 'work',
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

    if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];

    elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];

    // Get current template
    //  Пользуемся скрытыми метополями вордпресс
    //  для каждой страницы шаблона есть метаполе с именем шаблона
    //  скрыетое метополе _wp_page_template
    $current_template = get_post_meta( $post_id, '_wp_page_template', true );
    //  проверяем если шаблон не совпадает
    if( $current_template  === "main.php" ): // действия если шаблон не совпадает
    $meta_boxes[] = array(
        'id'         => 'info',
        'title'      => 'Additional date',
        'post_types' => 'page',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            /*          ABOUT US SECTION             */
            /* ------------------------------------- */
            array(
                'type' => 'heading',
                'name' => 'Section About US',
                'desc' => '',
            ),
            array(
                'id'        => 'about_show',
                'name'      => 'Show / Hidden section?',
                'type'      => 'switch',
                
                // Style: rounded (default) or square
                'style'     => 'rounded',
            
                // On label: can be any HTML
                'on_label'  => 'Show',
            
                // Off label
                'off_label' => 'Hidden',
            ),
            array(
                'name'        => 'Title',
                'id'          => 'about_title',
                'type'        => 'text',
            
                // Текст-подсказка внутри поля. Необязательный.
                'placeholder' => 'Title section',
            
                // Размер. Необязательный.
                //'size'        => 30,
                            
            ),
            array(
                'name'        => 'Text',
                'id'          => 'about_text',
                'type'        => 'textarea',
            
                // Эти параметры необязательные
                'placeholder' => 'text ', // По умолчанию без placeholder
                //'cols'        => 50, // По умолчанию 60
                'rows'        => 5, // По умолчанию 4
            ),
            array(
                'name'        => 'Link',
                'id'          => 'about_link',
                'type'        => 'text',
            
                // Текст-подсказка внутри поля. Необязательный.
                'placeholder' => 'link for transition',
            
                // Размер. Необязательный.
                //'size'        => 30,
                            
            ),



            /*         WORK SECTION             */
            /* ------------------------------------- */
            array(
                'type' => 'heading',
                'name' => 'Section Work',
                'desc' => '',
            ),
            array(
                'id'        => 'work_show',
                'name'      => 'Show / Hidden section?',
                'type'      => 'switch',
                
                // Style: rounded (default) or square
                'style'     => 'rounded',
            
                // On label: can be any HTML
                'on_label'  => 'Show',
            
                // Off label
                'off_label' => 'Hidden',
            ),
            /*         PEOPLE SECTION             */
            /* ------------------------------------- */
            array(
                'type' => 'heading',
                'name' => 'Section PEOPLE',
                'desc' => '',
            ),
            array(
                'id'        => 'people_show',
                'name'      => 'Show / Hidden section?',
                'type'      => 'switch',
                
                // Style: rounded (default) or square
                'style'     => 'rounded',
            
                // On label: can be any HTML
                'on_label'  => 'Show',
            
                // Off label
                'off_label' => 'Hidden',
            ),
            array(
                'name'        => 'Title',
                'id'          => 'people_title',
                'type'        => 'text',
            
                // Текст-подсказка внутри поля. Необязательный.
                'placeholder' => 'Title section',
            
                // Размер. Необязательный.
                //'size'        => 30,
                            
            ),
            array(
                'name'        => 'Text',
                'id'          => 'people_text',
                'type'        => 'textarea',
            
                // Эти параметры необязательные
                'placeholder' => 'text ', // По умолчанию без placeholder
                //'cols'        => 50, // По умолчанию 60
                'rows'        => 5, // По умолчанию 4
            ),

            /*         LAST POST SECTION             */
            /* ------------------------------------- */
            array(
                'type' => 'heading',
                'name' => 'Section LAST POST',
                'desc' => '',
            ),
            array(
                'id'        => 'post_show',
                'name'      => 'Show / Hidden section?',
                'type'      => 'switch',
                
                // Style: rounded (default) or square
                'style'     => 'rounded',
            
                // On label: can be any HTML
                'on_label'  => 'Show',
            
                // Off label
                'off_label' => 'Hidden',
            ),
            /*         CONTACT US SECTION             */
            /* ------------------------------------- */
            array(
                'type' => 'heading',
                'name' => 'Section Contact us',
                'desc' => '',
            ),
            array(
                'id'        => 'contact_show',
                'name'      => 'Show / Hidden section?',
                'type'      => 'switch',
                
                // Style: rounded (default) or square
                'style'     => 'rounded',
            
                // On label: can be any HTML
                'on_label'  => 'Show',
            
                // Off label
                'off_label' => 'Hidden',
            ),
            array(
                'name'        => 'LOCATION',
                //'label_description' => 'Label description',
                'id'          => 'contact_location',
                'desc'        => 'Please enter adress',
                'type'        => 'text',
            
                // Default value (optional)
                // 'std'         => 'Default text value',
            
                // Cloneable (i.e. have multiple value)?
                'clone'       => true,
            
                // Placeholder
                'placeholder' => 'Enter adress',
            
                // Input size
                //'size'        => 30,
            
                
            ),
            array(
                'name'        => 'FAX',
                //'label_description' => 'Label description',
                'id'          => 'contact_fax',
                'desc'        => 'Please enter phone',
                'type'        => 'text',
            
                // Default value (optional)
                // 'std'         => 'Default text value',
            
                // Cloneable (i.e. have multiple value)?
                'clone'       => true,
            
                // Placeholder
                'placeholder' => 'Enter phone',
            
                // Input size
                //'size'        => 30,
            ),
            array(
                'name'        => 'PHONE',
                //'label_description' => 'Label description',
                'id'          => 'contact_phone',
                'desc'        => 'Please enter phone',
                'type'        => 'text',
            
                // Default value (optional)
                // 'std'         => 'Default text value',
            
                // Cloneable (i.e. have multiple value)?
                'clone'       => true,
            
                // Placeholder
                'placeholder' => 'Enter phone',
            
                // Input size
                //'size'        => 30,
            ),
            array(
                'name'        => 'EMAIL',
                //'label_description' => 'Label description',
                'id'          => 'contact_email',
                'desc'        => 'Please enter phone',
                'type'        => 'text',
            
                // Default value (optional)
                // 'std'         => 'Default text value',
            
                // Cloneable (i.e. have multiple value)?
                'clone'       => true,
            
                // Placeholder
                'placeholder' => 'Enter Email',
            
                // Input size
                //'size'        => 30,
            ),
        )
    );
    endif;

    $meta_boxes[] = array(
        'id'         => 'info',
        'title'      => 'Additional date',
        'post_types' => 'people',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'type' => 'heading',
                'name' => 'Optional Data',
                'desc' => 'profession',
            ),
            array(
                'name'          => 'Profession',
                'id'            => 'people_prof',
                'type'          => 'text',

                'placeholder'   => 'Profession in company',
            )

           
            
        )
    );
            

    // Add more meta boxes if you want
    // $meta_boxes[] = ...

    return $meta_boxes;
}
?>
