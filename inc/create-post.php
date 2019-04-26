<?php

/**
 * Add Needed Post Types 
 */
function ele_init_post_types() {
	if (function_exists('ele_get_post_types')) {
		foreach (ele_get_post_types() as $type => $options) {
			ele_add_post_type($type, $options['config'], $options['singular'], $options['multiple']);
		}
	}
}
add_action('init', 'ele_init_post_types');

/**
 * Register Post Type Wrapper
 * @param string $name
 * @param array $config
 * @param string $singular
 * @param string $multiple
 */
function ele_add_post_type($name, $config, $singular = 'Entry', $multiple = 'Entries') {
       
    if (!isset($config['labels'])) {
		$config['labels'] = array(
			'name'              => $multiple, // основное название для типа записи
            'singular_name'     => $singular, // название для одной записи этого типа
            'add_new'           => 'Add New ' . $singular, // для добавления новой записи
            'add_new_item'      => 'Adding '. $singular, // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'         => 'Edit ', $singular, // для редактирования типа записи
            'new_item'          => 'New ' . $singular, // текст новой записи
            'view_item'         => 'View ', $singular, // для просмотра записи этого типа.
            'search_items'      => 'Search ' . $multiple, // для поиска по этим типам записи
            'not_found'         => 'No ' . $multiple . ' Found', // если в результате поиска ничего не было найдено
            'not_found_in_trash'=> 'No ' . $multiple . ' found in Trash', // если не было найдено в корзине
			'parent_item_colon' => '', // для родителей (у древовидных типов)
            //'menu_name'         => '____', // название меню
		);
	}

	register_post_type($name, $config);
}   

?>