<?php
	if ($this->parent->id==1){
		$isRoot = 1;
	} else { 
		$isRoot = 0; 
	}

	$oGallery = new Gallery();

	$count = 0;
	if ($isRoot==1){
		// album cover
		$albums = Record::query("select a.page_id, a.id, a.name as album_name from wolf_album a,wolf_page p where a.id=p.id AND a.status='1' group by a.id order by p.position asc");
	} else {
	    // loop photos
		$albums = Record::query("select a.page_id, a.id, a.name as album_name,g.* from wolf_gallery g inner join wolf_album a on a.id=g.album_id AND a.status='1' AND a.page_id='".$this->id."' where g.status='1' order by g.sequence asc, g.id desc");
	}

	while($album=$albums->fetchObject()){
		$count++;

		//Album cover
		$cover = Record::findOneFrom("Gallery","status='1' and album_id='".$album->id."' order by sequence asc LIMIT 1");
		if ($isRoot==1){
			$url = Page::urlById((int)$album->page_id);
			$img_src = $cover->filename!="" ? URL_PUBLIC.'public/gallery/images/'.$album->id.'/'.$cover->filename : THEME_PATH.'js/gallery/broken_image.jpg';
			echo '<div class="album-cover">
					<div><a href="'.$url.'">
						<img id="cover'.$album->id.'" src="'.$img_src.'" border=0>
					</a></div>
					<p>'.$album->album_name.'</p>
				</div>
			';
		} else { //Link that triggers the popup
			$img_src = $album->filename!= "" ? URL_PUBLIC.'public/gallery/images/'.$album->album_id.'/'.$album->filename : THEME_PATH.'js/gallery/broken_image.jpg';
			echo '<div class="album-cover">
				<div><a href="'.URL_PUBLIC.'public/gallery/images/'.$album->album_id.'/'.$album->filename.'" rel="photo['.$album->album_id.']">
						<img id="cover'.$album->album_id.'" src="'.$img_src.'" alt="" border=0>
				</a></div>
				<p>'.$album->title.'</p>
			</div>';
		}

	}

?>
	<div class="clear"></div>
	<script type="text/javascript" charset="utf-8">
		initgallery();

		function initgallery(){
			if (isMobileMode()){
				//if (typeof window.orientation != 'undefined' || window.innerWidth <= 600){
				$(document).ready(function(){
					if ($("#gallery a[rel^='photo']").length){
						$("a[rel^='photo']").unbind('click');
						$("#gallery a[rel^='photo']").photoSwipe();
					}
				});
			}
			else {
				$("#gallery a[rel^='photo']").unbind('click');
				$("a[rel^='photo']").prettyPhoto({
					animationSpeed: 'normal', /* fast/slow/normal */
					opacity: 0.60, /* Value between 0 and 1 */
					showTitle: false, /* true/false */
					hideflash: true,
					social_tools: false
				});
			}
		}

		$( window ).resize(function() {
			initgallery();
		});
	</script>




