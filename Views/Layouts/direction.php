<?php
function Direct($title, $title2, $sec1, $sec2){
    $out = '<section class="content-header">
			<h1>
			'.$title.'
			<small>'.$title2.'</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href=""><i class="fa fa-dashboard"></i>'.$sec1.'</a></li>
				<li class="active">'.$sec2.'</li>
			</ol>
		</section>';
        
    return $out;
}



