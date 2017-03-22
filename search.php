<form id='searchform' action='<?php echo $config->urls->root?>search' method='get'>
    <input placeholder="search.." type="text" name="q" maxlength="60">
</form>

<?php
if(isset($_POST['q'])){
    $search = str_word_count($_POST['q'],1);
    $i = 0;
    foreach($search as $item){
        if($i == 0){
            $q = $item;
            $i++;
        } else {
            $q = $q ."+".$item;
        }
    }
    echo $q;
}

if($page->template == "search"){
    $q = htmlspecialchars($_GET["q"]);
    $q = str_word_count($q,1);
    $i = count($q);
    $array = array();
    // Find all matches, count words
    for ($x = 0; $x < $i; $x++){
        $s = $q[$x];
        $matches = $pages->find("title|body~=$s, template=tutorials, limit=50, sort=created");
        foreach($matches as $item){
            $text = strtolower($item->get('title')) . strtolower($item->get('body'));
            $term = strtolower($q[$x]);
            $count = substr_count($text, $term);
            $s = 0;
            foreach($array as $a){
                if($a[1] == $item->id){
                    $count = $a[0] + $count;
                    unset($array[$s]);
                }
                $s++;
            }
            $array[] = array($count, $item->id);
        }
    }

    // Return results
    if (empty($array)){
        echo "<p>There's nothing here..</p>";
    } else {

        arsort($array);
        $count = count($array);
        echo "<p>Found $count articles for keywords ";
        $x=0;
        if($i > 1){
            echo $term = "<strong>$q[$x]</strong>";
            if($i > 2){
                for ($x = 1; $x < $i; $x++){
                    echo $term = ", <strong>$q[$x]</strong>";
                }
            } else {
                $x = $x + 1;
                echo $term = " and <strong>$q[$x]</strong>";
            }
        } else { echo $term = "<strong>$q[$x]</strong>"; }
        echo ".</p>";

        foreach($array as $item){
            $hit = $item[0];
            $item = $pages->get($item[1]);
            include('_tut.php');
        }

    }
}

?>
