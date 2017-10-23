<?php
namespace Utils;
/**
 * Description of ValidatorTest
 *
 * @author yoink
 */
class ValidatorTest extends \PHPUnit_Framework_TestCase
{
	
	public  function testValidEmailFalse()
	{
		$this->assertFalse(\Utils\Validator::validEmail('iluhamail.ru'));
		$this->assertFalse(\Utils\Validator::validEmail('iluha@mailru'));
	}
	public  function testValidEmailTrue()
	{
		$this->assertTrue(\Utils\Validator::validEmail('iluha@mail.ru'));
	}

	public  function testValidNameFalse()
	{
		$this->assertFalse(\Utils\Validator::validName('@!$#'));
		$this->assertFalse(\Utils\Validator::validName('qq'));
	}
	public  function testValidNameTrue()
	{
		$this->assertTrue(\Utils\Validator::validName('Iluha'));
	}

	public  function testValidPasswordFalse()
	{
		$this->assertFalse(\Utils\Validator::validPassword('sadd'));
		$this->assertFalse(\Utils\Validator::validPassword('@!$!%'));
	}
	public  function testValidPasswordTrue()
	{
		$this->assertTrue(\Utils\Validator::validPassword('tempwwq2'));
	}

	public  function testValidCountFalse()
	{
		$this->assertFalse(\Utils\Validator::validCount('-2'));
		$this->assertFalse(\Utils\Validator::validCount('3.5'));
	}
	public  function testValidCountTrue()
	{
		$this->assertTrue(\Utils\Validator::validCount('23'));
	}

	public  function testValidAuthNameFalse()
	{
		$this->assertFalse(\Utils\Validator::validAuthName('!@$'));
		$this->assertFalse(\Utils\Validator::validAuthName('W'));
	}
	public  function testValidAuthNameTrue()
	{
		$this->assertTrue(\Utils\Validator::validAuthName('Pushkin'));
	}
	public  function testValidGenreNameFalse()
	{
		$this->assertFalse(\Utils\Validator::validGenreName('!@$'));
		$this->assertFalse(\Utils\Validator::validGenreName(''));
	}
	public  function testValidGenreNameTrue()
	{
		$this->assertTrue(\Utils\Validator::validGenreName('Fantasy'));
	}
	public  function testValidBookNameFalse()
	{
		$this->assertFalse(\Utils\Validator::validBookName('$!'));
	}
	public  function testValidBookNameTrue()
	{
		$this->assertTrue(\Utils\Validator::validBookName('Lord of the rings'));
	}
	
	public  function testValidDescriptFalse()
	{
		$this->assertFalse(\Utils\Validator::validDescript('wq'));
	}
	
	public  function testValidDescriptTrue()
	{
		$this->assertTrue(\Utils\Validator::validDescript('Kniga o Frodo'));
	}

	public  function testValidPriceFalse()
	{
		$this->assertFalse(\Utils\Validator::validPrice('qwe'));
		$this->assertFalse(\Utils\Validator::validPrice('-2'));
		$this->assertFalse(\Utils\Validator::validPrice(' '));
	}
	public  function testValidPriceTrue()
	{
		$this->assertTrue(\Utils\Validator::validPrice('232.23'));
	}

	public  function testValidDiscountFalse()
	{
		$this->assertFalse(\Utils\Validator::validDiscount('qwe'));
		$this->assertFalse(\Utils\Validator::validDiscount('66'));
	}
	public  function testValidDiscountTrue()
	{
		$this->assertTrue(\Utils\Validator::validDiscount(23));
	}

}
