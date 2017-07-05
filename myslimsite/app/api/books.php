<?php 

// display all records
$app->get('/api/books', function(){

	require_once('dbconnect.php');

	$query = "select * from books order by id";
	$result = $mysqli->query($query);

	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}

	if(isset($data)){
		header("Content-Type: application/json");
		echo json_encode($data);
	}

});

// display a single row

$app->get('/api/books/{id}', function($request){

	require_once('dbconnect.php');
	$id = $request->getAttribute('id');

	$query = "select # from books where  id = $id";
	$result = $mysqli->query($query);

	$data[] = $result->fetch_assoc();

	if(isset($data)){
		header("Content-Type: application/json");
		echo json_encode($data);
	}

});

//post data and create a new record

$app->post('/api/books', function($request){

	require_once('dbconnect.php');



	$query = "INSERT INTO `books` (`book_title`, `author`, `amazon_url`) VALUES (?,?,?)";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("sss", $a, $b, $c);

	$a   = $request->getParsedBody()['book_title'];
	$b   = $request->getParsedBody()['author'];
	$c   = $request->getParsedBody()['amazon_url'];

	$stmt->execute();

});


// updating record oh the database
$app->put('/api/books/{id}', function($request){

	require_once('dbconnect.php');

	$id = $request->getAttribute('id');

	$query = "UPDATE books SET book_title = ?, author = ?, amazon_url = ? WHERE id = $id ";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("sss", $a, $b, $c);

	$a   = $request->getParsedBody()['book_title'];
	$b   = $request->getParsedBody()['author'];
	$c   = $request->getParsedBody()['amazon_url'];

	$stmt->execute();

});

// delete a record from the database


$app->delete('/api/books/{id}', function($request){

	require_once('dbconnect.php');

	$id = $request->getAttribute('id');

	$query = "delete from books where = $id ";
	$result = $mysqli->query($query);

});


// update a record on the database

$app->put('/api/books', function($request){

	$my_name = $request->getParsedBody()['my_name'];
	echo "hello this is a put request: ".$my_name;

});
