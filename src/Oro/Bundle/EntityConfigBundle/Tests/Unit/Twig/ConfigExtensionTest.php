<?php

namespace Oro\Bundle\EntityConfigBundle\Tests\Unit\Twig;

use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Bundle\EntityBundle\Tools\EntityClassNameHelper;
use Oro\Bundle\EntityConfigBundle\Config\Config;
use Oro\Bundle\EntityConfigBundle\Config\ConfigInterface;
use Oro\Bundle\EntityConfigBundle\Config\ConfigManager;
use Oro\Bundle\EntityConfigBundle\Config\Id\EntityConfigId;
use Oro\Bundle\EntityConfigBundle\Metadata\EntityMetadata;
use Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider;
use Oro\Bundle\EntityConfigBundle\Twig\ConfigExtension;
use Oro\Component\Testing\Unit\TwigExtensionTestCaseTrait;
use Symfony\Component\Routing\RouterInterface;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ConfigExtensionTest extends \PHPUnit\Framework\TestCase
{
    use TwigExtensionTestCaseTrait;

    /** @var \PHPUnit\Framework\MockObject\MockObject */
    private $configManager;

    /** @var ConfigExtension */
    private $extension;

    protected function setUp(): void
    {
        $this->configManager = $this->createMock(ConfigManager::class);
        $router = $this->createMock(RouterInterface::class);
        $entityClassNameHelper = $this->createMock(EntityClassNameHelper::class);
        $doctrineHelper = $this->createMock(DoctrineHelper::class);

        $container = self::getContainerBuilder()
            ->add(ConfigManager::class, $this->configManager)
            ->add(RouterInterface::class, $router)
            ->add(EntityClassNameHelper::class, $entityClassNameHelper)
            ->add(DoctrineHelper::class, $doctrineHelper)
            ->getContainer($this);

        $this->extension = new ConfigExtension($container);
    }

    public function testGetClassConfigNoConfig()
    {
        $className = 'Test\Entity';

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(false);
        $this->configManager->expects($this->never())
            ->method('getConfig');

        $this->assertEquals(
            [],
            self::callTwigFunction($this->extension, 'oro_entity_config', [$className])
        );
    }

    public function testGetFieldConfigForNullClassName()
    {
        $this->configManager->expects($this->never())
            ->method('hasConfig');

        $this->assertSame([], self::callTwigFunction($this->extension, 'oro_field_config', [null, 'testField']));
    }

    public function testGetFieldConfigNoConfig()
    {
        $className = 'Test\Entity';
        $fieldName = 'testField';

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className, $fieldName)
            ->willReturn(false);
        $this->configManager->expects($this->never())
            ->method('getProvider');

        $this->assertEquals(
            [],
            self::callTwigFunction($this->extension, 'oro_field_config', [$className, $fieldName])
        );
    }

    /**
     * @param string|null $inputScope
     *
     * @dataProvider getFieldConfigDataProvider
     */
    public function testGetFieldConfig($inputScope)
    {
        $className = 'Test\Entity';
        $fieldName = 'testField';
        $config    = array('key' => 'value');

        $configEntity = $this->getMockForAbstractClass(ConfigInterface::class);

        $configEntity->expects($this->any())
            ->method('all')
            ->willReturn($config);

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className, $fieldName)
            ->willReturn(true);

        $entityConfigProvider = $this->createMock(ConfigProvider::class);

        $scope = $inputScope ?: 'entity';

        $this->configManager->expects($this->once())
            ->method('getProvider')
            ->with($scope)
            ->willReturn($entityConfigProvider);

        $entityConfigProvider->expects($this->once())
            ->method('getConfig')
            ->with($className, $fieldName)
            ->willReturn($configEntity);

        if ($inputScope) {
            $actualConfig = self::callTwigFunction(
                $this->extension,
                'oro_field_config',
                [$className, $fieldName, $inputScope]
            );
        } else {
            $actualConfig = self::callTwigFunction(
                $this->extension,
                'oro_field_config',
                [$className, $fieldName]
            );
        }

        $this->assertEquals($config, $actualConfig);
    }

    public function getFieldConfigDataProvider()
    {
        return array(
            'default scope'   => array(
                'inputScope'    => null,
            ),
            'specified scope' => array(
                'inputScope'    => 'test',
            ),
        );
    }

    public function testGetFieldConfigValueForNullClassName()
    {
        $this->configManager->expects($this->never())
            ->method('hasConfig');

        $this->assertNull(
            self::callTwigFunction($this->extension, 'oro_field_config_value', [null, 'testField', 'test'])
        );
    }

    public function testGetFieldConfigValueNoConfig()
    {
        $className = 'Test\Entity';
        $fieldName = 'testField';

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className, $fieldName)
            ->willReturn(false);
        $this->configManager->expects($this->never())
            ->method('getProvider');

        $this->assertNull(
            self::callTwigFunction($this->extension, 'oro_field_config_value', [$className, $fieldName, 'test'])
        );
    }

    /**
     * @param string|null $inputScope
     *
     * @dataProvider getFieldConfigValueDataProvider
     */
    public function testGetFieldConfigValue($inputScope)
    {
        $className = 'Test\Entity';
        $fieldName = 'testField';
        $attrName  = 'attrName';
        $config    = array('key' => 'value');

        $configEntity = $this->getMockForAbstractClass(ConfigInterface::class);

        $configEntity->expects($this->any())
            ->method('get')
            ->with($attrName)
            ->willReturn($config);

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className, $fieldName)
            ->willReturn(true);

        $entityConfigProvider = $this->createMock(ConfigProvider::class);

        $scope = $inputScope ?: 'entity';

        $this->configManager->expects($this->once())
            ->method('getProvider')
            ->with($scope)
            ->willReturn($entityConfigProvider);

        $entityConfigProvider->expects($this->once())
            ->method('getConfig')
            ->with($className, $fieldName)
            ->willReturn($configEntity);

        if ($inputScope) {
            $actualConfig = self::callTwigFunction(
                $this->extension,
                'oro_field_config_value',
                [$className, $fieldName, $attrName, $inputScope]
            );
        } else {
            $actualConfig = self::callTwigFunction(
                $this->extension,
                'oro_field_config_value',
                [$className, $fieldName, $attrName]
            );
        }

        $this->assertEquals($config, $actualConfig);
    }

    public function getFieldConfigValueDataProvider()
    {
        return array(
            'default scope'   => array(
                'inputScope'    => null,
            ),
            'specified scope' => array(
                'inputScope'    => 'test',
            ),
        );
    }

    public function testGetClassConfigForNullClassName()
    {
        $this->configManager->expects($this->never())
            ->method('hasConfig');

        $this->assertSame([], self::callTwigFunction($this->extension, 'oro_entity_config', [null]));
    }

    /**
     * @param string      $expectedScope
     * @param string|null $inputScope
     *
     * @dataProvider getClassConfigDataProvider
     */
    public function testGetClassConfig($expectedScope, $inputScope)
    {
        $className = 'Test\Entity';
        $config    = array('key' => 'value');

        $configEntity = $this->getMockForAbstractClass(ConfigInterface::class);
        $configEntity->expects($this->any())
            ->method('all')
            ->willReturn($config);

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(true);
        $this->configManager->expects($this->once())
            ->method('getConfig')
            ->with($this->isInstanceOf(EntityConfigId::class))
            ->willReturnCallback(
                function (EntityConfigId $configId) use ($className, $expectedScope, $configEntity) {
                    self::assertEquals($className, $configId->getClassName());
                    self::assertEquals($expectedScope, $configId->getScope());

                    return $configEntity;
                }
            );

        if ($inputScope) {
            $actualConfig = self::callTwigFunction($this->extension, 'oro_entity_config', [$className, $inputScope]);
        } else {
            $actualConfig = self::callTwigFunction($this->extension, 'oro_entity_config', [$className]);
        }
        $this->assertEquals($config, $actualConfig);
    }

    public function getClassConfigDataProvider()
    {
        return array(
            'default scope'   => array(
                'expectedScope' => 'entity',
                'inputScope'    => null,
            ),
            'specified scope' => array(
                'expectedScope' => 'test',
                'inputScope'    => 'test',
            ),
        );
    }

    public function testGetClassConfigValueNoConfig()
    {
        $className = 'Test\Entity';

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(false);
        $this->configManager->expects($this->never())
            ->method('getConfig');

        $this->assertNull(
            self::callTwigFunction($this->extension, 'oro_entity_config_value', [$className, 'test'])
        );
    }

    public function testGetClassConfigValueForNullClassName()
    {
        $this->configManager->expects($this->never())
            ->method('hasConfig');

        $this->assertNull(self::callTwigFunction($this->extension, 'oro_entity_config_value', [null, 'test']));
    }

    public function testGetClassConfigValue()
    {
        $className         = 'Test\Entity';
        $configEntityScope = new Config(new EntityConfigId('entity', $className));
        $configEntityScope->set('test', 'entity_val');
        $configAnotherScope = new Config(new EntityConfigId('another', $className));
        $configAnotherScope->set('test', 'another_val');

        $this->configManager->expects($this->any())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(true);
        $this->configManager->expects($this->any())
            ->method('getConfig')
            ->with($this->isInstanceOf(EntityConfigId::class))
            ->willReturnCallback(
                function (EntityConfigId $configId) use ($className, $configEntityScope, $configAnotherScope) {
                    self::assertEquals($className, $configId->getClassName());
                    switch ($configId->getScope()) {
                        case 'entity':
                            return $configEntityScope;
                        case 'another':
                            return $configAnotherScope;
                        default:
                            return null;
                    }
                }
            );

        // test default scope
        $this->assertEquals(
            'entity_val',
            self::callTwigFunction($this->extension, 'oro_entity_config_value', [$className, 'test'])
        );
        // test with specified scope
        $this->assertEquals(
            'another_val',
            self::callTwigFunction($this->extension, 'oro_entity_config_value', [$className, 'test', 'another'])
        );
        // test undefined attribute
        $this->assertNull(
            self::callTwigFunction($this->extension, 'oro_entity_config_value', [$className, 'undefined'])
        );
    }

    public function testGetClassRouteForNullClassName()
    {
        $this->configManager->expects($this->never())
            ->method('hasConfig');

        $this->assertNull(self::callTwigFunction($this->extension, 'oro_entity_route', [null]));
    }

    public function testGetClassRouteNoConfig()
    {
        $className = 'Test\Entity';

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(false);
        $this->configManager->expects($this->never())
            ->method('getEntityMetadata');

        $this->assertNull(
            self::callTwigFunction($this->extension, 'oro_entity_route', [$className])
        );
    }

    public function testGetClassRouteInNonStrictMode()
    {
        $className = 'Test\Entity';
        $viewRoute = 'route_view';

        $metadata = $this->createMock(EntityMetadata::class);
        $metadata->expects($this->once())
            ->method('getRoute')
            ->with('view', false)
            ->willReturn($viewRoute);

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(true);
        $this->configManager->expects($this->once())
            ->method('getEntityMetadata')
            ->with($className)
            ->willReturn($metadata);

        $this->assertSame(
            $viewRoute,
            self::callTwigFunction($this->extension, 'oro_entity_route', [$className])
        );
    }

    public function testGetClassRouteShouldPassArgumentsToDelegatingMethod()
    {
        $className = 'Test\Entity';
        $createRoute = 'route_create';

        $metadata = $this->createMock(EntityMetadata::class);
        $metadata->expects($this->once())
            ->method('getRoute')
            ->with('create', $strict = true)
            ->willReturn($createRoute);

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(true);
        $this->configManager->expects($this->once())
            ->method('getEntityMetadata')
            ->with($className)
            ->willReturn($metadata);

        $this->assertSame(
            $createRoute,
            self::callTwigFunction($this->extension, 'oro_entity_route', [$className, 'create', $strict])
        );
    }

    public function testGetClassMetadataValueForNullClassName()
    {
        $this->configManager->expects($this->never())
            ->method('hasConfig');

        $this->assertNull(self::callTwigFunction($this->extension, 'oro_entity_metadata_value', [null, 'test']));
    }

    public function testGetClassMetadataValueNoConfig()
    {
        $className = 'Test\Entity';

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(false);
        $this->configManager->expects($this->never())
            ->method('getConfig');

        $this->assertNull(
            self::callTwigFunction($this->extension, 'oro_entity_metadata_value', [$className, 'test'])
        );
    }

    public function testGetClassMetadataValueNoAttr()
    {
        $className         = 'Test\Entity';
        $configEntityScope = new Config(new EntityConfigId('entity', $className));
        $configEntityScope->set('test', 'entity_val');
        $configAnotherScope = new Config(new EntityConfigId('another', $className));
        $configAnotherScope->set('test', 'another_val');

        $this->configManager->expects($this->any())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(true);

        $this->assertNull(
            self::callTwigFunction($this->extension, 'oro_entity_metadata_value', [$className, 'test'])
        );
    }

    public function testGetClassMetadataValue()
    {
        $className = 'Test\Entity';
        $attrName = 'routeView';
        $attrVal  = 'test_route';

        $metadata = $this->createMock(EntityMetadata::class);
        $reflection = new \ReflectionClass($metadata);
        $routeViewProp = $reflection->getProperty($attrName);
        $routeViewProp->setValue($metadata, $attrVal);

        $this->configManager->expects($this->once())
            ->method('hasConfig')
            ->with($className)
            ->willReturn(true);
        $this->configManager->expects($this->exactly(2))
            ->method('getEntityMetadata')
            ->with($className)
            ->willReturn($metadata);

        $this->assertSame(
            $attrVal,
            self::callTwigFunction($this->extension, 'oro_entity_metadata_value', [$className, $attrName])
        );
    }
}
