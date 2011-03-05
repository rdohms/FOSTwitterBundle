<?php
/**
 * Created by Amal Raghav <amal.raghav@gmail.com>
 * Date: 05/03/11
 */

namespace Kris\TwitterBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
    
class TwitterAnywhereExtension extends \Twig_Extension
{
    protected $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'twitter_anywhere_setup' => new \Twig_Filter_Method($this, 'renderSetup', array('is_safe' => array('html'))),
            'twitter_anywhere_initialize' => new \Twig_Filter_Method($this, 'renderInitialize', array('is_safe' => array('html'))),
            'twitter_anywhere_queue' => new \Twig_Filter_Method($this, 'queue', array('is_safe' => array('html'))),
            'twitter_anywhere_setConfig' => new \Twig_Filter_Method($this, 'setConfig', array('is_safe' => array('html'))),
        );
    }

    public function renderSetup($parameters = array(), $name = null)
    {
        return $this->container->get('kris_twitter.anywhere.helper')->setup($parameters, $name ?: 'KrisTwitterBundle::setup.html.twig');
    }

    public function renderInitialize($parameters = array(), $name = null)
    {
        return $this->container->get('kris_twitter.anywhere.helper')->initialize($parameters, $name ?: 'KrisTwitterBundle::initialize.html.twig');
    }

     /*
     *
     */
    public function queue($script)
    {
        return $this->container->get('kris_twitter.anywhere.helper')->queue($script);
    }

    /*
     *
     */
    public function setConfig($key, $value)
    {
        return $this->container->get('kris_twitter.anywhere.helper')->setConfig($key, $value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'twitter_anywhere';
    }
}