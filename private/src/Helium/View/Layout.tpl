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
          <a class="navbar-brand" href="{url alias='home'}"><img src="/img/logo.png" alt="Logo Helium" title="Logo Helium" id="logo_helium"/></a>
        </div>
      </div>
        <div id="navbar" class="navbar-collapse collapse">
      <div class="container">
           <ul class="nav navbar-nav">
            <li id="homepage"=>&nbsp;&nbsp;<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAVCAYAAABc6S4mAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAMSwAADEsBUs3p1QAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAGOSURBVDiNtdO/S9ZRFAbwzyuCr5Jo9MOGDF2iKWqIwKEham5pqb0mHSKEaAuEpgZb6i8oiqCymlpsidwsiCCIBh1Sg7AISdDb8J4v3V5e86q9Bx743vN9zvNwzrlXSkkpcBlP0FNcUyhcw02kwBvs/S8G6MK9EJ7D8/j+iOGMdxB3AwNFBtiNVyE4gwPowO3IfcHx4B7LOjyyqQGG8SEKHqAHE9UOMI51fMfZLRngBBaCfAO9eJwJzGAfLuIXVnEJrzc1wDn8xAouYAjvMvEKn3AYp7Ec3VzH/Q0NMIa1mO1JnMJSC/EKXzGCo5iP3CTqfxnE4m4F4S0ORcur/xCvsILzGMT7yD1EV2ir41H8mEJ/dktKsYYrUVvdumn0wdNY1AT24OUWxXNMoht3QvMFjbu+P9p5tgPxCqOh1Yd6Z0rpmz/Ra+exC1JKyzSW29Zou0FnIe8HRrEY5zO4WlTZ9NCmtV7cbBOvfwNewrWcu90RFddt16DWboPiuuYlL7ZkNWabR03jpTbHOj7nid9sUc6xKxoE8AAAAABJRU5ErkJggg57d3d456d8fe53e27135c7a24cb186de"/>&nbsp;&nbsp;
            {foreach from=$categories item=$one_categories}
                <li>&nbsp;{$one_categories->get_name()}&nbsp;
                {if count($one_categories->sub_menu) > 0}
                    {foreach from=$one_categories->sub_menu item=$one_sub_categories}
                        <ul class="nav navbar-inverse">
                            <li style="font-size:10px;"><a href="{url alias=$one_sub_categories->get_route_alias()}">&nbsp;&nbsp;&nbsp;&nbsp;{$one_sub_categories->get_name()}</a></li>
                        </ul>
                   {/foreach}
                {/if}
                </li>
            {/foreach}
          </ul>
        </div>
      </div><!--/.navbar-collapse -->
    </nav>


    <div class="container center-div">
        {include file=$model}
      
          <footer>
            <div class="cadre_all_border_grey">
                Vos articles vus récemment et vos recommandations en vedette<br/><br/>
                <p>Voir les recommandations personnalisées</p>
                <p><input type="button" value="Identifiez-vous"/></p>
            </div>
            <div class="cadre_link_bottom">
                <h2>Pour mieux nous connaître</h2>
                <a href="{url alias='a-propos-d-helium'}">À propos</a><br/>
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
        </footer>
      </div>

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