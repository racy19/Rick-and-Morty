<?php     
    include 'db-connect.php';
    include 'api_functions.php';
    include 'page-parts/header.php';
?>

<h1>Characters overview:</h1>
<p>
    Total characters count: <?php echo $charactersCount ?><br />
    Get character details by clicking on its button.
</p>
<div class="d-flex flex-wrap justify-content-center gap-2 mt-5 align-items-center">
<?php echo pageNavigation() ?>
<form name="pagination" action="<?php $currentURL ?>" method="get" class="d-sm-inline mb-0">
    <label for="page">...&nbsp;or&nbsp;go&nbsp;to&nbsp;page</label>
    <input type="number" id="page" name="page" min="1" max="<?php echo $lastPage ?>" value="<?php echo $currentPage ?>">
    <input type="submit" class="btn" value="ok">
    ...&nbsp;of&nbsp;<?php echo $lastPage ?>
</form>
</div>
<div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
    <?php echo charactersOverviewDB($itemsPerPage) ?> 
</div>
<div class="d-flex flex-wrap justify-content-center gap-2 mt-5">
<?php echo pageNavigation() ?>
<form name="pagination" action="<?php $currentURL ?>" method="get" class="d-sm-inline">
    <label for="page">...&nbsp;or&nbsp;go&nbsp;to&nbsp;page</label>
    <input type="number" id="page" name="page" min="1" max="<?php echo $lastPage ?>" value="<?php echo $currentPage ?>">
    <input type="submit" class="btn" value="ok">
    ...&nbsp;of&nbsp;<?php echo $lastPage ?>
</form>
</div>

<?php include 'page-parts/footer.php' ?>