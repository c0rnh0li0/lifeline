<?php
if ( in_category('product') ) {
	include 'single-product.php';
} else if ( in_category('blog') ) {
	include 'single-blog.php';	
} else {
	include 'single-default.php';}
?>