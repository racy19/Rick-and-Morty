<script>
    function reloadAndScroll() {
        const targetId = "random-characters";
        location.href = "#" + targetId;
        location.reload();
    }
</script>
<h2 id="random-characters">Random Characters:</h2>
<div class="text-center text-xxl-start">
<span class="btn rounded-pill mt-3 mt-sm-5" onclick="reloadAndScroll()">randomize!</span>
</div>
<div class="d-flex flex-wrap gap-3 justify-content-center mt-4 mt-sm-5">
    <?php echo charactersOverviewDB(4, true) ?> 
</div>
<div class="text-center text-xxl-start">
<a href="characters.php" class="btn rounded-pill mt-5">show more characters!</a>
</div>