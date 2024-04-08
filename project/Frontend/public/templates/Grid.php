<?php
function renderGridItem($array)
{
    $return = '';
    foreach ($array as $item) {
        $filename = $item['filename'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $lastAccess = $item['lastAccess']; // Assuming you have this information in your array

        // You can add logic here to determine the type based on filename or any other criteria
        $type = 'file'; // For example, assuming it's a file

        $return .= '<div class="icon-wrapper"> 
                        <img src="../assets/' . $type . '.svg"/>
                        <div class="text-wrapper">
                            <h3 class="title-small-text">' . $filename . '<span class="caption-text">.' . $ext . '</span>
                                <p class="caption-text">
                                    Last Access: ' . $lastAccess . '
                                </p>
                            </h3>
                        </div>
                    </div>';
    }
    return $return;
}
include_once "header.php";
?>

<main id="icon_grid">
        <div class="grid_wrapper">
            <?php
            // Example array to be passed to renderGridItem function
//            $array = [
//                ['filename' => 'example1.txt', 'lastAccess' => '2024-02-12'],
//                ['filename' => 'example2.jpg', 'lastAccess' => '2024-02-11'],
//                ['filename' => 'example3.png', 'lastAccess' => '2024-02-10'],
//                ['filename' => 'example4.docx', 'lastAccess' => '2024-02-09'],
//                ['filename' => 'example5.pdf', 'lastAccess' => '2024-02-08'],
//                // Add more items as needed
//            ];

            // Call the renderGridItem function to generate grid items
            echo renderGridItem($array=[]);
            ?>
    </div>
</main>

<style>
    .icon-wrapper {
        display: inline-block;
        width: 200px; /* Adjust width as needed */
        margin: 10px; /* Adjust margin as needed */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .text-wrapper {
        margin-top: 10px;
    }

    .title-small-text {
        font-size: 16px; /* Adjust font size as needed */
        margin-bottom: 5px;
    }

    .caption-text {
        font-size: 14px; /* Adjust font size as needed */
        color: #666;
    }
</style>

<?php
include_once "footer.php";
?>