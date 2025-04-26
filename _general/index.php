<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $a) : ?>

        <li>
            <a class="link" href=<?php echo '/'.$a['folder'].'/'; ?> >
                <?php echo $a['date'] . ': ' . $a['title'] ?>
            </a>
        </li>
            
        <?php endforeach; ?>
    </ul>
</section>

<div>
    <h1>Support me</h1>
    <div class="support">
        <div class="support-entry">
            <div class="support-descr">
                <div class="support-kind">Bitcoin</div>
                <a class="link" href="bitcoin:bc1qanrdv5c5glru49ulxfqurtvrxl3z754x2k0mnh">
                    bc1qanrdv5c5glru49ulxfqurtvrxl3z754x2k0mnh
                </a>
            </div>
            <div class="support-qr">
                <img src="btc_qr.png"/>
            </div>
        </div>
    </div>
</div>
