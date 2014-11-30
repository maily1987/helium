<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/favicon.ico">

    <title>Helium - site eCommerce</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/helium.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="/img/logo.png" alt="Logo Helium" title="Logo Helium" id="logo_helium"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
           <ul class="nav navbar-nav">
            <!-- <li class="active"><a href="/">Home</a></li> -->
            {foreach from=$categories item=$one_categories}
                <li style="color:white;">&nbsp;{$one_categories->get_name()}
                {if count($one_categories->sub_menu) > 0}
                    {foreach from=$one_categories->sub_menu item=$one_sub_categories}
                        <ul class="nav navbar-inverse">
                            <li style="font-size:10px;"><a href="{url alias=$one_sub_categories->get_route_alias()}">&nbsp;&nbsp;&nbsp;&nbsp;{$one_sub_categories->get_name()}</a></li>
                        </ul>
                   {/foreach}
                {/if}
                </li>
            {/foreach}
            <li><a href="#contact">Contact</a></li>
          </ul>
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>


    <div class="container">
        {include file=$model}
      
        <div class="cadre_all_border_grey">
            Vos articles vus récemment et vos recommandations en vedette<br/><br/>
            <p>Voir les recommandations personnalisées</p>
            <p><input type="button" value="Identifiez-vous"/></p>
        </div>
        <div class="cadre_link_bottom">
            <h2>Pour mieux nous connaître</h2>
            À propos<br/>
            Carrières<br/>
            Presse<br/>
            Hélium et notre planète<br/>
            Hélium Ensemble
        </div>
        <div class="cadre_link_bottom">
            <h2>Gagnez de l'argent</h2>
            Vendez sur Hélium<br/>
            Devenez Partenaire<br/>
            Expédié par Hélium<br/>
            Faites la promotion de vos produits<br/>
            Auto-publiez votre livre<br/>
            ›Tous nos programmes
        </div>
        <div class="cadre_link_bottom">
            <h2>Moyens de paiement Hélium</h2>
            Cartes de paiement<br/>
            Hélium Currency Converter<br/>
            Chèques-cadeaux<br/>
        </div>
        <div class="cadre_link_bottom">
            <h2>Besoin d'aide ?</h2>
            Visualiser ou suivre vos commandes<br/>
            Tarifs et options de livraison<br/>
            Hélium Premium<br/>
            Retourner un article<br/>
            Application Amazon Mobile<br/>
            Aide
        </div>
        <div class="cadre_bottom_large">
            &nbsp;<br:>
            <center><b>Hélium.fr</b></center><br/>
            <center>Australie&nbsp;&nbsp;&nbsp;Allemagne&nbsp;&nbsp;&nbsp;Brésil&nbsp;&nbsp;&nbsp;Canada&nbsp;&nbsp;&nbsp;
            Chine&nbsp;&nbsp;&nbsp;Espagne&nbsp;&nbsp;&nbsp;États-Unis&nbsp;&nbsp;&nbsp;Inde&nbsp;&nbsp;&nbsp;Italie&nbsp;&nbsp;&nbsp;
            Japon&nbsp;&nbsp;&nbsp;Mexique&nbsp;&nbsp;&nbsp;Pays-Bas&nbsp;&nbsp;&nbsp;Royaume-Uni</center>
        </div>
        <div class="cadre_mini_link_bottom">
            AbeBooks<br/>
            <span>Livres rares<br/>& manuels</span>
        </div>
        <div class="cadre_mini_link_bottom">
            Hélium BuyVIP<br/>
            <span>Ventes privées partout<br/>en Europe</span>
        </div>
        <div class="cadre_mini_link_bottom">
            Hélium Web Services<br/>
            <span>Services de Cloud<br/>Computing Flexibles</span>
        </div>
        <div class="cadre_mini_link_bottom">
            Audible<br/>
            <span>Téléchargez des<br/>livres audio</span>
        </div>
        <div class="cadre_mini_link_bottom">
            Book Depository<br/>
            <span>Livres avec<br/>livraison gratuite</span>
        </div>
        <div class="cadre_mini_link_bottom">
            CreateSpace<br/>
            <span>Auto-publiez facilement<br/>vos livres au format papier</span>
        </div>
        <div class="cadre_mini_link_bottom">
            Kindle Direct Publishing<br/>
            <span>Auto-publiez facilement<br/>vos livres au format numérique</span>
        </div>
        <div class="cadre_mini_link_bottom">
            MESHABITS<br/>
            <span>Mode privée<br/>et designers</span>
        </div>
        <div class="cadre_mini_link_bottom">
            Offres Reconditionnées<br/>
            <span>Bonnes affaires</span>
        </div>
        <div class="cadre_mini_link_bottom">
            Shopvetement<br/>
            <span>Vêtements de Marque<br/>& Mode</span>
        </div>
        <div class="cadre_bottom_large">
            &nbsp;<br/>
            Conditions générales de vente &nbsp;&nbsp;&nbsp;&nbsp;
            Vos informations personnelles &nbsp;&nbsp;&nbsp;&nbsp;
            Cookies et Publicité sur Internet &nbsp;&nbsp;&nbsp;&nbsp;
            © 2014-2015, Helium.com, Inc. ou ses filiales.
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>