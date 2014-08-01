<?php

namespace Bazo\Mandrill\Client;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;



/**
 * MandrillClient
 *
 * @author Martin Bažík <martin@bazo.sk>
 * @property-read \Mandrill\Calls\Users $users Users Calls
 * @property-read \Mandrill\Calls\Messages $messages Messages Calls
 */
class MandrillClient extends Client
{

	/** @var \Mandrill\Calls\Users */
	private $users;

	/** @var \Mandrill\Calls\Messages */
	private $messages;

	/** @var array */
	private $allowedProperties = [
		'users',
		'messages',
	];

	/**
	 * Factory method to create a new MandrillClient
	 *
	 * @param string $key Mandrill api key
	 */
	public function __construct($key)
	{
		$default = [
			'base_url' => 'https://mandrillapp.com/api/1.0/'
		];
		$required = ['base_url'];
		$config = Collection::fromConfig([], $default, $required);

		parent::__construct($config->get('base_url'), $config);
		$this->setDescription(ServiceDescription::factory(__DIR__ . DIRECTORY_SEPARATOR . 'client.json'));

		$this->getEventDispatcher()->addListener('command.before_prepare', function (\Guzzle\Common\Event $e) use($key) {
			$e['command']->set('key', $key);
		});

		$this->users = new \Mandrill\Calls\Users($this);
		$this->messages = new \Mandrill\Calls\Messages($this);
	}


	/**
	 * @param string $name
	 */
	public function __get($name)
	{
		if (!in_array($name, $this->allowedProperties)) {
			throw new \LogicException(sprintf('Property %s does not exist', $name));
		}

		return $this->$name;
	}


}