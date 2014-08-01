<?php

namespace Mandrill;



/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class File
{

	/** @var string */
	private $type;

	/** @var string */
	private $name;

	/** @var string */
	private $content;

	/**
	 * @param string $type the MIME type of the attachment
	 * @param type $name the file name of the attachment
	 * @param type $content the content of the attachment as a base64-encoded string
	 */
	public function __construct($type, $name, $content)
	{
		$this->type = $type;
		$this->name = $name;
		$this->content = $content;
	}


	/**
	 * @internal
	 * @return array
	 */
	public function toArray()
	{
		return [
			'type'		 => $this->type,
			'name'		 => $this->name,
			'content'	 => $this->content
		];
	}


}