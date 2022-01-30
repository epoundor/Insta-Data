<?php

//Récupère les infos en ligne depuis internet
$response = file_get_contents("https://www.instagram.com/mister_juicy.co?__a=1");
//Serializer les données en json pour le décoder
$data = json_decode($response,true);
//Récuperer les infos importantes
$username=$data['graphql']['user']['username'];
$full_name=$data['graphql']['user']['full_name'];
$numFollowers=$data['graphql']['user']['edge_followed_by']['count'];
$numPhoto=$data['graphql']['user']['edge_owner_to_timeline_media']["count"];
$bio=$data['graphql']['user']['biography'];
$category=$data['graphql']['user']['category_enum'];
$photo=$data['graphql']['user']['profile_pic_url_hd'];
file_put_contents('photo.jpg',file_get_contents($photo));
$numLike=0;
//Récupère tous les posts 
// accède aux nbr de likes
//faire la moyenne 
foreach (($data['graphql']['user']['edge_owner_to_timeline_media']["edges"]) as $key => $value) {
  $numLike+=$value["node"]["edge_liked_by"]["count"];
};
$numLike/=12;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- displays site properly based on user's device -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
  
  <title>Profile-card-component-main</title>

  <!-- Feel free to remove these styles or customise in your own stylesheet 👍 -->
  
</head>
<body>
  <main col-5>
    <div class="pattern"><img class="" src="images/bg-pattern-card.svg" alt=""></div>
    <div class="image" ><img width="114px" src="photo.jpg" alt=""></div>
    <div class="details d-flex flex-column"><p><?=$username?> ~<span class="gray" style="font-size: 18px;"> <?=$full_name?></span></p><div class="gray"><?=$category?></div></div>
 
    <hr>
<div class="d-flex stats">
  <div class="d-flex flex-column" > <span data-toformat="<?=round($numFollowers)?>"></span><div class="gray"> Followers</div></div>

  <div class="d-flex flex-column" > <span data-toformat="<?=round($numLike)?>"></span> <div class="gray"> Likes Moyens</div></div>

  <div class="d-flex flex-column" > <span data-toformat="<?=round($numPhoto)?>"></span> <div class="gray">Photos</div></div>
</div>
  
  </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
<script src="main.js"></script>
</html>
