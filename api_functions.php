<?php
// API variables
    $URL_api = "https://rickandmortyapi.com/api/";
    $URL_api_entity = [
        "character" => $URL_api . "character/",
        "location" => $URL_api . "location/",
        "episode" => $URL_api . "episode/"
    ];

    $charactersCount = json_decode(file_get_contents($URL_api_entity['character']))->{'info'}->{'count'};
    $locationsCount = json_decode(file_get_contents($URL_api_entity['location']))->{'info'}->{'count'};
    $episodesCount = json_decode(file_get_contents($URL_api_entity['episode']))->{'info'}->{'count'};
    set_time_limit(60);

// get url params
    $currentURL = $_SERVER['PHP_SELF'];
    $currentPageName = basename($currentURL);

    if (isset($_GET['page'])) {
        $currentPage = $_GET['page'];
    }
    else {
        $currentPage = 1;
    };

    if (isset($_GET['id'])) {
        $currentId = $_GET['id'];
    }
    else {
        $currentId = 1;
    };

// set characters count to display at one page
    $itemsPerPage = 8;
    $lastPage = intdiv($charactersCount, $itemsPerPage) + ($charactersCount % $itemsPerPage > 0 ? 1 : 0);

// navigation functions
    $navigation = [
        'previousPage' => [ 'page' =>  $currentPage - 1 ],
        'nextPage' => [ 'page' =>  $currentPage + 1 ],
        'previousId' => [ 'id' =>  $currentId - 1 ],
        'nextId' => [ 'id' =>  $currentId + 1 ],
    ];

    function newURL($param) {
        global $currentURL;
        $paramString = http_build_query($param);
        return htmlspecialchars($currentURL . '?' . $paramString);
    }

    function pageNavigation() {
        global $currentURL, $currentPage, $lastPage, $navigation;
        return '<div class="btn-group" role="group">'.
                ($currentPage > 1 ? ($currentPage > 2 ? 
                '<a class="btn btn-noborder" href="characters.php"> 1 &lsaquo;&lsaquo; </a>' 
                : '').'
                    <a class="btn btn-noborder" href="'.newURL($navigation['previousPage']).'">'.$navigation['previousPage']['page'].' &lsaquo; </a>' 
                : '').
                '<span class="btn btn-nolink btn-noborder"><strong>'.$currentPage.'</strong></span>'.
                ($currentPage >= $lastPage ? '': 
                '<a class="btn btn-noborder" href="'.newURL($navigation['nextPage']).'"> &rsaquo; '.$navigation['nextPage']['page'].'</a>').
                ($currentPage < $lastPage - 1 ? '<a class="btn btn-noborder" href="characters.php?page='.$lastPage.'"> &rsaquo;&rsaquo; '.$lastPage.' </a>' 
                : '').
                '</div>';
    }

    function idNavigation($lastId) {
        global $currentURL, $currentId, $navigation;
        return ($currentId > 1 ? '<a href="'.newURL($navigation['previousId']).'" class="btn rounded-pill">&lsaquo;&lsaquo; previous</a> ' : '').
                ($currentId < $lastId ? '<a href="'.newURL($navigation['nextId']).'" class="btn rounded-pill">next &rsaquo;&rsaquo;</a> ' : '');
    }

// get characters, locations, episodes from API
    // returns API URL for entity type (= character, location or episode) and id
    function entityUrl($entity, $id = null) {
        global $URL_api_entity;
        return $URL_api_entity[$entity] . ($id);
    }

    // returns property of entity with given url
    function getEntityProp($url, $prop, $subprop = null) {
        if ($subprop) {
            return json_decode(file_get_contents($url))->{$prop}->{$subprop};
        }
        return json_decode(file_get_contents($url))->{$prop};
    }

    // returns property of character with given id
    function getCharacterProp($id, $prop, $subprop = null) {
        return getEntityProp(entityUrl('character',$id), $prop, $subprop);
    }

    // returns property of location with given id
    function getLocationProp($id, $prop, $subprop = null) {
        return getEntityProp(entityUrl('location',$id), $prop, $subprop);
    }

    // returns property of episode with given id
    function getEpisodeProp($id, $prop, $subprop = null) {
        return getEntityProp(entityUrl('episode',$id), $prop, $subprop);
    }

    // returns array of episode urls of given character
    function getListOfEpisodes($characterId) {
        return getCharacterProp($characterId, 'episode');
    }

    // return badge with or without numbered entity
    function addBadge($entity, $id, $name, $number = false) {
        return '<span class="badge"><a href="' . $entity . '.php?id=' . $id . '">' . ($number ? $id . '. ' : '') . $name . '</a></span>';
    }

    // functions for listing values

    // returns card with character
    function characterItem($id) {
        return '
                <div class="card" style="width: 18rem;">
                    <img src="'.getCharacterProp($id,'image').'" class="card-img-top" alt="character image">
                    <div class="card-body pb-4">
                        <h5 class="card-title">'.
                            getCharacterProp($id,'name').
                        '</h5>
                        <p class="card-text">'.
                            getCharacterProp($id,'species').
                        '</p>
                        <a href="character.php?id='.getCharacterProp($id,'id').'" class="btn-outline rounded-pill">show me</a>
                    </div>
                </div>';
    }

    // returns list of characters
    function charactersOverview($count, $isRandom = false) {
        global $currentPage, $charactersCount;
        $listOfCharacters = '';
        for ($i = 1; $i <= $count; $i++) {
            if ($isRandom) {
                $id = rand(1, $charactersCount);
            }
            else {
                $id = $i + ($currentPage - 1) * $count;
            }
            $id <= $charactersCount ? 
            $listOfCharacters.= characterItem($id) : '';
        }
        return $listOfCharacters;
    }

    // returns list of episodes of given character
    function listOfEpisodes($characterId) {
        $list = '';
        // item represents an episode url
        foreach (getListOfEpisodes($characterId) as $item) {
            $list .= addBadge('episode', getEntityProp($item, 'id'), getEntityProp($item, 'name'), true);
        }
        return $list;
    }

    // returns list of residents on a given location or episode
    function listOfCharacters($callback) {
        $list = '';
        // callback should return array of characters urls, item represents one character url
        foreach (getListOfCharacters($callback) as $item) {
            $list .= addBadge('character', getEntityProp($item, 'id'), getEntityProp($item, 'name'));
        }
        return $list;
    }

