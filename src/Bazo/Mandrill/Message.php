<?php

namespace Mandrill;



/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Message
{

	private $struct = [];

	/**
	 *
	 * @param type $html
	 * @param type $text
	 * @return Message
	 */
	public function compose($html, $text = NULL)
	{
		$this->struct['html'] = $html;
		$this->struct['text'] = $text;

		return $this;
	}


	/**
	 *
	 * @param type $subject
	 * @return Message
	 */
	public function setSubject($subject)
	{
		$this->struct['subject'] = $subject;

		return $this;
	}


	/**
	 *
	 * @param type $email
	 * @param type $name
	 * @return Message
	 */
	public function from($email, $name = NULL)
	{
		$this->struct['from_email'] = $email;
		$this->struct['from_name'] = $name;

		return $this;
	}


	/**
	 *
	 * @param type $email
	 * @param type $name
	 * @return Message
	 */
	public function addRecipient($email, $name = NULL)
	{
		$recipient = [
			'email'	 => $email,
			'name'	 => $name
		];

		$this->struct['to'][] = $recipient;

		return $this;
	}


	/**
	 * An optional address to receive an exact copy of each recipient's email email
	 * @param type $bcc
	 * @return Message
	 */
	public function setBcc($bcc)
	{
		$this->struct['bcc'] = $bcc;

		return $this;
	}


	/**
	 * Set a message header
	 * @param string $header
	 * @param string $value
	 * @return Message
	 */
	public function setHeader($header, $value)
	{
		$this->struct['header'][$header] = $value;

		return $this;
	}


	/**
	 * Set global merge variables to use for all recipients. You can override these per recipient.
	 * @param array $vars Array of name, content pairs $vars = [['name' => 'name value', 'content' => 'content value'], [...]]
	 * @return Message
	 */
	public function setGlobalMergerVars(array $vars)
	{
		$this->struct['global_merge_vars'] = $vars;

		return $this;
	}


	/**
	 * Set per-recipient merge variables, which override global merge variables with the same name.
	 * @param string $recipient
	 * @param array $vars Array of name, content pairs $vars = [['name' => 'name value', 'content' => 'content value'], [...]]
	 * @return Message
	 */
	public function setRecipientMergeVars($recipient, array $vars)
	{
		$this->struct['merge_vars'][] = [
			'rcpt'	 => $recipient,
			'vars'	 => $vars
		];

		return $this;
	}


	/**
	 * Tag the message
	 * @param string|array $tags
	 * @return Message
	 */
	public function tag($tags)
	{
		if (!is_array($tags)) {
			$tags = func_get_args();
		}
		$this->struct['tags'] += $tags;

		return $this;
	}


	/**
	 * Add an attachment
	 * @param File $attachment
	 * @return Message
	 */
	public function addAttachment(File $attachment)
	{
		$this->struct['attachments'][] = $attachment->toArray();
		return $this;
	}


	/**
	 * Add an embedded image
	 * @param File $attachment
	 * @return Message
	 */
	public function embedImage(File $image)
	{
		$this->struct['images'][] = $image->toArray();
		return $this;
	}


	/**
	 * Set an arbitrary options for full list see here https://mandrillapp.com/api/docs/messages.html#method=send
	 * @param string $option
	 * @param mixed $value
	 * @return Message
	 */
	public function setOption($option, $value)
	{
		$this->struct[$option] = $value;
		return $this;
	}


	/**
	 * @internal
	 * @return array
	 */
	public function toArray()
	{
		return $this->struct;
	}


}