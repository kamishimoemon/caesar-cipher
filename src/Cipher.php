<?php

declare(strict_types=1);

namespace Kamishimoemon\Caesar;

use UnexpectedValueException;

class Cipher
{
	private int $pos;

	public function __construct (int $pos)
	{
		$this->pos = $pos;
	}

	public function transform (array $chars): array
	{
		return array_map(fn($char) => $char->shift($this->pos), $chars);
	}

	public function inverse (): Cipher
	{
		return new Cipher($this->pos * -1);
	}

	public static function new (int $shiftPositions): Cipher
	{
		return new Cipher($shiftPositions);
	}
}