<?php
$aUsers = [
    "kwmXX001" =>
        [
            "firstname" => "Max",
            "lastname" => "Mustermann",
            "courses" => ["oop", "kos", "mmi"]
        ],
    "kwmXX002" =>
        [
            "firstname" => "Jane",
            "lastname" => "Doe",
            "courses" => ["web", "asy"]
        ]
];


foreach ($aUsers as $key => $value) {
    echo "<b>User ";
    echo "(" . $key . ")</b>"; // KEY
    echo "<br>Name: " . $value["firstname"] . " " . $value["lastname"];
    echo "<br>Courses: ";

    foreach ($value['courses'] as $key2 => $value2) { // value['...']
        echo $value2 . " ";
    }

    echo "<br><br>";
}
