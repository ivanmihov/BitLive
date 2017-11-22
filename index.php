<?php
  require_once('includes/config.php');
?>

<html lang="en">
  <head>
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $config['site_meta']; ?>">

    <!-- FAV ICON -->
    <link rel="icon" href="assets/img/favicon.ico">

    <!-- TITLE -->
    <title><?php echo $config['site_title']; ?></title>

    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
  </head>

  <body>
    <!-- HEADER -->
    <section id="header" class="navbar navbar-inverse navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="#"><i class="fa fa-btc"></i> <?php echo $config['site_name']; ?></a>
          </div>
        </div>
    </section>

    <!-- TICKER -->
    <section id="ticker">
      <div class="container">
          <!-- CURRENT PRICE -->
          <h2>1 <span id="ticker" class="upper"><?php echo $config['ticker']?></span> is currently worth 
            <span id="price" class="price"></span>
            <span id="currency" class="upper"><?php echo $config['currency']?></span>
          </h2>
          <!-- HIGH/LOW -->
          <p>
            <span>
              <i class="fa fa-arrow-circle-o-up"></i> 
              High:
              <span id="high_price"></span>
            </span>
            <span>
              <i class="fa fa-arrow-circle-o-down"></i> 
              Low:
              <span id="low_price"></span>
            </span>
          </p>
      </div>
    </section>

    <!-- FEATURES -->
    <section id="features">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="feature">
              <div class="icon">
                <i class="fa fa-line-chart"></i>
              </div>
              <h3>Realtime Prices</h3> 
              <p>Bitcoin price is updated live</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature">
              <div class="icon">
                <i class="fa fa-mobile"></i>
              </div>
              <h3>Responsive</h3>
              <p>
                <?php echo $config['site_name']; ?> is built to be responsive!
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature">
              <div class="icon">
                <i class="fa fa-usd"></i>
              </div>
              <h3>Ads Support</h3>
              <p>Ads are inserted below.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php if ($config['enable_ads'] == true) :?>
      <!-- ADS -->
      <section id="ads">
        <div class="container">
          <div class="ads">
            <?php
            foreach (glob("includes/ads/*.php") as $ad_file) {
                require_once $ad_file;
            }
            ?>
          </div>
        </div>
      </section>
    <?php endif;?>
      
    <!-- FOOTER -->
    <section id="footer">
      <div class="container">
        <span class="pull-left copyright"><i class="fa fa-btc"></i> <?php echo $config['site_name']; ?></span>
        <span class="pull-right footerlinks"><a href="bitcoin:<?php echo $config['wallet_id']; ?>"><i class="fa fa-btc"></i> Donate</a></span>
      </div>
    </section>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/f95c65c9a5.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
      // Get the ticker price and update the blocks
      function getPrice(){
        var api_url = "includes/api.php?currency=<?php echo $config['currency']; ?>";
        $.ajax({url: api_url, success: function(raw_result){
          result = JSON.parse(raw_result);
          $("#price").html(result['last']);
          $("#high_price").html(result['high']);
          $("#low_price").html(result['low']);
        }});
      }

      getPrice();
      setInterval(function(){getPrice()}, <?php echo $config['update_rate']; ?>);
    </script>
    
    <?php if ($config['enable_g_analytics'] == true) :?>
    <!-- GOOGLE ANALYTICS -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', '<?php echo $config["g_analytics_ua"] ?>', 'auto');
      ga('send', 'pageview');
    </script>
    <?php endif; ?>
  </body>
</html>