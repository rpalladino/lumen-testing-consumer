<?php
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\MockService\MockServerEnvConfig;

class PersonClientConsumerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var MockServerEnvConfig
     */
    private $config;

    /**
     * @var InteractionBuilder
     */
    private $pact;

    /**
     * @before
     */
    public function createPact()
    {
        $this->config = new MockServerEnvConfig();
        $this->pact = new InteractionBuilder($this->config);

        $this->pact
            ->given("a request for Peter Pan")
            ->uponReceiving("person data")
            ->with((new ConsumerRequest())
                ->setMethod("GET")
                ->setPath("/hello/Pan")
            )
            ->willRespondWith((new ProviderResponse())
                ->setStatus(200)
                ->setBody("Hello Peter Pan!")
            );
    }

    /**
     * @test
     */
    public function shouldFetchPersonGreeting()
    {
        $client = new PersonClient();
        $personResponse = $client->fetchPerson();
        $this->assertEquals($personResponse, "Hello Peter Pan!");
    }
}
