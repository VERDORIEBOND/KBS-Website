<form id="aantalMenu<?= $key?>" action="winkelmand.php" method="get">
    <div class="form-group">

        <select name="aantal" style="width 100px; height: 38px; border-radius: 5px" onchange="document.getElementById('aantalMenu<?= $key?>').submit();">
            <?php

            for ($i = 1; $i <= 100; $i++) {
                if ($i == $value){
                    print "<span>" . "<option selected value='$i'>$i</option>" . "</span>";
                }else{
                    print "<span>" . "<option value='$i'>$i</option>" . "</span>";
                }
            }
            ?>
        </select>
        <input type="hidden" name="productID" value="<?php print($key) ?>">
    </div>
</form>