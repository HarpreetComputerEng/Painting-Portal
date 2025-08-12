<?php
$q = $_GET["q"]; // Genre

$xml = file_get_contents("Books.xml");

$xmlDoc = new DOMDocument();
$xmlDoc->loadXML($xml);

$books = $xmlDoc->getElementsByTagName('book');
$found = false;

foreach ($books as $book) {
    $genre = $book->getElementsByTagName('genre')->item(0)->nodeValue;

    if (strcasecmp($genre, $q) == 0) {
        $found = true;

        $title = $book->getElementsByTagName('title')->item(0)->nodeValue;
        $author = $book->getElementsByTagName('author')->item(0)->nodeValue;
        $price = $book->getElementsByTagName('price')->item(0)->nodeValue;
        $date = $book->getElementsByTagName('publish_date')->item(0)->nodeValue;
        $desc = $book->getElementsByTagName('description')->item(0)->nodeValue;

        echo "<p><strong>Title:</strong> $title<br>";
        echo "<strong>Author:</strong> $author<br>";
        echo "<strong>Genre:</strong> $genre<br>";
        echo "<strong>Price:</strong> $$price<br>";
        echo "<strong>Publish Date:</strong> $date<br>";
        echo "<strong>Description:</strong> $desc</p><hr>";
    }
}

if (!$found) {
    echo "<p>No books found for genre: $q</p>";
}
?>
