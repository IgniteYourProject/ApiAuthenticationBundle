<?php

namespace IgniteYourProject\ApiAuthenticationBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class IYPApiAuthenticationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['allowed_users'])) {
            $this->defineUserProvider($config['allowed_users'], $container);
        }
    }

    protected function defineUserProvider(array $arrUsers, ContainerBuilder $container)
    {
        $definition = new Definition('IgniteYourProject\ApiAuthenticationBundle\Security\UserProvider', [$arrUsers]);
        $definition->setPublic(false);
        $container->setDefinition('iyp_api.user_provider', $definition);
    }
}
