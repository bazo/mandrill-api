<?php

namespace Bazo\Mandrill\Calls;

use Bazo\Mandrill\Client\MandrillClient;

/**
 * Users Calls
 *
 * @author Martin Bažík <martin@bazo.sk>
 */
class Users
{

	/** @var MandrillClient */
	private $client;

	public function __construct(MandrillClient &$client)
	{
		$this->client = $client;
	}


	/**
	 * Return the information about the API-connected user
	 * @return array
	 */
	public function info()
	{
		$command = $this->client->getCommand('users-info', [
		]);

		return $command->execute();
	}


	/**
	 * Validate an API key and respond to a ping
	 * @return array
	 */
	public function ping()
	{
		$command = $this->client->getCommand('users-ping', [
		]);

		return $command->execute();
	}


	/**
	 * Validate an API key and respond to a ping (anal JSON parser version)
	 * @return array
	 */
	public function ping2()
	{
		$command = $this->client->getCommand('users-ping2', [
		]);

		return $command->execute();
	}


	/**
	 * Return the senders that have tried to use this account, both verified and unverified
	 * @return array
	 */
	public function senders()
	{
		$command = $this->client->getCommand('users-senders', [
		]);

		return $command->execute();
	}


}

