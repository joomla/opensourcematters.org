var config = {
		apiKey: 'f3c65236ed9682b20dd601125410aa54139c8dfa',
		product: 'PRO_MULTISITE',
		initialState: "NOTIFY",
		consentCookieExpiry: 90,
      	notifyOnce: false,
      	mode: 'GDPR',
      	encodeCookie: true,
      	subDomains: false,
		position: "left",
		theme: "light",
		layout: "slideout",
		setInnerHTML: true,
		rejectButton: false,
		branding : {
			fontFamily: '"Helvetica Neue",Helvetica,Arial,sans-serif',
			fontSizeTitle: "1.1em",
			fontSizeHeaders: "1em",
			fontSizeIntro: "1em",
			fontSize: "0.95em",
			fontColor: "#fff",
			backgroundColor: '#1a3867',
			notifyFontColor: '#fff',
			notifyBackgroundColor: '#1a3867',
			acceptText: '#FFF',
			acceptBackground: '#51a351',
			rejectText: '#000',
			rejectBackground: 'transparent',
			closeText: '#FFF',
			closeBackground: '#000',
			toggleText: '#000',
			toggleColor: '#ccc',
			toggleBackground: '#fff',
			alertText: '#000',
			alertBackground: '#51a351',
			buttonIcon: null,
			buttonIconWidth: "64px",
			buttonIconHeight: "64px",
			removeIcon: false,
			removeAbout: true
		},
		text : {
			// Main Panel
		  title: 'This website uses cookies to remember users and understand ways to enhance their experience.',
		  intro: 'Some cookies are necessary, while other cookies help us improve your experience, while you are navigating through our website. For further information, please visit our <a href="https://www.joomla.org/privacy-policy.html" target="_blank">Privacy Policy</a>.',
		  acceptSettings: 'I Accept',
		  acceptRecommended: 'Accept Cookies',
		  rejectSettings : '',
		  necessaryTitle: 'Manage Cookie Preferences',
		  necessaryDescription: '<strong>Strictly Necessary Cookies</strong> are essential for our website to function properly, for instance authenticating logins or serving files, crucial for the core functionality. You can only disable necessary cookies via browser settings but if you do, our website might not be properly functional for your needs.',
		  // thirdPartyTitle: '',
		  // thirdPartyDescription: '',
		  notifyTitle: 'Your choice regarding cookies on this site',
		  notifyDescription: 'We use cookies to optimize site functionality and give you the best possible experience. Learn more.',
		  // Vendors
		  showVendors: 'Show vendors within this category',
		  thirdPartyCookies: 'This vendor may set third party cookies.',
		  readMore: 'Read more',
		},
		statement : {
    		description: 'For more information vist our',
    		name : 'Privacy Statement',
    		url: 'https://www.joomla.org/privacy-policy.html',
    		updated : '11/08/2020'
  		},
  		sameSiteCookie: true,
  		sameSiteValue: "Strict",	
		optionalCookies: [{
				name: 'performance',
				label: 'Performance Cookies',
				description: 'Performance cookies help us to improve our website by collecting and reporting information anonymously. We use Analytics services from Google LLC to help analyze how users use the site. IP anonymization is activated on this website.',
				cookies: ['_dc_gtm_UA*','_ga','_gid'],
				onAccept: function() {
					(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
					j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
					'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
					})(window,document,'script','dataLayer','GTM-5GST4C');
					},
				onRevoke: function() {
					// Disable Google Analytics
					window['ga-disable-UA-544070-14'] = true;
					// End Google Analytics
					CookieControl.delete('_dc_gtm_UA-544070-14');
					CookieControl.delete('_ga');
					CookieControl.delete('_gid');
				},
				recommendedState: true,
				lawfulBasis: 'legitimate interest'
				},
				{
					name: 'advertising',
					label: 'Advertising Cookies',
					description: 'Advertising cookies help you see some ads based on your preferences. Joomla! serves or hosts ads as they are one of its major financial support.',
					cookies: ['IDE'],
					onAccept: function() {},
					onRevoke: function() {
						CookieControl.delete('IDE');
					},
				},
		    {
			name: 'accept',
			label: ' ',
			description: '<a href="" onclick="CookieControl.hide();">Continue to site</a>',
			toggleType: 'checkbox'
		    }   
			],
			statement: {},
		};

	    CookieControl.load( config );