<?php 

class layout {

    public static function show($page) {

        include_once('./includes/components/navbar.php');

        include_once('./pages/'.$page.'.php');

        include_once('./includes/components/footer.php');
        
    }

}
