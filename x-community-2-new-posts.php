<?php
widget_css();

$icon_url = widget_data_url( $widget_config['code'], 'icon' );

$file_headers = @get_headers($icon_url);

if( $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $icon_url = x::url()."/widget/".$widget_config['name']."/img/new.gif";
}

if( $widget_config['title'] ) $title = $widget_config['title'];
else $title = "조회수가 많은 글";

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 10;

$posts = g::posts(
	array(
		'domain'=>etc::domain(),
		'limit'=> $limit
	)
);
?>

<link rel='stylesheet' type='text/css' href='<?=x::url_theme()?>/css/new.posts.css' />
<div class='new-posts'>
	 <div class='title'>
		<img class='new-post-icon' src='<?=$icon_url?>' />
		<?=$title?>
	 </div>
	 <?php
	 $dot_url = x::url_theme().'/img/dot.gif';
	 
	 if ( $posts ) {
		foreach ( $posts as $p ) {
			$url = G5_BBS_URL."/board.php?bo_table=$p[bo_table]&wr_id=$p[wr_id]";
			$new_subject = conv_subject( $p['wr_subject'], 14, '...');					
			echo "
					<div class='row'>
						<img class='dot-icon' src='$dot_url'/><a href='$url'>$new_subject</a>
					</div>
			";

		}
	  }
	  else {?>
		<div class='row'>
			<img class='dot-icon' src='<?=$dot_url?>'/>
			<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=5'>사이트 만들기 안내</a>
		</div>
		<div class='row'>
			<img class='dot-icon' src='<?=$dot_url?>'/>
			<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=4'>블로그 만들기</a>
		</div>
		<div class='row'>
			<img class='dot-icon' src='<?=$dot_url?>'/>
			<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=3'>커뮤니티 사이트 만들기</a>
		</div>
		<div class='row'>
			<img class='dot-icon' src='<?=$dot_url?>'/>
			<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=2'>여행사 사이트 만들기</a>
		</div>
		<div class='row'>
			<img class='dot-icon' src='<?=$dot_url?>'/>
			<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=1'>(모바일)홈페이지, 스마트폰 앱</a>
		</div>
	<?}?>
</div>
