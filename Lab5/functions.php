<?php


/*
		TABLES:
		
	SITES: site_id, site, date;
	SITELINKS: site_id, link;




*/



function checkForUniqueURL($db,$urlEntry) {
	
	global $db;
	$sql = $db->prepare("SELECT * FROM sites where site = :urlEntry");
	$sql->bindParam(':urlEntry', $urlEntry, PDO::PARAM_STR);
	$sql->execute();
	$urls = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	$count = count($urls);
	
	return $count;

}//function checkForUniqueURL() CLOSE

function submitURL($urlEntry) {
	
	
	$errorMessage = "";
	global $db;
	$count = checkForUniqueURL($db,$urlEntry);
	//$uniqueUrlCheck = checkForUniqueURL($db,$urlEntry);
	
	
	//checking to see if url is entered
	if(!isset($urlEntry) || !preg_match('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/',$urlEntry)) {
		$errorMessage = "Please enter a valid URL.";
	} //if $urlEntry is null error CLOSE
	
	elseif($count > 0)
	{
		 $errorMessage = "This website is already in the database";
		 
	}//not a unique url CLOSE
// -------------------url is valid and unique----------------------------------

	else 
	{
	$file = file_get_contents($urlEntry);
	$arrayOfLinks = [];
	
	
	if(preg_match_all('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $file, $matches, PREG_OFFSET_CAPTURE));
		{
			$lastID = addSite($db,$urlEntry);
			
			foreach($matches as $match)
			{
				foreach($match as $innerMatch)
				{
					array_push($arrayOfLinks, $innerMatch[0]);
				}//foreach arrayoflinks CLOSE
			}//foreach matches CLOSE
			
		}//if pregmatchall CLOSE 
		
		$noDuplicatesArray = [];
		$noDuplicatesArray = array_unique($arrayOfLinks);
		//var_dump($noDuplicatesArray);
		
		$body = "<h2>Success! " . $urlEntry . " has been added to the database, along with these links: </h2>";
		$body .= "<ul>";
		foreach($noDuplicatesArray as $innerNoDuplicates)
		{
			addLinks($db, $lastID, $innerNoDuplicates);
			$body .= "<li>" . $innerNoDuplicates . "</li>";
			
		}
		$body .= "</ul>";
	
	}//else url is valid and unique CLOSE()
	echo $errorMessage;
	echo $body;
	//var_dump($lastID);
}//function submitURL() CLOSE


function addSite($db,$site) {
	
	try {
		$sql = $db->prepare("INSERT INTO sites VALUES (null, :site, NOW())");
		$sql->bindParam(':site',$site);
		$sql->execute();
		
		//grabbing last inserted id
		$lastId = $db->lastInsertId();
		return $lastId;
		
	}
	
	catch(PDOException $e){
		die("There was a problem adding the record.");
	}
}//addSite CLOSE

function addLinks($db, $site_id, $link) {
	
	$sql = $db->prepare("INSERT INTO sitelinks VALUES (:site_id, :link)");
	$sql->bindParam(':site_id', $site_id, PDO::PARAM_INT);
	$sql->bindParam(':link', $link);
	$sql->execute();
	
	
}//addLinks() CLOSE

function siteListingDropDown($db) {
	
	$sql = $db->prepare("SELECT * from sites");
	$sql->execute();
	
	$result = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	$siteLinks = [];
	
	foreach($result as $siteLink) {
		array_push($siteLinks, $siteLink);
		
	}
	return $siteLinks;
	
	
	
}//siteListingDropDown

function getCaption($db, $siteSelection) {
	
	$sql = $db->prepare("SELECT * FROM sites WHERE sites.site_id = :siteSelection");
	$sql->bindParam(':siteSelection', $siteSelection, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
	
}

function getLinks($db, $siteSelection) {
	
	$sql = $db->prepare("SELECT * FROM sitelinks WHERE sitelinks.site_id = :siteSelection");
	$sql->bindParam(':siteSelection', $siteSelection, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
	echo $results;
	
}

/*function getLinks($db, $siteSelection) {
	
	$sql = $db->prepare("SELECT * FROM sitelinks WHERE sitelinks.site_id = :siteSelection");
	$sql->bindParam(':siteSelection', $siteSelection, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	$table ="<table>";
	
	foreach($results as $siteLink)
		{
			$table .= "<tr><td><a href='" . $siteLink['link'] . "' target='popup'></a></td></tr>\n";
		}
	$table .= "</table>";
	
	return $table;
	
}*/
?>