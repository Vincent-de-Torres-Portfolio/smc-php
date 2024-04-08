<?php

namespace Utility;

use Classes\Movie;
class MovieUtility {

    /**
     * Write movie data to a CSV file.
     *
     * @param array $movies An array of Movie objects.
     * @param string $filename The name of the CSV file to write to.
     * @return bool True if writing was successful, false otherwise.
     */
    public static function writeMoviesToCSV(array $movies, string $filename): bool {
        // Open the CSV file for writing
        $file = fopen($filename, 'w');
        if (!$file) {
            return false;
        }

        // Write the header row
        fputcsv($file, ['MovieID', 'Title', 'Genre', 'Cost', 'Poster','Schedules']);

        // Write each movie as a row in the CSV file
        foreach ($movies as $movie) {
            fputcsv($file, [
                $movie->getMovieId(),
                $movie->getTitle(),
                $movie->getGenre(),
                $movie->getCost(),
                $movie->getPoster(),
                json_encode($movie->getSchedules())
            ]);
        }

        // Close the file
        fclose($file);
        return true;
    }

    /**
     * Parse movie data from a CSV file and instantiate Movie objects.
     *
     * @param string $filename The name of the CSV file to parse.
     * @return array An array of Movie objects.
     */
    public static function parseMoviesFromCSV(string $filename): array {
        $moviesData = array();
        if (($handle = fopen("movies.csv", "r")) !== false) {
            // Read each row of the CSV file
            while (($row = fgetcsv($handle)) !== false) {
                // Store movie data as an associative array
                $moviesData[] = array(
                    'movieId' => $row[0],
                    'title' => $row[1],
                    'genre' => $row[2],
                    'cost' => $row[3],
                    'poster' => $row[4],
                    'schedules' => json_decode($row[5], true)
                );
            }
            fclose($handle); // Close the CSV file
        }

        return $moviesData;
    }

    /**
     * Instantiates Movie objects from the movie data array.
     *
     * @param array $movies An array containing movie data.
     * @return array An array of Movie objects.
     */
    public static function instantiateMovies($movies) {
        $movieObjects = [];
        foreach ($movies as $movieData) {
            // Assuming $movieData is in the format [movieId, title, genre, cost, schedules]
            $movieObjects[] = new Movie(...$movieData);
        }
        return $movieObjects;
    }
}

