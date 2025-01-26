<?php
include 'db-connect.php';
include 'api_functions.php';
set_time_limit(4800);

for($i = 1; $i <= $charactersCount; $i++) {
    $sql = "INSERT INTO characters (id_ch, name_ch, species_ch, type_ch, gender_ch, status_ch, origin_id, location_id) 
            VALUES (:id_ch, :name_ch, :species_ch, :type_ch, :gender_ch, :status_ch, :origin_id, :location_id)";
    $stmt = $conn->prepare($sql);

    $name_ch = getCharacterProp($i, 'name');
    $species_ch = getCharacterProp($i, 'species');
    $type_ch = getCharacterProp($i, 'type') ? getCharacterProp($i, 'type') : null;
    $gender_ch = getCharacterProp($i, 'gender');
    $status_ch = getCharacterProp($i, 'status');
    $origin_id = getEntityProp(getCharacterProp($i, 'origin','url'), 'id') ? getEntityProp(getCharacterProp($i, 'origin','url'), 'id') : null;
    $location_id = getEntityProp(getCharacterProp($i, 'location','url'), 'id') ? getEntityProp(getCharacterProp($i, 'location','url'), 'id') : null;

    $stmt->bindParam('id_ch', $i);
    $stmt->bindParam('name_ch', $name_ch);
    $stmt->bindParam('species_ch', $species_ch);
    $stmt->bindParam('type_ch', $type_ch);
    $stmt->bindParam('gender_ch', $gender_ch);
    $stmt->bindParam('status_ch', $status_ch);
    $stmt->bindParam('origin_id', $origin_id);
    $stmt->bindParam('location_id', $location_id);

    if ($stmt->execute()) {
        echo "Character nr.".$i."successfully added to database!";
    } else {
        echo "Error: character not saved.";
    }
}

for($i = 1; $i <= $locationsCount; $i++) {
    $sql = "INSERT INTO locations (id_l, name_l, type_l,dimension_l) 
            VALUES (:id_l, :name_l, :type_l, :dimension_l)";
    $stmt = $conn->prepare($sql);

    $name_l = getLocationProp($i, 'name');
    $type_l = getLocationProp($i, 'type');
    $dimension_l = getLocationProp($i, 'dimension');

    $stmt->bindParam('id_l', $i);
    $stmt->bindParam('name_l', $name_l);
    $stmt->bindParam('type_l', $type_l);
    $stmt->bindParam('dimension_l', $dimension_l);
}

for($i = 1; $i <= $episodesCount; $i++) {
    $sql = "INSERT INTO episodes (id_e, name_e, air_date_e, episode_e) 
            VALUES (:id_e, :name_e, :air_date_e, :episode_e)";
    $stmt = $conn->prepare($sql);

    $name_e = getEpisodeProp($i, 'name');
    $air_date_e = getEpisodeProp($i, 'air_date');
    $episode_e = getEpisodeProp($i, 'episode');

    $stmt->bindParam('id_e', $i);
    $stmt->bindParam('name_e', $name_e);
    $stmt->bindParam('air_date_e', $air_date_e);
    $stmt->bindParam('dimension_l', $episode_e);
}

for($i = 1; $i <= $charactersCount; $i++) {
    $sql = "INSERT INTO characters_episodes (character_id, episode_id)
            VALUES (:character_id, :episode_id)";
    $stmt = $conn->prepare($sql);

    $listOfEpisodes = getListOfEpisodes($i);
    foreach ($listOfEpisodes as $item) {
        $stmt->bindParam('character_id', $i);
        $stmt->bindParam('episode_id', getEntityProp($item, 'id'));
    }
}

?>