<?php
$selector = '';

// we use this to store the info that generates the summary of what was searched for
$summary = array(
	"blog" => $input->get->blog, 
	"lang" => $input->get->lang,
	"country" => $input->get->country, 
	"cat" => $input->get->cat, 
	"keys" => $input->get->keys, 
);

// if a blog is specified, then we limit the results to having that blog as their parent
if($input->get->blog AND $input->get->blog) {
	$blogin = $pages->get("/blog/" . $sanitizer->pageName($input->get->blog));
	if($blogin->id) {
        $selector .= "parent=$blogin->id, ";
    }
}

if($input->get->lang) {
    $item = $input->get->lang;
    $item = $pages->get("/lang/" . $sanitizer->pageName($item));
    if($item->id){
        $selector .= ", lang=$item->id";
    }
}

if($input->get->country){
    $item = $input->get->country;
    $item = $pages->get("/country/" . $sanitizer->pageName($item));
    if($item->id){
        $selector .= "country=$item->id, ";
    }
}

if($input->get->cat){
    $item = $input->get->cat;
    $item = $pages->get("/c/" . $sanitizer->pageName($item));
    if($item->id){
        $selector .= "cat=$item->id";
    }
}

if($input->get->keys){
    $item = strip_tags($input->get->keys);
    $selector .= "title|body|sum~=$item, ";
}

$selector .= "sort=title";

echo "<h1>Search results</h1>";

$search_blog = $selector .", template=blog";
$blog = $pages->find($search_blog);

$search_article = $selector .", template=article";
$article = $pages->find($search_article);

if(!$input->get->blog AND count($blog)>0){
    $ifblog = TRUE;
    echo "<h2>$blog->count matches from blogs.</h2>";
    foreach($blog as $item){
        $cat = $item->cat;
        include('_list_blog.php');
        $i++;
    }
}

if(count($article)>0){
    $ifblog = FALSE;
    if($input->get->blog){
        echo "<h2>Found $article->count matches from blog $blogin->title.</h2>";
    } else {
        echo "<h2>Found $article->count matches from articles.</h2>";
    }
    foreach($article as $item){
        $cat = $item->parent->cat;
        include('_list_blog.php');
        $i++;
    }
}
?>
