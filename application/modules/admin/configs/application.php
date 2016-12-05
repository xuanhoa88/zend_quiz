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
								'admin' => array (
										'__construct' => array (
												'/static/metisMenu/dist/metisMenu.min.js',
												'/static/js/jquery.autoFill.js',
												'/static/js/modules/admin.js' 
										),
										'session' => array (
												'login' => array (
														'/static/js/modules/admin/login.js' 
												) 
										),
										'teacher' => array (
												'__construct' => array (
														'/static/js/modules/admin/teacher.js' 
												) 
										),
										'student' => array (
												'__construct' => array (
														'/static/js/modules/admin/student.js' 
												) 
										),
										'user' => array (
												'__construct' => array (
														'/static/js/modules/admin/user.js' 
												) 
										),
										'chapter' => array (
												'__construct' => array (
														'/static/js/modules/admin/chapter.js' 
												) 
										),
										'question' => array (
												'__construct' => array (
														'/static/jquery-easing/jquery.easing.1.3.js',
														'/static/jquery-easing/jquery.easing.compatibility.js',
														'/static/js/jquery.expander.js',
														'/static/jquery-scrollTo/1.4.13/jquery.scrollTo.min.js',
														'/static/jquery-uploadify/jquery.uploadify.min.js',
														'/static/jquery-uploadify/jquery.uploadify.configs.js',
														'/static/js/modules/admin/media.js',
														'/static/codemirror/codemirror.js',
														'/static/codemirror/xml.min.js',
														'/static/codemirror/formatting.min.js',
														'/static/summernote/summernote.js',
														'/static/summernote/lang/vi-VN.js',
														'/static/summernote/plugin/summernote-ext-video.js',
														'/static/summernote/plugin/summernote-ext-fontstyle.js',
														'/static/js/modules/admin/question.js' 
												) 
										),
										'exam' => array (
												'__construct' => array (
														'/static/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
														'/static/bootstrap-datetimepicker/js/locales/vi-VN.js',
														'/static/js/modules/admin/exam.js' 
												) 
										),
										'score' => array (
												'__construct' => array (
														'/static/js/modules/admin/score.js' 
												) 
										),
										'user' => array (
												'rearrange-navbar' => array (
														'/static/jquery-ui/1.11.4/jquery-ui.min.js',
														'/static/js/jquery.nestedSortable.js',
														'/static/js/modules/admin/user/rearrange-navbar.js' 
												) 
										),
										'media' => array (
												'__construct' => array (
														'/static/jquery-uploadify/jquery.uploadify.min.js',
														'/static/jquery-uploadify/jquery.uploadify.configs.js',
														'/static/js/modules/admin/media.js' 
												) 
										),
										'import' => array (
												'__construct' => array (
														'/static/bootstrap-filestyle/bootstrap-filestyle.min.js',
														'/static/js/jquery.fileDownload.js',
														'/static/js/modules/admin/import.js' 
												) 
										) 
								) 
						),
						// ; +------------+
						// ; | Stylesheet |
						// ; +------------+
						'stylesheet' => array (
								'admin' => array (
										'__construct' => array (
												'/static/metisMenu/dist/metisMenu.min.css',
												'/static/css/admin.css',
												'/static/css/admin-custom.css'
										),
										'exam' => array (
												'__construct' => array (
														'/static/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css' 
												) 
										),
										'user' => array (
												'rearrange-navbar' => array (
														'/static/jquery-ui/1.11.4/jquery-ui.min.css',
														'/static/jquery-ui/1.11.4/jquery-ui.structure.min.css',
														'/static/jquery-ui/1.11.4/jquery-ui.theme.min.css' 
												) 
										),
										'question' => array (
												'__construct' => array (
														'/static/codemirror/codemirror.css',
														'/static/codemirror/monokai.min.css',
														'/static/summernote/summernote.css' 
												) 
										),
										'media' => array (
												'__construct' => array (
														'/static/jquery-uploadify/uploadify.css' 
												) 
										) 
								) 
						) 
				) 
		),
		'development' => array (
				'_extends' => 'production' 
		) 
);