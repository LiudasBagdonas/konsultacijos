<article class="wrapper">
    <nav>
        <ul>
            <?php foreach ($nav['links'] as $link): ?>
                    <li>
                        <a href="<?php print $link['path']; ?>"><?php print $link['value']; ?></a>
                    </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</article>