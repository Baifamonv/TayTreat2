use taytreat
UPDATE wp_options SET option_value = replace(option_value, 'http://taystest.app','http://139.59.190.211' ) WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'http://taystest.app','http://139.59.190.211');
UPDATE wp_posts SET post_content = replace(post_content, 'http://taystest.app','http://139.59.190.211');
UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://taystest.app','http://139.59.190.211');