// get characters, locations, episodes from DB
    $dbTables = [
        'character' => 'characters',
        'location' => 'locations',
        'episode' => 'episodes',
        'charactersEpisodes' => 'characters_episodes',
    ];

    $suffix = [
        'character' => 'ch',
        'location' => 'l',
        'episode' => 'e',
    ];

    // fetch data from the database
    function fetchDataDB($sql, $entity, $id) {
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':'.$entity.'_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function fetchAllDataDB($sql, $entity, $id) {
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':'.$entity.'_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // get entity property
    function getEntityPropDB($entity, $id, $prop) {
        global $dbTables, $suffix;
        $table = $dbTables[$entity];
        $prop = $prop.'_'.$suffix[$entity];
        $sql = "SELECT ".$prop." FROM ".$table." WHERE id_".$suffix[$entity]." = :character_id";

        $result = fetchDataDB($sql, 'character', $id);

        if ($result) {
            return $result[$prop];
        } else {
            return null;
        }
    }

    function getCharactersLocationDB($id, $prop, $isOrigin) {
        $isOrigin ? $id = getEntityPropDB('character', $id, 'origin') : $id = getEntityPropDB('character', $id, 'location');
        return getEntityPropDB('location', $id, $prop);
    }

    // functions for listing values
    
    // returns card with character
    function characterItemDB($id) {
        return '
                <div class="card" style="width: 18rem;">
                    <img src="'.getCharacterProp($id,'image').'" class="card-img-top" alt="character image">
                    <div class="card-body pb-4">
                        <h5 class="card-title">'.
                            getEntityPropDB('character', $id, 'name').
                        '</h5>
                        <p class="card-text">'.
                        getEntityPropDB('character', $id, 'species').
                        '</p>
                        <a href="character.php?id='.$id.'" class="btn-outline rounded-pill">show me</a>
                    </div>
                </div>';
    }

    // returns list of characters
    function charactersOverviewDB($count, $isRandom = false) {
        global $currentPage, $charactersCount;
        $listOfCharacters = '';
        for ($i = 1; $i <= $count; $i++) {
            if ($isRandom) {
                $id = rand(1, $charactersCount);
            }
            else {
                $id = $i + ($currentPage - 1) * $count;
            }
            $id <= $charactersCount ? 
            $listOfCharacters.= characterItemDB($id) : '';
        }
        return $listOfCharacters;
    }

    // returns list of episodes of given character
    function listOfEpisodesDB($character_id) {
        $sql = "SELECT e.id_e, e.name_e 
            FROM episodes e
            JOIN characters_episodes ce ON e.id_e = ce.episode_id
            WHERE ce.character_id = :character_id";
        $episodes = fetchAllDataDB($sql, 'character', $character_id);

        if ($episodes) {
            $list = '';
            foreach ($episodes as $episode) {
                $list .= addBadge('episode', $episode['id_e'], $episode['name_e'], true);
            }
            return $list;
        }
    }

    function listOfCharactersByLocationDB($location_id) {
        $sql = "SELECT c.id_ch, c.name_ch
            FROM characters c
            WHERE c.location_ch = :location_id";
        $characters = fetchAllDataDB($sql, 'location', $location_id);

        if($characters) {
            $list = '';
            foreach ($characters as $character) {
                $list .= addBadge('character', $character['id_ch'], $character['name_ch']);
            }
            return $list;
        }
    }

    function listOfCharactersByEpisodeDB($episode_id) {
        $sql = "SELECT c.id_ch, c.name_ch 
            FROM characters c
            JOIN characters_episodes ce ON c.id_ch = ce.character_id
            WHERE ce.episode_id = :episode_id";
        $characters = fetchAllDataDB($sql, 'episode', $episode_id);

        if($characters) {
            $list = '';
            foreach ($characters as $character) {
                $list .= addBadge('character', $character['id_ch'], $character['name_ch']);
            }
            return $list;
        }
    }

// functions for pexeso
    // generate 14 unique random numbers
    $characterIds = range(1, $charactersCount);
    shuffle($characterIds);
    $cardIdsHalf = array_slice($characterIds, 0, 14);
    $cardIds = array_merge($cardIdsHalf, $cardIdsHalf);
    shuffle($cardIds);

    // returns list of cards for memory game
    function pexesoCards() {
        global $cardIds;
        $pexesoContainer = '<div class="d-flex gap-1 gap-xl-2 flex-wrap">';
        foreach ($cardIds as $id) {
            $imgSrc = getCharacterProp($id, 'image');
            $pexesoContainer .= '
                <div class="card pexeso-card hidden-card" data-value="'.$id.'" >
                    <img src="'.$imgSrc.'" class="card-img-top" style="width: 100%" />
                </div>
            ';
        }
        $pexesoContainer .= '</div>';
        return $pexesoContainer;
    }
?>