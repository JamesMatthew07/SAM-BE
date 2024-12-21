<?php
require_once 'connect.php';

$sql = "SELECT i.*, ic.islandContentID, ic.image as contentImage, ic.content, ic.color 
        FROM islandsofpersonality i 
        LEFT JOIN islandcontents ic ON i.islandOfPersonalityID = ic.islandOfPersonalityID 
        WHERE i.status = 'active' 
        ORDER BY i.islandOfPersonalityID, ic.islandContentID";
$result = $conn->query($sql);

$islands = [];
while ($row = $result->fetch_assoc()) {
    $islandId = $row['islandOfPersonalityID'];
    if (!isset($islands[$islandId])) {
        $islands[$islandId] = [
            'info' => [
                'name' => $row['name'],
                'shortDescription' => $row['shortDescription'],
                'longDescription' => $row['longDescription'],
                'mainImage' => $row['image'],
                'color' => $row['color']
            ],
            'contents' => []
        ];
    }
    if ($row['islandContentID']) {
        $islands[$islandId]['contents'][] = [
            'image' => $row['contentImage'],
            'content' => $row['content'],
            'color' => $row['color']
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Islands of Personality</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}
body {font-family: "Open Sans"}
.content-card {
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 8px;
}
</style>
</head>
<body class="w3-light-grey">

<!-- Navigation bar with social media icons -->
<div class="w3-bar w3-black w3-hide-small">
  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-facebook-official"></i></a>
  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-instagram"></i></a>
  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-snapchat"></i></a>
  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-flickr"></i></a>
  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-twitter"></i></a>
  <a href="#" class="w3-bar-item w3-button"><i class="fa fa-linkedin"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-right"><i class="fa fa-search"></i></a>
</div>

<div class="w3-content" style="max-width:1600px">

  <!-- Header -->
  <header class="w3-container w3-center w3-padding-48 w3-white">
    <h1 class="w3-xxxlarge"><b>James Matthew Llanos</b></h1>
    <h6>Welcome to my <span class="w3-tag">Islands of Personality</span></h6>
  </header>

  <!-- Grid -->
  <div class="w3-row w3-padding w3-border">

    <!-- Blog entries -->
    <div class="w3-col l8 s12">
    
    <?php foreach ($islands as $island): ?>
      <div class="w3-container w3-white w3-margin w3-padding-large">
        <div class="w3-center">
          <h3><?php echo htmlspecialchars($island['info']['name']); ?></h3>
          <h5><?php echo htmlspecialchars($island['info']['shortDescription']); ?></h5>
        </div>

        <div class="w3-justify">
          <img src="images/<?php echo htmlspecialchars($island['info']['mainImage']); ?>" 
               alt="<?php echo htmlspecialchars($island['info']['name']); ?>" 
               style="width:100%" class="w3-padding-16">
          
          <p><strong><?php echo htmlspecialchars($island['info']['name']); ?></strong></p>
          <p><?php echo htmlspecialchars($island['info']['longDescription']); ?></p>

          <div class="w3-row-padding">
            <?php foreach ($island['contents'] as $content): ?>
              <div class="w3-col m4">
                <div class="content-card" style="background-color: <?php echo htmlspecialchars($content['color']); ?>;">
                  <img src="images/<?php echo htmlspecialchars($content['image']); ?>" 
                       alt="Content Image" style="width:100%" class="w3-margin-bottom">
                  <p class="w3-text-white"><?php echo htmlspecialchars($content['content']); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <p class="w3-left"><button class="w3-button w3-white w3-border" onclick="likeFunction(this)">
            <b><i class="fa fa-thumbs-up"></i> Like</b></button>
          </p>
          <p class="w3-clear"></p>
        </div>
      </div>
      <hr>
    <?php endforeach; ?>
    </div>

    <!-- About/Information menu -->
    <div class="w3-col l4">
      <!-- About Card -->
      <div class="w3-white w3-margin">
        <img src="images/profile.jpg" alt="James" style="width:100%" class="w3-grayscale">
        <div class="w3-container w3-black">
          <h4>James Matthew Llanos</h4>
          <p>Welcome to my Islands of Personality - a collection of experiences, memories, and aspects that make me who I am.</p>
        </div>
      </div>
      <hr>

      <!-- Tags -->
      <div class="w3-white w3-margin">
        <div class="w3-container w3-padding w3-black">
          <h4>My Islands</h4>
        </div>
        <div class="w3-container w3-white">
          <p>
            <?php foreach ($islands as $island): ?>
              <span class="w3-tag w3-light-grey w3-margin-bottom">
                <?php echo htmlspecialchars($island['info']['name']); ?>
              </span> 
            <?php endforeach; ?>
          </p>
        </div>
      </div>
      <hr>

      <!-- Follow Me -->
      <div class="w3-white w3-margin">
        <div class="w3-container w3-padding w3-black">
          <h4>Follow Me</h4>
        </div>
        <div class="w3-container w3-xlarge w3-padding">
          <i class="fa fa-facebook-official w3-hover-opacity"></i>
          <i class="fa fa-instagram w3-hover-opacity"></i>
          <i class="fa fa-snapchat w3-hover-opacity"></i>
          <i class="fa fa-pinterest-p w3-hover-opacity"></i>
          <i class="fa fa-twitter w3-hover-opacity"></i>
          <i class="fa fa-linkedin w3-hover-opacity"></i>
        </div>
      </div>
      <hr>

    <!-- END About/Intro Menu -->
    </div>

  <!-- END GRID -->
  </div>

<!-- END w3-content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-dark-grey" style="padding:32px">
  <a href="#" class="w3-button w3-black w3-padding-large w3-margin-bottom">
    <i class="fa fa-arrow-up w3-margin-right"></i>To the top
  </a>
  <p>Created by James Matthew Llanos</p>
</footer>

<script>
function likeFunction(x) {
  x.style.fontWeight = "bold";
  x.innerHTML = "✓ Liked";
}
</script>

<?php
$conn->close();
?>

</body>
</html>