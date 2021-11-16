<?php
    if (class_exists('SitePress')) {
        Arrowit_WPML::show_language_dropdown();
    }else{
        Arrowit_WPML::show_language_dropdown_demo();
    }
