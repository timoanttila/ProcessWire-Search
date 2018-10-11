<form action="/search" method="get">
	<input name="q" type="search" placeholder="Keywords.."/>
	<button id="find" type="submit">
</form>
<?php
/* @author: Timo Anttila <info@tuspe.com> || Powered by ProcessWire! */
$search = $sanitizer->text($input->get->q);
$search = preg_replace("/[^A-Öa-ö0-9-_ ]/", "", $search);
$item = $pages->find("template=product, title|body|sku%=$search");
if($item->first->id){
	$c .= "<h1>Hakusanalla \"$search\" löytyi $item->count hakutulosta.</h1>";
	foreach($item as $item) echo "<a class='block' href='$item->url'>$item->title</a>";
} else echo "Hakusanalla \"$search\" ei löytynyt tuloksia.";
