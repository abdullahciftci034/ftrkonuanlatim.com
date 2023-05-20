<?php
require_once __DIR__."/croneRequire.php";
require_once __DIR__."/backup.php";
## burda mysql yedeğini aldık
mysqlBackup();
## sitemap yedeğini aldık
sitemapbackup()

?>