<?php     
    include 'db-connect.php';
    include 'api_functions.php';
    include 'page-parts/header.php';
?>
<h1>Episodes</h1>
<p>Total count: <?php echo $episodesCount ?></p>

<div class="card mt-4">
    <div class="card-body">
        <h3 class="card-title">#<?php echo getEntityPropDB('episode',$currentId,'id').' ( '.getEntityPropDB('episode',$currentId,'episode').' ): '.getEntityPropDB('episode',$currentId,'name') ?></h3>
        <p>Released: <?php echo getEpisodeProp($currentId, 'air_date') ?></p>
    </div>
    <div class="card-footer">
        <p><strong>Starring:</strong> <?php echo listOfCharactersByEpisodeDB($currentId) ?></p>
    </div>
</div>

<p class="mt-5"><?php echo idNavigation($episodesCount) ?></p>

<?php include 'page-parts/footer.php' ?>