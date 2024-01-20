<?php

require_once 'database.php';
require_once 'seed-text.php';
require_once 'functions.php';

$connect = Database::createConnection();
$connect->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

$queryTables = "SHOW TABLES";
    
$doQuery = mysqli_query($connect, $queryTables);

$tables = [];

while ($table = mysqli_fetch_assoc($doQuery)) {
    $headerName = "Tables_in_".MYSQL_DATABASE;
    $tables[] = $table[$headerName];
}

// sometimes this will be useful
// $tables = array_reverse($tables);

$i = 1;

echo $seedBegin;

foreach ($tables as $table) {

    if($table == "_prisma_migrations")
        continue;

    $query = "SELECT * FROM $table;";
    $doQuery = mysqli_query($connect, $query);

    $queryColumns = "SHOW COLUMNS FROM $table;";
    $doQueryColumns = mysqli_query($connect, $queryColumns);
    $columns = [];

    while ($column = mysqli_fetch_assoc($doQueryColumns)) {
        $field = $column['Field'];
        $columns[$field] = $column['Type'];
    }

    while ($row = mysqli_fetch_assoc($doQuery)) {
        $begin = true;

        foreach($row as $key => $value){

            if($begin){
            echo "<br>const $table$i = await prisma.$table.upsert({";
            
            if($columns[$key] == "int(11)")
                echo "where: { $key: $value },";
            else
                echo "where: { $key: '$value' },";

                echo "update: {},
                create: {";
            $begin = false;
            }

            if (is_null($value)){
                echo "$key: null,";
            } else if($columns[$key] == "int(11)")
                echo "$key: $value,";
            else if($columns[$key] == "tinyint(1)"){
                $value = returnBoolean($value);
                echo "$key: $value,";
            } else if($columns[$key] == "timestamp"){
                $value = returnDate($value);
                echo "$key: '$value',";
            } else {
                $value = str_replace("'", "\'", $value);
                echo "$key: '$value',";
            }
        
    }
    echo "
        },
      }
    )
  ";
  $i++;
}

}

echo $seedEnd;