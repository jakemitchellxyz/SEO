<?php

namespace Pyncil\SEO\Tests;

/**
 * Class SEOServiceProviderTest.
 */
class SEOServiceProviderTest extends BaseTest
{
    /**
     * Verify if classes are in service container.
     *
     * @dataProvider bindsListProvider
     *
     * @param string $contract
     * @param string $concreteClass
     */
    public function test_container_are_provided($contract, $concreteClass)
    {
        $this->assertInstanceOf(
            $contract,
            $this->app[$concreteClass]
        );
    }

    /**
     * @return array
     */
    public function bindsListProvider()
    {
        return [
            [
                'Pyncil\SEO\Contracts\SEOGenerator',
                'Pyncil\SEO\SEOGenerator',
            ],
        ];
    }
}
