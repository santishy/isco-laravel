<?php

return array(
	# Account credentials from developer portal
	//'mode'=>'live',
	'Account' => array(
		'ClientId' => 'AVFlmFoXKSRgugi6J4UQa2Rmmry54Vfy_jEm6dE770XppCCb8u1dU641SsVd0u_-bynp-dO2C_WeEN6B',
	'ClientSecret' => 'EB0gn3RBrBsEBRLcVQ6y4gGaQWSSeHHCxyM05kOk3tnp8oc_PR3V1XIhjKYwnyFfs1S-_SlB7mXWyXH9',
	),
	/*'Account' => array(
		'ClientId' => 'AfJwA0jjAtmAMqyJtkOWmIVbg7PCGjsY0nwndPq_6lyDHSh-4MWBLcVtPTOSsXXJHD049quRpjUTOupb',
		'ClientSecret' => 'ELs42pV9YrAO7IsuceFT4oK6JP4l-bU7dOOjJ-axTIWGvysrUwwhJ4AwGzirrX7EHZ1ZNoND0SK7Xp4T',
	),*/

	# Connection Information
	'Http' => array(
		// 'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),


	# Logging Information
	'Log' => array(
		//'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		//'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		//'LogLevel' => 'FINE',
	),
);
