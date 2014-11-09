		<p>&nbsp;<p>
        <h1>Step 1 : Verification</h1>
        <p>We must verify some points to start the installation of Helium</p>
        <p><img src="/img/{$Helium.db_conf.img}.png"/> {$Helium.db_conf.text}</p>
        <p><img src="/img/{$Helium.pdo.img}.png"/> {$Helium.pdo.text}</p>
        <p><img src="/img/{$Helium.mysql.img}.png"/> {$Helium.mysql.text}</p>
        {if $Helium.count_error < 1}<p><a class="btn btn-primary btn-lg" href="/2" role="button">Continue &raquo;</a></p>{/if}