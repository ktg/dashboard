<?php
$icon = site_url("wp-content/themes/$theme/services/website/images/link.png");

array_push($links, "<a href=\"{$service->token}\"><img class=\"link_icon\" src=\"$icon\" />{$service->token}</a>");
