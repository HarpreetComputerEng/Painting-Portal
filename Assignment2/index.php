<?php
// Load artwork data
$artworks = array();
$artworksData = file("paintings.txt");

foreach ($artworksData as $record) {
    $parts = explode("~", trim($record));
    $artworks[] = array(
        'artworkId' => $parts[0],
        'creatorName' => $parts[1],
        'artworkTitle' => $parts[2],
        'creationYear' => $parts[3],
        'dimWidth' => $parts[4],
        'dimHeight' => $parts[5],
        'cost' => $parts[6],
        'details' => $parts[7],
        'reference' => $parts[8],
        'category' => $parts[9]
    );
}

// Load creator data
$creators = array();
$creatorsData = file("artists.txt");

foreach ($creatorsData as $record) {
    $parts = explode("~", trim($record));
    $creators[] = array(
        'creatorId' => $parts[0],
        'fullName' => $parts[1],
        'origin' => $parts[2],
        'born' => $parts[3],
        'passed' => $parts[4],
        'bio' => $parts[5],
        'reference' => $parts[6]
    );
}

// Get category filter (PHP 5.3-compatible)
$chosenCategory = isset($_GET['genre']) ? $_GET['genre'] : null;

// Filter artworks by category
if ($chosenCategory) {
    $filteredArtworks = array();
    foreach ($artworks as $art) {
        if ($art['category'] === $chosenCategory) {
            $filteredArtworks[] = $art;
        }
    }
    $artworks = $filteredArtworks;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Assign2 - Home Page of Art Gallery</title>
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/text.css" />
  <link rel="stylesheet" href="css/960.css" />
  <link rel="stylesheet" href="css/assign2.css" />
</head>
<body>
<div class="container_12">
  <?php require_once("utilities/header.php"); ?>
  <div class="grid_3">
    <?php require_once("utilities/navigation.php"); ?>
  </div>

  <div class="grid_9">
    <h1>Welcome to the Art Gallery</h1>

    <?php foreach ($artworks as $artwork): ?>
      <div class="painting">
  <img src="resources/paintings/large/<?php echo $artwork['artworkId']; ?>.jpg" width="150" />

  <h2>
    <a href="singlePainting.php?id=<?php echo $artwork['artworkId']; ?>">
      <?php echo htmlspecialchars($artwork['artworkTitle']); ?>
    </a>
  </h2>

  <?php
    $creatorId = null;
    foreach ($creators as $creator) {
      if ($creator['fullName'] === $artwork['creatorName']) {
        $creatorId = $creator['creatorId'];
        break;
      }
    }
  ?>

  <p>
    <a href="singleArtist.php?id=<?php echo $creatorId; ?>">
      <?php echo htmlspecialchars($artwork['creatorName']); ?>
    </a>
  </p>
</div>
    <?php endforeach; ?>

    <?php if (empty($artworks)): ?>
      <p>No paintings found for genre:
         <?php echo htmlspecialchars($chosenCategory); ?></p>
    <?php endif; ?>
  </div>

  <div class="clear"></div>
</div>
</body>
</html>
