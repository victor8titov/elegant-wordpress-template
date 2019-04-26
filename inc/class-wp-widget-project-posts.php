<?php

class TopProjectPostsWidget extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since 2.8.0
     */
    /*
    *   Конструктор ничем не отличается от тех, что вы обычно пишете. Главное, что нужно сделать — это вызвать 
    *   родительский конструктор, который принимает три аргумента: идентификатор виджета, название виджета (это имя будет 
    *   показано на странице виджетов) и массив с другими деталями виджета (нужно только «description»):
    */
    public function __construct() {
        $widget_ops = array(
            'classname'                   => 'widget-recent-project',
            'description'                 => __( 'Your site&#8217;s most recent Project.' ),
            //'customize_selective_refresh' => true,
        );
        parent::__construct( 'recent-project', __( 'Recent Project' ), $widget_ops );
        //$this->alt_option_name = 'widget_recent_entries';
    }
    
    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    /*
    *   Этот метод используется для отображения виджета непосредственно в сайдбаре на сайте. У метода два аргумента: 
    *   $args — аргументы виджета (массив, содержащий некоторую информацию о виджете), $instance — массив со связанными с 
    *   виджетом переменными. В нашем случае $args не имеет значения.
    */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';//__( 'Recent Project' );
    
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title );
    
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number ) {
            $number = 5;
        }

        $class = isset( $args['class'] ) ? $args['class'] : 'widget-elegant';
    
        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         * @since 4.9.0 Added the `$instance` parameter.
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args     An array of arguments used to retrieve the recent posts.
         * @param array $instance Array of settings for the current widget.
         */
        
        
         $r = new WP_Query(array(
             'post_type'        => 'project',
             'posts_per_page'   => $number,

         ));
    
        if ( ! $r->have_posts() ) {
            return;
        }
        ?>
        <?php echo $args['before_widget']; ?>
        <?php
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
        <ul>
            <?php foreach ( $r->posts as $recent_post ) : ?>
                <?php
                $post_title = get_the_title( $recent_post->ID );
                $title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
                $img        = has_post_thumbnail( $recent_post->ID ) ? get_the_post_thumbnail( $recent_post->ID ) : $title;
                ?>
                <li>
                    <div class="project-img">
                        <a href="<?php the_permalink( $recent_post->ID ); ?>">
                            <?php echo $img; ?>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        echo $args['after_widget'];
        wp_reset_postdata();
        
    }
    
    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    /*
    *   Этот метод дает вам возможность проверить и обработать переданные значения перед использованием. Также у нас есть 
    *   возможность принимать решения исходя из старых значений. Метод update() должен возвращать массив, содержащий 
    *   переменные, которые вы собираетесь использовать для отображения виджета на сайте. WordPress передает два 
    *   аргумента: массив новых значений и массив оригинальных значений.
    */
    public function update( $new_instance, $old_instance ) {
        $instance              = $old_instance;
        $instance['title']     = sanitize_text_field( $new_instance['title'] );
        $instance['number']    = (int) $new_instance['number'];
        return $instance;
    }
    
    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    /*
    *   Виджет, который мы делаем должен давать возможность вводить заголовок и немного текста для отображения на 
    *   страницах сайта. Исходя из этого нам надо создать форму для ввода этих значений. Метод form() используется для 
    *   отображения настроек виджета на странице виджетов. У метода один аргумент — $instance — массив переменных, 
    *   связанных с виджетом. Когда форма отправится на сервер, будет вызван метод update() и мы сможем обновить 
    *   переменные в массиве $instance. После, метод widget() будет использовать этот массив для отображения виджета.
    *
    *   Методы get_field_id() и get_field_name() класса WP_Widget используются для генерации уникальных имен и 
    *   идентификаторов для полей вашего плагина. Использование этих методов позволяет избежать конфликтов.
    */

    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
    
        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
        <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
    
       
        <?php
    }
}

/*
 * регистрация виджета
 *  Теперь нужно зарегистрировать виджет. Для этого используется функция register_widget(), которая в качестве аргумента 
 *  принимает имя класса вашего виджета. Эта функция должна быть вызвана в определенное время, поэтому нам нужно 
 *  использовать систему хуков в WordPress. Нужный нам хук называется «widgets_init». Для связи регистрации виджета с 
 *  хуком будем использовать функцию add_action(), у которой два аргумента: первый — имя хука, второй — имя функции, 
 * которую надо выполнить (вторым аргументом может быть строка или замыкание). Этот код должен быть расположен после 
 * комментария в файле widget_init.php:
 */
function top_project_posts_widget_load() {
	register_widget( 'TopProjectPostsWidget' );
}
add_action( 'widgets_init', 'top_project_posts_widget_load' );



