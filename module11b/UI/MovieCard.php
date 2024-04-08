<?php

namespace UI;

class MovieCard
{
    public static function generateMovieCard($movieTitle, $movieID, $genre, $posterURL, $schedule, $cost)
    {
        return "
            <div class=\"movie-container\">
                <div class='movie-wrapper'>
                    <div class=\"movie-poster\">
                        <img src=\"$posterURL\" alt=\"$movieTitle Poster\">
                    </div>
                    <div class=\"movie-details\">
                        <div class='detail-wrapper'>
                            <p class='caption-text'>$movieID</p>
                            <h2 class='title-small-text'>$movieTitle</h2>
                            <fieldset>
                                <p class='caption-text'>Genre: $genre</p>
                                <p class='caption-text'>Schedule: $schedule</p>
                            </fieldset>
                        </div>
                        <h2 class='title-small-text'>$$cost.00</h2>
                    </div>
                </div>
                <div class='movie-form'>
                    <form action=\"index.php\" method=\"GET\">
                        <input type=\"hidden\" name=\"action\" value=\"addToCart\">
                        <input type=\"hidden\" name=\"movie_id\" value=\"$movieID\">
                        <select class='button' id=\"ticket_type\" name=\"ticket_type\">
                            <option value=\"GENERAL\">General Admission</option>
                            <option value=\"STUDENT\">Student</option>
                            <option value=\"CHILD\">Child</option>
                            <option value=\"SENIOR\">Senior</option>
                        </select>
                        <fieldset class='form-submit'>
                            <input class='button' type=\"number\" id=\"quantity\" name=\"quantity\" min=\"1\" max=\"10\" value='1'><br>
                            <input class='button' type=\"submit\" value=\"Add\">
                        </fieldset>
                    </form>
                </div>
            </div>
        ";
    }
}
