<?php
/**
 * Put this script into plugin directory.
 */
function plugin_mathjax_init()
{
    global $head_tags;
    $head_tags[] = <<<EOF
<script type="text/x-mathjax-config">
MathJax.Hub.Config({
  tex2jax: {
    inlineMath: [['$','$'], ['\\(','\\)']],
    processEscapes: true
  },
  CommonHTML: { matchFontHeight: false },
  displayAlign: "left"
});
</script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_CHTML"></script>
EOF;

}

/**
 * #mathjax{{{
 * E = mc^2
 * }}}
 */
function plugin_mathjax_convert()
{
    $args = func_get_args();
    $body = "";
    while ($line = array_pop($args)) {
      $body .= preg_replace('/^ +/', '', $line); 
    }
    return sprintf('<div class="math">%s</div>', format_mathjax($body));
}

/**
 * &mathjax(){ E = mc^2 };
 */
function plugin_mathjax_inline()
{
    $args = func_get_args();
    $body = array_pop($args);
    return '<span class="math">' . format_mathjax($body) . '</span>';
}

function format_mathjax($body)
{
    return sprintf("\\[\n%s\n\\]", htmlspecialchars($body));
}
