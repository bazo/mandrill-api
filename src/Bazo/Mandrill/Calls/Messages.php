<?php

namespace Bazo\Mandrill\Calls;

use Bazo\Mandrill\Client\MandrillClient;
use Bazo\Mandrill\Message;

/**
 * Messages Calls
 *
 * @author Martin Bažík <martin@bazo.sk>
 */
class Messages
{

	/** @var MandrillClient */
	private $client;


	public function __construct(MandrillClient &$client)
	{
		$this->client = $client;
	}


	/**
	 * Send a message
	 * @param struct $message
	 * @param bool $async enable a background sending mode that is optimized for bulk sending. In async mode, messages/send will immediately return a status of "queued" for every recipient. To handle rejections when sending in async mode, set up a webhook for the 'reject' event. Defaults to false for messages with no more than 10 recipients; messages with more than 10 recipients are always sent asynchronously, regardless of the value of async.
	 * @return array
	 */
	public function send(Message $message, $async = FALSE)
	{
		$command = $this->client->getCommand('messages-send', [
			'message' => $message->toArray(),
			'async' => $async
		]);

		return $command->execute();
	}

	/**
	 * Send a new transactional message through Mandrill using a template
	 * @param string $templateName
	 * @param array $templateContent
	 * @param \Mandrill\Message $message
	 * @param bool $async
	 * @return array
	 */
	public function sendTemplate($templateName, array $templateContent, Message $message, $async = FALSE)
	{
		$command = $this->client->getCommand('messages-send', [
			'message' => $message->toArray(),
			'async' => $async
		]);

		return $command->execute();
	}

	/**
	 * Search the content of recently sent messages and optionally narrow by date range, tags and senders
	 * @param string $query
	 * @param \DateTime $dateFrom
	 * @param \DateTime $dateTo
	 * @param array $tags
	 * @param array $senders
	 * @param int $limit
	 */
	public function search($query, $dateFrom, $dateTo, array $tags, array $senders, $limit)
	{

	}

	/**
	 * Parse the full MIME document for an email message, returning the content of the message broken into its constituent pieces
	 * @param string $rawMessage
	 */
	public function parse($rawMessage)
	{

	}

	/**
	 * Take a raw MIME document for a message, and send it exactly as if it were sent over the SMTP protocol
	 * @param string $rawMessage
	 * @param string $fromEmail
	 * @param string $fromName
	 * @param string $to
	 * @param bool $async
	 */
	public function sendRaw($rawMessage, $fromEmail, $fromName, $to, $async = FALSE)
	{

	}


}

