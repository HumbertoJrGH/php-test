<?php

use PHPUnit\Framework\TestCase;
use Control\Cidadão;

class CidadãoTest extends TestCase
{
	protected $cidadão;

	protected function setUp(): void
	{
		$this->cidadão = new Cidadão();
	}

	public function testCountCitizens()
	{
		$count = $this->cidadão->count();
		$this->assertIsInt($count);
		$this->assertGreaterThanOrEqual(0, $count);
	}

	public function testGetAllCitizens()
	{
		$citizens = $this->cidadão->getAll();
		$this->assertIsArray($citizens);
		foreach ($citizens as $citizen) {
			$this->assertArrayHasKey('nis', $citizen);
			$this->assertArrayHasKey('name', $citizen);
		}
	}

	public function testGetByNIS()
	{
		$nis = '12345678901'; // Use a valid NIS for testing
		$citizen = $this->cidadão->getByNIS($nis);
		$this->assertIsArray($citizen);
		if (count($citizen) > 0) {
			$this->assertEquals($nis, $citizen[0]['nis']);
		}
	}

	public function testSaveCitizen()
	{
		$name = 'Test Citizen';
		$result = $this->cidadão->save($name);
		$this->assertArrayHasKey('status', $result);
		if ($result['status']) {
			$this->assertArrayHasKey('NIS', $result);
			// Verify that the citizen was saved
			$savedCitizen = $this->cidadão->getByNIS($result['NIS']);
			$this->assertNotEmpty($savedCitizen);
			$this->assertEquals($name, $savedCitizen[0]['name']);
		} else {
			// If not successful, check the message
			$this->assertArrayHasKey('message', $result);
		}
	}

	public function testSQLInjectionProtection()
	{
		$name = "'; DROP TABLE citizen_nis; --";
		$result = $this->cidadão->save($name);
		$this->assertArrayHasKey('status', $result);
		$this->assertFalse($result['status'], 'SQL Injection should not succeed');
		$this->assertArrayHasKey('message', $result);
		$this->assertStringContainsString('Erro ao cadastrar cidadão', $result['message']);
		
	}
}
