		<p>&nbsp;<p>
        <h1>Step 1 : Verification</h1>
        <p>We must verify some points to start the installation of Helium</p>
        <p><img src="/img/{$setup.db_conf.img}.png"/> {$setup.db_conf.text}</p>
        <p><img src="/img/{$setup.pdo.img}.png"/> {$setup.pdo.text}</p>
        <p><img src="/img/{$setup.mysql.img}.png"/> {$setup.mysql.text}</p>
        {if $setup.count_error < 1}<p><a class="btn btn-primary btn-lg" href="/2" role="button">Continue &raquo;</a></p>{/if}