<html>
<body>
<main>
    <div class="section">
        <div class="container">
            <?php
            $numbers = array(array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0));
            echo '<table><tr>';
            for ($i = 0; $i < 5; $i++) {
                for ($j = 0; $j < 10; $j++) {
                    $numbers[$i][$j] = rand(0, 20);
                    echo '<th class="tg-29b9">' . $numbers[$i][$j] . '</th>';
                }
                echo '</tr>';
            }
            echo '</table>';
            ?>
        </div>
    </div>
</main>
</body>
</html>
