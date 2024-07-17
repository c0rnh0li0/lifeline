<?php
if ( in_category('product') ) {
	include 'single-product.php';
} else if ( in_category('blog') || in_category('blog-en') ) {
	include 'single-blog.php';	
} else if ( in_category('akcija') || in_category('discounts') ) {
	include 'single-akcija.php';	
} else if ( in_category('promotiven-set') || in_category('blog-en') ) {
	include 'single-promotiven-set.php';	
} else {
	include 'single-default.php';}
?>