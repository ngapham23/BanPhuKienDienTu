<div class="clear">

</div>
<div class="main">
  <?php
    if (isset($_GET['action'])&& $_GET['query']) {
        $tam = $_GET['action'];
        $query = $_GET['query'];
    } else {
        $tam = '';
        $query = '';
    }
    if ($tam == 'quanlydanhmucsanpham' && $query == 'them') {
        include ("Modules/quanlydanhmucsp/them.php");
        include ("Modules/quanlydanhmucsp/lietke.php");
    }elseif ($tam == 'quanlydanhmucsanpham' && $query == 'sua') {
        include ("Modules/quanlydanhmucsp/sua.php");    
    }elseif ($tam == 'quanlysanpham' && $query == 'them') {
        include ("Modules/quanlysp/them.php"); 
        include ("Modules/quanlysp/lietke.php");       
    }elseif($tam == 'quanlysanpham' && $query == 'sua') {
        include ("Modules/quanlysp/sua.php");

    }else  {
        include ("Modules/dasboard.php");
    }


    ?>
</div>