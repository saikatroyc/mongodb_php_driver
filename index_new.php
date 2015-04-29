<?php
header('Content-Type: application/json');
    if ( isset($_POST['username'])  && isset($_GET['type']) ) {
        //echo "Welcome ". $_POST['name']. "<br />";
        //echo "You are ". $_POST['age']. " years old.";
        //exit();
        getNews();
    }
?>
    <?php
        //phpinfo();
        //$dbhost = 'localhost';

        //getNewsCount();
        getNews();
        function connect() {
            $dbhost = '76.10.1.23';
            $dbname = 'local';
            // Connect to test database
            $m = new Mongo("mongodb://$dbhost");
            return $m;
        }

        function getNewsCount() {
            $dbname = 'local';
        $m = connect();
        if ($m == NULL) {
            echo "<br>nerror opening DB</br>";
        } else {
            echo "<br>mongdb conn established!!</br>";
        }
        $db = $m->$dbname;
        $c_users = $db->TweetStore;
        $count_things = 0;
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
        }
            return $count_things;
        }
        
        function getNews() {
            $dbname = 'local';
        $m = connect();
        if ($m == NULL) {
            echo "<br>nerror opening DB</br>";
        } else {
            //echo "<br>mongdb conn established!!</br>";
        }
        $db = $m->$dbname;
        $c_users = $db->TweetStore;
        if ($c_users == NULL) {
            echo "<br>TweetStore collection not found</br>";
        } else {
            $c_things = $db->TweetStore;
            if ($c_things !=  NULL) {
                //echo "<br>found TweetStore colelction</br>";
            }
            $cursor = $c_things->find();
            $count = 1;
            echo "[";
            foreach ( $cursor as $id => $value ) {
                //if ( $count == 20 ) break;
                echo json_encode($value);
                echo ",";
                $count++;
                //var_dump( $value );
            }
            echo "{}";
            echo "]";
        }
//        return json_encode($cursor);

        }
    ?>  
