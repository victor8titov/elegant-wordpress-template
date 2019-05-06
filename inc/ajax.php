<?php

function elegant_load_posts(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';
    
    $query = new WP_Query( $args );
    if( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template-parts/content', get_post_type() );
        }
    }    
    wp_reset_postdata(); // сбрасываем переменную $post
    
    die();
    
}

add_action('wp_ajax_loadmorepost', 'elegant_load_posts');
add_action('wp_ajax_nopriv_loadmorepost', 'elegant_load_posts');

function elegant_send_form() {
    // проверка на спам - просто прерываем выполнение кода, при желании можно и сообщение спамерам вывести
    if( strlen( $_POST['comment'] ) || strlen( $_POST['content'] ) )
    exit;
    
    // подключаем WP, можно конечно обойтись без этого, но зачем?
    // require( dirname(__FILE__) . '/wp-load.php');
    
    // следующий шаг - проверка на обязательные поля, у нас это емайл, имя и сообщение
    if( isset( $_POST['name'] )
    && isset( $_POST['email'] ) && is_email( $_POST['email'] ) // is_email() - встроенная функция WP для проверки корректности емайлов
    && isset( $_POST['message'] ) ) {
        $sendTo   = get_option('admin_email'); // Обязательно измените e-mail на свой
        //$sendToCc = "victor180188@gmail.com"; // Скрытая копия
        $usermail = $_POST['email'];
        $username = $_POST['name'];
        $content  = nl2br($_POST['message']);
        
        // Формируем заголовок письма
        $header[] = "From: " . strip_tags($usermail) . "\r\n";
        //$header[] = "Cc:" . strip_tags( $sendToCc ) . "\r\n";
        //$header[] = "Reply-To: ". strip_tags($usermail) . "\r\n";
        $header[] = "MIME-Version: 1.0\r\n";
        $header[] = "Content-Type:text/html; charset=utf-8\r\n";

        // Формирование заголовка сообщения.
        $subject  = "Сообщение формы обратной связи сайта Elegant";
        
        // Формирование тела письма
        $msg .= '<html><body style = "background-color: rgb(247, 247, 247); width: 90%; margin: 10px auto; font-family: Arial, Helvetica, sans-serif;">
        <h2>Новое сообщение от пользователя сайта Elegant.</h2>
        <dl><dt><strong>Name:</strong></dt>
        <dd>' . $username . '</dd></dl>
        <dl><dt><strong>EMail:</strong></dt>
        <dd>' . $usermail . '</dd></dl>
        <dl><dt><strong>Message:</strong></dt>
        <dd style="font-style:italic;">' . $content . '</dd></dl>
        </body></html>';
        
        
        if( wp_mail( $sendTo, $subject , $msg , $header ) ) {
            echo true;
        } else {
            echo false;
        }
    }

   
    exit;
}
add_action('wp_ajax_sendform', 'elegant_send_form');
add_action('wp_ajax_nopriv_sendform', 'elegant_send_form');
