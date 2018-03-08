<?php 


add_action('init','be_shortcodes_init');

function be_shortcodes_init() {
	global $be_themes_data;
	global $be_shortcode;
	$be_font_icons = array (
		'none',	
		'address',
		'adjust',
		'air',
		'alert',
		'archive',
		'arrow-combo',
		'arrows-ccw',
		'attach',
		'attention',
		'back-in-time',
		'back',
		'bag',
		'basket',
		'battery',
		'behance',
		'bell',
		'block',
		'book-open',
		'book',
		'bookmark',
		'bookmarks',
		'box',
		'briefcase',
		'brush',
		'bucket',
		'calendar',
		'camera',
		'cancel-circled',
		'cancel-squared',
		'cancel',
		'cc-by',
		'cc-nc-eu',
		'cc-nc-jp',
		'cc-nc',
		'cc-nd',
		'cc-pd',
		'cc-remix',
		'cc-sa',
		'cc-share',
		'cc-zero',
		'cc',
		'ccw',
		'cd',
		'chart-area',
		'chart-bar',
		'chart-line',
		'chart-pie',
		'chat',
		'check',
		'clipboard',
		'clock',
		'cloud-thunder',
		'cloud',
		'code',
		'cog',
		'comment',
		'compass',
		'credit-card',
		'cup',
		'cw',
		'database',
		'db-shape',
		'direction',
		'doc-landscape',
		'doc-text-inv',
		'doc-text',
		'doc',
		'docs',
		'dot-2',
		'dot-3',
		'dot',
		'down-bold',
		'down-circled',
		'down-dir',
		'down-open-big',
		'down-open-mini',
		'down-open',
		'down-thin',
		'down',
		'download',
		'dribbble-circled',
		'dribbble',
		'drive',
		'dropbox',
		'droplet',
		'erase',
		'evernote',
		'export',
		'eye',
		'facebook-circled',
		'facebook-squared',
		'facebook',
		'fast-backward',
		'fast-forward',
		'feather',
		'flag',
		'flash',
		'flashlight',
		'flattr',
		'flickr-circled',
		'flickr',
		'flight',
		'floppy',
		'flow-branch',
		'flow-cascade',
		'flow-line',
		'flow-parallel',
		'flow-tree',
		'folder',
		'forward',
		'gauge',
		'github-circled',
		'github',
		'globe',
		'google-circles',
		'gplus-circled',
		'gplus',
		'graduation-cap',
		'heart-empty',
		'heart',
		'help-circled',
		'help',
		'home',
		'hourglass',
		'inbox',
		'infinity',
		'info-circled',
		'info',
		'instagram',
		'install',
		'key',
		'keyboard',
		'lamp',
		'language',
		'lastfm-circled',
		'lastfm',
		'layout',
		'leaf',
		'left-bold',
		'left-circled',
		'left-dir',
		'left-open-big',
		'left-open-mini',
		'left-open',
		'left-thin',
		'left',
		'level-down',
		'level-up',
		'lifebuoy',
		'light-down',
		'light-up',
		'link',
		'linkedin-circled',
		'linkedin',
		'list-add',
		'list',
		'location',
		'lock-open',
		'lock',
		'login',
		'logo-db',
		'logout',
		'loop',
		'magnet',
		'mail',
		'map',
		'megaphone',
		'menu',
		'mic',
		'minus-circled',
		'minus-squared',
		'minus',
		'mixi',
		'mobile',
		'monitor',
		'moon',
		'mouse',
		'music',
		'mute',
		'network',
		'newspaper',
		'note-beamed',
		'note',
		'palette',
		'paper-plane',
		'pause',
		'paypal',
		'pencil',
		'phone',
		'picasa',
		'picture',
		'pinterest-circled',
		'pinterest',
		'play',
		'plus-circled',
		'plus-squared',
		'plus',
		'popup',
		'print',
		'progress-0',
		'progress-1',
		'progress-2',
		'progress-3',
		'publish',
		'qq',
		'quote',
		'rdio-circled',
		'rdio',
		'record',
		'renren',
		'reply-all',
		'reply',
		'resize-full',
		'resize-small',
		'retweet',
		'right-bold',
		'right-circled',
		'right-dir',
		'right-open-big',
		'right-open-mini',
		'right-open',
		'right-thin',
		'right',
		'rocket',
		'rss',
		'search',
		'share',
		'shareable',
		'shuffle',
		'signal',
		'sina-weibo',
		'skype-circled',
		'skype',
		'smashing',
		'sound',
		'soundcloud',
		'spotify-circled',
		'spotify',
		'star-empty',
		'star',
		'stop',
		'stumbleupon-circled',
		'stumbleupon',
		'suitcase',
		'sweden',
		'switch',
		'tag',
		'tape',
		'target',
		'thermometer',
		'thumbs-down',
		'thumbs-up',
		'ticket',
		'to-end',
		'to-start',
		'tools',
		'traffic-cone',
		'trash',
		'trophy',
		'tumblr-circled',
		'tumblr',
		'twitter-circled',
		'twitter',
		'up-bold',
		'up-circled',
		'up-dir',
		'up-open-big',
		'up-open-mini',
		'up-open',
		'up-thin',
		'up',
		'upload-cloud',
		'upload',
		'user-add',
		'user',
		'users',
		'vcard',
		'video',
		'vimeo-circled',
		'vimeo',
		'vkontakte',
		'volume',
		'water',
		'window',
		'attach2',
		'beaker',
		'calendar2',
		'camera2',
		'cd2',
		'clock2',
		'cloud2',
		'cog2',
		'comment2',
		'cup2',
		'database2',
		'desktop',
		'diamond',
		'doc2',
		'eye2',
		'fire',
		'food',
		'globe2',
		'graduation-cap2',
		'heart2',
		'inbox2',
		'key2',
		'lightbulb',
		'location2',
		'lock2',
		'mail2',
		'megaphone2',
		'mobile2',
		'money',
		'music2',
		'note2',
		'paper-plane2',
		'params',
		'pencil2',
		'photo',
		'search2',
		'shop',
		'sound2',
		'star2',
		't-shirt',
		'tag2',
		'thumbs-up2',
		'trash2',
		'truck',
		'tv',
		'user2',
		'videocam',
		'wallet',
		'acrobat',
		'aim',
		'amazon',
		'android',
		'angellist',
		'appnet',
		'appstore',
		'bitbucket',
		'bitcoin',
		'blogger',
		'buffer',
		'calendar3',
		'call',
		'cart',
		'cc2',
		'chrome',
		'cloudapp',
		'delicious',
		'digg',
		'disqus',
		'dribbble2',
		'dropbox2',
		'drupal',
		'duckduckgo',
		'dwolla',
		'ebay',
		'email',
		'eventasaurus',
		'eventbrite',
		'eventful',
		'evernote2',
		'facebook2',
		'fivehundredpx',
		'flattr2',
		'flickr2',
		'forrst',
		'foursquare',
		'github-circled2',
		'github2',
		'gmail',
		'google',
		'googleplay',
		'gowalla',
		'gplus2',
		'grooveshark',
		'guest',
		'hackernews',
		'html5',
		'ie',
		'instagram2',
		'instapaper',
		'intensedebate',
		'itunes',
		'klout',
		'lanyrd',
		'lastfm2',
		'lego',
		'linkedin2',
		'lkdto',
		'login2',
		'macstore',
		'meetup',
		'myspace',
		'ninetyninedesigns',
		'openid',
		'opentable',
		'paypal2',
		'pinboard',
		'pinterest2',
		'plancast',
		'plurk',
		'pocket',
		'podcast',
		'posterous',
		'print2',
		'quora',
		'reddit',
		'rss2',
		'scribd',
		'skype2',
		'smashmag',
		'songkick',
		'soundcloud2',
		'spotify2',
		'stackoverflow',
		'statusnet',
		'steam',
		'stripe',
		'stumbleupon2',
		'tumblr2',
		'twitter2',
		'viadeo',
		'vimeo2',
		'vk',
		'w3c',
		'weibo',
		'wikipedia',
		'windows',
		'wordpress',
		'xing',
		'yahoo',
		'yelp',
		'youtube',

		// 'spin1',
		// 'wallet',
		// 'spin5',
		// 'note',
		// 'note-beamed',
		// 'music',
		// 'search',
		// 'flashlight',
		// 'mail',
		// 'heart',
		// 'heart-empty',
		// 'star',
		// 'star-empty',
		// 'user',
		// 'users',
		// 'user-add',
		// 'video',
		// 'picture',
		// 'camera',
		// 'layout',
		// 'menu',
		// 'check',
		// 'cancel',
		// 'cancel-circled',
		// 'cancel-squared',
		// 'plus',
		// 'plus-circled',
		// 'plus-squared',
		// 'minus',
		// 'minus-circled',
		// 'minus-squared',
		// 'help',
		// 'help-circled',
		// 'info',
		// 'info-circled',
		// 'back',
		// 'home',
		// 'link',
		// 'attach',
		// 'lock',
		// 'lock-open',
		// 'eye',
		// 'tag',
		// 'bookmark',
		// 'bookmarks',
		// 'flag',
		// 'thumbs-up',
		// 'thumbs-down',
		// 'download',
		// 'upload',
		// 'upload-cloud',
		// 'reply',
		// 'reply-all',
		// 'forward',
		// 'quote',
		// 'code',
		// 'export',
		// 'pencil',
		// 'feather',
		// 'print',
		// 'retweet',
		// 'keyboard',
		// 'comment',
		// 'chat',
		// 'bell',
		// 'attention',
		// 'alert',
		// 'vcard',
		// 'address',
		// 'location',
		// 'map',
		// 'direction',
		// 'compass',
		// 'cup',
		// 'trash',
		// 'doc',
		// 'docs',
		// 'doc-landscape',
		// 'doc-text',
		// 'doc-text-inv',
		// 'newspaper',
		// 'book-open',
		// 'book',
		// 'folder',
		// 'archive',
		// 'box',
		// 'rss',
		// 'phone',
		// 'cog',
		// 'tools',
		// 'share',
		// 'shareable',
		// 'basket',
		// 'bag',
		// 'calendar',
		// 'login',
		// 'logout',
		// 'mic',
		// 'mute',
		// 'sound',
		// 'volume',
		// 'clock',
		// 'hourglass',
		// 'lamp',
		// 'light-down',
		// 'light-up',
		// 'adjust',
		// 'block',
		// 'resize-full',
		// 'resize-small',
		// 'popup',
		// 'publish',
		// 'window',
		// 'arrow-combo',
		// 'down-circled',
		// 'left-circled',
		// 'right-circled',
		// 'up-circled',
		// 'down-open',
		// 'left-open',
		// 'right-open',
		// 'up-open',
		// 'down-open-mini',
		// 'left-open-mini',
		// 'right-open-mini',
		// 'up-open-mini',
		// 'down-open-big',
		// 'left-open-big',
		// 'right-open-big',
		// 'up-open-big',
		// 'down',
		// 'left',
		// 'right',
		// 'up',
		// 'down-dir',
		// 'left-dir',
		// 'right-dir',
		// 'up-dir',
		// 'down-bold',
		// 'left-bold',
		// 'right-bold',
		// 'up-bold',
		// 'down-thin',
		// 'left-thin',
		// 'right-thin',
		// 'up-thin',
		// 'ccw',
		// 'cw',
		// 'arrows-ccw',
		// 'level-down',
		// 'level-up',
		// 'shuffle',
		// 'loop',
		// 'switch',
		// 'play',
		// 'stop',
		// 'pause',
		// 'record',
		// 'to-end',
		// 'to-start',
		// 'fast-forward',
		// 'fast-backward',
		// 'progress-0',
		// 'progress-1',
		// 'progress-2',
		// 'progress-3',
		// 'target',
		// 'palette',
		// 'list',
		// 'list-add',
		// 'signal',
		// 'trophy',
		// 'battery',
		// 'back-in-time',
		// 'monitor',
		// 'mobile',
		// 'network',
		// 'cd',
		// 'inbox',
		// 'install',
		// 'globe',
		// 'cloud',
		// 'cloud-thunder',
		// 'flash',
		// 'moon',
		// 'flight',
		// 'paper-plane',
		// 'leaf',
		// 'lifebuoy',
		// 'mouse',
		// 'briefcase',
		// 'suitcase',
		// 'dot',
		// 'dot-2',
		// 'spin2',
		// 'brush',
		// 'magnet',
		// 'infinity',
		// 'erase',
		// 'chart-pie',
		// 'chart-line',
		// 'chart-bar',
		// 'chart-area',
		// 'tape',
		// 'graduation-cap',
		// 'language',
		// 'ticket',
		// 'water',
		// 'droplet',
		// 'air',
		// 'credit-card',
		// 'floppy',
		// 'clipboard',
		// 'megaphone',
		// 'database',
		// 'drive',
		// 'bucket',
		// 'thermometer',
		// 'key',
		// 'flow-cascade',
		// 'flow-branch',
		// 'flow-tree',
		// 'flow-line',
		// 'flow-parallel',
		// 'rocket',
		// 'gauge',
		// 'traffic-cone',
		// 'cc',
		// 'cc-by',
		// 'cc-nc',
		// 'cc-nc-eu',
		// 'cc-nc-jp',
		// 'cc-sa',
		// 'cc-nd',
		// 'cc-pd',
		// 'cc-zero',
		// 'cc-share',
		// 'cc-remix',
		// 'duckduckgo',
		// 'aim',
		// 'delicious',
		// 'paypal',
		// 'flattr',
		// 'android',
		// 'eventful',
		// 'smashmag',
		// 'gplus',
		// 'wikipedia',
		// 'lanyrd',
		// 'calendar-1',
		// 'stumbleupon',
		// 'fivehundredpx',
		// 'pinterest',
		// 'bitcoin',
		// 'w3c',
		// 'foursquare',
		// 'html5',
		// 'ie',
		// 'call',
		// 'grooveshark',
		// 'ninetyninedesigns',
		// 'forrst',
		// 'digg',
		// 'spotify',
		// 'reddit',
		// 'guest',
		// 'gowalla',
		// 'appstore',
		// 'blogger',
		// 'cc-1',
		// 'dribbble',
		// 'evernote',
		// 'flickr',
		// 'google',
		// 'viadeo',
		// 'instapaper',
		// 'weibo',
		// 'klout',
		// 'linkedin',
		// 'meetup',
		// 'vk',
		// 'plancast',
		// 'disqus',
		// 'rss-1',
		// 'skype',
		// 'twitter',
		// 'youtube',
		// 'vimeo',
		// 'windows',
		// 'xing',
		// 'yahoo',
		// 'chrome',
		// 'email',
		// 'macstore',
		// 'myspace',
		// 'podcast',
		// 'amazon',
		// 'steam',
		// 'cloudapp',
		// 'dropbox',
		// 'ebay',
		// 'facebook',
		// 'github',
		// 'github-circled',
		// 'googleplay',
		// 'itunes',
		// 'plurk',
		// 'songkick',
		// 'lastfm',
		// 'gmail',
		// 'pinboard',
		// 'openid',
		// 'quora',
		// 'soundcloud',
		// 'tumblr',
		// 'eventasaurus',
		// 'wordpress',
		// 'yelp',
		// 'intensedebate',
		// 'eventbrite',
		// 'scribd',
		// 'posterous',
		// 'stripe',
		// 'opentable',
		// 'cart',
		// 'print-1',
		// 'angellist',
		// 'instagram',
		// 'dwolla',
		// 'appnet',
		// 'statusnet',
		// 'acrobat',
		// 'drupal',
		// 'buffer',
		// 'pocket',
		// 'bitbucket',
		// 'lego',
		// 'login-1',
		// 'stackoverflow',
		// 'hackernews',
		// 'lkdto',
		// 'music-1',
		// 'search-1',
		// 'mail-1',
		// 'heart-1',
		// 'star-1',
		// 'user-1',
		// 'videocam',
		// 'camera-1',
		// 'photo',
		// 'attach-1',
		// 'lock-1',
		// 'eye-1',
		// 'tag-1',
		// 'thumbs-up-1',
		// 'pencil-1',
		// 'comment-1',
		// 'location-1',
		// 'cup-1',
		// 'trash-1',
		// 'doc-1',
		// 'note-1',
		// 'cog-1',
		// 'params',
		// 'calendar-2',
		// 'sound-1',
		// 'clock-1',
		// 'lightbulb',
		// 'tv',
		// 'desktop',
		// 'mobile-1',
		// 'cd-1',
		// 'inbox-1',
		// 'globe-1',
		// 'cloud-1',
		// 'paper-plane-1',
		// 'fire',
		// 'graduation-cap-1',
		// 'megaphone-1',
		// 'database-1',
		// 'key-1',
		// 'beaker',
		// 'truck',
		// 'money',
		// 'food',
		// 'shop',
		// 'diamond',
		// 't-shirt',
		// 'dot-3',
	);
	asort($be_font_icons);
	array_unshift($be_font_icons, 'none');
	
	$animations = array (
		'flipInX', 
		'flipInY', 
		'fadeIn', 
		'fadeInDown', 
		'fadeInLeft', 
		'fadeInRight', 
		'fadeInUp', 
		'slideInDown', 
		'slideInLeft', 
		'slideInRight', 
		'rollIn', 
		'rollOut',
		'bounce',
		'bounceIn',
		'bounceInUp',
		'bounceInDown',
		'bounceInLeft',
		'bounceInRight',
		'fadeInUpBig',
		'fadeInDownBig',
		'fadeInLeftBig',
		'fadeInRightBig',
		'flash',
		'flip',
		'lightSpeedIn',
		'pulse',
		'rotateIn',
		'rotateInUpLeft',
		'rotateInDownLeft',
		'rotateInUpRight',
		'rotateInDownRight',
		'shake',
		'swing',
		'tada',
		'wiggle',
		'wobble'
	);
	
	$be_shortcode['portfolio'] = array (
		'name' => __('Portfolio', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array (
			'col' =>array (
				'title'=>__('Number of Columns','be-themes'),
				'type'=>'select',
				'options'=> array('two','three','four'),
				'default'=> 'three'
			),
			'show_filters' =>array (
				'title'=>__('Filterable Portfolio ?','be-themes'),
				'type'=>'select',
				'options'=> array('yes','no'),
				'default'=> 'yes'
			),
			'filter' =>array (
				'title'=>__('Filter to use ?','be-themes'),
				'type'=>'select',
				'options'=> array('categories','tags'),
				'default'=> 'categories'
			),
			'category' => array (
				'title'=> __('Portfolio Categories','be-themes'),
				'type'=>'taxo',
				'taxonomy'=> 'portfolio_categories'
			),
			'masonry' =>array (
				'title'=>__('Enable Masonry Layout','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'items_per_page' =>array (
				'title'=>__('Number of Items per Page','be-themes'),
				'type'=>'text',
				'default'=> '12'
			),
			'pagination' =>array (
				'title'=> __('Pagination Style','be-themes'),
				'type'=> 'select',
				'options'=> array (
					array('label' => 'None', 'value' => 'none'),
					array('label' => 'Infinite Scrolling', 'value' => 'infinite'),
					array('label' => 'Load More', 'value' => 'loadmore'),
				),
				'default'=> 'none'
			),
			'overlay_color' =>array(
				'title'=>__('Thumbnail Overlay Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme']
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),						
			// 'gallery' =>array (
			// 	'title'=> __('Act as Gallery?','be-themes'),
			// 	'type'=> 'select',
			// 	'options'=> array('yes','no'),
			// 	'default'=> 'no'
			// ),			
		)
	);
	
	$be_shortcode['portfolio_carousel'] = array (
		'name' => __('Portfolio Carousel', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array (
			'category' => array(
				'title'=> __('Portfolio Categories','be-themes'),
				'type'=>'taxo',
				'taxonomy'=> 'portfolio_categories'
			),
			'items_per_page' =>array(
				'title'=>__('Number of Items per Page','be-themes'),
				'type'=>'text',
				'default'=> '8'
			)
		)
	);


	$be_shortcode['portfolio_navigation_module'] = array (
		'name' => __('Portfolio Navigation', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'backend_output'=>false,
		'options' => array (
			'nav_links_color' => array (
				'title' => __('Next and Previous Page Navigation Color','be-themes'),
				'type' => 'color',
				'default' => '',
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);
	
	
	$be_shortcode['portfolio_full_screen'] = array(
		'name' => __('Fullwidth Portfolio', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'col' =>array(
				'title'=>__('Number of Columns','be-themes'),
				'type'=>'select',
				'options'=> array (
					array('label' => 'Three Columns', 'value' => 'three'),
					array('label' => 'Four Columns', 'value' => 'four'),
					array('label' => 'Five Columns', 'value' => 'five')
				),
				'default'=> 'three'
			),
			'show_filters' =>array(
				'title'=>__('Filterable Portfolio ?','be-themes'),
				'type'=>'select',
				'options'=> array('yes','no'),
				'default'=> 'yes'
			),
			'filter' =>array(
				'title'=>__('Filter to use ?','be-themes'),
				'type'=>'select',
				'options'=> array('categories','tags'),
				'default'=> 'categories'
			),
			'category' => array(
				'title'=> __('Portfolio Categories','be-themes'),
				'type'=>'taxo',
				'taxonomy'=> 'portfolio_categories'
			),		
			'items_per_page' =>array(
				'title'=>__('Number of Items per Page','be-themes'),
				'type'=>'text',
				'default'=> '12'
			),
			'masonry' =>array(
				'title'=>__('Enable Masonry Layout','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'pagination' =>array (
				'title'=> __('Pagination Style','be-themes'),
				'type'=> 'select',
				'options'=> array (
					array('label' => 'None', 'value' => 'none'),
					array('label' => 'Infinite Scrolling', 'value' => 'infinite'),
					array('label' => 'Load More', 'value' => 'loadmore'),
				),
				'default'=> 'none'
			),
			'overlay_color' =>array(
				'title'=>__('Thumbnail Overlay Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme']
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),				
		)
	);
	
	$be_shortcode['portfolio_full_screen_with_gutter'] = array(
		'name' => __('Fullwidth Portfolio Gutter', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'col' =>array(
				'title'=>__('Number of Columns','be-themes'),
				'type'=>'select',
				'options'=> array (
					array('label' => 'Three Columns', 'value' => 'three'),
					array('label' => 'Four Columns', 'value' => 'four'),
					array('label' => 'Five Columns', 'value' => 'five')
				),
				'default'=> 'three'
			),
			'show_filters' =>array(
				'title'=>__('Filterable Portfolio ?','be-themes'),
				'type'=>'select',
				'options'=> array('yes','no'),
				'default'=> 'yes'
			),
			'filter' =>array(
				'title'=>__('Filter to use ?','be-themes'),
				'type'=>'select',
				'options'=> array('categories','tags'),
				'default'=> 'categories'
			),
			'category' => array(
				'title'=> __('Portfolio Categories','be-themes'),
				'type'=>'taxo',
				'taxonomy'=> 'portfolio_categories'
			),		
			'items_per_page' =>array(
				'title'=>__('Number of Items per Page','be-themes'),
				'type'=>'text',
				'default'=> '12'
			),
			'masonry' =>array(
				'title'=>__('Enable Masonry Layout','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'pagination' =>array (
				'title'=> __('Pagination Style','be-themes'),
				'type'=> 'select',
				'options'=> array (
					array('label' => 'None', 'value' => 'none'),
					array('label' => 'Infinite Scrolling', 'value' => 'infinite'),
					array('label' => 'Load More', 'value' => 'loadmore'),
				),
				'default'=> 'none'
			),
			'overlay_color' =>array(
				'title'=>__('Thumbnail Overlay Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme']
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),							
		)
	);
	

	$be_shortcode['be_gallery'] = array (
		'name' => __('Gallery', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array (
			'col' =>array (
				'title'=>__('Number of Columns','be-themes'),
				'type'=>'select',
				'options'=> array (
					array('label' => 'Two Columns', 'value' => 'two'),
					array('label' => 'Three Columns', 'value' => 'three'),
					array('label' => 'Four Columns', 'value' => 'four'),
				),
				'default'=> 'three'
			),
			'images' => array (
				'title'=> __('Upload Image','be-themes'),
				'type'=> 'media',
				'select'=> 'multiple'
			),
			'masonry' =>array (
				'title'=>__('Enable Masonry Layout','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'overlay_color' =>array(
				'title'=>__('Thumbnail Overlay Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme']
			),
			'overlay_opacity' =>array (
				'title'=>__('Thumbnail Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> '85'
			),						
		)
	);

	$gallery_options = array (
		'col' =>array (
			'title'=>__('Number of Columns','be-themes'),
			'type'=>'select',
			'options'=> array (
				array('label' => 'Three Columns', 'value' => 'three'),
				array('label' => 'Four Columns', 'value' => 'four'),
				array('label' => 'Five Columns', 'value' => 'five')
			),
			'default'=> 'three'
		),
		'images' => array (
			'title'=> __('Upload Image','be-themes'),
			'type'=>'media',
			'select'=> 'multiple'
		),
		'masonry' =>array (
			'title'=>__('Enable Masonry Layout','be-themes'),
			'type'=>'checkbox',
			'default'=> '',
		),
		'overlay_color' =>array(
			'title'=>__('Thumbnail Overlay Color','be-themes'),
			'type'=>'color',
			'default'=> $be_themes_data['color_scheme']
		),
		'overlay_opacity' =>array (
			'title'=>__('Thumbnail Overlay Opacity','be-themes'),
			'type'=>'text',
			'default'=> '85'
		),						
	);
	
	$be_shortcode['gallery_full_screen'] = array (
		'name' => __('Gallery FullWidth', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => $gallery_options
	);
	
	$be_shortcode['gallery_full_screen_with_gutter'] = array (
		'name' => __('Gallery FullWidth Gutter', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => $gallery_options
	);
	
	$be_shortcode['blog'] = array (
		'name' => __('Blog', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'col' =>array (
				'title'=>__('Blog Masonry Columns','be-themes'),
				'type'=>'select',
				'options'=> array (
					array('label' => 'Three Columns', 'value' => 'three'),
					array('label' => 'Four Columns', 'value' => 'four'),
					array('label' => 'Five Columns', 'value' => 'five')
				),
				'default'=> 'three'
			),								
		)
	);

	$be_shortcode['text'] = array(
		'name' => __('Text Block', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'backend_output'=>true,
		'options' => array(
			'text_block' =>array(
				'title'=>__('Text Block Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true,
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),											
		)
	);	

	$be_shortcode['shortcode_modules'] = array(
		'name' => __('Plugin Shortcodes', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'text_block' =>array(
				'title'=>__('Shortcode','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
		)
	);		

	$be_shortcode['dropcap'] = array(
		'name' => __('Dropcaps', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'letter'=>array(
				'title'=>__('Letter to be Dropcapped','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'icon' =>array(
				'title'=>__('Icon to be Dropcapped  - prioritized over letter','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),			
			'type' =>array(
				'title'=>__('Dropcap Style','be-themes'),
				'type'=>'select',
				'options'=> array('circle','rounded','letter'),
				'default'=> 'circle'
			),
			'size' =>array(
				'title'=>__('Dropcap Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','big'),
				'default'=> 'small'
			),
			'color' =>array(
				'title'=>__('Dropcap Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme']
			),						
			'dropcap_content' => array(
				'title'=> __('Dropcap Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);	

 	$be_shortcode['team'] = array(
		'name' => __('Team', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h3',
			),					
			'description' => array(
				'title' => __('Description', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),	
			'designation' => array(
				'title' => __('Designation', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),					
			'image' => array(
				'title'=> __('Upload Team Member Image','be-themes'),
				'type'=>'media',
				'select'=> 'single'
			),		
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'description_color' => array(
				'title'=> __('Description Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'designation_color' => array(
				'title'=> __('Designation Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'facebook' => array(
				'title' => __('Facebook Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'twitter' => array(
				'title' => __('Twitter Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'google_plus' => array(
				'title' => __('Google Plus Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'linkedin' => array(
				'title' => __('LinkedIn Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'youtube' => array(
				'title' => __('Youtube Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'vimeo' => array(
				'title' => __('Vimeo Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),									
			'dribbble' => array(
				'title' => __('Dribbble Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'icon_hover_color' => array(
				'title'=> __('Icon Hover Color','be-themes'),
				'type'=>'color',
				'default'=> '#141414',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),						
		)
	);	


	$be_shortcode['separator'] = array (
	'name' => __('Divider', 'be-themes'),
	'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
	'type' => 'single',
	'options' => array (
			'height' => array(
				'title' => __('Divider Height', 'be-themes'),
				'type' => 'text',
				'default' => '1'
			),
	 		'color' => array(
	 			'title'=> __('Divider Color','be-themes'),
	 			'type'=>'color',
	 			'default' => $be_themes_data['sec_border'],
			),
		)
	);

	$be_shortcode['special_heading'] = array(
		'name' => __('Special Title', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'title_content' => array (
				'title'=> __('Title','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h5',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'sub_title' =>array(
				'title'=> __('Sub Title','be-themes'),
				'type'=> 'tinymce',
				'default'=> '',
				'content'=> true
			),	
			'separator_color' => array(
				'title'=> __('Divider Color','be-themes'),
				'type'=>'color',
				'default'=> '#e8e8e8'
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);
	
	$be_shortcode['special_heading2'] = array(
		'name' => __('Special Title Style2', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'title_content' =>array(
				'title'=> __('Title','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h3',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'sub_title' =>array(
				'title'=> __('Sub Title','be-themes'),
				'type'=> 'tinymce',
				'default'=> '',
				'content'=> true
			),
			'separator_color' => array(
				'title'=> __('Divider Color','be-themes'),
				'type'=>'color',
				'default'=> '#141414'
			),
			'border_color' => array(
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),
			'bg_color' => array(
				'title'=> __('Background Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),
			'bg_opacity' => array(
				'title'=> __('Background Opacity','be-themes'),
				'type'=> 'text',
				'default'=> '50'
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);
	
	$be_shortcode['special_heading3'] = array (
		'name' => __('Special Title Style3', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'title_content' =>array(
				'title'=> __('Title','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h3',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'sub_title1' =>array(
				'title'=> __('Top Caption','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'sub_title2' =>array(
				'title'=> __('Bottom Caption','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),
			'top_caption_color' => array(
				'title'=> __('Top Cation Color','be-themes'),
				'type'=>'color',
				'default'=> '#999999'
			),
			'bottom_caption_color' => array(
				'title'=> __('Bottom Cation Color','be-themes'),
				'type'=>'color',
				'default'=> '#999999'
			),
			'top_caption_separator_color' => array(
				'title'=> __('Top Cation Separator Color','be-themes'),
				'type'=>'color',
				'default'=> '#efefef'
			),
			'bottom_caption_separator_color' => array(
				'title'=> __('Top Cation Separator Color','be-themes'),
				'type'=>'color',
				'default'=> '#efefef'
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['title_icon'] = array(
		'name' => __('Title with Icon', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(			
			'icon' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),
			'size' =>array(
				'title'=>__('Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','medium'),
				'default'=> 'medium'
			),
			'alignment' =>array(
				'title'=>__('Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('left','right'),
				'default'=> 'left'
			),
			'style' =>array(
				'title'=>__('Style','be-themes'),
				'type'=>'select',
				'options'=> array('circled','plain'),
				'default'=> 'circled'
			),			
			'icon_bg' => array(
				'title'=> __('Background Color of Icon if circled','be-themes'),
				'type'=> 'color',
				'default'=> ''
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=> 'color',
				'default'=> '#000000'
			),
			'icon_border_color' => array(
				'title'=> __('Icon Border Color','be-themes'),
				'type'=> 'color',
				'default'=> '#000000'
			),
			'description' =>array(
				'title'=>__('Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['video'] = array(
		'name' => __('Video', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'source' =>array(
				'title'=>__('Choose a Video style','be-themes'),
				'type'=>'select',
				'options'=> array('youtube','vimeo'),
				'default'=> 'youtube'
			),
			'url' => array(
				'title'=> __('Enter the video url','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),			
		)
	);

	$be_shortcode['notifications'] = array(
		'name' => __('Notifications', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=> true,
		'options' => array(
			'bg_color' =>array(
				'title'=>__('Background Color of Notification box','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['sec_bg'],
			),
			'notice' => array(
				'title'=> __('Notification Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),			
		)
	);


	$be_shortcode['button'] = array (
		'name' => __('Buttons', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=> true,
		'options' => array(
			'button_text' =>array(
				'title'=>__('Button Text','be-themes'),
				'type'=>'text',
				'default'=> ''
			),	
			'url' => array(
				'title'=> __('Button Link','be-themes'),
				'type'=>'text',
				'default'=> 'http://themeforest.net'
			),		
			'type' =>array(
				'title'=>__('Button Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','medium','large','block'),
				'default'=> 'medium'
			),
			'alignment' =>array(
				'title'=>__('Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('none', 'left', 'center', 'right'),
				'default'=> 'none',
			),							
			'bg_color' =>array(
				'title'=>__('Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'hover_bg_color' =>array(
				'title'=>__('Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'color' =>array(
				'title'=>__('Text Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'hover_color' =>array(
				'title'=>__('Hover Text Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['alt_bg_text_color'],
			),
			'border_width' => array(
				'title'=> __('Border Width<br/><br/> <i style="color:red">Border will not apply on a "Block" type button</i>  ','be-themes'),
				'type'=> 'text',
				'default'=> '',
			),			
			'border_color' => array(
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000',
			),
			'hover_border_color' => array(
				'title'=> __('Hover Border Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'rounded' =>array(
				'title'=>__('Rounded Corners ?','be-themes'),
				'type'=>'checkbox',
				'default'=> '1'
			),	
			'image' => array(
				'title'=> __('Select Lightbox image / video','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'new_tab' =>array(
				'title'=> __('Open Link in New Tab','be-themes'),
				'type'=> 'checkbox',
				'default'=> 0,
			),
			// 'lightbox_content' => array (
			// 	'title'=> __('Lightbox Content','be-themes'),
			// 	'type'=> 'tinymce',
			// 	'content' => true,
			// 	'default' => '',
			// ),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);



 	$be_shortcode['call_to_action'] = array (
		'name' => __('Call to Action', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'bg_color' =>array (
				'title'=>__('Background Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h4',
			),			
			'title_color' =>array(
				'title'=>__('Title Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),						
			'button_text' => array(
				'title' => __('Button Text', 'be-themes'),
				'type' => 'text',
				'default' => __('Click Here', 'be-themes')
			),
			'button_link' => array(
				'title' => __('Url to be linked to the button', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'new_tab' =>array(
				'title'=> __('Open Link in New Tab','be-themes'),
				'type'=> 'checkbox',
				'default'=> 0,
			),
			'button_bg_color' =>array(
				'title'=>__('Button Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'hover_bg_color' =>array(
				'title'=>__('Button Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> '#000000',
			),
			'color' =>array(
				'title'=>__('Button Text Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),
			'hover_color' =>array(
				'title'=>__('Button Hover Text Color','be-themes'),
				'type'=> 'color',
				'default'=> '#ffffff'
			),
			'border_width' => array (
				'title'=> __('Button Border Width','be-themes'),
				'type'=> 'text',
				'default'=> '1',
			),			
			'border_color' => array(
				'title'=> __('Button Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#ffffff'
			),
			'hover_border_color' => array (
				'title'=> __('Button Hover Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'image' => array (
				'title'=> __('Select Lightbox image / video','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),				
		)
	);			       

	$be_shortcode['tabs'] = array(
		'name' => __('Tabs', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'tab'		
	);

	$be_shortcode['tab'] = array (
		'name' => __('Tab', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array(
			'title' => array(
				'title'=> __('Tab Title','be-themes'),
				'type'=>'text'
			),
			'icon' => array(
				'title'=> __('Choose and icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
			),
			'tab_content' => array(
				'title'=> __('Tab Content','be-themes'),
				'type'=>'tinymce',
				'default'=>'',
				'content'=>true
			),
			'title_bg_color' =>array(
				'title'=> __('Title Section Background Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_bg'],
			),
			'title_border_color' =>array(
				'title'=> __('Title Section Border Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_border'],
			),
			'title_color' =>array(
				'title'=>__('Title Section Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['sec_color'],
			),
			'content_bg_color' =>array(
				'title'=> __('Content Section Background Color','be-themes'),
				'type'=> 'color',
				'default'=> ''
			),
			'content_border_color' =>array(
				'title'=> __('Content Section Border Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_border'],
			)
		)		
	);	

	$be_shortcode['accordion'] = array(
		'name' => __('Accordion Toggles', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'toggle'
	);

	$be_shortcode['toggle'] = array (
		'name' => __('Toggle', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',
		'options' => array (
			'title' => array (
				'title'=> __('Accordian Title','be-themes'),
				'type'=>'text'
			),
			'accordion_content' => array(
				'title'=> __('Accordian Content','be-themes'),
				'type'=>'tinymce',
				'default'=>'',
				'content'=>true
			),
			'title_bg_color' =>array(
				'title'=> __('Title Section Background Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_bg'],
			),
			'title_color' =>array(
				'title'=>__('Title Section Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['sec_color'],
			),
			'title_border_color' =>array(
				'title'=> __('Title Section Border Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_border'],
			),
			'content_bg_color' =>array(
				'title'=> __('Content Section Background Color','be-themes'),
				'type'=> 'color',
				'default'=> ''
			),
			'content_border_color' =>array(
				'title'=> __('Content Section Border Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_border'],
			),
		)		
	);



	$be_shortcode['lists'] = array(
		'name' => __('Lists', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'list'		
	);

	$be_shortcode['list'] = array(
		'name' => __('List Item', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',
		'options' => array(
			'icon' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),
			'circled' =>array(
				'title'=>__('Circled ?','be-themes'),
				'type'=>'checkbox',
				'default'=> 0
			),
			'icon_bg' => array(
				'title'=> __('Background Color if circled','be-themes'),
				'type'=>'color',
				'default'=>$be_themes_data['color_scheme']
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> '#141414'
			),
			'list_content' =>array(
				'title'=>__('Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			)																							
		)
	);		



	$be_shortcode['flex_slider'] = array (
		'name' => __('Flex Slider', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'flex_slide',
		'options' => array(
			'animation' => array(
				'title'=> __('Animation Style','be-themes'),
				'type'=>'select',
				'options' => array('slide','fade'),
				'default'=>'fade'
			),
			'auto_slide' => array(
				'title'=> __('Auto Slide','be-themes'),
				'type'=>'select',
				'options' => array('yes','no'),
				'default'=>'yes'
			),
			'slide_interval' => array(
				'title'=> __('Slide Interval in milli secs if auto slide is enabled','be-themes'),
				'type'=>'text',
			),
		)		
	);

	$be_shortcode['flex_slide'] = array(
		'name' => __('Slide', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array(
			'image' => array(
				'title'=> __('Choose a slider image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'video' => array(
				'title'=> __('Enter Youtube/ Vimeo url if you wish to have video in the slide','be-themes'),
				'type'=>'text',
			)									
		)		
	);

	$be_shortcode['testimonials'] = array(
		'name' => __('Testimonials', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'testimonial',
		'options' => array (
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),			
		)		
	);
	
	$be_shortcode['testimonial'] = array (
		'name' => __('Testimonial', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array (
			'description' => array (
				'title'=> __('Testimonial Content','be-themes'),
				'type'=>'tinymce',
				'content'=> true,
			),
			'author' => array (
				'title'=> __('Testimonial Author','be-themes'),
				'type'=>'text',
				'default'=>'',
			),			
			'author_color' => array (
				'title'=> __('Testimonial Author Text Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
		)		
	);

	$be_shortcode['project_details'] = array (
		'name' => __('Portfolio Details', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single'
	);

	$be_shortcode['linebreak'] = array(
		'name' => __('Extra Spacing', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'height' => array(
				'title'=> __('Height in px','be-themes'),
				'type'=>'text',
				'default'=>'',
			)
		)			
	);	 


	$be_shortcode['recent_posts'] = array(
		'name' => __('Recent - Blog Posts', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'number' => array(
				'title'=> __('Number of Items','be-themes'),
				'type'=>'select',
				'options'=>array('three','four'),
				'default'=>'three'
			)							
		)
	);	

	$be_shortcode['section'] = array(
		'name' => __('Section Settings', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'bg_color' => array(
				'title'=> __('Background Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),			
			'bg_image' => array(
				'title'=> __('Background Image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'bg_repeat' => array(
				'title'=> __('Background Repeat','be-themes'),
				'type'=>'select',
				'options'=> array('repeat','repeat-x','four','repeat-y', 'no-repeat'),
				'default'=>'repeat'
			),
			'bg_attachment' => array(
				'title'=> __('Background Attachment','be-themes'),
				'type'=>'select',
				'options'=>array('scroll','fixed'),
				'default'=>'scroll'
			),
			'bg_position' => array(
				'title'=> __('Background Position','be-themes'),
				'type'=>'select',
				'options'=> array('top left','top right','top center', 'center left', 'center right', 'center center','bottom left','bottom right','bottom center'),
				'default'=> 'top left'
			),
			'bg_stretch' =>array(
				'title'=>__('Center Scale Image to occupy container','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'bg_parallax' =>array(
				'title'=>__('Enable Parallax','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'bg_mousemove_parallax' =>array (
				'title'=>__('Enable MouseMove Parallax','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),							
			'border_size' => array(
				'title'=> __('Border Size','be-themes'),
				'type'=>'text',
				'default'=> '1'
			),
			'border_color' => array(
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'padding_top' => array(
				'title'=> __('Top Padding','be-themes'),
				'type'=>'text',
				'default'=> '80'
			),
			'padding_bottom' => array(
				'title'=> __('Bottom Padding','be-themes'),
				'type'=>'text',
				'default'=> '80'
			),
			'bg_video' =>array(
				'title'=>__('Enable Background Video','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),				
			'bg_video_mp4_src' => array(
				'title'=> __('.MP4 Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_video_mp4_src_ogg' => array(
				'title'=> __('.OGG Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_video_mp4_src_webm' => array(
				'title'=> __('.Webm Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_overlay' =>array(
				'title'=>__('Enable Background Overlay','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'overlay_color' => array (
				'title'=> __('Background Overlay Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'overlay_opacity' => array (
				'title'=> __('Background Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'section_id' => array (
				'title'=> __('Section Id','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'full_screen' =>array (
				'title'=>__('Full Screen Section','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'full_screen_header_scheme' =>array (
				'title'=>__('Full Screen Section Transparent Header Scheme','be-themes'),
				'type'=>'select',
				'options'=> array (
						array('label' => 'Dark', 'value' => 'background--light'),
						array('label' => 'Light', 'value' => 'background--dark')
				),
				'default'=> 'background--dark',
			),
		)
	);
	
	$column = array (
		'name' => __('Column Settings', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'exclude' => true,
		'options' => array (
			'bg_color' => array(
				'title'=> __('Background Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),			
			'bg_image' => array(
				'title'=> __('Background Image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'bg_repeat' => array(
				'title'=> __('Background Repeat','be-themes'),
				'type'=>'select',
				'options'=>array('repeat','repeat-x','four','repeat-y', 'no-repeat'),
				'default'=>'repeat'
			),
			'bg_attachment' => array(
				'title'=> __('Background Attachment','be-themes'),
				'type'=>'select',
				'options'=>array('scroll','fixed'),
				'default'=>'scroll'
			),
			'bg_position' => array(
				'title'=> __('Background Position','be-themes'),
				'type'=>'select',
				'options'=>array('top left','top top right','top center', 'center left', 'center right', 'center center','bottom left','bottom right','bottom center'),
				'default'=>'top left'
			),
			'bg_stretch' =>array(
				'title'=>__('Center Scale Image to occupy container','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'center_pad' =>array(
				'title'=>__('Column Padding','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			)
		)
	);
	
	$be_shortcode['one_col'] = $column;
	$be_shortcode['one_half'] = $column;
	$be_shortcode['one_third'] = $column;
	$be_shortcode['one_fourth'] = $column;
	$be_shortcode['one_fifth'] = $column;
	$be_shortcode['two_third'] = $column;
	$be_shortcode['three_fourth'] = $column;

	$be_shortcode['row'] = array(
		'name' => __('Row Settings', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'no_wrapper' =>array(
				'title'=>__('No Wrap ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
			'no_margin_bottom' =>array(
				'title'=>__('Zero Bottom Margin ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
			'no_space_columns' =>array(
				'title'=>__('No Space Between Columns ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
		)
	);



	$be_shortcode['gmaps'] = array(
		'name' => __('Google Map', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array (
			'address' => array (
				'title'=> __('Address','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'latitude' => array (
				'title'=> __('Latitude','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'longitude' => array (
				'title'=> __('Longitude','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'height' => array(
				'title'=> __('Height in px (only numbers)','be-themes'),
				'type'=>'text',
				'default'=>'300',
			),
			'zoom' => array(
				'title'=> __('Zoom Value','be-themes'),
				'type'=>'text',
				'default'=>'14',
			),
			'style'=> array(
				'title'=> __('Style','be-themes'),
				'type'=>'select',
				'options'=>array('standard','greyscale', 'bluewater', 'midnight','black','redalert'),
				'default'=>'standard' 
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['icon'] = array (
		'name' => __('Icons', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'name' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),
			'size' =>array(
				'title'=>__('Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','medium','large'),
				'default'=> 'small',
			),			
			'style' =>array(
				'title'=>__('Style','be-themes'),
				'type'=>'select',
				'options'=> array('circle','plain'),
				'default'=> 'circle',
			),
			'bg_color' =>array(
				'title'=>__('Background Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'hover_bg_color' =>array(
				'title'=>__('Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'color' =>array(
				'title'=>__('Icon Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'hover_color' =>array(
				'title'=>__('Hover Icon Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['alt_bg_text_color'],
			),
			'border_width' => array(
				'title'=> __('Border Width','be-themes'),
				'type'=> 'text',
				'default'=> '1',
			),			
			'border_color' => array(
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=> '#000000'
			),
			'hover_border_color' => array(
				'title'=> __('Hover Border Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'href' => array(
				'title'=> __('Icon Link URL','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'alignment' =>array(
				'title'=>__('Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('none', 'left', 'center', 'right'),
				'default'=> 'none',
			),
			'image' => array(
				'title'=> __('Select Lightbox image / video','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'new_tab' =>array (
				'title'=>__('Open as new tab','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)
	);

	$be_shortcode['pricing_column'] = array(
		'name' => __('Pricing Table', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'pricing_feature',
		'options' => array(
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'h_tag' =>array(
				'title'=>__('Title Heading Tag','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h5',
			),
			'price' => array(
				'title' => __('Price', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),						
			'duration' => array(
				'title' => __('Duration', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'currency' => array(
				'title' => __('Currency', 'be-themes'),
				'type' => 'text',
				'default' => __('$', 'be-themes')
			),				
			'button_text' => array(
				'title' => __('Button Text', 'be-themes'),
				'type' => 'text',
				'default' => __('Click Here', 'be-themes')
			),
			'button_link' => array(
				'title' => __('Url to be linked to the button', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'button_color' =>array(
				'title'=>__('Button Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme']
			),
			'button_hover_color' =>array(
				'title'=>__('Button Hover Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['alt_bg_text_color'],
			),
			'button_bg_color' =>array(
				'title'=>__('Button Background Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'button_bg_hover_color' =>array(
				'title'=>__('Button Background Hover Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'button_border_color' =>array(
				'title'=>__('Button Border Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'button_border_hover_color' =>array(
				'title'=>__('Button Border Hover Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme'],
			),									
			'highlight' =>array(
				'title'=>__('Highlight Column','be-themes'),
				'type'=>'select',
				'options'=> array('yes','no'),
				'default'=> 'no',
			),
			'style' =>array(
				'title'=>__('Style Options','be-themes'),
				'type'=>'select',
				'options'=> array('style-1','style-2'),
				'default'=> 'style-1',
			),
			'animate' =>array(
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),
		)				
	);

	$be_shortcode['pricing_feature'] = array(
		'name' => __('Pricing Feature', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array(
			'feature' => array(
				'title'=> __('Feature','be-themes'),
				'type'=>'text',
			),
			'highlight' =>array(
				'title'=>__('Highlight this section ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
			'highlight_color' =>array(
				'title'=>__('Highlight Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['sec_bg'],
			),			
			'highlight_text_color' =>array(
				'title'=>__('Highlight Text Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['sec_color'],
			)

		)		
	);
	
	$be_shortcode['skills'] = array(
		'name' => __('Skills', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'skill',
		
	);

	$be_shortcode['skill'] = array(
		'name' => __('Skill Option', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',
		'options' => array(
			'title' => array(
				'title'=> __('Skill Name','be-themes'),
				'type'=>'text',
			),
			'title_color' => array(
				'title'=> __('Title Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_color'],
			),
			'value' => array(
				'title'=> __('Skill Score in %','be-themes'),
				'type'=>'text',
				'default'=>'50',
			),
			'fill_color' => array(
				'title'=> __('Fill Color','be-themes'),
				'type'=>'color',
				'default'=>$be_themes_data['color_scheme'],
			),
			'bg_color' => array(
				'title'=> __('Background Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['sec_bg'],
			), 			  							
		)		
	);
	$be_shortcode['clients'] = array(
		'name' => __('Clients', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'client',
		//'options' => array ()
	);	

	$be_shortcode['client'] = array(
		'name' => __('Client', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array(
			'image' => array(
				'title'=> __('Choose a Client image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'link' => array(
				'title'=> __('Link to Client Website','be-themes'),
				'type'=>'text',
			),
			'new_tab' => array(
				'title'=> __('Open Link in New tab','be-themes'),
				'type'=>'select',
				'options'=>array('yes','no'),
				'default'=>'yes'
			)									
		)		
	);
	
	$be_shortcode['services'] = array(
		'name' => __('Services', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'service',
		'options' => array (
			'line_color' =>array (
				'title'=>__('Timeline Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_border'],
			)
		)
	);	

	$be_shortcode['service'] = array(
		'name' => __('Service', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array (
			'icon' =>array (
				'title'=>__('Service Icon','be-themes'),
				'type'=> 'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),
			'icon_size' =>array (
				'title'=>__('Service Icon Size','be-themes'),
				'type'=> 'select',
				'options'=> array('small','medium','large'),
				'default'=> 'medium',
			),
			'icon_bg_color' =>array (
				'title'=>__('Service Icon Background Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['sec_bg'],
			),
			'icon_color' =>array (
				'title'=>__('Service Icon Color','be-themes'),
				'type'=> 'color',
				'default'=> '#141414'
			),
			'icon_hover_bg_color' =>array (
				'title'=>__('Service Icon Hover Background Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'icon_hover_color' =>array (
				'title'=>__('Service Icon Hover Color','be-themes'),
				'type'=> 'color',
				'default'=> $be_themes_data['alt_bg_text_color'],
			),
			'content' => array(
				'title'=> __('Servies Content','be-themes'),
				'type'=> 'tinymce',
				'content'=>true
			),
		)		
	);
	
	$be_shortcode['animated_numbers'] = array(
		'name' => __('Animated Numbers', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'number' => array(
				'title'=> __('Number','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'caption' => array(
				'title'=> __('Caption','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'number_size' => array(
				'title'=> __('Number Size','be-themes'),
				'type'=>'text',
				'default'=> '45'
			),
			'number_color' => array(
				'title'=> __('Number Color','be-themes'),
				'type'=>'color',
				'default'=> '#323232'
			),			
			'caption_size' => array(
				'title'=> __('Caption Size','be-themes'),
				'type'=>'text',
				'default'=> '13'
			),	
			'caption_color' => array(
				'title'=> __('Caption Color','be-themes'),
				'type'=>'color',
				'default'=> '#323232'
			),																					
		)
	);
	
	$be_shortcode['chart'] = array (
		'name' => __('Animated Chart', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'percentage' => array (
				'title'=> __('Percentage','be-themes'),
				'type'=> 'text',
				'default'=> 70
			),
			'caption' => array (
				'title'=> __('Caption','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
			'percentage_color' => array(
				'title'=> __('Percentage Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'percentage_font_size' => array (
				'title'=> __('Percentage Font Size','be-themes'),
				'type'=> 'text',
				'default'=> '14'
			),
			'caption_color' => array(
				'title'=> __('Caption Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'percentage_bar_color' => array(
				'title'=> __('Percentage Bar Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme'],
			),
			'percentage_track_color' => array(
				'title'=> __('Percentage Track Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['sec_bg'],
			),
			'percentage_scale_color' => array(
				'title'=> __('Percentage Scale Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'size' => array(
				'title'=> __('Size','be-themes'),
				'type'=> 'text',
				'default'=> 100
			),
			'linewidth' => array(
				'title'=> __('Bar Width','be-themes'),
				'type'=> 'text',
				'default'=> 5
			),
		)
	);
	$be_shortcode['html'] = array (
		'name' => __('Html Block', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'backend_output'=>false,
		'options' => array (
			'text_block' =>array (
				'title'=> __('Html Block Content','be-themes'),
				'type'=> 'textarea',
				'content'=> true,
				'default'=> '',
			),
			'scroll_to_animate' => array (
				'title'=> __('Enable Animation When Scrolling','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animate' =>array (
				'title'=>__('Enable CSS Animation','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'fadeIn',
			),											
		)
	);
	$be_shortcode['contact_form'] = array (
		'name' => __('Contact Form', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'backend_output'=>false,
		'options' => array (
			'input_bg_color' => array (
				'title'=> __('Input Background Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),
			'input_color' => array (
				'title'=> __('Input Color','be-themes'),
				'type'=>'color',
				'default'=> ''
			),
			'input_border_color' => array (
				'title' => __('Input border Color','be-themes'),
				'type' => 'color',
				'default' => ''
			),										
		)
	);
	
	// $be_shortcode['be_slider'] = array (
	// 	'name' => __('Be Slider', 'be-themes'),
	// 	'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
	// 	'type' => 'multi',
	// 	'multi_field'=> true,
	// 	'single_field'=>'be_slide',
	// 	'options' => array (
	// 		'animation_type' => array (
	// 			'title'=> __('Slider Animation Type','be-themes'),
	// 			'type'=> 'select',
	// 			'options'=> array('fxSoftScale', 'fxPressAway', 'fxSideSwing', 'fxFortuneWheel', 'fxSwipe', 'fxPushReveal', 'fxSnapIn', 'fxLetMeIn', 'fxStickIt', 'fxArchiveMe', 'fxVGrowth', 'fxSlideBehind', 'fxSoftPulse', 'fxEarthquake', 'fxCliffDiving'),
	// 			'default'=> 'fxSoftScale'
	// 		),
	// 		'slider_height' => array (
	// 			'title'=> __('Slider Height','be-themes'),
	// 			'type'=> 'text',
	// 			'default'=> ''
	// 		),
	// 	)	
	// );

	// $be_shortcode['be_slide'] = array (
	// 	'name' => __('Slide', 'be-themes'),
	// 	'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
	// 	'type' => 'multi_single',			
	// 	'options' => array (
	// 		'image' => array (
	// 			'title'=> __('Choose a slider image','be-themes'),
	// 			'type'=>'media',
	// 			'default'=>'',
	// 			'select' => 'single'
	// 		),
	// 		'bg_video' =>array (
	// 			'title'=>__('Enable Background Video','be-themes'),
	// 			'type'=>'checkbox',
	// 			'default'=> '',
	// 		),				
	// 		'bg_video_mp4_src' => array (
	// 			'title'=> __('.MP4 Video File','be-themes'),
	// 			'type'=>'text',
	// 			'default'=> ''
	// 		),
	// 		'bg_video_ogg_src' => array (
	// 			'title'=> __('.OGG Video File','be-themes'),
	// 			'type'=>'text',
	// 			'default'=> ''
	// 		),
	// 		'bg_video_webm_src' => array (
	// 			'title'=> __('.Webm Video File','be-themes'),
	// 			'type'=>'text',
	// 			'default'=> ''
	// 		),
	// 		'content_width' => array (
	// 			'title' => __('Content Width','be-themes'),
	// 			'type' => 'text',
	// 			'default'=> ''
	// 		),
	// 		'content_alignment' =>array(
	// 			'title'=>__('Content Alignment','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> array('left', 'center', 'right'),
	// 			'default'=> 'left',
	// 		),
	// 		'title' => array (
	// 			'title' => __('Title','be-themes'),
	// 			'type' => 'text',
	// 			'default'=> ''
	// 		),
	// 		'h_tag' =>array(
	// 			'title'=>__('Heading tag to use for Title','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> array('h1','h2','h3','h4','h5','h6'),
	// 			'default'=> 'h3',
	// 		),
	// 		'title_color' => array (
	// 			'title' => __('Title Color','be-themes'),
	// 			'type' => 'color',
	// 			'default' => '',
	// 		),
	// 		'title_animation_type' =>array (
	// 			'title'=>__('Title Animation Type','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> $animations,
	// 			'default'=> 'fadeIn',
	// 		),
	// 		'small_image' => array (
	// 			'title'=> __('Content image','be-themes'),
	// 			'type'=>'media',
	// 			'default'=>'',
	// 			'select' => 'single'
	// 		),
	// 		'image_animation_type' =>array (
	// 			'title'=>__('Image Animation Type','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> $animations,
	// 			'default'=> 'fadeIn',
	// 		),
	// 		'content' => array (
	// 			'title'=> __('Slide Content','be-themes'),
	// 			'type'=> 'tinymce',
	// 			'content'=>true
	// 		),
	// 		'content_animation_type' =>array (
	// 			'title'=>__('Content Animation Type','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> $animations,
	// 			'default'=> 'fadeIn',
	// 		),
	// 	)		
	// );
}

?>