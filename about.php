<?php     
    include 'api_functions.php';
    include 'page-parts/header.php';
?>

<div class="d-flex flex-wrap flex-lg-nowrap gap-5">
<div style="max-width: 600px">
    <h2 id="about-app">About app - developer insight</h2>
    <p>Here you can find a database of characters from the show Rick and Morty. You can browse a list of characters divided into pages. By clicking on a specific character, you will see their details, including links to locations and episodes in which they appeared. Each episode and location also contains links to the characters associated with them.</p>
    <h3>Data source and backend</h3>
    <p>The application is based on PHP. The data source is the <a href="https://rickandmortyapi.com/">Rick and Morty API</a>, which provides information in JSON format.
    This data was processed and stored locally in a MySQL database.</p>
    <h3>Future improvements</h3>
    <p>I plan to create search and filtering options for characters, locations, and episodes because the database of characters is quite large, making it difficult to quickly find specific information. Searching and filtering will enhance interactivity and user experience. I also want to improve some design features. Additionally, I want to improve the memory game.</p>
    <h3>Previous steps in the development of the application.</h3>
    Originally, the application was directly connected to the API in real time. However, the number of API requests was slowing down the pages. Therefore, I decided to store the data in a database.
</div>
<div class="text-center">
    <img src="img/rick-morty-series.jpg" style="width:100%; max-width=400px" />
</div>
</div>
<div>
    <h2 id="series">About the show Rick and Morty</h2>
    <p>More information will be added later. For now you can check <a href="https://www.imdb.com/title/tt2861424/">
            Rick and Morty</a> on IMDb.</p>
</div>

<?php include 'page-parts/footer.php' ?>