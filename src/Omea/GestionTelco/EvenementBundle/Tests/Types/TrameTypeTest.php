<?php
namespace Omea\GestionTelco\EvenementBundle\Tests\Types;

use Doctrine\DBAL\Types\Type;
use Omea\GestionTelco\EvenementBundle\DTO\ActeDefinition;
use Omea\GestionTelco\EvenementBundle\Types\TrameType;

class TrameTypeTest extends \PHPUnit_Framework_TestCase
{
    private $platformMock;
    private $trameType;

    /**
     * Enregistre le type doctrine
     *
     * @beforeClass
     */
    public static function setUpType()
    {
        Type::addType('trametype', 'Omea\GestionTelco\EvenementBundle\Types\TrameType');
    }

    public function setUp()
    {
        $this->platformMock = $this->getMockBuilder('\Doctrine\DBAL\Platforms\AbstractPlatform')->getMockForAbstractClass();
        $this->trameType = Type::getType('trametype');
    }


    public function testToSQLValue()
    {
        $acteDefinitions = [
            new ActeDefinition('foo', 'key=value&key2=value'),
            new ActeDefinition('bar', 'key=value&key2=value')
        ];

        $expectedJson = '[{"name":"foo","options":"key=value&key2=value"},{"name":"bar","options":"key=value&key2=value"}]';

        $this->assertEquals(
            $expectedJson,
            $this->trameType->convertToDatabaseValue($acteDefinitions, $this->platformMock)
        );
    }

    public function testToPHPValue()
    {
        $expected = [
            new ActeDefinition('foo', 'key=value&key2=value'),
            new ActeDefinition('bar', 'key=value&key2=value')
        ];

        $jsonDefinition = '[{"name":"foo","options":"key=value&key2=value"},{"name":"bar","options":"key=value&key2=value"}]';

        $this->assertEquals(
            $expected,
            $this->trameType->convertToPHPValue($jsonDefinition, $this->platformMock)
        );
    }
}
