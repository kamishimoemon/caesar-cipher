<?php

declare(strict_types=1);

namespace Kamishimoemon\Caesar;

use RuntimeException;
use function mb_str_split;

class Characters
{
	private array $chars;

	public function __construct (array $chars)
	{
		$this->chars = $chars;
	}

	public function encrypt (Cipher $cipher): Characters
	{
		return Characters::fromArray($cipher->transform($this->chars));
	}

	public function decrypt (Cipher $cipher): Characters
	{
		return $this->encrypt($cipher->inverse());
	}

	public function __toString (): string
	{
		return implode(array_map(fn($char) => strval($char), $this->chars));
	}

	public static function fromString (string $str): Characters
	{
		$chars = [];
		foreach (mb_str_split($str) as $char) {
			$chars[] = Character::fromChar($char);
		}
		return new Characters($chars);
	}

	public static function fromArray (array $chars): Characters
	{
		return new Characters($chars);
	}
}