<link rel="stylesheet" type="text/css" href="./fontawesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
<script src="jquery.js"></script>
<script src="jquery-ui/jquery-ui.js"></script>
<script src='./dist/js/bootstrap.js'></script>
<style>
body {
}
</style>
<?php
	include "confidential.php";
        $id = $_GET["adminid"];
	$tablename = "person";
        $out = $con->query("SELECT * FROM ".$tablename." WHERE ".$tablename."_id=".$id);
        $row = mysqli_fetch_array($out);
	$baseurl = "";
	$action = $_GET["action"];
	echo "<input id='info' active='' user='".$_GET["adminid"]."' style='display:none'></input>";
	if( $action ) {	
		if ($action == "shop") {
            		$top_menu = "
            		<li><a href='customerpage.php?adminid=".$id."'>Home</a></li>
            		<li class='active'><a href='".$baseurl."customerShopPage.php?adminid=".$id."&action=shop'>Shop</a></li>
            		<li><a href='".$baseurl."customerItemsPage.php?adminid=".$id."&action=item'>Items</a></li>
            		<li><a href='".$baseurl."customerBillPage.php?adminid=".$id."&action=bill'>Bill</a></li>
                    <li><a href='".$baseurl."customerReturnPage.php?adminid=".$id."&action=return'>Return</a></li>
            		";	
		}
		else if($action=="item") {
                        $top_menu = "
                        <li><a href='".$baseurl."customerpage.php?adminid=".$id."'>Home</a></li>
                        <li><a href='".$baseurl."customerShopPage.php?adminid=".$id."&action=shop'>Shop</a></li>
                        <li class='active'><a href='".$baseurl."customerItemsPage.php?adminid=".$id."&action=item'>Items</a></li>
                        <li><a href='".$baseurl."customerBillPage.php?adminid=".$id."&action=bill'>Bill</a></li>
                        <li><a href='".$baseurl."customerReturnPage.php?adminid=".$id."&action=return'>Return</a></li>
                        ";
		}
		else if($action=="bill") {
                        $top_menu = "
                        <li><a href='".$baseurl."customerpage.php?adminid=".$id."'>Home</a></li>
                        <li><a href='".$baseurl."customerShopPage.php?adminid=".$id."&action=shop'>Shop</a></li>
                        <li><a href='".$baseurl."customerItemsPage.php?adminid=".$id."&action=item'>Items</a></li>
                        <li class='active'><a href='".$baseurl."customerBillPage.php?adminid=".$id."&action=bill'>Bill</a></li>
                        <li><a href='".$baseurl."customerReturnPage.php?adminid=".$id."&action=return'>Return</a></li>
                        ";
		}
        else if($action=="return"){
                    $top_menu = "
                        <li><a href='".$baseurl."customerpage.php?adminid=".$id."'>Home</a></li>
                        <li><a href='".$baseurl."customerShopPage.php?adminid=".$id."&action=shop'>Shop</a></li>
                        <li><a href='".$baseurl."customerItemsPage.php?adminid=".$id."&action=item'>Items</a></li>
                        <li><a href='".$baseurl."customerBillPage.php?adminid=".$id."&action=bill'>Bill</a></li>
                        <li class='active'><a href='".$baseurl."customerReturnPage.php?adminid=".$id."&action=return'>Return</a></li>
                        ";
        }
	}
	else {
	    $top_menu = "
            <li class='active'><a href='".$baseurl."customerpage.php?adminid=".$id."'>Home</a></li>
            <li><a href='".$baseurl."customerShopPage.php?adminid=".$id."&action=shop'>Shop</a></li>
            <li><a href='".$baseurl."customerItemsPage.php?adminid=".$id."&action=item'>Items</a></li>
            <li><a href='".$baseurl."customerBillPage.php?adminid=".$id."&action=bill'>Bill</a></li>
                   <li><a href='".$baseurl."customerReturnPage.php?adminid=".$id."&action=return'>Return</a></li>
	        ";
	}
	$header = "
<!-- Fixed navbar -->
    <nav class='navbar navbar-default' role='navigation'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand'><i class='fa fa-user'></i> Hi, ".$row['name']."</a>
        </div>
        <div id='navbar' class='collapse navbar-collapse'>
          <ul class='nav navbar-nav'>".$top_menu."
                <li><a id='give-sug'>Suggestions</a></li>
                <li><a id='give-com'>Complaints</a></li>
		<li><a id='emptycart' class='btn btn-sm' style='color: red' role='button'><i class='fa fa-exclamation-triangle'></i> Empty Cart</a></li>
          </ul>
           <ul class='nav navbar-nav navbar-right'>
              <li class='active' ><a id='toolyo' class='btn btn-sm' data-toggle='tooltip' data-placement='left' title='Logout' href='logout.php?adminid=".$_GET['adminid']."' role='button'><i class='fa fa-sign-out fa-2x'></i></a></li>
           </ul>
        </div><!--/.nav-collapse -->
    </nav>
<div id='fsuggestion' class='modal fade'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
        <h4 class='modal-title'><i class='fa fa-thumbs-up'></i> Suggestion</h4>
      </div>
      <div class='modal-body'>
        <textarea cols='65' rows='10' id='fsuggestion-text'></textarea>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        <button id='fsuggestion-save' type='button' data-dismiss='modal' class='btn btn-primary'>Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<div id='fcomplaint' class='modal fade'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
        <h4 class='modal-title'><i class='fa fa-thumbs-down'></i> Complaint</h4>
      </div>
      <div class='modal-body'>
        <textarea cols='65' rows='10' id='fcomplaint-text'></textarea>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        <button id='fcomplaint-save' type='button' data-dismiss='modal' class='btn btn-primary'>Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
";
	echo $header;
?>
<script>
$(function(){

	$("#toolyo").tooltip();

	emptyCart = function() {
                var _url = "emptyCart.php?adminid=" + $("#info").attr("user");
		$.ajax({
                        type: "GET",
                        url: _url,
                        dataType: "html",
                        }).done(function(html){
				alert(html);
                                window.location.reload();
                        });

	};
	$("#emptycart").bind('click', emptyCart);
	$("#give-sug").bind('click', function(){
		$("#fsuggestion").modal();
	});
	$("#give-com").bind('click', function(){
		$("#fcomplaint").modal();
	});
	$("#fsuggestion-save").bind('click', function(){
		_url = "accept.php?adminid=" + $("#info").attr("user") + "&type=suggestion";
		$.ajax({
			type: "POST",
			url: _url,
			dataType: "html",
			data: { "text": $("#fsuggestion-text").val() }
		}).done(function(html){
			$("#fsuggestion-text").val("");
		});
	});
        $("#fcomplaint-save").bind('click', function(){
                _url = "accept.php?adminid=" + $("#info").attr("user") + "&type=complaint";
                $.ajax({
                        type: "POST",
                        url: _url,
                        dataType: "html",
                        data: { "text": $("#fcomplaint-text").val()}
                }).done(function(html){
			$("#fcomplaint-text").val("");	
                });
        });
});
</script>
