<?php 
    $CI = & get_instance();
    $CI->load->helper('cookie');
    $CI->load->helper('url');
    if($CI->uri->segment(1) != 'admin' && !$CI->input->post()) {
        $cookie = get_cookie('lang');
        $base_lang = 'ge';
        $c_lang = ($cookie) ? $cookie : $base_lang;;
        $c_lang = ($CI->input->get('lang')) ? $CI->input->get('lang') : $c_lang;

        $CI->load->model("Languages_model");
        $CI->load->database();
        $lang = $CI->Languages_model->checkLang($c_lang);
        
        if(!$lang){ 
            $c_lang = $base_lang;
            $CI->input->set_cookie('lang', $c_lang, 3600);
        }
        if( empty($cookie)) { 
            $CI->input->set_cookie('lang', $c_lang, 3600);
            $cookie = $c_lang;
            redirect(base_url(uri_string()));
        }
        if($cookie != $base_lang && empty($CI->input->get('lang'))) {
            $get_query ="?lang=$c_lang"; 

            foreach ($CI->input->get() as $key => $value) {
                if($value!="")
                    $get_query .= "&$key=$value";
            }
            redirect(base_url(uri_string()).$get_query);
        }
        if($CI->input->get('lang') != $cookie && !empty($CI->input->get('lang')) ) {
            $CI->input->set_cookie('lang', $c_lang, '3600');
        }

        define('LANG',$c_lang);
    }
?>