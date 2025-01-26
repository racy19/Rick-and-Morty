<?php 
    include 'db-connect.php';
    include 'api_functions.php';
    include 'page-parts/header.php';
?>

<h3>
    Character #<?php echo $currentId.'/'.$charactersCount ?>
</h3>

<div class="card mt-4">
    <div class="card-body d-flex gap-3 p-sm-0 flex-wrap flex-sm-nowrap">
        <div>
            <img src="<?php echo getEntityProp('character', $currentId, 'image') ?>" style="max-width: 100%" />
        </div>
        <div>
            <h1 class="card-title  mb-4 mt-2">
                <?php echo getEntityPropDB('character', $currentId, 'name') ?>
            </h1>
            <p class="card-subtitle mb-2">
             <?php echo 'Species: '.getEntityPropDB('character', $currentId, 'species').'<br> '.
                    (getEntityPropDB('character', $currentId, 'type') ? 'Type: '.getEntityPropDB('character', $currentId, 'type').'<br> ' : '').
                    'Gender: '.getEntityPropDB('character', $currentId, 'gender') ?>
            </p>
            <p>
                Alive: <?php echo (getEntityPropDB('character', $currentId, 'status') === 'Alive' ? 'yes' : 
                ((getEntityPropDB('character', $currentId, 'status') === 'Dead') ? 'no' : 'unknown')) ?>
            </p>
            <p>
                Origin: <?php echo getCharactersLocationDB($currentId, 'id', true) ? '<a href="location.php?id='.getCharactersLocationDB($currentId, 'id', true).'">'.
                            getCharactersLocationDB($currentId, 'name', true).'</a>' : 'unknown' ?><br />
                Location: <?php echo getCharactersLocationDB($currentId, 'id', false) ? '<a href="location.php?id='.getCharactersLocationDB($currentId, 'id', false).'">'.
                            getCharactersLocationDB($currentId, 'name', false).'</a>' : 'unknown' ?>
            </p>
        </div>
    </div>
    <div class="card-footer">
        <p>
            <strong>Episodes:</strong> <?php echo listOfEpisodesDB($currentId) ?>
        </p>
    </div>
</div>

<p class="mt-5"><?php echo navigation('id', $currentId, $charactersCount, $navigation) ?></p>

<?php include 'page-parts/footer.php' ?>