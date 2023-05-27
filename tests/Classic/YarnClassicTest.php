<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Classic;

use PHPUnit\Framework\TestCase;

class YarnClassicTest extends TestCase
{
    public function testPackages(): void
    {
        $yarnLock = [
            '@types/node@^18' => [
                'version' => '18.16.16',
                'resolved' => 'https://registry.yarnpkg.com/@types/node/-/node-18.16.16.tgz#3b64862856c7874ccf7439e6bab872d245c86d8e',
                'integrity' => 'sha512-NpaM49IGQQAUlBhHMF82QH80J08os4ZmyF9MkpCzWAGuOHqE4gTEbhzd7L3l5LmWuZ6E0OiC1FweQ4tsiW35+g==',
            ],
            'typescript@^5' => [
                'version' => '5.0.4',
                'resolved' => 'https://registry.yarnpkg.com/typescript/-/typescript-5.0.4.tgz#b217fd20119bd61a94d4011274e0ab369058da3b',
                'integrity' => 'sha512-cW9T5W9xY37cc+jfEnaUvX91foxtHkza3Nw3wkoF4sSlKn0MONdkdEndig/qPBWXNkmplh3NzayQzCiHM4/hqw==',
            ],
        ];

        $packages = (new YarnClassic())->packages($yarnLock);

        $this->assertCount(2, $packages);

        $this->assertSame('@types/node', $packages[0]->getName());
        $this->assertSame('18.16.16', $packages[0]->version);
        $this->assertSame('https://registry.yarnpkg.com/@types/node/-/node-18.16.16.tgz#3b64862856c7874ccf7439e6bab872d245c86d8e', $packages[0]->resolvedUrl);
        $this->assertSame('sha512-NpaM49IGQQAUlBhHMF82QH80J08os4ZmyF9MkpCzWAGuOHqE4gTEbhzd7L3l5LmWuZ6E0OiC1FweQ4tsiW35+g==', $packages[0]->integrity);
        $this->assertCount(1, $packages[0]->getConstraints()->all());
        $this->assertSame('^18', $packages[0]->getConstraints()->first()->getRange());

        $this->assertSame('typescript', $packages[1]->getName());
        $this->assertSame('5.0.4', $packages[1]->version);
        $this->assertSame('https://registry.yarnpkg.com/typescript/-/typescript-5.0.4.tgz#b217fd20119bd61a94d4011274e0ab369058da3b', $packages[1]->resolvedUrl);
        $this->assertSame('sha512-cW9T5W9xY37cc+jfEnaUvX91foxtHkza3Nw3wkoF4sSlKn0MONdkdEndig/qPBWXNkmplh3NzayQzCiHM4/hqw==', $packages[1]->integrity);
        $this->assertCount(1, $packages[1]->getConstraints()->all());
        $this->assertSame('^5', $packages[1]->getConstraints()->first()->getRange());
    }
}
