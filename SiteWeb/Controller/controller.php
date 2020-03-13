<?php
    require('model/manager.php');

    function Homepage()
    {
        $currentPage = "Home";
        require('view/viewHome.php');
    }
?>