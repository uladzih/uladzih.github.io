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
