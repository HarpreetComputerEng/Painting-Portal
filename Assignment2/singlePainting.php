<?php

$artworkId = isset($_GET['id']) ? $_GET['id'] : null;
$artworks = array();
$artworksData = file("paintings.txt");

foreach ($artworksData as $entry) {
    $parts = explode("~", trim($entry));
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

$creators = array();
$creatorsData = file("artists.txt");

foreach ($creatorsData as $entry) {
    $parts = explode("~", trim($entry));
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

// Find the artwork
$selectedArtwork = null;
foreach ($artworks as $art) {
    if ($art['artworkId'] === $artworkId) {
        $selectedArtwork = $art;
        break;
    }
}


$creatorInfo = null;
if ($selectedArtwork) {
    foreach ($creators as $creator) {
        if ($creator['fullName'] === $selectedArtwork['creatorName']) {
            $creatorInfo = $creator;
            break;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Assign2 - Single Painting</title>
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/text.css" />
  <link rel="stylesheet" href="css/960.css" />
  <link rel="stylesheet" href="css/assign2.css" />
</head>
<body>
<div class="container_12">
  <?php require_once("utilities/header.php"); ?>
</div>

<div class="container_12 contentWhite">	
  <div class="grid_3">
    <?php require_once("utilities/navigation.php"); ?>		
  </div>
  <div class="grid_9">
    <?php if ($selectedArtwork): ?>
      <h2><?php echo htmlspecialchars($selectedArtwork['artworkTitle']); ?></h2>

      <!-- Image path fixed: use 'large' version -->
      <img src="resources/paintings/large/<?php echo $selectedArtwork['artworkId']; ?>.jpg"
           alt="<?php echo htmlspecialchars($selectedArtwork['artworkTitle']); ?>"
           width="300" />

      <p><strong>Artist:</strong> 
        <?php if ($creatorInfo): ?>
          <a href="singleArtist.php?id=<?php echo $creatorInfo['creatorId']; ?>">
            <?php echo htmlspecialchars($selectedArtwork['creatorName']); ?>
          </a>
        <?php else: ?>
          <?php echo htmlspecialchars($selectedArtwork['creatorName']); ?>
        <?php endif; ?>
      </p>

      <p><strong>Year:</strong> <?php echo htmlspecialchars($selectedArtwork['creationYear']); ?></p>
      <p><strong>Dimensions:</strong> <?php echo htmlspecialchars($selectedArtwork['dimWidth']); ?> x <?php echo htmlspecialchars($selectedArtwork['dimHeight']); ?> cm</p>

      <p><strong>Genre:</strong>
        <a href="index.php?genre=<?php echo urlencode($selectedArtwork['category']); ?>">
          <?php echo htmlspecialchars($selectedArtwork['category']); ?>
        </a>
      </p>
<p><strong>Description:</strong> <?php echo htmlspecialchars($selectedArtwork['details']); ?></p>
      <p><a href="<?php echo htmlspecialchars($selectedArtwork['reference']); ?>" target="_blank">More info on Wikipedia</a></p>
    <?php else: ?>
      <p>Painting not found.</p>
    <?php endif; ?>
  </div>
  <div class="clear"></div>
</div>
</body>
</html>
