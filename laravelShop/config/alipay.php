<?php
return array (
		//应用ID,您的APPID。
		'app_id' => "2016092500594926",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEAyweG+PlkUQQtDhL+wyZHgKGUPHRMj66C/QZKHCMT98kfO2hvxfLBbR+uqGll3PxdcQcSp4Dty0cxdP4hUWpq1X6wIG4BHVUp42is5ZkvxrGWC2mVHmYK2iNYInlnlnY5ZD17c5ZAGAk2nS1Sl/Gddgqaz02ibt76K01oAtUS4OITobKUPINJaV0ZY7it1qKAsDtn7gy0zsGl0Yzugc5R31D4IknPbq/HF9MhqhXQhvTrryeqr2CWmuKxvdaiX/ZNgDfeXB72qu3HDIgfZpHIXVLNu5cRvz0TEgjixWxFHmX3J6qL5DLj9S9CUvCI3CXh5VWWMhUiboSOn3bYdNfaIwIDAQABAoIBABYoDCK/lKMCwaf3irXhR4xSFctDJdfIQ6M5PH01lshDupTRIOGJTHKMMpNObT9gixH6o56EA29bpZoO4bPw2RfTa4UefCCnWprmoXes7/nPB4DXVN6sZCLKGKQqe5N/82NtEjva+cOlvcAJYioSxAxNu/dDkaZnzwVKvT8R4a2IzKiyuugUKzQfgxV2/V3i/yt0G7EA7Sg4pjwsEbF3SvKz484ipWfiNuKRQJprCtGxbeyWFzNpwzXLhonGDTo0FRF1LqhLo1JXZP8k/PuQD1xy8fi/hG3dfEqlTPrFHvJ+bL4G8Oyafu6qKDfECvYsG/h4mnq9agFKcIw+IcThUAECgYEA7+JLZnbQIa3msKsM2Zh8hJy2ES8hASj8pfLWLlvOiwvfCOLuQBgI1dZTLxG5M6eGk4nBhgT/ouA6CzUtw38Q25H+f7Kb2CLO2EWGf7UMxItOGCkenXqLPvFV/CMLWnWsTnh5aWlFOOy/G5h7zKStxjmQ/S3GAWTL40frYdShFYECgYEA2KthUpx/fnynZ2XXQOHt9vo0VNg9qigjjSfwGQGY0VmABPAX2o8TzQEQup/2e8XLIvSTQGNUHY11z5Q8YN+0N+OMaH0LlJTo1eq6vywvSmNnRXnKc8oRG2zP1gX0U8O8jL+rKKcw1ah4fts78IpCMmpQziiuB1ABVleXj7eVqaMCgYEA15kVl3P1wC9iBSrXE8KfNzj50hv/l+FUoXnN0kClNAdpX71F0MlJN5e3j7hoMerBY10OV/uqHqNUx7n19Z0Ac7eVewP2WZ1/NpXWOnVokkV53PEoGPWIrPuPAlwk2hqk0KoqxPjeRDlT0eOMcPMZU+1tSH+ZVKtZLF75SSYn2QECgYAmqu9DfwqB2F1H5rTzr154pU6RlcXriB5QIsCGtfI/6mkeeHrJVp+CBp6lr8adcD9AjcV5yEBKxeQwl5Pu9f2Du+hi/W4Dpk+nXazWUVxfOj5D9+hZocZLzq+I0qc4C8aql8pEBxKADwDyIs4fr40A0lh5cmkchPq4Hgm+bFUZYQKBgQCfN4xONHJLD4bNEzPjHj3tTeZ+O0Zx4mWq6/rbzNumxTB6Hk8eJcZGeAwBpv0uGAaN92hbNG8Opw06F7jtIqQq25WOUKeGc9ltIg2UNcUPT5NVwVTxtcwX2oB9pZR8Aubi5qQ/Dayl3L+g40/NO16nJOLx9fVLdSPOu68WBiBC+g==",
		
		//异步通知地址
		'notify_url' => url('return'),
		
		//同步跳转
		'return_url' => url('success'),

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB",
		
	
);