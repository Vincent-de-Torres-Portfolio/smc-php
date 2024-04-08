<?php
session_start();
require_once 'autoload.php';


// Mock data for movies
$moviesData = [
    [
        "movieId" => "PVFBJO",
        "title" => "Wonka",
        "genre" => "Comedy",
        "cost" => 10,
        "poster" => "assets/poster/poster1.jpg",
        "schedules" => [
            ['theaterNumber' => 1, 'movieSchedule' => '2024-02-10'],
            ['theaterNumber' => 2, 'movieSchedule' => '2024-02-11']
        ]
    ],
    [
        "movieId" => "AJJFIO",
        "title" => "Aquaman",
        "genre" => "Sci-Fi",
        "cost" => 8,
        "poster" => "assets/poster/poster2.jpg",
        "schedules" => [
            ['theaterNumber' => 3, 'movieSchedule' => '2024-02-12'],
            ['theaterNumber' => 4, 'movieSchedule' => '2024-02-13']
        ]
    ],
    [
        "movieId" => "OPLZ92",
        "title" => "Migration",
        "genre" => "Kids",
        "cost" => 12,
        "poster" => "assets/poster/poster3.jpg",
        "schedules" => [
            ['theaterNumber' => 5, 'movieSchedule' => '2024-02-14'],
            ['theaterNumber' => 6, 'movieSchedule' => '2024-02-15']
        ]
    ]
];

// Mock data for member
$memberData = [
    "name" => "John Doe",
    "email" => "johndoe@icloud.com",
    "birthdate" => "02-01-2000",
    "memberId" => "83f7a6b2887666f3"
];
