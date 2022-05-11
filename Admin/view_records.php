<?php
session_start();
include("../connections.php");
include("nav.php");
?>

<script type = "text/javascript" src = "js/jQuery.js"></script>

<script type = "application/javascript">
    setInterval(function(){
        $('#retriever').load('retriever.php');
    }, 1000);
</script>

<div id = "retriever">
<?php
include("retriever.php");
?>
</div>