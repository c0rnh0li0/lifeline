<?php
if ( in_category('product') ) {
	include 'single-product.php';
} else if ( in_category('blog') ) {
	include 'single-blog.php';	
} else if ( in_category('akcija') ) {
	include 'single-akcija.php';	
} else if ( in_category('promotiven-set') ) {
	include 'single-promotiven-set.php';	
} else {
	include 'single-default.php';}
?>