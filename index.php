<!DOCTYPE html>
<html lang="en">
<head>
  <title>Supply Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--favicons-->
<link rel="apple-touch-icon" sizes="57x57" href="icons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="icons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="icons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="icons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="icons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="icons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="icons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="icons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="icons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="icons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="icons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="icons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="icons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="icons/manifest.json">
<link rel="mask-icon" href="icons/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="icons/favicon.ico">
<meta name="apple-mobile-web-app-title" content="Supply Order">
<meta name="application-name" content="Supply Order">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="icons/mstile-144x144.png">
<meta name="msapplication-config" content="icons/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

  <script>
    var user = "John Smith";
    var orderItem;

    $(document).ready(function(){
      $.get('list.php',function(data){
        $("#items").html("");
        data = data.split("\n");
        data = cleanArray(data);
        data.forEach(function(item){
          $("#items").append('<li class="list-group-item">'+item+'</li>');
        });
      });
 
      $("#user").html("Welcome " + user);

      $("#filter").on('input',function(){
        $("#items li").each(function(i, item){
          var input = $("#filter").val().toLowerCase();
          var text = $(this).html().toLowerCase();
          if(text.indexOf(input)>=0){
            $(this).show();
          }else{
            $(this).hide();
          }
          var num = $('#items li:visible').size();
          if(num == 1){
            var item = $('#items li:visible').html();
            selectItem(item);
          }
        }); 
      });

      $("#items").on("click","li",function(){
        var item = $(this).html();
        selectItem(item);
      });

      $("#submitBTN").click(submit);

      $('#amount').keyup(function(e){
          if(e.keyCode == 13){submit()}
      });
    });

    function submit(){
      $("#filter").val("");
      $("#amount").val("");
      $("#items li").each(function(i, item){$(this).show();}); 
      $("#myModal").modal('hide');
      console.log("Submited");
      $("#filter").focus();
    }

    function selectItem(item){
      //$('#amount').focus();
      setTimeout(function(){$('#amount').focus();},500);

      $('#mTitle').html("You Are Ordering " + item);
      $('#MSG').html("How many would you like?");
      $('#myModal').modal('show');
    }

    // Will remove all falsy values: undefined, null, 0, false, NaN and "" (empty string)
    function cleanArray(actual) {
      var newArray = new Array();
      for (var i = 0; i < actual.length; i++) {
        if (actual[i]) {
          newArray.push(actual[i]);
        }
      }
      return newArray;
    }
  </script>
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <h1>Supply Order</h1>
    <p id="user"></p> 
  </div>
  <div class="row">
    <div class="col-sm-12">
      <input type="text" class="form-control" id="filter" placeholder="Filter List">
      <hr>
      <ul id="items" class="list-group">
        <li class="list-group-item">First item</li>
        <li class="list-group-item">Second item</li>
        <li class="list-group-item">Third item</li>
      </ul>
    </div>
    <div class="col-sm-12">
    </div>
    <div class="col-sm-12">
    </div>
  </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="mTitle"></h4>
        </div>
        <div class="modal-body">
          <p id="MSG"></p>
          <input id="amount" type="number"></input>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button id="submitBTN" type="button" class="btn btn-default" >Order</button>
        </div>
      </div>

    </div>
  </div>
</body>
</html>

