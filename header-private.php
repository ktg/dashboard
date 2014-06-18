<?php
$user_id = get_current_user_id();
if ($user_id == 0)
{
	if (!is_front_page())
	{
		wp_redirect(esc_url(home_url()));
	}
}
else
{
	if (is_front_page())
	{
		wp_redirect(esc_url(site_url('discover')));
	}
}

get_header();