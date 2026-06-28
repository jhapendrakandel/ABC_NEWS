<?php

function abcnepal_setup() {

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('custom-logo', array(
        'height'      => 120,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    register_nav_menus(array(
        'main-menu' => 'Main Menu'
    ));

}

add_action('after_setup_theme', 'abcnepal_setup');


function abcnepal_is_live_update_path() {
    if (is_admin() || empty($_SERVER['REQUEST_URI'])) {
        return false;
    }

    $request_path = trim(wp_parse_url(wp_unslash($_SERVER['REQUEST_URI']), PHP_URL_PATH), '/');
    $home_path = trim(wp_parse_url(home_url('/'), PHP_URL_PATH), '/');

    if (!empty($home_path) && 0 === strpos($request_path, $home_path)) {
        $request_path = trim(substr($request_path, strlen($home_path)), '/');
    }

    return in_array($request_path, array('liveupdate', 'live-update'), true);
}


function abcnepal_styles() {

    wp_enqueue_style(
        'abc-style',
        get_stylesheet_uri(),
        array(),
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    if (is_page_template('page-live-update.php') || is_page(array('liveupdate', 'live-update')) || abcnepal_is_live_update_path()) {
        wp_enqueue_script(
            'abc-live-update',
            get_template_directory_uri() . '/js/live-update.js',
            array('jquery'),
            filemtime(get_template_directory() . '/js/live-update.js'),
            true
        );

        wp_localize_script(
            'abc-live-update',
            'abcLiveUpdate',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('abc_live_update_nonce'),
            )
        );
    }
}

add_action('wp_enqueue_scripts', 'abcnepal_styles');


function abcnepal_logo_markup($class = 'site-logo-link') {
    $home_url = esc_url(home_url('/'));
    $site_name = get_bloginfo('name') ?: 'ABC News Nepal';
    $custom_logo_id = get_theme_mod('custom_logo');
    $local_logo_path = get_template_directory() . '/abc.png';
    $local_logo_url = get_template_directory_uri() . '/abc.png';
    $logo_html = '';

    if ($custom_logo_id) {
        $logo_src = wp_get_attachment_image_src($custom_logo_id, 'full');

        if (!empty($logo_src[0])) {
            $logo_html = sprintf(
                '<img src="%s" alt="%s">',
                esc_url($logo_src[0]),
                esc_attr($site_name)
            );
        }
    }

    if (empty($logo_html) && file_exists($local_logo_path) && filesize($local_logo_path) > 100) {
        $logo_html = sprintf(
            '<img src="%s" alt="%s">',
            esc_url($local_logo_url),
            esc_attr($site_name)
        );
    }

    if (empty($logo_html)) {
        $logo_html = '<span class="site-logo-text"><strong>ABC</strong><span>News Nepal</span></span>';
    }

    printf(
        '<a class="%s" href="%s" aria-label="%s">%s</a>',
        esc_attr($class),
        $home_url,
        esc_attr__('ABC Nepal TV homepage', 'abcnepal-tv'),
        $logo_html
    );
}


function abcnepal_translate_menu_title($title) {

    $labels = array(
        'mainnews'      => 'मुख्य समाचार',
        'main news'     => 'मुख्य समाचार',
        'rajneeti'      => 'राजनीति',
        'rajniti'       => 'राजनीति',
        'kutni'         => 'कूटनीति',
        'kutniti'       => 'कूटनीति',
        'artha'         => 'अर्थ वाणिज्य',
        'entertainment' => 'मनोरञ्जन',
        'abc_videos'    => 'एबीसी भिडियो',
        'abc videos'    => 'एबीसी भिडियो',
        'english'       => 'अंग्रेजी',
        'international' => 'अन्तर्राष्ट्रिय',
        'opinion'       => 'विचार',
        'economics'     => 'अर्थतन्त्र',
        'sports'        => 'खेलकुद',
        'liveupdate'    => 'लाइभ अपडेट',
        'live update'   => 'लाइभ अपडेट',
        'live updates'  => 'लाइभ अपडेट',
    );

    $key = strtolower(trim(wp_strip_all_tags($title)));

    return isset($labels[$key]) ? $labels[$key] : $title;
}

add_filter('nav_menu_item_title', 'abcnepal_translate_menu_title');


function abcnepal_live_update_route_status() {
    if (!abcnepal_is_live_update_path()) {
        return;
    }

    global $wp_query;

    if ($wp_query) {
        $wp_query->is_404 = false;
        $wp_query->is_page = true;
        $wp_query->is_singular = true;
    }

    status_header(200);
}

add_action('template_redirect', 'abcnepal_live_update_route_status', 0);


function abcnepal_live_update_template_route($template) {
    if (!abcnepal_is_live_update_path()) {
        return $template;
    }

    $live_template = locate_template('page-live-update.php');

    return !empty($live_template) ? $live_template : $template;
}

add_filter('template_include', 'abcnepal_live_update_template_route', 99);


function abcnepal_section_config($section) {

    $sections = array(
        'mainnews' => array(
            'category'      => '',
            'breaking'      => 'ताजा अपडेट : राष्ट्रिय राजनीति, अर्थतन्त्र, समाज र खेलकुदका प्रमुख समाचार',
            'section_title' => 'मुख्य समाचार',
            'sidebar_title' => 'ताजा समाचार',
            'featured'      => 'सरकारको प्राथमिकतामा सेवा प्रवाह सुधार, नागरिकका मुद्दा केन्द्रमा',
            'excerpt'       => 'नयाँ कार्ययोजनासहित सरकारले प्रशासनिक सुधार, सार्वजनिक सेवा र आर्थिक गतिविधिलाई गति दिने तयारी अघि बढाएको छ।',
            'latest'        => array(
                'संसद बैठकमा जनजीविकाका विषयमा छलफल',
                'स्थानीय तहमा बजेट कार्यान्वयन तीव्र बनाइँदै',
                'मनसुन सक्रिय भएपछि सावधानी अपनाउन आग्रह',
                'स्वास्थ्य संस्थामा सेवा विस्तार गर्ने निर्णय',
                'युवा रोजगारी कार्यक्रमका लागि नयाँ प्रस्ताव',
            ),
            'cards'         => array(
                'पूर्वाधार निर्माणमा ढिलाइ हटाउन निर्देशन',
                'पर्यटन क्षेत्रमा बुकिङ बढेपछि व्यवसायी उत्साहित',
                'शिक्षा क्षेत्रमा डिजिटल प्रणाली विस्तार हुँदै',
                'सार्वजनिक यातायात सुधारका लागि नयाँ मापदण्ड',
                'कृषि उत्पादन बजारसम्म पुर्‍याउन सहकारी सक्रिय',
                'नगर क्षेत्रमा सरसफाइ अभियान सुरु',
            ),
        ),
        'politics' => array(
            'category'      => 'politics',
            'breaking'      => 'राजनीति अपडेट : दलहरूबीच संवाद, संसद र सरकारका पछिल्ला गतिविधि',
            'section_title' => 'राजनीति विशेष',
            'sidebar_title' => 'ताजा राजनीतिक समाचार',
            'featured'      => 'संसदमा नीति प्राथमिकतामाथि बहस, दलहरू आन्तरिक छलफलमा',
            'excerpt'       => 'सत्तापक्ष र प्रतिपक्षबीच संसदीय कार्यसूची, सुशासन र जनसरोकारका विषयमा संवाद बढेको छ।',
            'latest'        => array(
                'दलहरूबीच सहमतिको प्रयास जारी',
                'संसदीय समितिमा विधेयकमाथि छलफल',
                'प्रदेश सरकार पुनर्गठनबारे परामर्श',
                'नेताहरू जनताका मुद्दा केन्द्रमा राख्न आग्रह',
                'स्थानीय तहको समन्वय बैठक सम्पन्न',
            ),
            'cards'         => array(
                'नयाँ राजनीतिक समीकरणबारे शीर्ष नेताहरूको भेट',
                'सुशासनका विषयमा संसदमा प्रश्न उठ्यो',
                'दलहरूको आन्तरिक बैठकमा संगठन सुदृढीकरण छलफल',
                'संविधान कार्यान्वयनका चुनौतीबारे बहस',
                'युवा प्रतिनिधित्व बढाउन राजनीतिक दबाब',
                'प्रदेशसभामा बजेट प्राथमिकतामाथि छलफल',
            ),
        ),
        'kutniti' => array(
            'category'      => 'kutniti',
            'breaking'      => 'कूटनीति अपडेट : छिमेक, सहायता र अन्तर्राष्ट्रिय सम्बन्धका खबर',
            'section_title' => 'कूटनीति विशेष',
            'sidebar_title' => 'ताजा कूटनीति समाचार',
            'featured'      => 'नेपालको विकास साझेदारीमा नयाँ चरण, दूतावासस्तरीय संवाद तीव्र',
            'excerpt'       => 'पूर्वाधार, ऊर्जा र शिक्षा क्षेत्रमा अन्तर्राष्ट्रिय सहकार्य विस्तार गर्न विभिन्न मुलुकसँग छलफल अघि बढेको छ।',
            'latest'        => array(
                'द्विपक्षीय भेटवार्तामा आर्थिक सहकार्य प्राथमिकता',
                'विदेशस्थित नेपाली सेवामा सुधारको तयारी',
                'सीमा क्षेत्रका विषयमा संयुक्त संयन्त्र सक्रिय',
                'विकास साझेदारसँग परियोजना समीक्षा',
                'क्षेत्रीय सम्मेलनमा नेपाली प्रतिनिधिमण्डल सहभागी',
            ),
            'cards'         => array(
                'ऊर्जा व्यापारबारे उच्चस्तरीय छलफल',
                'श्रम गन्तव्य मुलुकसँग नयाँ समझदारीको तयारी',
                'कूटनीतिक नियोगमा सेवा डिजिटल बनाइँदै',
                'अन्तर्राष्ट्रिय मञ्चमा नेपालको जलवायु मुद्दा',
                'विदेशी लगानी आकर्षित गर्न दूतावास सक्रिय',
                'छिमेकी मुलुकसँग यातायात सम्पर्क विस्तार',
            ),
        ),
        'artha' => array(
            'category'      => 'artha',
            'breaking'      => 'अर्थ वाणिज्य अपडेट : बजार, बैंकिङ, उद्योग र व्यापारका खबर',
            'section_title' => 'अर्थ वाणिज्य विशेष',
            'sidebar_title' => 'ताजा अर्थ समाचार',
            'featured'      => 'लगानी वातावरण सुधारको संकेत, निजी क्षेत्र नयाँ नीतिबाट उत्साहित',
            'excerpt'       => 'बैंकिङ तरलता, ब्याजदर र व्यापारिक गतिविधिमा देखिएको सुधारले बजारमा सकारात्मक अपेक्षा बढाएको छ।',
            'latest'        => array(
                'सेयर बजारमा सामान्य सुधार',
                'बैंकिङ क्षेत्रमा नयाँ निर्देशन लागू',
                'पर्यटन आय बढ्दा व्यवसायी उत्साहित',
                'उद्योगीहरूले कर प्रणाली सरल बनाउन माग गरे',
                'विदेशी मुद्रा सञ्चिति मजबुत हुँदै',
            ),
            'cards'         => array(
                'व्यापार घाटा घटाउन उत्पादनमुखी नीति आवश्यक',
                'साना उद्यमलाई सहुलियत कर्जा विस्तार',
                'निर्यात प्रवर्द्धनका लागि नयाँ योजना',
                'होटल क्षेत्रमा लगानी बढ्ने संकेत',
                'कृषि बजारलाई डिजिटल प्रणालीमा जोड्ने तयारी',
                'बिमा क्षेत्रमा ग्राहक सेवा सुधार अभियान',
            ),
        ),
        'entertainment' => array(
            'category'      => 'entertainment',
            'breaking'      => 'मनोरञ्जन अपडेट : चलचित्र, संगीत, कला र सेलिब्रेटी खबर',
            'section_title' => 'मनोरञ्जन विशेष',
            'sidebar_title' => 'ताजा मनोरञ्जन समाचार',
            'featured'      => 'नयाँ नेपाली चलचित्रको घोषणा, युवा कलाकार मुख्य भूमिकामा',
            'excerpt'       => 'नेपाली चलचित्र उद्योगमा नयाँ कथावस्तु र डिजिटल प्रविधिको प्रयोग बढ्दै जाँदा दर्शकको चासो पनि बढेको छ।',
            'latest'        => array(
                'गायकको नयाँ गीत सार्वजनिक',
                'चलचित्र महोत्सवमा नेपाली फिल्म छनोट',
                'रंगमञ्चमा नयाँ नाटक मञ्चन हुँदै',
                'कलाकारहरूले सामाजिक अभियानमा सहभागिता जनाए',
                'वेब सिरिज निर्माणमा युवा टोली सक्रिय',
            ),
            'cards'         => array(
                'लोकगीतमा नयाँ पुस्ताको आकर्षण बढ्दै',
                'फिल्म छायांकनका लागि पोखरा रोजाइमा',
                'संगीत भिडियोमा डिजिटल प्लेटफर्मको प्रभाव',
                'कलाकार संघले सम्मान कार्यक्रम गर्ने',
                'सांस्कृतिक कार्यक्रमका लागि तयारी पूरा',
                'सिनेमा हलमा दर्शक फर्किन थाले',
            ),
        ),
        'abc_video' => array(
            'category'      => 'abc-video',
            'breaking'      => 'एबीसी भिडियो अपडेट : अन्तर्वार्ता, रिपोर्ट र विशेष भिडियो',
            'section_title' => 'एबीसी भिडियो विशेष',
            'sidebar_title' => 'ताजा भिडियो',
            'featured'      => 'विशेष संवाद : समसामयिक राजनीतिबारे विस्तृत कुराकानी',
            'excerpt'       => 'एबीसी नेपाल टिभीको भिडियो खण्डमा प्रमुख समाचार, विश्लेषण र जनसरोकारका विषयलाई दृश्य सामग्रीमार्फत प्रस्तुत गरिएको छ।',
            'latest'        => array(
                'आजको मुख्य समाचार भिडियो',
                'अर्थतन्त्रबारे विशेषज्ञसँग कुराकानी',
                'प्रदेश विशेष रिपोर्ट प्रसारण',
                'युवा उद्यमीको सफलताको कथा',
                'अन्तर्राष्ट्रिय घटनाक्रमको भिडियो विश्लेषण',
            ),
            'cards'         => array(
                'स्टुडियो बहस : सुशासन र सेवा प्रवाह',
                'मैदानबाट रिपोर्ट : किसानका समस्या',
                'विशेष अन्तर्वार्ता : नीति र नेतृत्व',
                'भिडियो रिपोर्ट : बजारको पछिल्लो अवस्था',
                'जनआवाज : नागरिकका अपेक्षा',
                'साप्ताहिक समीक्षा : सात दिनका मुख्य घटना',
            ),
        ),
        'english' => array(
            'category'      => 'english',
            'breaking'      => 'अंग्रेजी संस्करण अपडेट : नेपालका प्रमुख खबरको संक्षिप्त प्रस्तुति',
            'section_title' => 'अंग्रेजी संस्करण विशेष',
            'sidebar_title' => 'ताजा अंग्रेजी संस्करण',
            'featured'      => 'नेपालका मुख्य घटनाक्रम अन्तर्राष्ट्रिय पाठकका लागि प्रस्तुत',
            'excerpt'       => 'अंग्रेजी संस्करणले राजनीति, अर्थतन्त्र, समाज र कूटनीतिका प्रमुख नेपाली खबरलाई विश्वव्यापी पाठकसम्म पुर्‍याउने लक्ष्य राखेको छ।',
            'latest'        => array(
                'सरकारी प्राथमिकताबारे संक्षिप्त रिपोर्ट',
                'बजार र व्यापार गतिविधिको अपडेट',
                'पर्यटन क्षेत्रमा सुधारको संकेत',
                'कूटनीतिक भेटवार्ताको सार',
                'खेलकुद उपलब्धिबारे छोटो समाचार',
            ),
            'cards'         => array(
                'नेपालको अर्थतन्त्रबारे तथ्यसहित विश्लेषण',
                'नयाँ नीतिले लगानीकर्तालाई दिएको संकेत',
                'स्थानीय शासनमा देखिएका परिवर्तन',
                'जलवायु मुद्दामा नेपालको आवाज',
                'पर्यटन गन्तव्यको अन्तर्राष्ट्रिय प्रचार',
                'खेलकुदमा नेपाली टोलीको तयारी',
            ),
        ),
        'international' => array(
            'category'      => 'international',
            'breaking'      => 'अन्तर्राष्ट्रिय अपडेट : विश्व राजनीति, अर्थतन्त्र र दक्षिण एसियाका खबर',
            'section_title' => 'अन्तर्राष्ट्रिय विशेष',
            'sidebar_title' => 'ताजा अन्तर्राष्ट्रिय समाचार',
            'featured'      => 'दक्षिण एसियाली क्षेत्रमा आर्थिक सहकार्यबारे नयाँ छलफल',
            'excerpt'       => 'क्षेत्रीय राजनीति, व्यापार र सुरक्षा विषयमा भइरहेका परिवर्तनले नेपालसहित दक्षिण एसियाका मुलुकमा प्रभाव पार्ने देखिएको छ।',
            'latest'        => array(
                'विश्व बजारमा ऊर्जा मूल्यमा उतारचढाव',
                'क्षेत्रीय सम्मेलनमा आर्थिक मुद्दा प्राथमिकता',
                'प्रविधि क्षेत्रमा नयाँ नियम लागू',
                'जलवायु परिवर्तनबारे राष्ट्रहरूको प्रतिबद्धता',
                'अन्तर्राष्ट्रिय सहायता कार्यक्रम विस्तार',
            ),
            'cards'         => array(
                'विश्व अर्थतन्त्रमा सुस्त सुधारको संकेत',
                'छिमेकी मुलुकमा निर्वाचन तयारी तीव्र',
                'समुद्री व्यापार मार्गमा नयाँ चुनौती',
                'श्रम बजारमा प्रवासी कामदारको माग बढ्दै',
                'शिक्षा र अनुसन्धानमा अन्तर्राष्ट्रिय सहकार्य',
                'स्वास्थ्य सुरक्षा प्रणाली बलियो बनाउने प्रयास',
            ),
        ),
        'opinion' => array(
            'category'      => 'opinion',
            'breaking'      => 'विचार अपडेट : विश्लेषण, टिप्पणी र सम्पादकीय दृष्टिकोण',
            'section_title' => 'विचार विशेष',
            'sidebar_title' => 'ताजा विचार',
            'featured'      => 'सुशासनको बहस कागजमा होइन, नागरिकको सेवामा देखिनुपर्छ',
            'excerpt'       => 'राजनीतिक प्रतिबद्धता, प्रशासनिक क्षमता र नागरिक निगरानी एकसाथ अघि बढे मात्रै सार्वजनिक सेवा प्रभावकारी बन्न सक्छ।',
            'latest'        => array(
                'युवाको सहभागिता किन आवश्यक छ?',
                'अर्थतन्त्र सुधारका लागि नीतिगत स्थिरता',
                'स्थानीय सरकारको जवाफदेहिता बढाउने उपाय',
                'शिक्षामा गुणस्तरको बहस',
                'जलवायु संकट र हाम्रो तयारी',
            ),
            'cards'         => array(
                'लोकतन्त्र बलियो बनाउन संस्थागत सुधार',
                'मिडियाको जिम्मेवारी र सार्वजनिक विश्वास',
                'शहर विकासमा दीर्घकालीन सोचको खाँचो',
                'स्वास्थ्य सेवामा नागरिकमैत्री प्रणाली',
                'उद्यमशीलता बढाउन नीतिको भूमिका',
                'कृषि क्षेत्रमा बजार पहुँचको चुनौती',
            ),
        ),
        'economics' => array(
            'category'      => 'economics',
            'breaking'      => 'अर्थतन्त्र अपडेट : उत्पादन, रोजगारी, बजार र नीतिका मुख्य खबर',
            'section_title' => 'अर्थतन्त्र विशेष',
            'sidebar_title' => 'ताजा अर्थतन्त्र समाचार',
            'featured'      => 'उत्पादन र रोजगारी बढाउने नीतिमा विज्ञहरूको जोड',
            'excerpt'       => 'आयात निर्भरता घटाउँदै स्थानीय उत्पादन, सीप विकास र वित्तीय पहुँच विस्तार गर्नुपर्ने आवाज बलियो बन्दै गएको छ।',
            'latest'        => array(
                'रोजगारी सिर्जनाका लागि नयाँ कार्यक्रम प्रस्ताव',
                'कृषि उत्पादनको बजार मूल्यमा सुधार',
                'साना उद्योगलाई प्रविधि सहयोग आवश्यक',
                'विकास खर्च बढाउन मन्त्रालयहरू सक्रिय',
                'नीतिगत स्थिरता माग्दै निजी क्षेत्र',
            ),
            'cards'         => array(
                'स्थानीय उत्पादन प्रवर्द्धनमा पालिकाको भूमिका',
                'ऊर्जा क्षेत्रमा लगानी बढ्दा अर्थतन्त्रलाई टेवा',
                'पूर्वाधार परियोजनाले रोजगारी सिर्जना गर्ने अपेक्षा',
                'डिजिटल भुक्तानीले कारोबार पारदर्शी बनाउँदै',
                'कृषि बीमामा किसानको आकर्षण बढ्दै',
                'आन्तरिक पर्यटनबाट स्थानीय अर्थतन्त्र चलायमान',
            ),
        ),
        'pradesh' => array(
            'category'      => 'pradesh',
            'breaking'      => 'प्रदेश अपडेट : सातै प्रदेशका ताजा समाचार र गतिविधि',
            'section_title' => 'प्रदेश विशेष',
            'sidebar_title' => 'ताजा प्रदेश समाचार',
            'featured'      => 'प्रदेश सरकारहरूको बजेट कार्यान्वयनमा तेजी, विकास आयोजना अघि बढ्दै',
            'excerpt'       => 'सातै प्रदेशमा स्थानीय विकास, सेवा प्रवाह र सुशासनका विषयमा नयाँ गतिविधि भइरहेका छन्।',
            'latest'        => array(
                'प्रदेश १ मा सडक पूर्वाधार निर्माण तीव्र',
                'मधेश प्रदेशमा सिंचाइ परियोजना उद्घाटन',
                'बागमती प्रदेशमा स्वास्थ्य शिविर सञ्चालन',
                'गण्डकी प्रदेशमा पर्यटन प्रवर्द्धन अभियान',
                'लुम्बिनी प्रदेशमा कृषि विकास कार्यक्रम',
            ),
            'cards'         => array(
                'कर्णाली प्रदेशमा शिक्षा सुधार अभियान',
                'सुदूरपश्चिममा आर्थिक विकासका नयाँ पहल',
                'प्रदेश सरकारहरूले विकास बजेट बढाए',
                'स्थानीय तहसँग प्रदेश सरकारको समन्वय बैठक',
                'प्रदेशस्तरीय खेलकुद प्रतियोगिता हुँदै',
                'प्रदेश विधानसभामा नयाँ विधेयकमाथि छलफल',
            ),
        ),
        'literature' => array(
            'category'      => 'literature',
            'breaking'      => 'साहित्य अपडेट : कविता, कथा, उपन्यास र सांस्कृतिक कार्यक्रमका खबर',
            'section_title' => 'साहित्य विशेष',
            'sidebar_title' => 'ताजा साहित्य समाचार',
            'featured'      => 'नेपाली साहित्यको नयाँ कृति सार्वजनिक, पाठकमाझ उत्साह',
            'excerpt'       => 'नेपाली साहित्यमा नयाँ पुस्ताको उदय भइरहेको छ — कविता, कथा र उपन्यासका माध्यमले सामाजिक यथार्थ उजागर गरिँदैछ।',
            'latest'        => array(
                'राष्ट्रिय कविता महोत्सव सम्पन्न',
                'नयाँ उपन्यासले साहित्य पुरस्कार जित्यो',
                'लेखक संघको वार्षिक अधिवेशन हुँदै',
                'विद्यालयमा साहित्यिक प्रतियोगिता आयोजना',
                'नेपाली साहित्य अनुवाद विदेशमा प्रकाशित',
            ),
            'cards'         => array(
                'युवा लेखकको पहिलो कथासंग्रह सार्वजनिक',
                'पुस्तक मेलामा नेपाली प्रकाशनको बाहुल्य',
                'कविता वाचन कार्यक्रममा दर्शकको भीड',
                'साहित्यिक पत्रिकाको नयाँ अंक प्रकाशित',
                'लोककथा संरक्षणमा डिजिटल पहल',
                'साहित्य अनुसन्धान केन्द्रको स्थापना',
            ),
        ),
        'sports' => array(
            'category'      => 'sports',
            'breaking'      => 'खेलकुद अपडेट : क्रिकेट, फुटबल र राष्ट्रिय खेलका खबर',
            'section_title' => 'खेलकुद विशेष',
            'sidebar_title' => 'ताजा खेलकुद समाचार',
            'featured'      => 'नेपाली टोलीको तयारी तीव्र, आगामी प्रतियोगितामा राम्रो नतिजाको लक्ष्य',
            'excerpt'       => 'प्रशिक्षक टोलीले फिटनेस, रणनीति र युवा खेलाडीको भूमिकालाई केन्द्रमा राखेर अभ्यास अघि बढाएको छ।',
            'latest'        => array(
                'क्रिकेट टोलीको बन्द प्रशिक्षण सुरु',
                'फुटबल लिगको तालिका सार्वजनिक',
                'एथलेटिक्समा नयाँ राष्ट्रिय कीर्तिमान',
                'युवा खेलाडी छनोट प्रक्रिया अघि बढ्यो',
                'विद्यालयस्तरीय प्रतियोगिता आयोजना हुँदै',
            ),
            'cards'         => array(
                'नेपालले मैत्रीपूर्ण खेलमा जित निकाल्यो',
                'महिला टोलीको प्रदर्शनमा प्रशिक्षक सन्तुष्ट',
                'खेल पूर्वाधार सुधार गर्न बजेट माग',
                'स्थानीय क्लबहरू लिगका लागि तयारीमा',
                'मार्शल आर्ट्स खेलाडी अन्तर्राष्ट्रिय प्रतियोगितामा',
                'ग्रासरुट फुटबल कार्यक्रम विस्तार हुँदै',
            ),
        ),
    );

    return isset($sections[$section]) ? $sections[$section] : $sections['mainnews'];
}


function abcnepal_render_sample_image($seed, $size = 'large') {

    $dimensions = 'large' === $size ? '900/500' : '500/320';

    // crc32() can return negative integers; abs() preserves the unique value
    // while absint() would collapse all negatives to 0 (same image for many sections)
    printf(
        '<img src="%s" alt="">',
        esc_url('https://picsum.photos/' . $dimensions . '?random=' . abs($seed))
    );
}


function abcnepal_render_news_section($section) {

    $config = abcnepal_section_config($section);
    $category = $config['category'];
    $query_args = array(
        'posts_per_page' => 9,
    );

    if (!empty($category)) {
        $query_args['category_name'] = $category;
    }

    $news_query = new WP_Query($query_args);
    $posts = $news_query->posts;
    ?>

    <main class="container news-section news-section-<?php echo esc_attr($section); ?>">
        <div class="breaking-news">
            <span><?php echo esc_html($config['breaking']); ?></span>
        </div>

        <h1 class="main-headline">
            <?php
            if (!empty($posts)) {
                echo esc_html(get_the_title($posts[0]));
            } else {
                echo esc_html($config['featured']);
            }
            ?>
        </h1>

        <div class="news-grid">
            <article class="main-news">
                <?php if (!empty($posts)) : ?>
                    <a href="<?php echo esc_url(get_permalink($posts[0])); ?>">
                        <?php
                        if (has_post_thumbnail($posts[0])) {
                            echo get_the_post_thumbnail($posts[0], 'large');
                        } else {
                            abcnepal_render_sample_image(crc32($section . 'featured'));
                        }
                        ?>
                    </a>
                    <p class="featured-excerpt">
                        <?php echo esc_html(wp_trim_words(get_the_excerpt($posts[0]), 32)); ?>
                    </p>
                <?php else : ?>
                    <?php abcnepal_render_sample_image(abs(crc32($section . 'featured'))); ?>
                    <p class="featured-excerpt"><?php echo esc_html($config['excerpt']); ?></p>
                <?php endif; ?>
            </article>

            <aside class="side-news">
                <h3><?php echo esc_html($config['sidebar_title']); ?></h3>
                <ul>
                    <?php
                    $latest_posts = array_slice($posts, 1, 5);

                    if (!empty($latest_posts)) :
                        foreach ($latest_posts as $post_item) :
                            ?>
                            <li>
                                <a href="<?php echo esc_url(get_permalink($post_item)); ?>">
                                    <?php echo esc_html(get_the_title($post_item)); ?>
                                </a>
                            </li>
                            <?php
                        endforeach;
                    endif;

                    $latest_needed = 5 - count($latest_posts);

                    if ($latest_needed > 0) :
                        foreach (array_slice($config['latest'], 0, $latest_needed) as $headline) :
                            ?>
                            <li><?php echo esc_html($headline); ?></li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </aside>
        </div>

        <div class="category-section">
            <h2><?php echo esc_html($config['section_title']); ?></h2>
            <div class="category-grid">
                <?php
                $grid_posts = array_slice($posts, 0, 8);

                if (!empty($grid_posts)) :
                    foreach ($grid_posts as $index => $post_item) :
                        ?>
                        <article>
                            <a href="<?php echo esc_url(get_permalink($post_item)); ?>">
                                <?php
                                if (has_post_thumbnail($post_item)) {
                                    echo get_the_post_thumbnail($post_item, 'medium');
                                } else {
                                    abcnepal_render_sample_image(abs(crc32($section . $index)), 'medium');
                                }
                                ?>
                                <h3><?php echo esc_html(get_the_title($post_item)); ?></h3>
                            </a>
                        </article>
                        <?php
                    endforeach;
                endif;

                $grid_needed = max(0, 8 - count($grid_posts));

                if ($grid_needed > 0) :
                    foreach (array_slice($config['cards'], 0, $grid_needed) as $index => $headline) :
                        ?>
                        <article>
                            <?php abcnepal_render_sample_image(abs(crc32($section . 'sample' . $index)), 'medium'); ?>
                            <h3><?php echo esc_html($headline); ?></h3>
                        </article>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>

        <div class="ad-slot">
            <img src="<?php echo esc_url('https://picsum.photos/1200/150?random=' . abs(crc32($section . 'ad'))); ?>" class="ad-image" alt="">
        </div>
    </main>
    <?php

    wp_reset_postdata();
}

function register_live_update_cpt() {
    register_post_type('live_update', array(
        'labels' => array(
            'name'          => 'Live Updates',
            'singular_name' => 'Live Update',
            'add_new_item'  => 'Add New Live Update',
            'edit_item'     => 'Edit Live Update',
        ),
        'public'       => true,
        'has_archive'  => true,
        'supports'     => array('title', 'editor', 'thumbnail', 'author'),
        'menu_icon'    => 'dashicons-update',
        'show_in_rest' => true,
    ));

    register_taxonomy('update_topic', 'live_update', array(
        'labels' => array(
            'name'          => 'Update Topics',
            'singular_name' => 'Update Topic',
            'add_new_item'  => 'Add New Update Topic',
            'edit_item'     => 'Edit Update Topic',
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'update-topic'),
    ));
}
add_action('init', 'register_live_update_cpt');

add_action('wp_ajax_load_more_updates', 'load_more_updates');
add_action('wp_ajax_nopriv_load_more_updates', 'load_more_updates');

function abcnepal_get_live_update_topic_slug() {
    return isset($_GET['topic']) ? sanitize_title(wp_unslash($_GET['topic'])) : '';
}

function abcnepal_live_update_query_args($paged = 1, $topic = '') {
    $args = array(
        'post_type'      => 'live_update',
        'posts_per_page' => 5,
        'paged'          => max(1, absint($paged)),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if (!empty($topic)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'update_topic',
                'field'    => 'slug',
                'terms'    => sanitize_title($topic),
            ),
        );
    }

    return $args;
}

function abcnepal_render_live_update_card() {
    ?>
    <article class="update-box">
        <h3><?php the_title(); ?></h3>
        <div class="update-meta">
            <span class="time"><?php echo esc_html(get_the_date('M j, Y') . ' | ' . get_the_time('g:i a')); ?></span>
            <span class="update-author">
                <?php
                printf(
                    esc_html__('Updated by: %s', 'abcnepal-tv'),
                    esc_html(get_the_author())
                );
                ?>
            </span>
        </div>
        <div class="entry">
            <?php the_content(); ?>
        </div>
    </article>
    <?php
}

function load_more_updates() {
    check_ajax_referer('abc_live_update_nonce', 'nonce');

    $paged = isset($_POST['page']) ? absint($_POST['page']) : 1;
    $topic = isset($_POST['topic']) ? sanitize_title(wp_unslash($_POST['topic'])) : '';
    $args = abcnepal_live_update_query_args($paged, $topic);
    $query = new WP_Query($args);

    if($query->have_posts()) :
        while($query->have_posts()) : $query->the_post();
            abcnepal_render_live_update_card();
        endwhile;
    endif;

    wp_reset_postdata();
    wp_die();
}

// Add this to your existing functions.php
add_action('init', 'enable_post_hierarchy');
function enable_post_hierarchy() {
    add_post_type_support('post', 'page-attributes');
}
