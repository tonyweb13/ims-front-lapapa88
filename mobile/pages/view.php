<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
if(isset($_GET['view'])){
    if($_GET['view'] == "desktop"){
        $_SESSION['viewDesktop'] = true;
        header("Location: /#/");
        exit();
    }else{
        unset($_SESSION['viewDesktop']);
    }
}
?>
