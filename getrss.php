<?php
//get the q parameter from URL
$q = $_GET["q"];

//find out which feed was selected
if ($q == "algeria") {
    $xml = ("http://en.aps.dz/algeria?format=feed");
} elseif ($q == "aljazeera") {
    $xml = ("http://www.aljazeera.com/xml/rss/all.xml");
} elseif ($q == "sports") {
    $xml = ("http://en.aps.dz/sports?format=feed");
} elseif ($q == "economy") {
    $xml = ("http://en.aps.dz/economy?format=feed");
} elseif ($q == "nytimes") {
    $xml = ("http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml");
} elseif ($q == "world") {
    $xml = ("http://en.aps.dz/world?format=feed");
} elseif ($q == "health") {
    $xml = ("http://en.aps.dz/health-science-tech?format=feed");
} elseif ($q == "cnn") {
    $xml = ("http://rss.cnn.com/rss/cnn_topstories.rss");
} elseif ($q == "culture") {
    $xml = ("http://en.aps.dz/culture?format=feed");
} elseif ($q == "elwatan") {
    $xml = ("http://www.elwatan.com/sports/rss.xml");
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel = $xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
    ->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
    ->item(0)->childNodes->item(0)->nodeValue;
// $channel_desc = $channel->getElementsByTagName('description')
// ->item(0)->childNodes->item(0)->nodeValue;

// output elements from "<channel>"
echo("<div class='newsFeedContainer'><p><a href='" . $channel_link
    . "'>" . $channel_title . "</a></div>");
// echo("<br>");
// echo($channel_desc . "</p></div>");

//get and output "<item>" elements
$x = $xmlDoc->getElementsByTagName('item');
for ($i = 0; $i <= 2; $i++) {
    $item_title = $x->item($i)->getElementsByTagName('title')
        ->item(0)->childNodes->item(0)->nodeValue;
    $item_link = $x->item($i)->getElementsByTagName('link')
        ->item(0)->childNodes->item(0)->nodeValue;
    $imgs = $x->item($i)->getElementsByTagName('description')
        ->item(0)->childNodes->item(0)->nodeValue;
    preg_match('/(<img[^>]+>)/i', $imgs, $img);

    $item_desc = $x->item($i)->getElementsByTagName('description')
        ->item(0)->childNodes->item(0)->nodeValue;
    // echo ("<p><a href='" . $item_link
    // . "'>" . $item_title . "</a>");
    // echo ("<br>");
    // echo ($item_desc . "</p>");

    echo '<div class="img-figure" style="height: 77px"></div>'
        . '<div class="title">'
        . '<h1>' . $item_title . '</h1>'
        . '</div>'
        . '<div class="description">'
        . $item_desc
        . '</div>'
        . '<p class="more">'
        . '  <a href="' . $item_link . '">read more</a><i class="fa fa-angle-right" aria-hidden="true"></i>'
        . '</p>';
}
?>