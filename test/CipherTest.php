<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use Kamishimoemon\Caesar\Cipher;
use Kamishimoemon\Caesar\Characters;

class CipherTest extends TestCase
{
	#[Test]
	#[DataProvider('examples')]
	function encrypting (string $plaintext, string $ciphertext, int $shiftPositions): void
	{
		$key = Cipher::new($shiftPositions);

		$result = Characters::fromString($plaintext)->encrypt($key);

		$this->assertEquals($ciphertext, strval($result));
	}

	#[Test]
	#[DataProvider('examples')]
	function decrypting (string $plaintext, string $ciphertext, int $shiftPositions): void
	{
		$key = Cipher::new($shiftPositions);

		$result = Characters::fromString($ciphertext)->decrypt($key);

		$this->assertEquals($plaintext, strval($result));
	}

	public static function examples (): array
	{
		return [
			'The quick brown fox jumps over the lazy dog' => ['THEQUICKBROWNFOXJUMPSOVERTHELAZYDOG', 'QEBNRFZHYOLTKCLUGRJMPLSBOQEBIXWVALD', -3],
			'Attack at once' => ['ATTACKATONCE', 'EXXEGOEXSRGI', 4],
		];
	}
}