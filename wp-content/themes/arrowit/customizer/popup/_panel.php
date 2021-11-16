<?php
$panel    = 'popup';
$priority = 1;
Arrowit_Kirki::add_section( 'account', array(
    'title'    => esc_html__( 'Account', 'arrowit' ),
    'panel'    => $panel,
    'priority' => $priority ++,
) );