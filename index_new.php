<html>
    <head>Welcome to mongo test </head>
<body>
    <?php
        //phpinfo();
        //$dbhost = 'localhost';
        $dbhost = '76.10.1.23';
        $dbname = 'local';
        // Connect to test database
        $m = new Mongo("mongodb://$dbhost");
        if ($m == NULL) {
            echo "<br>nerror opening DB</br>";
        } else {
            echo "<br>mongdb conn established!!</br>";
        }
        $db = $m->$dbname;
        $c_users = $db->TweetStore;
        if ($c_users == NULL) {
            echo "<br>TweetStore collection not found</br>";
        } else {
            $c_things = $db->TweetStore;
            if ($c_things !=  NULL) {
                echo "<br>found TweetStore colelction</br>";
            }
            // Get a count of documents in the things collection
            $count_things = $c_things->count();
            echo "<br>There are $count_things documents in the things collection.</br>";

            $cursor = $c_things->find();
            foreach ( $cursor as $id => $value ) {
                echo "$id: ";
                var_dump( $value );
            }
        }
    ?>  
</body>
</html>
