<?php
return array (
		'production' => array (
				// ; +--------+
				// ; | Assets |
				// ; +--------+
				'assets' => array (
						// ; +------------+
						// ; | Javascript |
						// ; +------------+
						'javascript' => array (
								'default' => array (
										'__construct' => array (
												'/static/js/modules/default.js' 
										),
										'index' => array (
												'index' => array (
														'/static/js/jquery.countdown.js' 
												) 
										),
										'quiz' => array (
												'__construct' => array (
														'/static/js/jquery.countdown.js',
														'/static/js/modules/default/quiz.js' 
												) 
										) 
								) 
						),
						// ; +------------+
						// ; | Stylesheet |
						// ; +------------+
						'stylesheet' => array (
								'default' => array () 
						) 
				)
				 
		),
		'development' => array (
				'_extends' => 'production' 
		) 
);