<?php
add_shortcode('get_current_language', 'polylang_get_lang');
function polylang_get_lang()
{
  return pll_current_language('slug');
}
