<?php
$newColor = get_query_var('color');
?>

<svg width="16px" height="16px" class="<?php echo $newColor; ?>" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11 2C11 1.45 10.55 1 10 1H2C1.45 1 1 1.45 1 2M11 2V8C11 8.55 10.55 9 10 9H2C1.45 9 1 8.55 1 8V2M11 2L6 5.5L1 2" stroke="<?php $newColor; ?>" stroke-linecap="round" stroke-linejoin="round"/>
</svg>