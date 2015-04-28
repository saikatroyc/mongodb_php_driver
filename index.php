<html>
    <head>Welcome to mongo test </head>
<body>
    <?php
        //phpinfo();
        $dbhost = 'localhost';
        $dbname = 'test';
        // Connect to test database
        $m = new Mongo("mongodb://$dbhost");
        if ($m == NULL) {
            echo "<br>nerror opening DB</br>";
        } else {
            echo "<br>mongdb conn established!!</br>";
        }
        $db = $m->$dbname;
	
	/*
	{

		"first_name" : "MongoDB",
		"last_name" : "Fan",
		"tags" : ["developer","user"]
	}*/
        // Get the users collection
        $c_users = $db->user;
       	if ($c_users == NULL) {
		echo "<br>user collection not found</br>";
	} else { 
        	// Insert this new document into the users collection
        	//$c_users->save($user);
		$user = array(
		'first_name' => 'MongoDB',
		'last_name' => 'Fan'
		);

		$user = $c_users->findOne($user);
		//$user = $c_users->find();
		//var_dump($user);
	}

	/*
	one =   {
	  "string" : "This is not my beautiful house",
	  "number" : 42,
	  "boolean" : true,
	  "list" : ["one", "two", "three"],
	  "doc" : {"one" : 1, "two" : 2}
	};
	db.things.save(one);
	two = {
	  "string" : "This is not my beautiful wife",
	  "number" : 666,
	  "boolean" : false,
	  "list" : [1, 2, 3],
	  "doc" : {"1" : "one", "2" : "two"}
	};
	db.things.save(two);
	three = {
	  "string" : "Same as it ever was",
	  "number" : 117,
	  "boolean" : true,
	  "list" : ["one", "two", "four"],
	  "doc" : {"one" : 1, "four" : 4}
	};
	db.things.save(three);
	*/	
	// Get the users collection
	$c_things = $db->things;
	if ($c_things !=  NULL) {
		echo "<br>found things colelction</br>";
	}
	// Get a count of documents in the things collection
	$count_things = $c_things->count();
	echo "<br>There are $count_things documents in the things collection.</br>";

	// How many have the boolean property set to true?
	$count_things = $c_things->count(array('boolean' => true));
	echo "<br>There are $count_things true documents in the things collection</br>";


	// How many have a list property with array values including "one" and "two"?
	$count_things = $c_things->count(array('list' => array('$in' => array('one','two'))));
	echo "<br>There are $count_things documents with 'one' and 'two' as list array values in the things collection</br>";

	// How many have a list property with array values not including 'three'?
	$count_things = $c_things->count(array('list' => array('$nin' => array('three'))));
	echo "<br>There are $count_things documents not including the string 'three' in list array values in the things collection.</br>";

	// How many have include 'ever was' in the string property? Using a regular expression:
	$regex = new MongoRegex("/ever was/");
	//$regex = new MongoRegex("/ house /");
	$count_things = $c_things->count(array('string' => $regex));
	echo "<br>There are $count_things documents including the string 'ever was' in string property in the things collection.</br>";
    
	// Find a document that includes 'ever was' in the string property using a regular expression:
	$ever_was = $c_things->findOne(array('string' => $regex));
	var_dump($ever_was);
?>  
</body>
</html>
