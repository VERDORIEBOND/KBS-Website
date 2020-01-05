<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" >

<?php
include "connection.php";
include "functions.php";
include "index.php";

?>

</head>
<body>



<div align="center" style="background: #000000; padding: 50px;">
    <i class="fa fa-star fa-2x" data-index="0" ></i>
    <i class="fa fa-star fa-2x" data-index="1"></i>
    <i class="fa fa-star fa-2x" data-index="2"></i>
    <i class="fa fa-star fa-2x" data-index="3"></i>
    <i class="fa fa-star fa-2x" data-index="4"></i>

</div>

<script
    src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">

</script>
    <script>
        var ratedIndex = -1;

        $(document).ready(function () {
            resetStarColors();

            if (localStorage.getItem('ratedIndex') != null)
                setStars(parseInt(localStorage.getItem('ratedIndex')));

            $('.fa-star').on('click', function () {
                ratedIndex = parseInt($(this).data('index'));
                localStorage.setItem('ratedIndex', ratedIndex)
            });

            $('.fa-star').mouseover(function () {
                resetStarColors();

                var currentIndex = parseInt($(this).data('index'));

                setStars(currentIndex);
            });
            $('.fa-star').mouseleave(function () {
                resetStarColors();

                if (ratedIndex != -1)
                    setStars(ratedIndex);
            });

            function setStars(max) {
                for (var i = 0; i <= max; i++)
                    $('.fa-star:eq(' + i + ')').css('color', 'purple');

            }


            function resetStarColors() {
                $('.fa-star').css('color', 'white');

            }
        });
    </script>





</body>
</html>
