<?php 
    include 'db-connect.php';
    include 'api_functions.php';
    include 'page-parts/header.php';
?>
<h1>Locations</h1>
<p>Total count: <?php echo $locationsCount ?></p>

<div class="card mt-4">
    <div class="card-body">
        <h3 class="card-title">#<?php echo getEntityPropDB('location', $currentId, 'id').': '.getEntityPropDB('location', $currentId, 'name') ?></h3>
        <p>Type: <?php echo getEntityPropDB('location', $currentId, 'type') ?><br />
        Dimension: <?php echo getEntityPropDB('location', $currentId, 'dimension') ?></p>
    </div>
    <div class="card-footer">
        <p><strong>Residents:</strong> <?php echo listOfCharactersByLocationDB($currentId) ?></p>
    </div>
</div>

<p class="mt-5"><?php echo navigation('id', $currentId, $locationsCount, $navigation) ?></p>

<?php include 'page-parts/footer.php' ?> 