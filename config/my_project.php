<?php

	//select in the database
	$getproject=dbaselink()->prepare("SELECT * From tabs_my_project Where tabs_project = :project_id");
	$getproject->execute([
		'project_id' => 1
	]);

	$project=$getproject->fetch(PDO::FETCH_ASSOC);

	$my_project_name = $project['tabs_project_name'];
	$my_project_address = $project['tabs_project_address'];
	$my_project_title = $project['tabs_system_title'];
	$my_project_origin = $project['tabs_year_origin'];
	$my_event_image = $project['tabs_event_image'];
?>