<?php

// The $steps array below contains the exact copy of the steps
// in our online demo at http://www.phpsetupwizard.com/demo
// We left it to help you understand how PHP Setup Wizard works
// Feel free to change it as necessary or simply clean it up and
// create your own $steps array to suit your needs. Enjoy!

$steps = array(
	array(
		'name' => 'Başlangıç',
		'fields' => array(
			array(
				'type' => 'info',
				'value' => 'Hoşgeldin! Mirarus MVC TS3 DNS Sisteminin Kurulumuna Başlamak İçin İleri\'ye tıklayın.',
			),
		),
    ),
	array(
		'name' => 'Sistem Gereksinimleri',
		'fields' => array(
			array(
				'type' => 'info',
				'value' => 'Tam yükleme işlemine devam etmeden önce, yazılımımızı yükleyip çalıştırabilmeniz için sunucu yapılandırmanız üzerinde bazı testler yapacağız. Lütfen sonuçları tamamen okuduğunuzdan emin olun ve gerekli tüm testler geçilmeden devam etmeyin.',
			),
			array(
				'type' => 'info',
				'value' => 'Ve bu sihirbaz Yapılandırma Dosyasını yaratacaktır',
			),
			array(
				'type' => 'php-config',
				'label' => 'Gerekli PHP ayarları',
				'items' => array(
					'php_version' => array('>=5.6', 'PHP Version'),
					'register_globals' => false,
					'upload_max_filesize' => '>=2mb',
				),
			),
			array(
				'type' => 'php-modules',
				'label' => 'Gerekli PHP modülleri',
				'items' => array(
					//'mysql' => array(true, 'MySQL'),
					'mysqli' => array(true, 'MySQLi'),
					'PDO' => array(true, 'PDO'),
					'curl' => array(true, 'cURL'),
				),
			),
			array(
				'type' => 'file-permissions',
				'label' => 'Klasörler ve dosyalar',
				'items' => array(
					'core/config.php' => 'write',
				),
			),
		),
	),
	array(
		'name' => 'Site İsmi & Klasör yolları ',
		'fields' => array(
			array(
				'type' => 'info',
				'value' => '404 Sayfası İsmi İçin Ve Bazı Gerekli Sayfalar İçin Kullanılıcaktır!',
			),
			array(
				'type' => 'text',
				'label' => 'Website İsmi',
				'name' => 'website_name',
				'default' => 'Mirarus MVC TS3 DNS System',
				'validate' => array(
					array('rule' => 'required'),
				),
			),
			array('type' => 'info','value' => '',),
			array('type' => 'info','value' => '',),
			array(
				'type' => 'info',
				'value' => 'Sistemin gerektirdiği yolları otomatik olarak önceden tanımladık. Lütfen bir sonraki adıma geçmeden önce her şeyin doğru olduğundan emin olun.',
			),
			array(
				'type' => 'info',
				'value' => 'Komut dosyasının mutlak yolunu ayarlamanız gerekir. Örneğin: /lisans (Sonunda eğik çizgi olmadan.',
			),
			array(
				'type' => 'text',
				'label' => 'Website URL\'si',
				'name' => 'virtual_path',
				'default' => rtrim(preg_replace('#/install/$#', '', VIRTUAL_PATH), '').'',
				'validate' => array(
					array('rule' => 'required'),
				),
			),
			array(
				'type' => 'text',
				'label' => 'Kurulum yolu',
				'name' => 'system_path',
				'default' => rtrim(preg_replace('#/install/$#', '', BASE_PATH), '').'',
				'validate' => array(
					array('rule' => 'required'),
					array('rule' => 'validate_system_path'),
				),
			),
		),
	),
	array(
		'name' => 'Veritabanı Ayarları',
		'fields' => array(
			array(
				'type' => 'info',
				'value' => 'Veritabanı ayarlarınızı burada belirtin. Kurulum sihirbazının veritabanının bu adımdan önce oluşturulması gerektiğini lütfen unutmayın. Henüz bir tane oluşturmadıysanız, şimdi oluşturun.',
			),
			array(
				'label' => 'Veritabanı hostname',
				'name' => 'db_hostname',
				'type' => 'text',
				'default' => 'localhost',
				'validate' => array(
					array('rule' => 'required'),
				),
			),
			array(
				'label' => 'Veritabanı İsmi',
				'name' => 'db_name',
				'type' => 'text',
				'default' => '',
				'highlight_on_error' => false,
				'validate' => array(
					array('rule' => 'required'),
					array(
						'rule' => 'database',
						'params' => array(
							'db_host' => 'db_hostname',
							'db_name' => 'db_name',
							'db_user' => 'db_username',
							'db_pass' => 'db_password'
						)
					),
				),
			),
			array(
				'label' => 'Veritabanı Kullanıcı Adı',
				'name' => 'db_username',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'),
				),
			),
			array(
				'label' => 'Veritabanı Şifresi',
				'name' => 'db_password',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'),
				),
			),
		),
	),
	array(
		'name' => 'Yüklemeye hazır',
		'fields' => array(
			array(
				'type' => 'info',
				'value' => 'Şimdi kuruluma devam etmeye hazırız. Bu adımda, gerekli tüm tabloları oluşturmaya ve bunları verilerle doldurmaya çalışacağız. Bir şeyler ters giderse, Veritabanı Ayarları adımına geri dönün ve her şeyin doğru olduğundan emin olun.',
			),
		),
		'callbacks' => array(
			array('name' => 'install'),
		),
	),
	array(
		'name' => 'Admin Hesabı',
		'fields' => array(
			array(
				'type' => 'info',
				'value' => 'Veritabanı tabloları başarıyla oluşturuldu ve verilerle dolduruldu!',
			),
			array(
				'type' => 'info',
				'value' => 'Şimdi kendiniz için bir yönetici hesabı oluşturabilirsiniz. Bu, web sitesini kontrol panelinden yönetmenizi sağlar.',
			),
			array(
				'label' => 'Kullanıcı Adı',
				'name' => 'username',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'),
				),
			),
			array(
				'label' => 'Şifre',
				'name' => 'user_password',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'),
					array('rule' => 'alpha_numeric'),
					array('rule' => 'min_length', 'params' => 5),
					array('rule' => 'max_length', 'params' => 20),
				),
			),
			array(
				'label' => 'Şifre (doğrulama)',
				'name' => 'user_password2',
				'type' => 'text',
				'default' => '',
				'validate' => array(
					array('rule' => 'required'),
					array('rule' => 'matches', 'params' => 'user_password'),
				),
			),
		),
		'callbacks' => array(
			array('name' => 'setup_admin'),
		),
	),
	array(
		'name' => 'Tamamlandı',
		'fields' => array(
			array(
				'type' => 'info',
				'value' => 'Admin hesabı başarıyla oluşturuldu.',
			),
			array(
				'type' => 'info',
				'value' => '<font color="red">UYARI: Güvenliğiniz İçin "install" Klasörünü Silin!!!</font>',
			),
			array(
				'type' => 'info',
				'value' => 'Website Adresi: <a href="'.rtrim(isset($_SESSION['params']['virtual_path']) ? $_SESSION['params']['virtual_path'] : '', '/').'" target="_blank">'.rtrim(isset($_SESSION['params']['virtual_path']) ? $_SESSION['params']['virtual_path'] : '', '/').'</a>'),
			array(
				'type' => 'info',
				'value' => 'Admin Paneli Adresi: <a href="'.rtrim(isset($_SESSION['params']['virtual_path']) ? $_SESSION['params']['virtual_path'].'/admin' : '', '/').'" target="_blank">'.rtrim(isset($_SESSION['params']['virtual_path']) ? $_SESSION['params']['virtual_path'].'/admin' : '/admin', '/').'</a>'),
			array(
				'type' => 'info',
				'value' => 'Bu Bilgileri Kullanarak Admin Girişi Yapabilirsiniz:',
			),
			array(
				'type' => 'info',
				'value' => 'Kullanıcı Adı: '.(isset($_SESSION['params']['username']) ? $_SESSION['params']['username'] : '').'<br/>
				Şifre: '.(isset($_SESSION['params']['user_password']) ? $_SESSION['params']['user_password'] : ''),
			),
		),
	),
);
