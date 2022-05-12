<?php
///////// CUSTOM TOOLBARS FOR THE "FULL" WYSIWYG


// REMOVE UNUSED FORMAT TINYMCE
function tiny_mce_remove_unused_formats($init)
{
    // Add block format elements you want to show in dropdown
    $init['block_formats'] = 'Titre 1=h2; Titre 2=h3; Titre 3=h4; Introduction=h5; Paragraph=p;';
    return $init;
}
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats');


// Removes buttons from the first row of the tiny mce editor 
add_filter('mce_buttons', 'remove_tiny_mce_buttons_from_editor');
function remove_tiny_mce_buttons_from_editor($buttons)
{
    $remove_buttons = array(
        'hr',
        'alignleft',
        'aligncenter',
        'alignright',
        'wp_more', // read more link
        // 'forecolor', // text color
        'spellchecker',
        'dfw', // distraction free writing mode
        'wp_adv', // kitchen sink toggle (if removed, kitchen sink will always display)
    );
    foreach ($buttons as $button_key => $button_value) {
        if (in_array($button_value, $remove_buttons)) {
            unset($buttons[$button_key]);
        }
    }
    return $buttons;
}
//Removes buttons from the second row (kitchen sink) of the tiny mce editor
function remove_tiny_mce_buttons_from_kitchen_sink($buttons)
{
    $remove_buttons = array(
        'formatselect', // format dropdown menu for <p>, headings, etc
        'underline',
        'hr',
        'strikethrough',
        'alignjustify',
        'forecolor', // text color
        'pastetext', // paste as text
        'removeformat', // clear formatting
        'charmap', // special characters
        'outdent',
        'indent',
        'undo',
        'redo',
        'wp_help', // keyboard shortcuts
    );
    foreach ($buttons as $button_key => $button_value) {
        if (in_array($button_value, $remove_buttons)) {
            unset($buttons[$button_key]);
        }
    }
    return $buttons;
}
add_filter('mce_buttons_2', 'remove_tiny_mce_buttons_from_kitchen_sink');
